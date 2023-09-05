<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;


class RoleUpdateRequest extends FormRequest
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
            'name'=> 'required|unique:roles,name,'.$id,
        ];
    }
    public function messages(){
        return [
            'name.required' => 'Please Enter Role Name',
            'name.unique'=>'Roles already exists. Enter new one'
        ];


    }
}
