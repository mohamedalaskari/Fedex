<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{

    public function index(User $user)
    {
        Gate::authorize('viewAny',$user);
        $users = $user->get();
        return $this->response(code: 200, data: $users);
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
    public function store($request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    // public function show(Country $country)
    // {
    //     $id=$country->id;
    //     $country_data=Country::with(['employee','customer','branch'])->find($id);
    //     return $country_data;
    // }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($country)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($request,  $country)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    // public function destroy( $country)
    // {
    //     //
    // }
}
