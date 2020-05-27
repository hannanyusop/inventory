<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;


class UpdateCustomersRequest extends FormRequest
{

    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email|unique:customers,email,'.request('id'),
            'phone_number' => '',
            'address' => ''
        ];
    }
}
