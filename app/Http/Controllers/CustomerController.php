<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCountryRequest;
use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Country;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Customer $customer)
    {
        Gate::authorize('viewAny', $customer);
        $customer = $customer->get();
        return $this->response(data: $customer, code: "200");
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
    public function store(StoreCustomerRequest $request, StoreCountryRequest $country)
    {
        $request = str_replace(' ', '', $request->validated());
        //caLculate age
        $age = Carbon::createFromDate($request['birth_date'])->diff(carbon::now())->format('%y');
        //    //country_id
        $country = str_replace(' ', '', $country->validated());
        $array_valus = implode(array_values($country));
        $data_country = Country::all()->where('country', "$array_valus")->first();
        $request['age'] = $age;
        $request['country_id'] = $data_country['id'];
        $request['password'] = Hash::make($request['password']);
        $request['role'] = ['guest'];

        //insert_customer
        $insert_customer = Customer::create($request);

        // insert_user
        $data = [
            'email' => $insert_customer['email'],
            'password' => $insert_customer['password'],
            'role' => $insert_customer['role'],
        ];
        $data['tokenable_type'] = 'Customer';
        $data['tokenable_id'] = $insert_customer['id'];
        $insert_user = User::create($data);
        return  $this->response(code: 201, data: $insert_customer);
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        Gate::authorize('view', $customer);
        $id = $customer->id;
        $customers = Customer::with('ContactCustomer', 'country')->find($id);
        return $this->response(code: 200, data: $customers);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer, StoreCountryRequest $country)
    {
        Gate::authorize('update', $customer);
        $request = str_replace(' ', '', $request->validated());
        //caLculate age
        $age = Carbon::createFromDate($request['birth_date'])->diff(carbon::now())->format('%y');
        //    //country_id
        $country = str_replace(' ', '', $country->validated());
        $array_valus = implode(array_values($country));
        $data_country = Country::all()->where('country', "$array_valus")->first()->id;
        $request['age'] = $age;
        $request['country_id'] = $data_country;
        $request['password'] = Hash::make($request['password']);
        $customer_id = Auth::user()->tokenable_id;
        $id = Auth::user()->id;


        //UPDATA
        $update_customer = DB::table('customers')->where('id', $customer_id)->update([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'birth_date' => $request['birth_date'],
            'email' => $request['email'],
            'password' => $request['password'],
            'customer_image' => $request['customer_image'],
            'age' => $request['age'],
            'country_id' => $request['country_id'],

        ]);
        $update_user=DB::table('users')->where('id',$id)->update(['email'=>$request['email'],'password'=>$request['password']]);

        return $this->response(code:201,data:$update_user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
    public function delete(Customer $Customer)
    {
        Gate::authorize('delete', $Customer);
        $delete= $Customer->delete();
        return $this->response(code:204);
    }
    public function deleted()
    {
        return Customer::onlyTrashed()->get();
    }
    public function restore($Customer)
    {
        $restore= Customer::where('id', $Customer)->restore();
        return $this->response(code:200);
    }
    public function delete_from_trash($Customer)
    {
        return Customer::where('id', $Customer)->forceDelete();
    }
}
