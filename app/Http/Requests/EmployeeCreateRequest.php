<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeCreateRequest extends FormRequest
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
            'email'=> 'required|unique:users',
            'image' => 'image|mimes:jpeg,png,jpg',
            'cv' => 'mimes:jpeg,png,jpg,pdf,doc,docx',
            'citizenship' => 'mimes:jpeg,png,jpg,pdf,doc,docx',
        ];
    }

    public function messages()
    {
        return [
            'email.required'=> 'Please enter email',
            'email.unique'=> 'The Email Has Been Already Taken',
        ];
    }
}
