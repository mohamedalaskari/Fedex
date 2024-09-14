<?php

namespace App\Http\Controllers;

use App\Models\EmployeeChildren;
use App\Http\Requests\StoreEmployeeChildrenRequest;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeChildrenRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;

class EmployeeChildrenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(EmployeeChildren $employeeChildren)
    {
        Gate::authorize('viewAny',$employeeChildren);
        $employeeChildren = $employeeChildren->get();
        return $this->response(code: 200, data: $employeeChildren);
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
    public function store(StoreEmployeeChildrenRequest $request,EmployeeChildren $employeeChildren)
    {
        Gate::authorize('create',$employeeChildren);
        $request = str_replace(' ', '', $request->validated());
        //age
        $age = Carbon::createFromDate($request['birth_date'])->diff(carbon::now())->format('%y');
        $request['age'] = $age;
        $request['role'] = ['employeeChildren'];
        $request['password'] = Hash::make($request['password']);
        //insert_data
        $employeeChildren = EmployeeChildren::create($request);
        // return $employeeChildren;
        //insert_user
        $data = [
            'email' => $employeeChildren['email'],
            'password' => $employeeChildren['password'],
            'role' => $employeeChildren['role'],
        ];
        $data['tokenable_type'] = 'employeeChildren';
        $data['tokenable_id'] = $employeeChildren['id'];
        $insert_user = User::create($data);
        return  $this->response(code: 201, data: $employeeChildren);
    }

    /**
     * Display the specified resource.
     */
    public function show(EmployeeChildren $employeeChildren)
    {
        Gate::authorize('view',$employeeChildren);
        $id = $employeeChildren->id;
        $employeeChildrens = EmployeeChildren::with('Employee')->find($id);
        return $this->response(code: 200, data: $employeeChildrens);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EmployeeChildren $employeeChildren)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeChildrenRequest $request, EmployeeChildren $employeeChildren)
    {
        Gate::authorize('update',$employeeChildren);
        $request = str_replace(' ', '', $request->validated());
        $age = Carbon::createFromDate($request['birth_date'])->diff(carbon::now())->format('%y');
        $request['age']=$age;
        $employeechildren_id = Auth::user()->tokenable_id;
        $id = Auth::user()->id;
        $update_employee_children=DB::table('employee_childrens')->where('id',$employeechildren_id)->update([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'birth_date' => $request['birth_date'],
            'email' => $request['email'],
            'password' =>  Hash::make($request['password']),
            'employee_childern_image' => $request['employee_childern_image'],
            'age' => $request['age'],
        ]);
$update_user=DB::table('users')->where('id',$id)->update([
    'email'=>$request['email'],'password'=>Hash::make($request['password'])
]
);
return $this->response(code:201,data:$update_user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EmployeeChildren $employeeChildren)
    {
        //
    }
    public function delete(EmployeeChildren $employeeChildren)
    {
        Gate::authorize('delete',$employeeChildren);
        $delete= $employeeChildren->delete();
        return $this->response(code:204);
    }
    public function deleted()
    {
        return EmployeeChildren::onlyTrashed()->get();
    }
    public function restore($employeeChildren)
    {
        $restore= EmployeeChildren::where('id', $employeeChildren)->restore();
        return $this->response(code:200);
    }
    public function delete_from_trash($employeeChildren)
    {
        return EmployeeChildren::where('id', $employeeChildren)->forceDelete();
    }
}
