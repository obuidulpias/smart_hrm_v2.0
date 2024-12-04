<?php

namespace App\Http\Controllers\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Employee\EmployeeRequest;
use App\Models\Employee;
use App\Models\User;
use App\Repositories\EmployeeRepository;
use Illuminate\Http\Request;
use Auth;

class EmployeeController extends Controller
{
    protected $employee;
    public function __construct(Employee $employee)
    {
        $this->employee = new EmployeeRepository($employee);
    }
    /**
     * Function : New Employee create
     * @param mixed \App\Http\Requests\Employee\EmployeeRequest;
     * @return \Response
     */
    public function create(EmployeeRequest $request)
    {

        return $this->employee->create($request);
    }

    /**
     * Function : Get all employee
     * @return response
     */
    public function list()
    {
        return $this->employee->all();
    }
}
