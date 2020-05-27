<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ManageUserRequest.
 */
class InsertCustomerRequest extends FormRequest
{

    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    public function rules()
    {
        return [
           'name' => 'required',
            'email' => 'email|unique:customers',
            'phone_number' => '',
            'address' => ''
        ];
    }
}
