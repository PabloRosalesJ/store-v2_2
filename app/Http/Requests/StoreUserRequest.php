<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|string', 
            'l_name' => 'required|string', 
            's_name' => 'required|string', 
            'address' => 'string|nullable', 
            'phone' => 'numeric|nullable|unique:people',
            'email' => 'string|nullable|unique:people',
            'username' => 'required|unique:users',
            'password' => 'required|confirmed'
        ];
    }
}
