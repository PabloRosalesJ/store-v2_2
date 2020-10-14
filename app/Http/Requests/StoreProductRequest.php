<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
        return [
            'category_id'     => 'required|integer',
            'bar_code'        => 'required|min:10|unique:products,bar_code,'.$this->route('id'),
            'name'            => 'required|unique:products,name,'.$this->route('id'),
            'description'     => 'nullable',
            'image'           => 'image|nullable',
            'buy_price'       => 'required|numeric',
            'unit_price'      => 'required|numeric',
            'wholesale_price' => 'required|numeric',
            'stock'           => 'required|numeric'
        ];
    }
}
