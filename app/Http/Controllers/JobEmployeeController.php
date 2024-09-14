<?php

namespace App\Http\Controllers;

use App\Models\JobEmployee;
use App\Http\Requests\StoreJobEmployeeRequest;
use App\Http\Requests\UpdateJobEmployeeId;
use App\Http\Requests\UpdateJobEmployeeRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class JobEmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(JobEmployee $jobEmployee)
    {
        Gate::authorize('viewAny',$jobEmployee);
        $jobEmployee = $jobEmployee->get();
        return $this->response(code: 200, data: $jobEmployee);
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
    public function store(StoreJobEmployeeRequest $request,JobEmployee $jobEmployee)
    {
        Gate::authorize('create',$jobEmployee);
        $request = str_replace(' ', '', $request->validated());
        $insert_data = JobEmployee::create($request);
        return $this->response(code: 201, data: $insert_data);
    }

    /**
     * Display the specified resource.
     */
    public function show(JobEmployee $jobEmployee)
    {
        Gate::authorize('view',$jobEmployee);
        $id = $jobEmployee->id;
        $jobEmployee = JobEmployee::with('Employee')->find($id);
        return $this->response(code: 200, data: $jobEmployee);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(JobEmployee $jobEmployee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateJobEmployeeRequest $request, JobEmployee $jobEmployee,UpdateJobEmployeeId $jop_employee_id)
    {
        Gate::authorize('update',$jobEmployee);
        $request = str_replace(' ', '', $request->validated());
        $jop_employee_id=str_replace(' ', '',$jop_employee_id->validated());
        $id=$jop_employee_id['id'];
        $updata=DB::table('job_employees')->where('id',$id)->update(['job_title'=>$request['job_title']]);
        return $this->response(code:201,data:$updata);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(JobEmployee $jobEmployee)
    {
        //
    }
    public function delete(JobEmployee $jobEmployee)
    {
        Gate::authorize('delete',$jobEmployee);
        $delete= $jobEmployee->delete();
        return $this->response(code:204);
    }
    public function deleted()
    {
        return JobEmployee::onlyTrashed()->get();

    }
    public function restore($jobEmployee)
    {
         $restore=JobEmployee::where('id', $jobEmployee)->restore();
         return $this->response(code:200);
    }
    public function delete_from_trash($jobEmployee)
    {
        return JobEmployee::where('id', $jobEmployee)->forceDelete();
    }
}
