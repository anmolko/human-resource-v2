<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BranchOfficeCreateRequest extends FormRequest
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
        return [
            'ref_no'=> 'required|max:50|unique:branch_offices',
            'branch_office_name'=> 'required|unique:branch_offices',
        ];
    }

    public function messages()
    {
        return [
            'ref_no.required'=> 'Please Enter Ref No.',
            'ref_no.unique'=> 'The Ref No. Has Been Already Taken',
            'ref_no.max'=>'Ref No. must be less than 50 character',
            'branch_office_name.required'=> 'Please Enter Branch Office Name',
            'branch_office_name.unique'=> 'The  Branch Office Name Has Been Already Taken',

        ];
    }
}
