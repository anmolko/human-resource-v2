<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionCreateRequest extends FormRequest
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
            'name'=> 'required|unique:permissions',
            'key'=> 'required|unique:permissions',
            'module_id'=> 'required',
        ];
    }



    public function messages()
    {
        return [
            'name.required'=> 'Please Enter Permission Name',
            'name.max'=>'Name must be less than 100 character',
            'key.required'=> 'Please Enter Key',
            'module_id.required'=> 'Please Select Module',

        ];
    }
}
