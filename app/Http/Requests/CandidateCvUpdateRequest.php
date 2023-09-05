<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class CandidateCvUpdateRequest extends FormRequest
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
            'candidate_personal_information_id'=> 'unique:candidate_cv,candidate_personal_information_id,'.$id,
            ];
    }
    public function messages(){
        return [
            'candidate_personal_information_id.unique'=> 'The Candidate Name Has Been Already Use',
        ];

    }
}
