<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanySettingCreateRequest extends FormRequest
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
            'company_name'=> 'required|max:50|unique:company_settings',
            'company_address'=> 'required',
            'email'=> 'required',
            'phone'=> 'required',
            'mobile'=> 'required',
            'pan_number'=> 'required',
            'to'=> 'required',
            'from'=> 'required',
            'slug'=> 'required',
            'company_logo' => 'required|image|mimes:jpeg,png,jpg',
        ];
    }

    public function messages()
    {
        return [
            'company_name.required'=> 'Please Enter Company Name',
            'company_name.unique'=> 'The Company Name Has Been Already Taken',
            'company_name.max'=>'Name must be less than 50 character',
            'company_address.required'=> 'Please Enter Company Address',
            'pan_number.required'=> 'Please Enter the Company PAN Number',
            'from.required'=> 'Please Enter the opening period date',
            'to.required'=> 'Please Enter the ending period date',
            'mobile.required'=> 'Please Enter Mobile Number',
            'slug.required'=> 'Please Type Company Name For Slug',
            'company_logo.required'=> 'Please select company logo',
        ];
    }
}
