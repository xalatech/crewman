<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Employment;
use App\Models\Assignment;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::select('employees.*', 'employers.name AS employer')
                    ->leftJoin('current_employments', 'current_employments.employee_id', '=', 'employees.id')
                    ->leftJoin('employments', 'employments.id', '=', 'current_employments.employment_id')
                    ->leftJoin('employers', 'employers.id', '=', 'employments.employer_id')
                    ->orderBy('first_name', 'asc')
                    ->orderBy('last_name', 'asc')
                    ->get();
        
        /* another method to get current employment
        $result = array();
        foreach($employees as $employee) {
            $latestEmployment = Employment::select('name')
                                ->join('employers', 'employers.id', '=', 'employments.employer_id')
                                ->where('employee_id', $employee['id'])
                                ->orderBy('start_date', 'desc')
                                ->first();

            $employee['employer'] = $latestEmployment['name']; 
            $result[] = $employee;
        }
        */
        return $employees;
    }

     /**
     * Get Employment profile by employee_id.
     *
     * @param  int  $employee_id
     * @return \Illuminate\Http\Response
     */
    public function profile($employee_id)
    {
        $result = array();
        $employee = Employee::select('*')
                    ->where('employees.id', $employee_id)
                    ->first();
        
        // add employee record to the object
        $result['employee'] = $employee;

        // produce array of employments for the employee
        $employments = Employment::select('employments.*', 'current_employments.employment_id AS current', 'employers.name AS employer')
                       ->join('employers', 'employers.id', '=', 'employments.employer_id')
                       ->leftJoin('current_employments', 'current_employments.employment_id', '=', 'employments.id', 
                       'AND', 'current_employments.employee_id', '=', 'employments.employee_id')
                       ->where('employments.employee_id', $employee['id'])
                       ->get();

    
        foreach($employments as $index => $employment) {
            $assignments = Assignment::select('assignments.*')
                            ->where('employment_id', $employment->id)
                            ->get();
          
            $employments[$index]['assignments'] = $assignments;
        }
        
        $result['employee']['employments'] = $employments;
       
     

        return $result;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
