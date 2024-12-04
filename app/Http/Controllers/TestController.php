<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function testOrm()
    {
        //$employess = Employee::with('phone')->get();
        //$employess = User::with('user_phone')->get();
        //$employess = Employee::with('user_phone')->get();
        //dd($employess);
        Employee::select('id as ID', 'name as FULL_NAME')
            ->whereIn('id', function ($query) {
                $query->select('emp_code')
                    ->from('users')
                    ->where('user_type', 1);
            })->get();
        $employees = Employee::paginate(2);
        /*
        Employee::chunk(2, function ($users) {
            foreach ($users as $user) {
                echo $user->name . "<br>";
            }
        });
        */
        //dd($employees);
        //return apiResponse($employees);
        return view("test", ["employees" => $employees]);
    }
}
