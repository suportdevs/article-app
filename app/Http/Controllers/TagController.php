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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // dd($request->tag_name);
        $paginateCount = $request->item_count ?? 25;
        $view = $request->ajax() ? "backend.tags._list" : "backend.tags.index";
        return view($view, [
            'page_title' => 'Tags',
            'dataset' => Tag::filter($request)->paginate($paginateCount)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.tags.create', ['page_title' => "Tags"]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            $request->validate([
                'name' => 'required|unique:tags'
            ]);
            Tag::create([
                'name'          => $request->name,
                'slug'          => Str::slug($request->name),
                'created_by'    => Auth::guard('admin')->user()->id,
                '_key'          => Str::random(32)
            ]);
            DB::commit();
            return redirect()->route('admin.tags.index')->with('success', 'Record inserted successfull.');
        }catch(\Exception $e){
            DB::rollback();
            return back()->with('error', 'Something went wrong while inserting!');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('backend.tags.edit', [
            'page_title'    => 'Tags Edit',
            'data'          => Tag::find(Crypt::decrypt($id))
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:tags',
        ]);

        DB::beginTransaction();
        try{
            Tag::find($id)->update([
                'name'          => $request->name,
                'slug'          => Str::slug($request->name),
                'updated_by'    => Auth::guard('admin')->user()->id,
            ]);
            DB::commit();
            return redirect()->route('admin.tags.index')->with('success', 'Record updated successfull.');
        }catch(\Exception $e){
            DB::rollBack();
            return back()->with('error', 'Something went wrong while updating!');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
            // return response()->json($e->getMessage(), $e->getCode());
            return "Something went wrong while record deleting!";
        }
    }
}
