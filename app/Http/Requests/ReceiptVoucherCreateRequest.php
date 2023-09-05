<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReceiptVoucherCreateRequest extends FormRequest
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
            'date'=> 'required',
            'narration'=> 'required',
            'ref_no'=> 'required|unique:receipt_vouchers',
        ];
    }


    public function messages()
    {
        return [
            'date.required'=> 'Please select date',
            'narration.required'=> 'Please write narration',
            'ref_no.unique'=> 'The Voucher No. Has Been Already Taken',
        ];
    }
}
