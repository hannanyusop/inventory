<?php

namespace App\Http\Requests\Item;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class ManageUserRequest.
 */
class UpdateItemRequest extends FormRequest
{

    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    public function rules()
    {
        return [
            'code' => 'required|unique:items,code,'.request('id'),
            'name' => 'required',
//            'image_url' => 'image|max:5000',
            'description' => '',
            'qty_left' => '',
            'qty_total' => '',
            'qty_alert' => 'min:0|numeric',
//            'qty_alert_disabled' => 'in:0,1',
            'price_supplier' => 'numeric|required|min:0',
            'price_customer' => 'numeric|required|min:0'
        ];
    }
}
