<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\StoreCountryRequest;
use App\Models\Employee;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\StoreJobEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Requests\UpdateJobEmployeeRequest;
use App\Models\Branch;
use App\Models\Country;
use App\Models\JobEmployee;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Employee $employee)
    {
        Gate::authorize('viewAny', $employee);
        $employee = $employee->get();
        return $this->response(code: 200, data: $employee);
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
    public function store(StoreEmployeeRequest $request, StoreCountryRequest $country, StoreJobEmployeeRequest $job_title, StoreBranchRequest $branch_id, Employee $employee)
    {
        Gate::authorize('create', $employee);
        $request =  $request->validated();
        //age
        $age = Carbon::createFromDate($request['birth_date'])->diff(carbon::now())->format('%y');
        //country_id
        $country =  str_replace(' ', '', $country->validated());
        $data_country = Country::all()->where('country', $country['country'])->first()->id;
        //job_employee_id
        $job_title =  str_replace(' ', '', $job_title->validated());
        $data_JobEmployee = JobEmployee::all()->where('job_title', $job_title['job_title'])->first()->id;
        //branch_id
        $branch_id =  str_replace(' ', '', $branch_id->validated());
        $data_Branch = Branch::all()->where('address', $branch_id['address'])->first()->id;
        //insert_data
        $request['age'] = $age;
        $request['job_employee_id'] = $data_JobEmployee;
        $request['country_id'] = $data_country;
        $request['branch_id'] = $data_Branch;
       $request['password'] = Hash::make($request['password']);

        $insert_employee = Employee::create($request);
        //insert_user
        $data = [
            'email' => $insert_employee['email'],
            'password' => $insert_employee['password'],
            'role' => $insert_employee['role'],
        ];
        $data['tokenable_type'] = 'employee';
        $data['tokenable_id'] = $insert_employee['id'];
        $insert_user = User::create($data);
       return  $this->response(code: 200, data: $insert_employee);
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        Gate::authorize('view', $employee);
        $id = $employee->id;
        $employe = Employee::with(['EmployeeChildren', 'contactemployee', 'jobEmployee', 'country'])->find($id);
        return $this->response(code: 200, data: $employee);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee, UpdateJobEmployeeRequest $request_Jobemployee, StoreCountryRequest $country, StoreBranchRequest $branch)
    {
        Gate::authorize('update', $employee);
        $request =  str_replace(' ', '', $request->validated());
        $age = Carbon::createFromDate($request['birth_date'])->diff(carbon::now())->format('%y');
        $request_Jobemployee = $request_Jobemployee->validated();
        $array_valus = $request_Jobemployee['job_title'];
        $data = JobEmployee::all()->where('job_title', "$array_valus")->first()->id;
        $country =  str_replace(' ', '', $country->validated());
        $array_valus = implode(array_values($country));
        $data_country = Country::all()->where('country', "$array_valus")->first()->id;
        $branch =  str_replace(' ', '', $branch->validated());
        $array_valus = $branch['address'];
        $data_branch = Branch::all()->where('address', "$array_valus")->first()->id;

        $request['job_employee_id'] = $data;
        $request['country_id'] = $data_country;
        $request['branch_id'] = $data_branch;
        $request['age'] = $age;

        $employee_id = Auth::user()->tokenable_id;
        $id = Auth::user()->id;

        $updata_employee = DB::table('employees')->where('id', $employee_id)->update([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'birth_date' => $request['birth_date'],
            'email' => $request['email'],
            'password' => $request['password'],
            'employee_image' => $request['employee_image'],
            'age' => $request['age'],
            'country_id' => $request['country_id'],
            'branch_id' => $request['branch_id'],
            'job_employee_id' => $request['job_employee_id'],
        ]);
        $update_user = DB::table('users')->where('id', $id)->update(['email' => $request['email'], 'password' => $request['password']]);
        return $this->response(code: 201, data: $update_user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        //
    }
    public function delete(Employee $employee)
    {
        Gate::authorize('delete', $employee);
        $delete= $employee->delete();
        return $this->response(code:204);
    }
    public function deleted()
    {
        return Employee::onlyTrashed()->get();
    }
    public function restore($employee)
    {
        $restore= Employee::where('id', $employee)->restore();
        return $this->response(code:200);
    }
    public function delete_from_trash($employee)
    {
        return Employee::where('id', $employee)->forceDelete();
    }
}
