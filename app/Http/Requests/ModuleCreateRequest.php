<?php

namespace App\Http\Requests;

use App\Rules\ModuleRankUniqueRule;
use Illuminate\Foundation\Http\FormRequest;

class ModuleCreateRequest extends FormRequest
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
            'name'=> 'required|max:50|unique:modules',
            'key'=> 'required|unique:modules',
            'url'=> 'required',
            'rank' => ['required', new ModuleRankUniqueRule()],

        ];
    }

    public function messages()
    {
        return [
            'name.required'=> 'Please Enter Module Name',
            'name.unique'=> 'The Module Name Has Been Already Taken',
            'name.max'=>'Name must be less than 50 character',
            'key.required'=> 'Please Enter Key',
            'url.required'=> 'Please Enter Url',
        ];
    }
}
