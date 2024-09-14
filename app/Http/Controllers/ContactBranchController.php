<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBranchRequest;
use App\Models\ContactBranch;
use App\Http\Requests\StoreContactBranchRequest;
use App\Http\Requests\StoreContactTypeRequest;
use App\Http\Requests\UpdateBranchRequest;
use App\Http\Requests\UpdateContactBranchRequest;
use App\Http\Requests\UpdateContactTypeRequest;
use App\Models\Branch;
use App\Models\ContactType;
use App\Models\Country;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ContactBranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ContactBranch $contactBranch)
    {
        Gate::authorize('viewAny', $contactBranch);
        $contactBranch = $contactBranch->get();
        return $this->response(code: 200, data: $contactBranch);
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
    public function store(StoreContactBranchRequest $request, ContactBranch $contactBranch, StoreBranchRequest $branch, StoreContactTypeRequest $contact_type)
    {
        Gate::authorize('create', $contactBranch);

        $request = str_replace(' ', '', $request->validated());
        $branch = str_replace(' ', '', $branch->validated());
        $branch = Branch::all()->where('address', $branch['address'])->first()->id;
        $contact_type = str_replace(' ', '', $contact_type->validated());
        $contact_type = ContactType::all()->where('contact_type', $contact_type['contact_type'])->first()->id;
        $request['branch_id'] = $branch;
        $request['contact_type_id'] = $contact_type;
        $insert = ContactBranch::create($request);
        return $this->response(code: 200, data: $insert);
    }

    /**
     * Display the specified resource.
     */
    public function show(ContactBranch $contactBranch)
    {
        Gate::authorize('view', $contactBranch);
        $id = $contactBranch->id;
        $contactBranch_data = ContactBranch::with(['branch', 'contact_type'])->find($id);
        return $this->response(code: 200, data: $contactBranch_data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContactBranch $contactBranch)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactBranchRequest $request, ContactBranch $contactBranch, updateContactTypeRequest $contact_type, UpdateBranchRequest $branch)
    {
        Gate::authorize('update', $contactBranch);
        //contact branch
        $request = str_replace(' ', '', $request->validated());
        //contact_type_id
        $contact_type = str_replace(' ', '', $contact_type->validated());
        $array_valus = implode(array_values($contact_type));
        $data_country = ContactType::all()->where('contact_type', "$array_valus")->first()->id;
        $request['contact_type_id'] = $data_country;
        $branch = $branch->validated();
        $data_branch = Branch::all()->where('address', $branch['address'])->first()->id;
        $request['branch_id'] = $data_branch;
        $update = DB::table('contact_branches')->where('id', $branch['id'])->update([
            'contact' => $request['contact'],
            'contact_type_id' => $request['contact_type_id'],
            'branch_id' => $request['branch_id'],
        ]);
        return $this->response(code:201,data:$update);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactBranch $contactBranch)
    {
        //
    }
    public function delete(ContactBranch $contactBranch)
    {
        Gate::authorize('delete', $contactBranch);
        $delete = $contactBranch->delete();
        return $this->response(code: 204);
    }
    public function deleted()
    {
        return ContactBranch::onlyTrashed()->get();
    }
    public function restore($contactBranch)
    {
        $restore = ContactBranch::where('id', $contactBranch)->restore();
        return $this->response(code: 200);
    }
    public function delete_from_trash($contactBranch)
    {
        return ContactBranch::where('id', $contactBranch)->forceDelete();
    }
}
