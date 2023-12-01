<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Routing\Redirector;
use App\Models\User;
use App\Models\Form;
use App\Models\Formversion;
use Illuminate\Support\Facades\Crypt;
use Session;
use Illuminate\Support\Facades\Auth;
use App\Models\Submittedform;
use Illuminate\Support\Facades\Config;
use Mail;
use App\Mail\Mailtrap;
use DB;

class Organisationfunction extends Controller
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


  public function imageUpload(){
    return view('imageUpload');
  }

  public function imageUploadPost(Request $request,$folder){
      try{    
        $extension = $request->file('choosefile')->getClientOriginalExtension();
         //new filename
         $new_filename = $folder.'/'.time().'.'.$extension;
         $normal = Image::make($request->file('choosefile'))->resize(200,200)->encode($extension);
          //Upload File
          Storage::disk('s3')->put($new_filename, (string)$normal, $folder);
           $path = Storage::disk('s3')->url($new_filename);
          return $path; 
          }catch(\Exception $e){
          $messags['msg'] = $e->getMessage();
          $messags['erro']= 202;
     } 
      echo json_encode($messags);
      die;
  }

  public function removeprofilepic($condition){
   try{
    $image = User::getdetailsuserret2($condition,'profile');
     if($image != 'undefined' && $image != null && $image != ''){
      Storage::disk('s3')->delete(parse_url($image));
     }
    return true;
   }catch(\Exception $e){
    $messags['msg'] = $e->getMessage();
    $messags['erro']= 202;
   } 
      echo json_encode($messags);
      die;
    }


  public function updateprofile(Request $request){
    try{
      if($request->isMethod('post'))
      {
        $data = $request->all();
        unset($data['_token']);
       if($request->file('choosefile')){
          $data['profile'] = $this->imageUploadPost($request,'organization');
           $this->removeprofilepic([['id','=',$this->user_id]]);
           unset($data['choosefile']);
        }else{
          unset($data['choosefile']);
        }
        if(User::updateUser($data,$this->user_id)){
          $page = ' | Profile';
          $profile = User::getonedata([['id','=',$this->user_id]]);
          $messags['msg'] = 'The profile has been updated successfully!!.';
          $messags['erro']= 101;
          $messags['data'] = $data;
           $messags['htmlclass'] = 'profile';
           if($request->file('choosefile')){
            $messags['htmlid'] = 'profileimage';
            $messags['html'] = $data['profile'];
          }
        }else{
          $messags['msg'] = 'Oops, there is some problem, try again later!!.';
          $messags['erro']= 202;
        }
      }
     }catch(\Exception $e){
       $messags['msg'] = $e->getMessage();
       $messags['erro']= 202;
    } 
      echo json_encode($messags);
      die;
  }

  public function updatepassword(Request $request){
    try{
      if($request->isMethod('post')){
       $wereh = [['id','=',$this->user_id]];
       $users =  User::getonedata($wereh);
        if($users != null && $request->currentpassword == Crypt::decryptString($users->password)){ 
          if($request->newpassword == $request->confirmpassword){
             $updatedata['password'] = Crypt::encryptString($request->newpassword);
            if(User::updateoption2($updatedata,array('id'=>$this->user_id))){
             $messags['msg'] = 'Password has been changed successfully!!.';
             $messags['erro']= 101;
             $messags['resetform'] = 'yes';
            }
          }else{
            $messags['msg'] = 'Confirm password does not match with a new password.';
            $messags['erro']= 202;
          }
       }else{
         $messags['msg'] = 'The current password does not match.';
         $messags['erro']= 202;
       }
      }
     }catch(\Exception $e){
       $messags['msg'] = $e->getMessage();
       $messags['erro']= 202;
    } 
    echo json_encode($messags);
    die;
  }
  
  public function updatesuborgprofile(Request $request)
  {
      
       $user_id = $request->user_id;
       $fname = $request->First_name;
       $lname = $request->last_name;
       $email = $request->email;
       
       if (User::where('email', '=', $email)->count() > 0) {
           return redirect()->back()->with('Failed', 'Email alreay exsist');
       }else{
            User::where('id','=',$user_id)->update(['name'=>$fname,'lname'=>$lname,'email'=>$email]);
            return redirect()->back()->with('success', 'Profile updated');
       }
      
      
         
  }
  
  public function updatesuborgpassword(Request $request)
  {
      $user_id = $request->user_id;
      $new_password = Crypt::encryptString($request->newpassword);
      User::where('id','=',$user_id)->update(['password'=>$new_password]);
      return redirect()->back()->with('success', 'Password updated');  
  }

  public function signOut() {
    Session::flush();
    Auth::logout();
    return Redirect('/');
  }

  public function headervariables($id='')
  {
    if($id == '')
    {
          $Session = Session::get('organization');
          Config::set('site_vars.profile.name', $Session->name != null ? $Session->name : '');
      Config::set('site_vars.profile.email', $Session->email);
      Config::set('site_vars.profile.profile', $Session->profile != null ? $Session->profile : url('/').'/resources/views/organization/assets/img/user1.png');
    }else
    {
      $wereh = [['id','=',$this->user_id],['status','=','1']];
      $users =  User::getonedata($wereh);
      if($users != null){ 
      Config::set('site_vars.profile.name', $users->name != null ? $users->name : '');
      Config::set('site_vars.profile.email', $users->email);
      Config::set('site_vars.profile.profile', $users->profile != null ? $users->profile : url('/').'/resources/views/organization/assets/img/user1.png');
      } 
    }
     return true;
  }

  public function getform($id='')
  {
     try{
      $were = [['id','=',$id]];
      $data = Form::getdetailsuserret2($were,'form_data');
       return json_decode($data); die;
    }catch(\Exception $e){
      $newdata = [];
    } 
    echo json_encode($newdata);
    die;
  }
  
  public function addorganization_user(Request $request)
  {
      try{
     if($request->isMethod('post')){
          
      $organizationdata = User::getonedata([['id','=',$request->parent]]);
     $appuser =  User::where('role','=','2')->where('parent_id','=',$request->parent)->count();
      
      if($organizationdata->user_quota <=$appuser)
      {
          $messags['msg'] = 'You have reached the limit of add users for this particular organization.';
          $messags['erro']= 202;
          echo json_encode($messags); die;
      }
      $data = $request->all();
      unset($data['_token']);
      unset($data['id']);
      $were = [['email','=',$data['email']],['status','!=','3'],['role','=',2]];
      $users =  User::getonedata($were);
      if($users == null){
            $alldata = [
              'name' => $data['name'],
              'lname' => $data['lname'],
              'email' => $data['email'],
              'division' => $data['division'],
              'status' => $data['status'],
               'role' => 2,
               'parent_id'=> $request->parent
            ];
          if((isset($request->password) && $request->password != null)){
            if($request->password == $request->confirmpassword){
              $alldata['password'] = Crypt::encryptString($data['password']);
            }else{
              $messags['msg'] = 'Confirm password does not match with a new password.';
              $messags['erro']= 202;
              echo json_encode($messags); die;
            }
          }
            if($request->file('choosefile')){
            $alldata['profile'] = $this->imageUploadPost($request,'users');
             unset($data['choosefile']);
            }else{
             unset($data['choosefile']);
            }
            $userid = User::create($alldata)->id;
            if($userid)
            {
                $hash    = md5(uniqid(rand(), true));
                $string  = $userid."&".$hash;
                $iv = base64_encode($string);
                $dat['name'] = $data['name'].',';
               if(isset($data['confirmation_email'])  && $data['confirmation_email'] == 1)
               {
                /*** This url will be replace with App Link ***/
                $dat['url']  = url('login/');
                $dat['body'] = 'Your account has been added as an user. Your login credentials are Email:'.$data['email'].' and Password:'.$data['password'].'. Login your account by below link.';
                $dat['buttoname'] = 'Login';
                $messags['msg'] = 'The User has been added successfully and confirmation has been sent to the user!!.';
                 $dat['page'] = 'emails.confimationemail';
                Mail::to($data['email'])->send(new Mailtrap($dat));
               }
               User::updateoption2(['total_users'=> User::getcount([['parent_id','=',$this->user_id]])],[['id','=',$this->user_id]]);
               $messags['erro']= 101;
               $messags['redirecturl'] =  url('/organization/user');
               $messags['msg'] = 'The user has been added successfully!!.';
               $messags['erro']= 101;
            }else
            {
              $messags['msg'] = 'Oops, there is some problem, try again later!!.';
              $messags['erro']= 202;
            }
      }else
       {
         $messags['msg'] = 'The user has already existed in the record with this same email!!.';
          $messags['erro']= 202;
       }
     }
    }catch(\Exception $e){
       $messags['msg'] = $e->getMessage();
       $messags['erro']= 202;
    } 
    echo json_encode($messags);
      die;
  }
  
  public function editorganization_user(Request $request,$userid='')
 {
   try{
     if($request->isMethod('post')){
      $data = $request->all();
      unset($data['_token']);
      unset($data['id']);
      $were = [['email','=',$data['email']],['status','!=','3'],['role','=',2],['id','!=',$userid]];
      $users =  User::getonedata($were);
      if($users == null){
            $alldata = [
              'name' => $data['name'],
              'lname' => $data['lname'],
              'division' => $data['division'],
              'email' => $data['email'],
              'status' => $data['status'],
            ];
          if((isset($request->password) && $request->password != null)){
            if($request->password == $request->confirmpassword){
              $alldata['password'] = Crypt::encryptString($data['password']);
            }else{
              $messags['msg'] = 'Confirm password does not match with a new password.';
              $messags['erro']= 202;
              echo json_encode($messags); die;
            }
          }
            if($request->file('choosefile')){
            $alldata['profile'] = $this->imageUploadPost($request,'users');
             unset($data['choosefile']);
            }else{
             unset($data['choosefile']);
            }
             if(User::updateoption2($alldata,[['id','=',$userid]]))
             {
               $messags['erro']= 101;
               $messags['redirecturl'] =  url('organization/user');
               $messags['msg'] = 'The user has been updated successfully!!.';
               $messags['erro']= 101;
             }else
             {
                $messags['msg'] = 'Oops, there is some problem, try again later!!.';
                $messags['erro']= 202;
             }
      }else
       {
         $messags['msg'] = 'The user has already existed in the record with this same email!!.';
          $messags['erro']= 202;
       }
     }
    }catch(\Exception $e){
       $messags['msg'] = $e->getMessage();
       $messags['erro']= 202;
    } 
    echo json_encode($messags);
      die;
 }
 
 
 public function submitted_from_status(Request $request)
 {
   try{
         $data = $request->all();
         if($data['value'] === 2)
         {
            $data['value'] = '2'; 
         }
         if($data['value'] === 1)
         {
            $data['value'] = '1'; 
         }
         if($data['value'] === 0)
         {
            $data['value'] = '0'; 
         }
     
         $were = [['id','=',$data['submissionId']]];
            $updatedata['status'] = $data['value'];
      
      if(Submittedform::updateoption2($updatedata,$were))
      {
           $messags['msg'] = 'Status has been changed';
          $messags['erro']= 101;
      }
     }catch(\Exception $e){
        $messags['msg'] = $e->getMessage();
       $messags['erro']= 202;
    } 
    echo json_encode($messags);
      die;
   
 }
 
  public function submitted_from_status_multiple(Request $request)
 {
    $submissionId=$request->submissionId;
   try{
         $data = $request->all();
         if($data['value'] === 2)
         {
            $data['value'] = '2'; 
         }
         if($data['value'] === 1)
         {
            $data['value'] = '1'; 
         }
         if($data['value'] === 0)
         {
            $data['value'] = '0'; 
         }
         $v=$data['value'];
     foreach($submissionId as $d)
     { 
         Submittedform::where('id', $d)->update(['status' => $v]);
     }
         
        //  $were = [['id','=',$data['submissionId']]];
        //     $updatedata['status'] = $data['value'];
      
    //   if(Submittedform::updateoption2($updatedata,$were))
    //   {
           $messags['msg'] = 'Status has been changed';
          $messags['erro']= 101;
    //   }
     }catch(\Exception $e){
        $messags['msg'] = $e->getMessage();
       $messags['erro']= 202;
    } 
    echo json_encode($messags);
      die;
   
 }
 
  public function changeSuborgStatus(Request $req)
  {
     $user_id =$req->user_id;
     $status = $req->status;
     User::where('id','=',$user_id)->update(['status'=>$status]);
     return 1;
  }
 

 
 
//  public function pushNotification()
//  {$user_id="17";
//  $form_id="17";
//     $tok =  User::select('android_device_token','ios_device_token')->where(['id'=>$user_id])->first();
//     $extra = $form_id;
//     if($tok->android_device_token)
//         {
//             $android_array = json_decode($tok->android_device_token);
//         }
//     if($tok->ios_device_token)
//         {
//             $ios_array = json_decode($tok->ios_device_token);
//         }

//       $allTokens=array_merge($android_array,$ios_array);
      
//      foreach($allTokens as $token)
//      { 
//          $API_ACCESS_KEY = "AAAAs9O_3Fg:APA91bEHU3oRa-HB-NLMHZGsxbw7sS5DU9ml5DjlvLpjPAkvWMgpKAzU943SKc82mN7buTQCTuUwoxJ5Zi3M4cmYEzMJC0s40Ab_ya2DnoTkWFfUPvlFLkhU1wAdSny0mpbZbYhfsNJF";
//           $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
         
//             $notification = [
//                 'title' =>'New Form Assigned',
//                 'body' => 'You have assigned a new form !!',
//                 'icon' =>'myIcon', 
//                 'sound' => 'mySound',
//                 "moredata" =>$extra
//             ];
//             $extraNotificationData = ["message" => $notification];
    
//             $fcmNotification = [
//                 //'registration_ids' => $tokenList, //multple token array
//                 'to'        => $token, //single token
//                 'notification' => $notification,
//                 'data' => $extraNotificationData
//             ];
    
//             $headers = [
//                 'Authorization: key=' . $API_ACCESS_KEY,
//                 'Content-Type: application/json'
//             ];
    
    
//             $ch = curl_init();
//             curl_setopt($ch, CURLOPT_URL,$fcmUrl);
//             curl_setopt($ch, CURLOPT_POST, true);
//             curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
//             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//             curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//             curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
//           return $result = curl_exec($ch);
//             curl_close($ch);
    
    
//              $noti = new Notification();
//              $noti->title="New Form Assigned";
//              $noti->body='You have assigned a new form !!';
//              $noti->user_id=$user_id;
//              $noti->form_id=$form_id;
//              $noti->save();
             
//              return 1;
//      }
//  }


}
