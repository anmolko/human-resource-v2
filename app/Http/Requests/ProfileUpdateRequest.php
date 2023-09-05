<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProfileUpdateRequest extends FormRequest
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
            'name'=> 'required',
            'email'=> 'required',
            'dob'=> 'required',
            'gender'=> 'required',
            'address'=> 'required',
            'contact'=> 'required',
        ];
    }

    public function messages(){
        return [
            'name.required'=> 'Please Enter Company Name',
            'email.required'=> 'Please Enter Company Address',
            'dob.required'=> 'Please Enter Phone Number',
            'gender.required'=> 'Please Enter Mobile Number',
            'address.required'=> 'Please Type Company Name For Slug',
            'contact.required'=> 'Please Type Company Name For Slug',
        ];
    }
}
