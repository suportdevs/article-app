<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserPermission;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $item_count = $request->item_count ?? $this->getSetting();
        $view = $request->ajax() ? 'backend.users._list' : 'backend.users.index';

        return view($view, [
            'page_title'    => 'Users',
            'dataset'       => User::filter($request)->orderBy('id', 'DESC')->paginate($item_count)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        return view("backend.users.edit", [
            'page_title'    => "User Edit",
            'data'          => User::find(decrypt($id))
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
        return redirect()->route(app()->master->routePrefix . 'users.index')->with('success', 'Record inserted successfull.');
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
