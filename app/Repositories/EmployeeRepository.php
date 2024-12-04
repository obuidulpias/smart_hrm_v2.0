<?php
namespace App\Repositories;

use App\Models\Employee;
use App\Repositories\BaseRepository;
use Auth;
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
        try {
            //dd($data);
            $employee_arr = [
                'card_number' => $data['card_number'],
                'punch_number' => $data['punch_number'],
                'name' => $data['name'],
                'email' => $data['email'],
                'phone_number' => $data['phone_number'],
                'father_name' => $data['father_name'],
                'mother_name' => $data['mother_name'],
                'gender' => $data['gender'],
                'birth_date' => new Carbon($data['birth_date']),
                'nid' => $data['nid'],
                'company_id' => $data['company_id'],
                'location_id' => $data['location_id'],
                'department_id' => $data['department_id'],
                'designation_id' => $data['designation_id'],
                'joining_date' => new Carbon($data['joining_date']),
                'gross_salary' => $data['gross_salary'],
                'status' => 1,
                'is_deleted' => 0,
                'created_by' => Auth::user()->id,
                'updated_by' => '',
            ];
            $this->employee->create($employee_arr);
            return $this->response = apiResponse($employee_arr);
        } catch (\Exception $e) {
            return $this->response = errorResponse('', $e);
            //return response()->json(['error' => $e->getMessage(), 'line' => $e->getLine(),], 500);
        }
    }

    public function all()
    {
        try {
            $employees = $this->employee->all();
            return $this->response = apiResponse($employees);
        } catch (\Exception $e) {
            return $this->response = errorResponse('', $e);
        }
    }
}