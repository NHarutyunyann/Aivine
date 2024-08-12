<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class ProfileUpdateRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:225',
            'email' => 'required|string|max:100|unique:users,id,' . auth()->user()->id,
            "current_password" =>"required_with:password|nullable|current_password",
            "password" =>"password|confirmed|nullable|different:current_password|required_with:current_password|max:50",
            "password_confirmation" =>"password|nullable|required_with:password|required_with:current_password"
        ];
    }

    public function messages()
    {
        return [
        ];
    }
}
