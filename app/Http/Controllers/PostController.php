<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
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

    public function create()
    {
        return view('backend.posts.create', [
            'page_title' => 'Post',
            'categories' => Category::pluck('name', 'id'),
            'tags' => Tag::pluck('name', 'id')
        ]);
    }

    public function store(StorePostRequest $request)
    {
        try{
            DB::beginTransaction();
            $imageUrl = '';
            if($request->hasFile('image')){
                $fileName = hexdec(uniqid());
                $extension = $request->file('image')->getClientOriginalExtension();
                $finalName = $fileName . '_' . time() . '.' . $extension;

                $imageUrl = 'media/featured/' . $finalName;
                
                $attributes = $request->validated();
                $attributes['tag_id']       = json_encode($request->tag_id);
                $attributes['image']        = $imageUrl;
                $attributes['slug']         = Str::slug($request->title);
                $attributes['created_by']   = Auth::user()->id;
                $attributes['_key']         = Str::random(32);
                Post::create($attributes);

                Image::make($request->file('image'))->resize(1600, 1066)->save(public_path('media/featured/') . $finalName);
                
                DB::commit();
                return redirect()->route(app()->master->routePrefix . 'post.index')->with('success', 'Record inserted successfully.');
            } else {
                return back()->with('error', 'Post image required!');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function imageUpload(Request $request)
    {
        if($request->hasFile('upload')){
            $fileName = hexdec(uniqid());
            $extension = $request->file('upload')->getClientOriginalExtension();
            $finalName = $fileName .'_'.time().'.'.$extension;

            Image::make($request->file('upload'))->resize(1600, 1066)->save(public_path('media/') . $finalName);

            // $request->file('upload')->move(public_path('media/'), $finalName);

            $url = asset('media/'.$finalName);

            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }

    public function show($id)
    {
        return view('backend.posts.show', [
            'page_title'    => 'Post Details',
            'data'          => Post::find(decrypt($id))
        ]);
    }

    public function edit($id)
    {
        return view('backend.posts.edit', [
            'page_title' => 'Post',
            'data' => Post::find(decrypt($id)),
            'categories' => Category::pluck('name', 'id'),
            'tags' => Tag::pluck('name', 'id')
        ]);
    }


    public function update(StorePostRequest $request, $id)
    {
        try{
            DB::beginTransaction();
            $post  = Post::find($id);
            $imageUrl = '';
            if($request->hasFile('image')){
                if($request->file('image') != '' && !empty($post->image)){
                    unlink($post->image);
                }
                $fileName = hexdec(uniqid());
                $extension = $request->file('image')->getClientOriginalExtension();
                $finalName = $fileName . '_' . time() . '.' . $extension;

                $imageUrl = 'media/featured/' . $finalName;
                
                $attributes = $request->validated();
                $attributes['tag_id']       = json_encode($request->tag_id);
                $attributes['image']        = $imageUrl;
                $attributes['slug']         = Str::slug($request->title);
                $attributes['created_by']   = Auth::guard('admin')->user()->id;
                $attributes['_key']         = Str::random(32);
                $post->update($attributes);

                Image::make($request->file('image'))->resize(1600, 1066)->save(public_path('media/featured/') . $finalName);

                DB::commit();
                return redirect()->route('admin.post.index')->with('success', 'Record inserted successfully.');
            } else {
                $attributes = $request->validated();
                $attributes['tag_id']       = json_encode($request->tag_id);
                $attributes['slug']         = Str::slug($request->title);
                $attributes['created_by']   = Auth::guard('admin')->user()->id;
                $attributes['_key']         = Str::random(32);
                $post->update($attributes);
                
                DB::commit();
                return redirect()->route('admin.post.index')->with('success', 'Record inserted successfully.');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }
    public function publish($key)
    {
        DB::beginTransaction();
        try{

            Post::where('_key', decrypt($key))->update(['status' => 'Published']);
            DB::commit();
            return back()->with('success', 'Post published successfull.');
        } catch (\Exception $e){
            DB::rollBack();
            // return response()->json($e->getMessage(), $e->getCode());
            return "Something went wrong while record deleting!";
        }
    }

    public function delete(Request $request)
    {
        DB::beginTransaction();
        try{
            foreach($request->data as $key){
                $data = Post::where('_key', $key)->firstOrFail();
                if(!empty($data->image) && file_exists($data->image)){
                    unlink($data->image);
                }

                $data->delete();
            }
            DB::commit();
            return "Record deleted successfull.";
        }catch(\Exception $e){
            DB::rollBack();
            return response()->json($e->getMessage(), $e->getCode());
        }
    }
}
