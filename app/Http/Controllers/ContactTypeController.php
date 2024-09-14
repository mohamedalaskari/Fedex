<?php

namespace App\Http\Controllers;

use App\Models\ContactType;
use App\Http\Requests\StoreContactTypeRequest;
use App\Http\Requests\UpdateContactTypeRequest;
use Illuminate\Support\Facades\Gate;

class ContactTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ContactType $contactType)
    {
        Gate::authorize('viewAny',$contactType);
        $contactType = $contactType->get();
        return $this->response(code: 200, data: $contactType);
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
    public function store(StoreContactTypeRequest $request,ContactType $contactType)
    {
        Gate::authorize('create',$contactType);
        $request = str_replace(' ', '', $request->validated());
        $contactType_data = contacttype::create($request);
        return $this->response(code: 201, data: $contactType_data);
    }

    /**
     * Display the specified resource.
     */
    public function show(ContactType $contactType)
    {
        Gate::authorize('view',$contactType);
        $id = $contactType->id;
        $contactType_data = ContactType::with(['Contactemployee', 'Contactcustomer', 'Contactbranch'])->find($id);
        return $this->response(code: 200, data: $contactType_data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContactType $contactType)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactTypeRequest $request, ContactType $contactType)
    {
//
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactType $contactType)
    {
        //
    }
    public function delete(ContactType $contactType)
    {
        Gate::authorize('delete',$contactType);
        $delete= $contactType->delete();
        return $this->response(code:204);
    }
    public function deleted()
    {
        return ContactType::onlyTrashed()->get();
    }
    public function restore($contactType)
    {
        $restore= ContactType::where('id', $contactType)->restore();
        return $this->response(code:200);
    }
    public function delete_from_trash($contactType)
    {
        return ContactType::where('id', $contactType)->forceDelete();
    }
}
