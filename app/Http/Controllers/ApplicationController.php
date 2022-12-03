<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ApplicationRequest;
use JWTAuth;
use App\Models\Application;

class ApplicationController extends ApiController
{
    
    //--list all the app and paginate --//
    public function list(){

        $items = Application::query()->paginate(7);

        return $this->success($items);
    }

    //--list onle one app in this function based on id--//

    public function index($id){

        if(!$id){
            return $this->error(['error' => 'job_index'], 'Invalid request');
        }

        $app = Application::query()->where('id', $id)->first();
        return $this->success($app);
    }

//-- add the application as one array in mysql --//
    public function store(ApplicationRequest $request){

        
            $data  =  $request->all();
          
            $app   =  Application::create($data);

        if(!$app){

            return $this->error(['error' => 'Application_store'], 'Invalid request');

        }
                    
       return $this->success();


    }

    public function update(ApplicationRequest $request, $app_id )
    {
      
        if(!$app_id){
            return $this->error(['error' => 'Application_update'], 'Invalid request');
        }

        $app = Application::find($app_id);

        if(!$app){
            return $this->error(['error' => 'Application_update'], 'Invalid request');
        }

           $data = $request->all();

           $app->update($data);
       
        return $this->success();
    }

    public function destroy($id)
    {
        
        if(!$id){
            return $this->error(['error' => 'product_destroy'], 'Invalid request');
        }

        Application::query()->where('id', $id)->delete();
        return $this->success();
    }


}
