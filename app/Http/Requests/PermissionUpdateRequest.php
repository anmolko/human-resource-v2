<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PermissionUpdateRequest extends FormRequest
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
            'name'=> 'required|unique:permissions,name,'.$id,
            'key'=> 'required|unique:permissions,key,'.$id,
            'module_id'=> 'required',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Please Enter Permission Name',
            'name.unique' => 'Permission already exists. Enter new one',
            'key.required' => 'Please Enter Permission Key',
            'module_id.required' => 'Module Must be chosen for permission',
            'key.unique' => 'Permission Key already exists. Enter new one'

        ];


    }
}
