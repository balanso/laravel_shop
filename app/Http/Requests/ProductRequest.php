<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'name' => 'required',
            'code' => 'required|unique:products,code,',
            'price' => 'required|numeric',
            'category_id' => 'exists:categories,id',
            'image' => 'mimes:jpeg,png,bmp',
        ];

        if ($this->route()->named('products.update')) {
            $rules['code'] .= $this->route('product')->id;
        }

        return $rules;
    }
}
