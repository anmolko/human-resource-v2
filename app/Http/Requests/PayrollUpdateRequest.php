<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PayrollUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id=Request::segment(2);

        return [
            'employee_id'=> 'required|unique:payrolls,employee_id,'.$id,
            'employee_type'=> 'required',
            'basic_salary'=> 'required',
        ];
    }

    public function messages()
    {
        return [
            'employee_id.required'=> 'Please choose a employee to add payroll details.',
            'employee_id.unique'=>'The chosen employee payroll info exists. Please make changes to existing one or remove and create new one.',
            'employee_type.required'=> 'Please choose a employee type.',
            'basic_salary.required'=> 'Please choose a basic salary.',
        ];
    }
}
