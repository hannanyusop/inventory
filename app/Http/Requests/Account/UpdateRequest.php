<?php

namespace App\Http\Requests\Account;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ManageUserRequest.
 */
class UpdateRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'email|required|unique:users,email,'.auth()->user()->id,
            'first_name' => 'required|min:2',
            'last_name' => 'required|min:2',
        ];
    }
}
