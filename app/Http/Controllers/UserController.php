<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\Models\User;
use Storage;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest ;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Validator;


class UserController extends ApiController
{

    //-- function make user update his information--//
    public function editProfile(UserRequest $request, $user_id )
    {
      
        if(!$user_id){
            return $this->error(['error' => 'User_update'], 'Invalid request');
        }

        $user = User::find($user_id);

        if(!$user){
            return $this->error(['error' => 'User_update'], 'Invalid request');
        }

        if ($request->hasFile('pic')) { 

            $image 		= $request->file('pic');
            $filename 	= Str::uuid().'.'.time().'.'.$request->pic->getClientOriginalExtension();
            $image      ->storeAs('public/users', $filename);
        }
       
           $data = $request->all();
           $data['pic'] = $filename;
           $user->update($data);
       
        return $this->success();
    }

}
