<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RoleCreateRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                Rule::unique('roles')->where(function ($query) {
                    $query->whereNull('deleted_at');
                }),
            ],
        ];
    }
    public function messages(){
        return [
            'name.required' => 'Please Enter Role Name',
            'name.unique'=>'Roles already exists. Enter new one'
        ];
    }
}
