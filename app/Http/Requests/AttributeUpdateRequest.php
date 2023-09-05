<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AttributeUpdateRequest extends FormRequest
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
            'name'=> 'required|max:50|unique:attributes,name,'.$id,
            'slug'=> 'required|unique:attributes,slug,'.$id,
        ];
    }

    public function messages()
    {
        return [
            'name.required'=> 'Please Enter Attribute Name',
            'name.unique'=> 'The Attribute Name Has Been Already Taken',
            'name.max'=>'Name must be less than 50 character',
            'slug.required'=> 'Please Enter slug',
            'slug.unique'=> 'The Attribute slug Has Been Already Taken',

        ];
    }
}
