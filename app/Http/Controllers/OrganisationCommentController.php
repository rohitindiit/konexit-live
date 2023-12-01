<?php

namespace App\Http\Controllers;

use App\Models\SubmissionComments;
use Illuminate\Http\Request;
use Session;
use App\Models\User;
use App\Models\Submittedform;
use App\Models\Notification;
use Carbon\Carbon;
class OrganisationCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function addComment(Request $request)
    {
        $now = Carbon::now();
       $now->setTimezone('Europe/London');
        if(isset($request->isshowuser))
        {
           $isshowuser =  "1";
        }else{
             $isshowuser =  "0";
        }
        $comment = $request->comment;
        $submission_id = $request->submission_id;
        
        $organisation_id =  Session::get('organization')->id;

        $submission = new SubmissionComments();
        $submission->submission_id =$submission_id;
        $submission->comment_by = $organisation_id;
        $submission->comment = $comment;
        $submission->user_view =$isshowuser;
        $submission->created_at =$now->format('Y-m-d H:i:s.u');
        $submission->save();
        
        $desktopuser = User::where('id',"=",$organisation_id)->pluck('name')->implode('');
        $user_id=Submittedform::where('id',"=",$submission_id)->pluck('userid')->implode('');
        $formid=Submittedform::where('id',"=",$submission_id)->pluck('formid')->implode('');
        if(isset($request->isshowuser))
        {
         $this->pushNotification($user_id,$desktopuser,$submission_id);
        }
        return redirect()->back()->with('success', 'Comment Posted'); 

    }
    
    public function addCommentbyAjax(Request $request)
    {
        $all=[];
        $comment = $request->comment;
        $submission_id = $request->submission_id;
        
        $organisation_id =  Session::get('organization')->id;

        $submission = new SubmissionComments();
        $submission->submission_id =$submission_id;
        $submission->comment_by = $organisation_id;
        $submission->comment = $comment;
        $submission->save();

        $comments =SubmissionComments::where('submission_id','=',$submission_id)->orderByDesc('created_at')->latest('created_at') // Order by created_at in descending order
    ->take(2)              // Limit the number of results to 2
    ->get();;
         foreach($comments as $single)
         {
             $id = $single->comment_by;
             $name = User::where('id',"=",$id)->pluck('name')->implode('');
             $carbonDate = \Carbon\Carbon::parse($single->created_at);

        $formattedDate = $carbonDate->format('d-M-Y g:i A');
             array_push($all,["comment"=>$single->comment,"created_at"=>$formattedDate,"name"=>$name]);
             
         }
         return json_encode($all); 

    }
    
      public function pushNotification($user_id,$desktopuser,$formid)
         {
            $tok =  User::select('android_device_token','ios_device_token')->where(['id'=>$user_id])->first();
         
         
            $allTokens=[];
             
            if($tok->android_device_token)
                {
                    $allTokens[] = json_decode($tok->android_device_token);
                }
            if($tok->ios_device_token)
                {
                    $allTokens[] = json_decode($tok->ios_device_token);
                }
        
             
             
             foreach($allTokens as $token)
             { 
                 $API_ACCESS_KEY = "AAAAs9O_3Fg:APA91bEHU3oRa-HB-NLMHZGsxbw7sS5DU9ml5DjlvLpjPAkvWMgpKAzU943SKc82mN7buTQCTuUwoxJ5Zi3M4cmYEzMJC0s40Ab_ya2DnoTkWFfUPvlFLkhU1wAdSny0mpbZbYhfsNJF";
                  $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
                 
                    $notification = [
                        'title' =>'New Comment',
                        'body' => '1 new message from '.$desktopuser.','.$formid,
                        'icon' =>'myIcon', 
                        'sound' => 'mySound',
                      
                    ];
                    $extraNotificationData = ["message" => $notification];
            
                    $fcmNotification = [
                        //'registration_ids' => $tokenList, //multple token array
                        'to'        => $token, //single token
                        'notification' => $notification,
                        'data' => $extraNotificationData
                    ];
            
                    $headers = [
                        'Authorization: key=' . $API_ACCESS_KEY,
                        'Content-Type: application/json'
                    ];
            
            
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL,$fcmUrl);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
                    $result = curl_exec($ch);
                    curl_close($ch);
            
                    
                 
             }
             
              $noti = new Notification();
             $noti->title="New Form Assigned";
             $noti->body='1 new message from '.$desktopuser;
             $noti->user_id=$user_id;
             $noti->form_id=$formid;
             $noti->type="comment";
             $noti->save();
             
             return 1;
         }

   
}
