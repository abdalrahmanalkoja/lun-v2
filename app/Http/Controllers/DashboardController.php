<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\C_v;
use App\Models\Application;
use App\Models\Subscriber;
class DashboardController extends Controller
{
   
    public function list(){

        // $average = DB::table('applactions')->avg('id');
        // $count_apps = Application::count();

        // $average = DB::table('applactions')->avg('id');
        // $count_apps = Application::count();

        // $average = DB::table('applactions')->avg('id');
        // $count_apps = Application::count();

        // $average = DB::table('applactions')->avg('id');
        // $count_apps = Application::count();

        $applications = Application::withAvg('rating as ratings', 'rating')
        ->withCount('comment as comments')
        ->latest()->filter()->paginate(12);

        $jobs = Job::withAvg('rating as ratings', 'rating')
        ->withCount('comment as comments')
        ->latest()->filter()->paginate(12);

        $subscribe = Subscriber::withAvg('rating as ratings', 'rating')
        ->withCount('comment as comments')
        ->latest()->filter()->paginate(12);

        $cvs = C_v::withAvg('rating as ratings', 'rating')
        ->withCount('comment as comments')
        ->latest()->filter()->paginate(12);

      
        return $this->success($items);
    }

}
