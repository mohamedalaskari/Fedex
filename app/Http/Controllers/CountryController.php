<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Country $country)
    {
        Gate::authorize('viewAny', $country);
        $country = $country->get();
        return $this->response(code: 200, data: $country);
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
    public function store(StoreCountryRequest $request, Country $country)
    {
        Gate::authorize('create', $country);
        $request = str_replace(' ', '', $request->validated());
        $data = Country::create($request);
        return $this->response(code: 201, data: $data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Country $country)
    {
        Gate::authorize('view', $country);
        $id = $country->id;
        $country_data = Country::with(['employee', 'customer', 'branch'])->find($id);
        return $this->response(code: 200, data: $country_data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Country $country)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCountryRequest $request, Country $country)
    {
        Gate::authorize('update', $country);
        $request = str_replace(' ', '', $request->validated());
        $update = DB::table('countries')->where('country', $request['country_old'])->update(['country' => $request['country']]);
        return $this->response(code: 201, data: $update);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Country $country)
    {
        //
    }
    public function delete(Country $country)
    {
        Gate::authorize('delete', $country);
        $delete= $country->delete();
        return $this->response(code:204);
    }
    public function deleted()
    {
        return Country::onlyTrashed()->get();
    }
    public function restore($country)
    {
        $restore= Country::where('id', $country)->restore();
        return $this->response(code:200);
    }
    public function delete_from_trash($country)
    {
        return Country::where('id', $country)->forceDelete();
    }
}
