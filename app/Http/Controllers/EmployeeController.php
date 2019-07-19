<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Employment;

use App\Models\Assignment;
use App\Models\AssignmentRole;
use App\Models\AssignmentLeave;
use App\Models\AssignmentLocation;

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

        // produce array of all employments for the employee
        $employments = Employment::select('employments.*', 'employers.name AS employer', 'current_employments.employee_id AS current')
                       ->join('employers', 'employers.id', '=', 'employments.employer_id')
                       ->leftJoin('current_employments', 'current_employments.employment_id', '=', 'employments.id',
                       'AND', 'current_employments.employee_id', '=', 'employments.employee_id')
                       ->where('employments.employee_id', $employee['id'])
                       ->orderBy('current', 'desc')
                       ->orderBy('end_date', 'desc')
                       ->orderBy('start_date', 'desc')
                       ->get();

        // Add assignments to employments array
        foreach($employments as $index => $employment) {
            $assignments = Assignment::select('assignments.*')
                            ->where('employment_id', $employment->id)
                            ->get();

            // Add roles, leaves, locations to each assignment
            foreach($assignments as $i => $assignment) {

                // get roles for each assignment
                $assignmentRoles = AssignmentRole::select('assignment_roles.*')
                ->where('assignment_id', $assignment->id)
                ->get();

                $assignments[$i]['roles'] = $assignmentRoles;

                // get leaves for each assignment
                $assignmentLeaves = AssignmentLeave::select('assignment_leaves.*')
                ->where('assignment_id', $assignment->id)
                ->get();

                $assignments[$i]['leaves'] = $assignmentLeaves;

                // get locations for each assignment
                $assignmentLocations = AssignmentLocation::select('assignment_locations.*')
                ->where('assignment_id', $assignment->id)
                ->get();

                $assignments[$i]['locations'] = $assignmentLocations;
            }

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
