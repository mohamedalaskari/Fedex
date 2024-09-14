<?php

namespace App\Http\Controllers;

use App\Models\ContactCustomer;
use App\Http\Requests\StoreContactCustomerRequest;
use App\Http\Requests\StoreContactTypeRequest;
use App\Http\Requests\UpdateContactCustomerRequest;
use App\Http\Requests\UpdateContactTypeRequest;
use App\Models\ContactType;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class ContactCustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ContactCustomer $contactCustomer)
    {
        Gate::authorize('viewAny', $contactCustomer);
        $contactCustomer = $contactCustomer->get();
        return $this->response(code: 200, data: $contactCustomer);
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
    public function store(StoreContactCustomerRequest $request,ContactCustomer $contactCustomer,StoreContactTypeRequest $contact_type)
    {
        Gate::authorize('create',$contactCustomer);
        $request=str_replace(' ','',$request->validated());
        $contact_type=str_replace(' ','',$contact_type->validated());
        $contact_type_id=ContactType::all()->where('contact_type',$contact_type['contact_type'])->first()->id;
        $request['contact_type_id']=$contact_type_id;
        $customer_id=Auth::user()->tokenable_id;
        $request['customer_id']=$customer_id;
        $insert=ContactCustomer::create($request);
        return $this->response(code:200,data:$insert);

    }

    /**
     * Display the specified resource.
     */
    public function show(ContactCustomer $contactcustomer)
    {
        Gate::authorize('view', $contactcustomer);
        $id = $contactcustomer->id;
        $contactCustomer_data = ContactCustomer::with(['customer', 'contact_type'])->find($id);
        return $this->response(code: 200, data: $contactCustomer_data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContactCustomer $contactCustomer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateContactCustomerRequest $request, ContactCustomer $contactCustomer, UpdateContactTypeRequest $contact_type)
    {
        Gate::authorize('update', $contactCustomer);
        //contact
        $request = str_replace(' ','',$request->validated());
        //customer_id
        $customer_id = Auth::user()->id;
        //contact-type_id
        $contact_type = str_replace(' ','',$contact_type->validated());
        $array_valus = implode(array_values($contact_type));
        $data_ontact_type = ContactType::all()->where('contact_type', "$array_valus")->first()->id;

        $request['customer_id'] = $customer_id;
        $request['contact_type_id'] = $data_ontact_type;
        //update_data
        $updata = DB::table('contact_customers')->where('contact', $request['contact_old'])
            ->update(['customer_id' => $request['customer_id'], 'contact_type_id' => $request['contact_type_id'], 'contact' => $request['contact']]);
        return $this->response(code:201,data:$updata);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactCustomer $contactCustomer)
    {
        //
    }
    public function delete(ContactCustomer $ContactCustomer)
    {
        Gate::authorize('delete', $ContactCustomer);
        $delete =$ContactCustomer->delete();
        return $this->response(code:204);
    }
    public function deleted()
    {
        return ContactCustomer::onlyTrashed()->get();
    }
    public function restore($ContactCustomer)
    {
        $restore= ContactCustomer::where('id', $ContactCustomer)->restore();
        return $this->response(code:200);
    }
    public function delete_from_trash($ContactCustomer)
    {
        return ContactCustomer::where('id', $ContactCustomer)->forceDelete();
    }
}
