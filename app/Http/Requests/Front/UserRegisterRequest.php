<?php

namespace App\Http\Requests\Front;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:users|string|max:100',
            'phone' => 'required|string|max:225',
            'email' => 'required|unique:users|string|max:100',
            'password' => 'required|string|min:8',
            'confirm_password' => 'required_with:password|same:password|min:6'

        ];
    }

    public function messages()
    {
        return [
            'name' => 'Անուն դաշտը պարտադիր է:',
            'phone' => 'Հեռախոսահամար դաշտը պարտադիր է:',
            'email' => 'Էլ․հասցե դաշտը պարտադիր է:',
            'password' => 'Գաղտնաբառերը դաշտը պարտադիր է',
            'confirm_password' => 'Գաղտնաբառերը չեն համընկնում։',
        ];
    }
}
