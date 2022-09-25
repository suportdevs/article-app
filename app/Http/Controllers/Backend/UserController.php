<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function index(Request $request)
    {
        Gate::authorize("user_list");
        $item_count = $request->item_count ?? $this->getSetting();
        $view = $request->ajax() ? 'backend.users._list' : 'backend.users.index';

        return view($view, [
            'page_title'    => 'Users List',
            'dataset'       => User::filter($request)->orderBy('id', 'DESC')->paginate($item_count)
        ]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }
    
    public function show($id)
    {
        Gate::authorize("user_show");
        return view("backend.users.show", [
            'page_title'    => "User Details",
            'data'          => User::find(decrypt($id))
        ]);
    }

    public function edit($id)
    {
        Gate::authorize("user_edit");
        return view("backend.users.edit", [
            'page_title'    => "User Edit",
            'data'          => User::find(decrypt($id))
        ]);
    }

    public function update(UpdateUserRequest $request, $id)
    {
        try{
            DB::beginTransaction();
            $user = User::find(decrypt($id));
            $imageUrl = '';
            if($request->hasFile('avatar')){
                if($request->file('avatar') != '' && !empty($user->avatar)){
                    unlink($user->avatar);
                }
                $fileName = hexdec(uniqid());
                $extension = $request->file('avatar')->getClientOriginalExtension();
                $finalName = $fileName . '_' . time() . '.' . $extension;

                $imageUrl = 'user/avatar/' . $finalName;
                
                $attributes = $request->validated();
                $attributes['avatar']       = $imageUrl ?? 'user/avatar/default.png';
                $attributes['slug']         = Str::slug($request->username);
                $attributes['locale']       = $request->locale;
                $attributes['updated_by']   = Auth::user()->id;
                $attributes['_key']         = Str::random(32);
                $user->update($attributes);

                Image::make($request->file('avatar'))->resize(250, 200)->save(public_path('user/avatar/') . $finalName);
                
            } else {
                $attributes = $request->validated();
                $attributes['slug']         = Str::slug($request->username);
                $attributes['locale']       = $request->locale;
                $attributes['updated_by']   = Auth::user()->id;
                $attributes['_key']         = Str::random(32);
                $user->update($attributes);
            }

            DB::commit();
            return redirect()->route(app()->master->routePrefix . 'user.index')->with('success', 'Record inserted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        //
    }

    public function access($key)
    {
        $user = User::where('_key', decrypt($key))->first();
        $_permission = UserPermission::where('user_id', $user->id)->first();
        $permission = json_decode($_permission->items ?? '{}', true);
        return view('backend.users.access', [
            'page_title'        => 'User Permission List',
            'user'              => $user,
            'permission'        => $permission
        ]);
    }

    public function saveAccess(Request $request, $id)
    {
        $permission = UserPermission::where('user_id', decrypt($id))->first();
        $access = json_encode($request->access);
        if(!is_null($permission)){
            $permission->update([
                'user_id'   => $request->user_id,
                'items'     => $access
            ]);
        } else {
            UserPermission::create([
                'user_id'   => $request->user_id,
                'items'     => $access
            ]);
        }
        return redirect()->route(app()->master->routePrefix . 'user.index')->with('success', 'Record inserted successfull.');
    }

    public function profile($key)
    {
        $user = User::where('id', decrypt($key))->first();
        return view('backend.users.edit', [
            'page_title'        => 'User Profile',
            'data'              => $user,
        ]);
    }
}
