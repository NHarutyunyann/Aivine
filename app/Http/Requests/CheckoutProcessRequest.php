<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutProcessRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'payment_type' => 'in:on_deliver,bank_transfer',
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'address' => 'required|string|max:200',
            'city' => 'required|string',
            'phone_number' => 'required|string',
            'additional_info' => 'nullable|string',
            'cart' => 'required|array',
        ];
    }
}
