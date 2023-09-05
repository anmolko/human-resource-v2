<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class DepartmentUpdateRequest extends FormRequest
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
            'name'=> 'required|max:50|unique:departments,name,'.$id,
        ];
    }

    public function messages()
    {
        return [
            'name.required'=> 'Please Enter Department Name.',
            'name.unique'=> 'The Department Name Has Been Already Taken',
            'name.max'=>'Department Name must be less than 50 character',

        ];
    }
}
