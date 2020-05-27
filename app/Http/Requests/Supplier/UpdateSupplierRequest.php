<?php

namespace App\Http\Requests\Supplier;

use Illuminate\Foundation\Http\FormRequest;


class UpdateSupplierRequest extends FormRequest
{

    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'email|unique:suppliers,email,'.request('id'),
            'phone_number' => '',
            'address' => ''
        ];
    }
}
