<?php
namespace App\Repositories;

use App\Models\Employee;
use App\Repositories\BaseRepository;
use Carbon\Carbon;

class EmployeeRepository extends BaseRepository
{
    protected $employee;
    public function __construct(Employee $employee)
    {
        $this->employee = new BaseRepository($employee);
    }
    public function create($data)
    {
        //return $this->employee->create($data);
        //dd($data);
        //$employee = $this->employee;
        $employee = new Employee();
        //dd($data["user_id"]);
        $employee->user_id = $data["user_id"];
        $employee->name = $data["name"];
        $employee->email = $data["email"];
        $employee->phone_number = $data["phone_number"];
        $employee->father_name = $data["father_name"];
        $employee->mother_name = $data["mother_name"];
        $employee->gender = $data["gender"];
        //$employee->birth_date = date('Y-M-d', strtotime($data["birth_date"]));
        $employee->birth_date = new Carbon($data["birth_date"]);
        $employee->company_id = $data["company_id"];
        $employee->location_id = $data["location_id"];
        $employee->department_id = $data["department_id"];
        $employee->designation_id = $data["designation_id"];
        //$employee->joining_date = date('Y-M-d', strtotime($data["joining_date"]));
        $employee->joining_date = new Carbon($data["joining_date"]);
        $employee->gross_salary = $data["gross_salary"];
        $employee->save();
        return $this->response = apiResponse("");
    }
}