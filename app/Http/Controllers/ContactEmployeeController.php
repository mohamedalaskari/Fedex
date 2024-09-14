<?php

namespace App\Http\Controllers;

use App\Models\ContactEmployee;
use App\Http\Requests\StoreContactEmployeeRequest;
use App\Http\Requests\StoreContactTypeRequest;
use App\Http\Requests\UpdateContactEmployeeRequest;
use App\Http\Requests\UpdateContactTypeRequest;
use App\Models\ContactType;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ContactEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ContactEmployee $contactEmployee)
    {
        Gate::authorize('viewAny',$contactEmployee);
        $contactEmployee = $contactEmployee->get();
        return $this->response(code: 200, data: $contactEmployee);
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
    public function store(StoreContactEmployeeRequest $request,StoreContactTypeRequest $contact_type)
    {
        $request=str_replace(' ', '', $request->validated());
        $contact_type=str_replace(' ', '', $contact_type->validated());
        $contact_type_id=ContactType::all()->where('contact_type',$contact_type['contact_type'])->first()->id;
        $request['contact_type_id']=$contact_type_id;
        $employee_id=Auth::user()->tokenable_id;
        $request['employee_id']=$employee_id;
        $insert=ContactEmployee::create($request);
        return $this->response(code:200,data:$insert);
    }

    /**
     * Display the specified resource.
     */
    public function show(ContactEmployee $contactEmployee)
    {
        Gate::authorize('view',$contactEmployee);
        $id = $contactEmployee->id;
        $contactemployee_data = ContactEmployee::with(['Employee', 'contact_type'])->find($id);
        return $this->response(code: 200, data: $contactemployee_data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContactEmployee $contactEmployee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactEmployeeRequest $request, ContactEmployee $contactEmployee ,UpdateContactTypeRequest  $contact_type)
    {
        Gate::authorize('update',$contactEmployee);
        $request = str_replace(' ', '', $request->validated());
        //customer_id
        $employee_id = Auth::user()->id;
        //contact-type_id
        $contact_type = $contact_type->validated();
        $contact_type = str_replace(' ', '', $contact_type);
        $array_valus = implode(array_values($contact_type));
        $data_ontact_type = ContactType::all()->where('contact_type', "$array_valus")->first()->id;

        $request['employee_id'] = $employee_id;
        $request['contact_type_id'] = $data_ontact_type;
        // //update_data
        $updata = DB::table('contact_employees')->where('contact', $request['contact_old'])
            ->update(['employee_id' => $request['employee_id'], 'contact_type_id' => $request['contact_type_id'], 'contact' => $request['contact']]);
        return $this->response(code:201,data:$updata);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactEmployee $contactEmployee)
    {
        //
    }
    public function delete(ContactEmployee $contactemployee)
    {
        Gate::authorize('delete',$contactemployee);
        $delete= $contactemployee->delete();
        return $this->response(code:204);
    }
    public function deleted()
    {
        return ContactEmployee::onlyTrashed()->get();
    }
    public function restore($contactemployee)
    {
        $restore= ContactEmployee::where('id', $contactemployee)->restore();
        return $this->response(code:200);
    }
    public function delete_from_trash($contactemployee)
    {
        return ContactEmployee::where('id', $contactemployee)->forceDelete();
    }
}
