<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\JobRequest ;
use Illuminate\Http\Response;
use App\Models\Job;
use App\Models\C_v;
use Storage;
use DB;
use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use JWTAuth;
use Illuminate\Support\Collection;

class JobController extends ApiController
{


    //-- show all jobs --//
    public function list(){

        $jobs = Job::query()->paginate(7);

        $collection = new Collection();

        foreach ($jobs as $job) {

        $count_cv = C_v::where('job_id', $job->id)->count();

        $data = [

            "title"         => $job->title,
            "type"          => $job->type,
            "hierarchical"  => $job->hierarchical,
            "salary"        => $job->salary,
            "experience"    => $job->experience,
            "description"   => $job->experience,
            "requirement"   => $job->requirement,
            "status"        => $job->status,
            "start_time"    => $job->start_time,
            "end_time"      => $job->end_time,
            "image"         => $job->image,
            "count_cv"      => $count_cv,
        ];

        $collection->push($data);

      }

        return $this->success($collection) ;
    }

    //-- only one job --//
    public function index(){
        $id = request('id', 0);
        if(!$id){
            return $this->error(['error' => 'job_index'], 'Invalid request');
        }

        $job = Job::query()->where('id', $id)->first();
        return $this->success($job);
    }



    //--Store a new blog post--//

    public function store(JobRequest $request){

        if ($request->hasFile('image')) {

            $image 		= $request->file('image');
            $filename 	= Str::uuid().'.'.time().'.'.$request->image->getClientOriginalExtension();
            $image      ->storeAs('public/images', $filename);
        }
            $data          = $request->all();
            $data['image'] = $filename;
            $job           = Job::create($data);

        if(!$job){

            return $this->error(['error' => 'job_store'], 'Invalid request');

        }

       return $this->success();


    }


    //-- update job --//
    public function update(JobRequest $request, $job_id )
    {

        if(!$job_id){
            return $this->error(['error' => 'job_update'], 'Invalid request');
        }

        $job = Job::find($job_id);

        if(!$job){
            return $this->error(['error' => 'job_update'], 'Invalid request');
        }

        if ($request->hasFile('image')) {

            $image 		= $request->file('image');
            $filename 	= Str::uuid().'.'.time().'.'.$request->image->getClientOriginalExtension();
            $image      ->storeAs('public/images', $filename);
        }

           $data = $request->all();
           $data['image'] = $filename;
           $job->update($data);

        return $this->success();
    }


    public function destroy($id)
    {

        if(!$id){
            return $this->error(['error' => 'product_destroy'], 'Invalid request');
        }

        Job::query()->where('id', $id)->delete();
        return $this->success();
    }


}
