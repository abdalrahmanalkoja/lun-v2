<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobRequest extends FormRequest
{
   
    public function rules()
    {
        return [
            
            'title'       => 'required|string|max:225',
            'address'     => 'required|string|max:225',
            'salary'      => 'required|integer',
            'description' => 'required|string',
            'image'       => 'required|image|max:1024',

        ];
    }
}
