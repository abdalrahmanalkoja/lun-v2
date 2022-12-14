<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RateRequest;
use App\Models\Rate;

class RateController extends ApiController
{
    
    // -- view all reviews-- //
    public function list(){

        $items = Rate::query()->paginate(7);

        return $this->success($items);
    }
    //-- delete review--//
    public function destroy($id)
    {
        
        if(!$id){
            return $this->error(['error' => 'rating_destroy'], 'Invalid request');
        }

        Rate::query()->where('id', $id)->delete();
        return $this->success();
    }

    //--ada review--//
    public function store(RateRequest $request){

        
      $data  =  $request->all();
    
      $rate   =  Rate::create($data);

  if(!$rate){

      return $this->error(['error' => 'Rate_store'], 'Invalid request');

  }
              
 return $this->success();


}

}
