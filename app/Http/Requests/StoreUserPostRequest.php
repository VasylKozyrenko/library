<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class StoreUserPostRequest extends Request
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
            'first_name' => 'required|min:3|max:80|alpha',
            'last_name' => 'required|min:3|max:80|alpha',
            'email' => 'required|email|unique:users',
            'password' => 'required|alphanum|between:4,8|confirmed'
        ];
    }
}