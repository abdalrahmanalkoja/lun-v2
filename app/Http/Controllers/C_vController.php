<?php

namespace App\Http\Controllers;

use App\Models\C_v;
use App\Http\Requests\C_vRequest ;
use JWTAuth;
use Str;
use Illuminate\Http\Request;

class C_vController extends ApiController
{
    
 // protected $user;
 
 public function __construct()
 {
    $this->user = JWTAuth::parseToken()->authenticate();
 }


//---list cvs ----///

 public function list(){

    $items = C_v::query()->paginate(7);

    return $this->success($items);
}



public function index(){
   $id = request('id', 0);
   if(!$id){
       return $this->error(['error' => 'job_index'], 'Invalid request');
   }

   $c_v = C_v::query()->where('id', $id)->first();
   return $this->success($c_v);
}


public function destroy($id)
{
    
    if(!$id){
        return $this->error(['error' => 'product_destroy'], 'Invalid request');
    }

    C_v::query()->where('id', $id)->delete();
    return $this->success();
}


public function store(C_vRequest $request){

   if ($request->hasFile('file')) { 

       $cv 		= $request->file('file');
       $filename 	= Str::uuid().'.'.time().'.'.$request->file->getClientOriginalExtension();
       $cv      ->storeAs('public/cvs', $filename);
   }
       $data          = $request->all();
       $data['file'] = $filename;
       $insert           = C_v::create($data);

   if(!$insert){

       return $this->error(['error' => 'CV_store'], 'Invalid request');

   }
               
  return $this->success();


}
  


public function update(C_vRequest $request , $cv_id ){

   if(!$cv_id){
      return $this->error(['error' => 'CV_update'], 'Invalid request');
  }

  $cv = C_v::find($cv_id);

  if(!$cv){
      return $this->error(['error' => 'CV_update'], 'Invalid request');
  }

   if ($request->hasFile('file')) { 

       $file		= $request->file('file');
       $filename 	= Str::uuid().'.'.time().'.'.$request->file->getClientOriginalExtension();
       $file      ->storeAs('public/cvs', $filename);
   }

   $data = $request->all();
   $data['file'] = $filename;
   $cv->update($data);

               
  return $this->success();


}


}
