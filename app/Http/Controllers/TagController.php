<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index(Request $request)
    {
        $paginateCount = $request->item_count ?? 25;
        $view = $request->ajax() ? "backend.tags._list" : "backend.tags.index";
        return view($view, [
            'page_title' => 'Tags',
            'dataset' => Tag::filter($request)->paginate($paginateCount)
        ]);
    }

    public function create()
    {
        return view('backend.tags.create', ['page_title' => "Tags"]);
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name' => 'required|unique:tags'
        ]);
        DB::beginTransaction();
        try{
            Tag::create([
                'name'          => $request->name,
                'slug'          => Str::slug($request->name),
                'created_by'    => Auth::user()->id,
                '_key'          => Str::uniqid(32)
            ]);
            DB::commit();
            return redirect()->route(app()->master->routePrefix . 'tags.index')->with('success', 'Record inserted successfull.');
        }catch(\Exception $e){
            DB::rollback();
            return back()->with('error', 'Something went wrong while inserting! ' . $e->getMessage());
        }
        
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view('backend.tags.edit', [
            'page_title'    => 'Tags Edit',
            'data'          => Tag::find(Crypt::decrypt($id))
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required'
        ]);
        DB::beginTransaction();
        try{
            Tag::find($id)->update([
                'name'          => $request->name,
                'slug'          => Str::slug($request->name),
                'updated_by'    => Auth::user()->id,
            ]);
            DB::commit();
            return redirect()->route(app()->master->routePrefix . 'tags.index')->with('success', 'Record updated successfull.');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('error', 'Something went wrong while updating! '. $e->getMessage());
        }

    }

    public function destroy($id)
    {
        //
    }
    
    public function delete(Request $request)
    {
        DB::beginTransaction();
        try{
            foreach($request->data as $key){
                $data = Tag::where('_key', $key)->firstOrFail();
                $data->delete();
            }
            DB::commit();
            return "Record deleted successfull.";
        }catch(\Exception $e){
            DB::rollBack();
            return "Something went wrong while record deleting! " . $e->getMessage();
        }
    }
}
