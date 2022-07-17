<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $paginateCount = $request->item_count ?? 25;

        $view = $request->ajax() ? 'backend.posts._list' : 'backend.posts.index';

        return view($view, [
            'page_title' => 'Post',
            'categories' => Category::pluck('name', 'id'),
            'tags' => Tag::pluck('name', 'id'),
            'dataset' => Post::filter($request)->paginate($paginateCount)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.posts.create', [
            'page_title' => 'Post',
            'categories' => Category::pluck('name', 'id'),
            'tags' => Tag::pluck('name', 'id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            DB::beginTransaction();

            $attributes = $request->validated();
            $attributes['slug']         = Str::slug($request->title);
            $attributes['created_by'] = Auth::guard('admin')->user()->id;
            $attributes['_key']         = Str::random(32);
            Post::create($attributes);
            
            DB::commit();
            return redirect()->route('admin.post.index')->with('success', 'Record inserted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Something went while inserting!');
        }
    }

    /**
     * Image upload by Ckeditor
     */
    public function imageUpload(Request $request)
    {
        if($request->hasFile('upload')){
            $orginalName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($orginalName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $finalName = $fileName.'_'.time().'.'.$extension;

            // $request->file('upload')->move(public_path('media'), $finalName);
            $img = Image::make(public_path('media'), $finalName)->resize(1680, 1200);
            dd($img);
            $request->file('upload')->move(public_path('media'), $finalName);

            $url = asset('media/'.$finalName);


            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
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
        //
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
        //
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
}
