<?php

namespace App\Http\Requests\PurchaseOrder;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AddRequest extends FormRequest
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
            'reference_number' => ['required'],
            'billing_address' => ['required'],
            'expected_delivery_date' => ['required', 'date'],
            'shipment_preferences' => ['required'],
            'items' => ['required', 'array'],
            'supplier_id' => ['required', Rule::exists('supplier', 'supplier_id')],
        ];
    }
}
