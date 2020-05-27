<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ManageUserRequest.
 */
class InsertSupplierRequest extends FormRequest
{

    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    public function rules()
    {
        return [
           'name' => 'required',
            'email' => 'email|unique:suppliers',
            'phone_number' => '',
            'address' => ''
        ];
    }
}
