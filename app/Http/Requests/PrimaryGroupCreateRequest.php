<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrimaryGroupCreateRequest extends FormRequest
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
            'name'=> 'required|max:50|unique:primary_groups',
            'slug'=> 'required|unique:primary_groups',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=> 'Please Enter Primary Group Name',
            'name.unique'=> 'The Primary Group Name Has Been Already Taken',
            'name.max'=>'Name must be less than 50 character',
            'slug.required'=> 'Please Enter slug',
            'slug.unique'=> 'The Primary Group slug Has Been Already Taken',

        ];
    }
}
