<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class TicketingAgentUpdateRequest extends FormRequest
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
            'company_name'=> 'unique:ticketing_agent,company_name,'.$id,
            ];
    }
    public function messages(){
        return [
            'company_name.unique'=> 'The Company Name Has Been Already Use',
        ];

    }
}
