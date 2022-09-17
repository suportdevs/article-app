<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function index($key)
    {
        return view("backend.profile.index", [
            'page_title'    => 'User Profile',
            'dataset'       => User::where("_key", $key)->firstOrFail()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function profileUpdate($key)
    {
        
    }
    
    public function profile($key)
    {
        return view("backend.profile.index", [
            'page_title'    => 'User Profile',
            'dataset'       => User::where("_key", $key)->firstOrFail()
        ]);
    }

    public function access($key)
    {
        $user = User::where('_key', decrypt($key))->first();
        $_permission = UserPermission::where('user_id', $user->id)->first();
        $permission = json_decode($_permission->items ?? '{}', true);
        return view('backend.profile.access', [
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
        return redirect()->route(app()->master->routePrefix . 'profile.index')->with('success', 'Record inserted successfull.');
    }

    public function profileEdit($key)
    {
        $user = User::where('id', decrypt($key))->first();
        return view('backend.profile.edit', [
            'page_title'        => 'User Profile',
            'data'              => $user,
        ]);
    }
}
