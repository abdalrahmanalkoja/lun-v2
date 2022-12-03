<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApplicationRequest extends FormRequest
{
   
    public function rules()
    {
        return [
            
            'name'       =>  'required|min:5',
            'email'      =>  'required|email|unique:users',
            'country'    =>  'required|string',
            'phone'      =>  'required|numeric|digits:10',
            'idea'       =>  'required|string',
            'des_idea'   =>  'required|string',
            'status'     =>  'required|string',

        ];
    }
}
