<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ThemeSettingUpdateRequest extends FormRequest
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
            'website_name'=> 'required|max:50|unique:theme_settings,website_name,'.$id,
            'logo' => 'image|mimes:jpeg,png,jpg',
            'favicon' => 'image|mimes:jpeg,png,jpg',
            ];
    }

    public function messages()
    {
        return [
            'website_name.required'=> 'Please Enter Website Name',
            'website_name.unique'=> 'The Website Name Has Been Already Taken',
            'website_name.max'=>'Website name must be less than 50 character',
        ];
    }
}
