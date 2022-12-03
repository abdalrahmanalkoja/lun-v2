<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
   
    public function rules()
    {
        return [

            'name'     => 'required|string',
            'email'    => 'required|email|unique:users',
            'pic'      => 'required|image|max:1024',
            'password' => 'required|string|min:6|max:50',
            'phone'    => 'required|integer|min:10',

        ];
    }
}
