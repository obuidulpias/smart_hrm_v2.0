<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'card_number' => 'required|unique:employees',
            'punch_number' => 'required|unique:employees',
            'email' => 'required|unique:employees',
            'phone_number' => 'required|numeric|min:11',
            'name' => 'required|string',
            'gender' => 'required|numeric',
            'nid' => 'required|unique:employees',
            'company_id' => 'required|integer',
            'location_id' => 'required|integer',
            'department_id' => 'required|integer',
            'designation_id' => 'required|integer',
            'joining_date' => 'required|date',
        ];
    }

    /**
     * Get the validation error messages that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function messages(): array
    {
        return [
            'email.required' => 'Please enter the registered email address',
            'email.email' => 'Please enter a valid email address',
            'email.unique' => 'Please enter a unique email address',
        ];
    }
}
