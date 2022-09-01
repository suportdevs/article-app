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

    public function access($key)
    {
        $user = User::where('_key', decrypt($key))->first();
        // dd($user);
        return view('backend.users.access', [
            'page_title'        => 'User Permission List',
            'user' => $user,
        ]);
    }

    public function saveAccess(Request $request, $id)
    {
        $permission = UserPermission::where('user_id', decrypt($id))->first();
        $access = json_encode($request->access);
        if(!is_null($permission)){
            $model = $permission;
        } else {
            $model = new UserPermission();
        }
        $model->user_id = $id;
        $model->items   = $access;
        $model->created_at = Carbon::now();
        $model->updated_at = Carbon::now();
        // if(!$model->save()){
        //     return back()->with('error', 'Something went wrong while inserting!');
        // }
        $model->save();
        return redirect()->route(app()->master->routePrefix . 'users.index')->with('success', 'Record inserted successfull.');
    }
}
