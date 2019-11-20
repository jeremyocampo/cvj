<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'landline' => ['required'],
            'fax' => ['required'],
            'mobile' => ['required'],
            'payment_terms' => ['required'],
            'company_address' => ['required'],
            'billing_address' => ['required'],
            'supplier_type' => ['required'],
            'remarks' => ['required']
        ];
    }
}
