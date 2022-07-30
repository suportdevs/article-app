<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\HomeController;
use App\Models\Settings\BusinessType;
use App\Models\Settings\Company;
use App\Services\SearchValue;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Str;

class CompanyController extends HomeController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {

        Gate::authorize('company_list');
        $perPageCount = $request->item_count ?? $this->getSettings()->pagesize;
        $view         = $request->ajax() ? 'settings.company._list' : 'settings.company.index';

        return view($view, [
            'page_title' => 'Company List',
            'dataset' => Company::filter($request)->latest()->paginate($perPageCount),
            'companies' => BusinessType::pluck('name', 'id'),
            'searchValues' => SearchValue::searchItem($request)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Gate::authorize('company_create');
        return view('settings.company.create',[
            'page_title' => 'Create new company',
            'companies' => BusinessType::pluck('name', 'id')
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFactoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Gate::authorize('company_create');
        $request->validate([
            'business_type_id' => 'required',
            'name' => 'required|string|unique:companies|max:255',
            'route_name' => 'required|string'
        ]);

        Company::create([
            'business_type_id' => $request->business_type_id,
            'name' => $request->name,
            'route_name' => $request->route_name,
            'mobile' => $request->mobile,
            'phone' => $request->phone,
            'address' => $request->address,
            'created_by' => Auth::id(),
            '_key' => Str::random(30)
        ]);
        if($request->new ?? false)
        {
            return redirect()->route('company.create')->with('success', 'Successfully Company Created');
        }
        return redirect()->route('company.index')->with('success', 'Successfully Company Created');
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        Gate::authorize('company_edit');
        return view('settings.company.edit', [
            'page_title' => 'Update Company',
            'data'    => $company,
            'companies' => BusinessType::pluck('name', 'id')
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFactoryRequest  $request
     * @param  \App\Models\Setting\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile' => 'required|max:20'
        ]);

        $company->update([
            'business_type_id' => $request->business_type_id,
            'name' => $request->name,
            'mobile' => $request->mobile,
            'phone' => $request->phone,
            'address' => $request->address,
            'updated_by' => Auth::id(),
        ]);
        return redirect()->route('company.index')->with('success','Successfully Company Updated');
    }

    public function delete(Request $request)
    {
        try {
            DB::beginTransaction();
            foreach ($request->data as $key) {
                $data = Company::with('factories')->where('_keys', $key)->first();
                if($data->factories()->count() == 0){
                    $data->delete();
                    DB::commit();
                    return 'succesfully deleted';
                }
                return "$data->name has many Factory, Please delete them first!";
            }
        } catch (\Exception $error) {
            DB::rollback();
            return response()->json($error->getMessage(), $error->getCode());
        }
    }


}