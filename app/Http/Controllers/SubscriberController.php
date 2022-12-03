<?php

namespace App\Http\Controllers;

use App\Mail\Subscribe;
use App\Models\Subscriber;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use JWTAuth;
use Illuminate\Notifications\Notification;
use App\Notifications\EmailNotification;
use Illuminate\Support\Facades\Validator;


class SubscriberController extends ApiController
{

    //----function list of Email---//
    public function list(){

        $items = Subscriber::query()->paginate(7);

        return $this->success($items);
    }


    //---- subscribe function---//
    public function subscribe(Request $request) 
{
    $validator = Validator::make($request->all(), [
         'email' => 'required'
    ]);

    if ($validator->fails()) {
        return new JsonResponse(['success' => false, 'message' => $validator->errors()], 422);
    }  

    $email = $request->all()['email'];
        $subscriber = Subscriber::create([
            'email' => $email
        ]
    ); 

    if ($subscriber) {
        Mail::to($email)->send(new Subscribe($email));
        return new JsonResponse(
            [
                'success' => true, 
                'message' => "Thank you for subscribing to our email, please check your inbox"
            ], 
            200
        );
    }
}


//---- send email only to one email---//
    public function sendEmail(Request $request) 
{
    $validator = Validator::make($request->all(), [
         'email' => 'required'
    ]);

    if ($validator->fails()) {
        return new JsonResponse(['success' => false, 'message' => $validator->errors()], 422);
    }  

        $email = $request->all()['email'];
        Mail::to($email)->send(new Subscribe($email));
        return new JsonResponse(
            [
                'success' => true, 
                'message' => "Thank you for subscribing to our email, please check your inbox"
            ], 
            200
        );
    
}


    //----send email ti all chack emails----//
    public function emailTo_all(Request $request) 
    {
        
        $validator = Validator::make($request->all(), [
            'emails' => 'required'
    ]);

    if ($validator->fails()) {
        return new JsonResponse(['success' => false, 'message' => $validator->errors()], 422);
    }  

        $emails = $request->all();

        // $email_arr = json_encode($emails);

        // dd($emails);
        // $emails = ['abodeabode9001@gmail.com', 'abdalrahmanalkhoja@gmail.com','myother2@esomething.com'];
        foreach($emails as $email){
        
        Mail::to($email[])->send(new Subscribe($email));
        }

            return new JsonResponse(
                [
                    'success' => true, 
                    'message' => "Thank you for subscribing to our email, please check your inbox"
                ], 
                200
            );
        
    }

    public function send() 
        {
            $email = "abodeabode9001@gmail.com";

            //$userEmail = json_encode($request->all());
            //$email1 = str_replace("\xE2\x80\x8B", "",$email);

            $project = [
                'greeting' => 'Hi ',
                'body' => 'This is the project assigned to you.',
                'thanks' => 'Thank you this is from codeanddeploy.com',
                'actionText' => 'View Project',
                'actionURL' => url('/'),
                'id' => 57
            ];

            //Notification::send($email, new EmailNotification($project));
            \Notification::route('mail',  $email)->notify(new EmailNotification($project));

            dd('Notification sent!');
        }

        public function destroy($id)
        {
            
            if(!$id){
                return $this->error(['error' => 'product_destroy'], 'Invalid request');
            }

            Subscriber::query()->where('id', $id)->delete();
            return $this->success();
        }
    

}
