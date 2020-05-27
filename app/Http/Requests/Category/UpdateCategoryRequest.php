<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;


class UpdateCategoryRequest extends FormRequest
{

    public function authorize()
    {
        return $this->user()->isAdmin();
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:categories,name,'.request('id'),
            'remark' => 'required'
        ];
    }
}
