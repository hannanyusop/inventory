<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;


class UpdatePasswordRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'password' => 'required',
            'new_password' => 'required|confirmed|min:5',
            'new_password_confirmation' => 'required'
        ];
    }
}
