<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateBranchRequest;
use App\Models\Country;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Branch $branch)
    {
        Gate::authorize('all',$branch);
        $branch=$branch->get();
        return $this->response(code: 200, data: $branch);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBranchRequest $request, Branch $branch, StoreCountryRequest $country)
    {
        Gate::authorize('create',$branch);
        $request = str_replace(' ','',$request->validated());
        //country_id
        $country = str_replace(' ','',$country->validated());
        $array_valus = implode(array_values($country));
        $data_country = Country::all()->where('country', "$array_valus")->first()->id;
        //insert_country_id
        $request['country_id'] = $data_country;

        $data = Branch::create($request);
        return $this->response(code: 201, data: $data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        Gate::authorize('show',$branch);
        $id = $branch->id;
        $Branch_data = Branch::with(['country', "contact_branch", 'order'])->find($id);
        return $this->response(code: 200, data: $Branch_data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBranchRequest $request, Branch $branch, StoreCountryRequest $country)
    {
        Gate::authorize('update',$branch);
        $request = $request->validated();
        $request = str_replace(' ', '', $request);
        //country_id
         $country = $country->validated();
         $country = str_replace(' ', '', $country);
         $array_valus = implode(array_values($country));
         $data_country = Country::all()->where('country', "$array_valus")->first()->id;
        // //update
         $request["country_id"] = $data_country;
         $id = $request['id'];
         $update = DB::table('branches')->where('id', $id)->update(['address' => $request['address'], 'country_id' => $request['country_id']]);
        return $this->response(code: 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        //
    }
    public function delete(Branch $branch)
    {
        Gate::authorize('delete',$branch);
        $delete= $branch->delete();
        return $this->response(code:204);
    }
    public function deleted()
    {
        return Branch::onlyTrashed()->get();
    }
    public function restore($branch)
    {
        $restore= Branch::where('id', $branch)->restore();
         return $this->response(code:200);;
    }
    public function delete_from_trash($branch)
    {
        return Branch::where('id', $branch)->forceDelete();
    }
}
