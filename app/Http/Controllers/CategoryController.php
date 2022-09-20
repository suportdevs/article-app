<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize('category_list');
        $paginateCount = $request->item_count ?? 25;

        $view = $request->ajax() ? 'backend.category._list' : 'backend.category.index';
        return view($view, [
            'page_title'    => 'Category',
            'dataset'       => Category::filter($request)->paginate($paginateCount)
        ]);
    }

    public function create()
    {
        return view('backend.category.create', [
            'page_title' => 'Category'
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories'
        ]);

        DB::beginTransaction();
        try{
            Category::create([
                'name'          => $request->name,
                'slug'          => Str::slug($request->name),
                'description'   => $request->description,
                'created_by'    => Auth::user()->id,
                '_key'          => Str::random(32)
            ]);
            DB::commit();
            return redirect()->route(app()->master->routePrefix . 'category.index')->with('success', 'Record inserted successfull.');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('error', 'Something went wrong while inserting! ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        return view('backend.category.edit', [
            'page_title'        => 'Category',
            'data'              => Category::find(decrypt($id))
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);
        DB::beginTransaction();
        try{
            Category::find($id)->update([
                'name'          => $request->name,
                'slug'          => Str::slug($request->name),
                'description'   => $request->description,
                'updated_by'    => Auth::user()->id
            ]);
            DB::commit();
            return redirect()->route(app()->master->routePrefix . 'category.index')->with('success', 'Record inserted successfull.');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('error', 'Something went wrong while updating! ' . $e->getMessage());
        }
    }

    public function delete(Request $request)
    {
        DB::beginTransaction();
        try{
            foreach($request->data as $key){
                $data = Category::where('_key', $key)->firstOrFail();
                $data->delete();
            }
            DB::commit();
            return 'Record inserted successfull.';
        } catch(\Exception $e){
            DB::rollBack();
            return 'Something went wrong while deleting!';
        }
    }
}
