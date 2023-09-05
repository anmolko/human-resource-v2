<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ModuleUpdateRequest extends FormRequest
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
            'name'=> 'required|unique:modules,name,'.$id,
            'key'=> 'required|unique:modules,key,'.$id,
            'url'=> 'required|unique:modules,url,'.$id,
            ];
    }
    public function messages(){
        return [
            'name.required' => 'Please Enter Module Name',
            'name.unique'=>'Module already exists. Enter new one',
            'key.required' => 'Please Enter Module Key',
            'key.unique'=>'Module key already exists. Enter new one',
            'url.required' => 'Please Enter Module URL',
            'url.unique'=>'Module url already exists. Enter new one',


        ];


    }
}

