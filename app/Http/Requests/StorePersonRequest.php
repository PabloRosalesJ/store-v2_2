<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePersonRequest extends FormRequest
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
        $id = $this->route('id');
        return [
            'name' => 'required|string', 
            'l_name' => 'required|string', 
            's_name' => 'required|string', 
            'address' => 'string|nullable', 
            'phone' => "numeric|nullable|unique:people,phone,$id",//:people,phone,'.$id, 
            'email' => "string|nullable|unique:people,email,$id",
        ];
    }
}
