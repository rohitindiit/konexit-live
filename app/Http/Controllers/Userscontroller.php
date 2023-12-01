<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Routing\Redirector;
use App\Models\User;
use App\Models\Notification;
use App\Models\Form;
use App\Models\Formversion;
use App\Models\Assigntousers;
use Illuminate\Support\Facades\Crypt;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class Userscontroller extends Organisationfunction
{
    //
    private $user_id;

 public function __construct(Request $request, Redirector $redirect){  
   $this->middleware(function ($request, $next){
    if(Session()->exists('admin') || Session::get('organization')){ 
    $userid = (Session()->get('admin') != null && Session()->get('admin') != '') ? Session()->get('admin') : Session()->get('organization');
      $this->user_id = $userid['id'];
      $were= [['id','=',$userid['id']],['status','=','1']];
      $exists= User::getbycondition($were);
      $this->user_id = $userid['id'];
      if(count($exists) > 0){ 
       $this->headervariables(); 
       return $next($request);
      }else{ 
        $this->middleware('auth');
        Auth::logout();
        Session::flush();
        $messags['msg'] = 'The session has expired!!.';
        $messags['erro']= 202;
        $messags['redirecturl'] = url('/');
        echo json_encode($messags);
        die;
      }
    }
    });
  }


  public function userssearch(Request $request,$parentid='')
 {
   try{
      $data = $request->all();
      $were = [['status','!=','3'],['role','=',2],['parent_id','=',$parentid]];
      $weres = [];
      $weresdate = [];
       if(isset($data['query']) || isset($data['query'])) {
          if(isset($data['query']) && $data['query'] != null){
               $weres[] = ['email','like','%' .$data['query']. '%'];
               $weres[] = ['name','like','%' .$data['query']. '%'];
               $weres[] = ['lname','like','%' .$data['query']. '%'];
          } 
        }
      $data['users'] = User::getbyconditionmultiplewhere2($were,$weres,$weresdate);
      if($data['users'])
      {
        return json_encode($data['users']);   
      }else
      {
          return [];
      }
    // echo '<pre>'; print_r($data); die;
     }catch(\Exception $e){
     //  return [];
        $messags['msg'] = $e->getMessage();
       $messags['erro']= 202;
    } 
    echo json_encode($messags);
      die;
 }

 public function assignuserform(Request $request)
 { 
    try{
      if($request->isMethod('post')){
      $data = $request->all();
      if(isset($data['ids']) && $data['ids'] != null)
      {
        $ids = explode(",",$data['ids']);
        if(count($ids) > 0)
        {
          $updata['formid'] = $data['formid'];
         $u =  User::select('parent_id','role')->where('id','=', $this->user_id)->first();
         if($u->role=="4")
         {
             $updata['organization_id'] = $u->parent_id;
         }else{
             $updata['organization_id'] = $this->user_id;
         }
          
          $count = 0;
          foreach ($ids as $key => $value) {
           $updata['userid'] = $value;
           Assigntousers::updateorcreates([['userid','=',$value],['organization_id','=',$this->user_id],['formid','=',$data['formid']],['status','!=','2']],$updata);
           $this->pushNotification($value,$data['formid']);
           $count++;
           if($count == count($ids))
           {
            $this->getassignforms($request);
           }
          }
          
        }else
        {
          $this->getassignforms($request);
        }
      }else
      {
         $this->getassignforms($request);
      }
    }
    }catch(\Exception $e){
       //$newdata = [];
        $messags['msg'] = $e->getMessage();
       $messags['erro']= 202;
    } 
    echo json_encode($messags);
    die;
 }
 
  public function pushNotification($user_id,$form_id)
 {
    $tok =  User::select('android_device_token','ios_device_token')->where(['id'=>$user_id])->first();
    $form_title = Form::where('id','=',$form_id)->pluck('form_title')->implode('');
    $extra =  $form_id;
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
                'title' =>'New Form Assigned',
                'body' => 'You have assigned a new form '.$extra,
                'icon' =>'myIcon', 
                'sound' => 'mySound',
                "moredata" =>$extra
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
    
            
             $noti = new Notification();
             $noti->title="New Form Assigned";
             $noti->body='You have assigned a new form -'.$form_title;
             $noti->user_id=$user_id;
             $noti->form_id=$form_id;
             $noti->type="form_assign";
             $noti->save();
             
             return 1;
     }
 }

 public function getassignforms(Request $request)
 {
   try{
     
      $data = $request->all();
       $formid = $data['formid'];
       $users = Assigntousers::getjoin($formid,$this->user_id);
     /* $formassigns = Assignform::getbyconditionid([['formid','=',$data['formid']]]);
      $were = [['status','!=','3']];
      $users =User::getbyIncondition($were,$formassigns);*/
     
      $html = view('pages.assignuserslist', compact('users','formid'))->render();

    //  return json_encode($data['users']); 
       $messags['data'] = $users;
       $messags['msg'] = '';
       $essags['msg'] = '';

        $messags['htmlclass'] = 'assignedusers';
         $messags['html'] = $html;
           

       $messags['erro']= 101;
     }catch(\Exception $e){
       //return [];
       $messags['msg'] = $e->getMessage();
       $messags['erro']= 202;
    } 
      echo json_encode($messags);
    die;
 }

 public function deleteassignedusers(Request $request)
 {
   try{
      if($request->isMethod('post')){
      $data = $request->all();
      if(isset($data['formid']) && $data['formid'] != null && isset($data['userid']) && $data['userid'] != null)
      {
        $were = [['formid','=',$data['formid']],['userid','=',$data['userid']],['organization_id','=',$this->user_id]];
        $updatedata['status'] = '2';
         Assigntousers::updateoption2($updatedata,$were);
          $this->getassignforms($request);
       }
      {
         $this->getassignforms($request);
      }
    }
    }catch(\Exception $e){
       //$newdata = [];
        $messags['msg'] = $e->getMessage();
       $messags['erro']= 202;
    } 
    echo json_encode($messags);
    die;
 }

}
