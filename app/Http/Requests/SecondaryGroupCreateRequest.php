<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SecondaryGroupCreateRequest extends FormRequest
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
            'name'=> 'required|max:50|unique:secondary_groups',
            'slug'=> 'required|unique:secondary_groups',
            'primary_group_id'=> 'required',

        ];
    }

    public function messages()
    {
        return [
            'name.required'=> 'Please Enter Secondary Group Name',
            'name.unique'=> 'The Secondary Group Name Has Been Already Taken',
            'name.max'=>'Name must be less than 50 character',
            'slug.required'=> 'Please Enter slug',
            'slug.unique'=> 'The Secondary Group slug Has Been Already Taken',
            'primary_group_id.required'=> 'Please Select Primary Group',

        ];
    }
}
