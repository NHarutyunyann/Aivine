<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            // 'email' => 'required|string|max:100',
            'email' => 'required|string|max:100',
            'password' => 'required|string|min:8',
        ];
    }

    public function messages()
    {
        return [
            'email' => 'Էլ․հասցե դաշտը  պարտադիր է:',
            'password' => 'Գաղտնաբառերը դաշտը Սխալ է',
        ];
    }
}
