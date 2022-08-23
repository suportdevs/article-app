<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SubscriberController extends Controller
{
    public function index(Request $request)
    {
        $itemCount = $request->item_count ?? 25;
        $view = $request->ajax() ? 'backend.subscriber._list' : 'backend.subscriber.index';

        return view($view, [
            'page_title'    => 'Subscriber List',
            'dataset'       => Subscriber::filter($request)->latest()->paginate(2)
        ]);
    }

    public function create()
    {
        return view('backend.subscriber.create', ['page_title' => 'Subscriber Create']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:subscribers'
        ]);
        DB::beginTransaction();
        try{
            Subscriber::create(['email' => $request->email, '_key' => uniqid(32)]);
            DB::commit();
            return redirect()->route(app()->master->routePrefix . 'subscriber.index')->with('success', 'Record inserted successfull.');
        }catch(\Exception $e){
            DB::rollback();
            return back()->with('error', 'Something went wrong while inserting! ' . $e->getMessage());
        }
    }

    public function delete(Request $request)
    {
        DB::beginTransaction();
        try{
            foreach($request->data as $key){
                $data = Subscriber::where('_key', $key)->firstOrFail();
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
