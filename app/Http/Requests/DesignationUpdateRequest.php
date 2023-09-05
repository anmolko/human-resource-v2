<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class DesignationUpdateRequest extends FormRequest
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
            'name'=> 'required|max:50|unique:designations,name,'.$id,
        ];
    }

    public function messages()
    {
        return [
            'name.required'=> 'Please Enter Designation Name.',
            'name.unique'=> 'The Designation Name Has Been Already Taken',
            'name.max'=>'Designation Name must be less than 50 character',

        ];
    }
}
