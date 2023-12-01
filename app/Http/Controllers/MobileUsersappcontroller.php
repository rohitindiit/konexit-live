<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Routing\Redirector;
use App\Models\User;
use App\Models\Form;
use App\Models\Formversion;
use App\Models\Assignform;
use App\Models\Notification;
use App\Models\Submittedform;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Carbon;
use Validator;
use App\Models\UserActivity;
use App\Models\UserDoc;
use App\Models\Document;

class MobileUsersappcontroller extends Controller
{
    //
     private $user_id;

 public function __construct(Request $request, Redirector $redirect) {  

  }
  
  public function saveUserActivity($user,$activity)
  {
      $activitysave = new UserActivity();
      $activitysave->user_id =$user;
      $activitysave->activity =$activity;
      $activitysave->save();
  }
  
  public function userlogin(Request $request)
  {
    try{
        $custom_token = "9abcdefghijklmno".mt_rand()+time();
        $device_name=NULL;
        $jsonString = $request->getContent();
         // Use json_decode() to convert the JSON string to an array
        $data = json_decode($jsonString, true);
       
            if (array_key_exists('email', $data)) {
             $email = $data['email'];
            }
            if (array_key_exists('password', $data)) {
             $password = $data['password'];
            }
            
            if (array_key_exists('device_type', $data)) {
              $device_type = $data['device_type'];
            }
            
            if (array_key_exists('device_token', $data)) {
              $device_token = $data['device_token'];
            }
            
             if (array_key_exists('device_name', $data)) {
              $device_name = $data['device_name'];
            }
      
       
       if(isset($email) && isset($password))
       {
        $wereh = [['email','=',$email],['status','=','1'],['role','=',2]];
        $users =  User::getonedata($wereh);
         if($users != null){ 
             
             if($users->token)
             {
                  $messags['msg'] = "A user already loged in with these credentials.";
                  $messags['status']= 202;
                  echo json_encode($messags); die;
             }
             
         if(isset($device_type) && isset($device_token) )
         {
        
            if($device_type=="android")
             {
           
                 User::where(['email'=>$email])->update(['device_name'=>$device_name,'android_device_token'=>json_encode($device_token),'token'=>$custom_token]);
             }
             
             if($device_type=="ios")
             {
                
                  User::where(['email'=>$email])->update(['device_name'=>$device_name,'ios_device_token'=>json_encode($device_token),'token'=>$custom_token]);
             }
         }else{
               User::where(['email'=>$email])->update(['device_name'=>$device_name,'token'=>$custom_token]);
         }
           
        
             $mytime = Carbon\Carbon::now();
             User::where(['email'=>$email])->update(['last_login'=>$mytime->toDateTimeString()]);
             $users->token = $custom_token;
         	if($request->password == Crypt::decryptString($users->password)){
                $messags['msg'] = "Logged In!!.";
          	    $messags['status']= 101;
          	    $messags['userdata']= $users;
          	    
          	    $this->saveUserActivity($users->id,'Login');
          	    
         	}else{
                $messags['msg'] = "Your credentials doesn't match with our record.";
                $messags['status']= 202;
         	}
         }else{
                $messags['msg'] = "Your credentails doesn't match with our record.";
                $messags['status']= 202;
       } 
       }else
       {
            $messags['msg'] = "2Your credentails doesn't match with our record.";
            $messags['status']= 202;
       }
    }catch(\Exception $e){
         $messags['msg2'] = $e;
      $messags['msg'] = $e->getMessage();
      $messags['status']= 202;
    } 
     echo json_encode($messags); die;
  }
  
   public function userToken(Request $request)
   {
       $rules = [
                'user_id' => 'required',
            ];
       $messages = [
        'user_id.required' => 'The id  is required.',
       ];
            
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return json_encode(['msg'=>'Invalid Request','status'=>201,'data'=>[]]);
        }
        return User::where('id', $request->user_id)->first();
      if(!User::where('id', $request->user_id)->exists())
      {
           return json_encode(['msg'=>'User not exsist','status'=>201,'data'=>[]]);
      }else{
         $token =  User::where('id', $request->user_id)->pluck('token')->implode('');
         return json_encode(['msg'=>'Token get successfully','status'=>200,'token'=>$token]);
      }
   }
  
//   public function userlogout(Request $request)
//   {
//       try{
//             $jsonString = $request->getContent();
//             // Use json_decode() to convert the JSON string to an array
//             $data = json_decode($jsonString, true);
//             if($data){
//                 if (array_key_exists('user_id', $data)) {
//                   $user_id = $data['user_id'];
//                 }
//                 if (array_key_exists('device_token', $data)) {
//                   $device_token = $data['device_token'];
//                 }
//                 if (array_key_exists('device_type', $data)) {
//                   $device_type = $data['device_type'];
//                 }
                
//                 if(isset($user_id) && isset($device_token) && isset($device_type))
//                 {
//                     $tok =  User::select('android_device_token','ios_device_token')->where(['id'=>$user_id])->where(['role'=>2])->first();
//                     if($device_type=="android")
//                     {
//                          $android_array=[];
//                          if($tok->android_device_token)
//                          {
//                             $android_array = json_decode($tok->android_device_token);
//                             if (in_array($device_token, $android_array))
//                             {
//                                 $newArray = array_filter($android_array, function($value) use ($device_token) {
//                                         return $value !== $device_token;
//                                     });
                                   
//                                     User::where(['id'=>$user_id])->update(['android_device_token'=>json_encode($newArray)]);
//                             }
                            
//                          }
//                     }
                 
//                      if($device_type=="ios")
//                      {
//                          $ios_array =[];
//                          if($tok->ios_device_token)
//                          {
//                             $ios_array = json_decode($tok->ios_device_token);
//                              if (in_array($device_token, $ios_array))
//                             {
//                                 $newArray = array_filter($ios_array, function($value) use ($device_token) {
//                                         return $value !== $device_token;
//                                     });
//                                     User::where(['id'=>$user_id])->update(['ios_device_token'=>json_encode($newArray)]);
//                             }
//                          }
//                      }
//                  }
                 
//                   $messags['msg'] ="logout successfully";
//                   $messags['status']= 200;
//             }else{
//                  $messags['msg'] ="Invalid request";
//                  $messags['status']= 202;
//             }
             
          
            
//       }catch(\Exception $e){
       
//          $messags['msg'] = $e->getMessage();
//          $messags['status']= 202;
//     } 
//      echo json_encode($messags); die;
//   }

 public function userlogout(Request $request)
  {
       try{
            $jsonString = $request->getContent();
            // Use json_decode() to convert the JSON string to an array
            $data = json_decode($jsonString, true);
            if($data){
                if (array_key_exists('user_id', $data)) {
                  $user_id = $data['user_id'];
                }
                if (array_key_exists('device_token', $data)) {
                  $device_token = $data['device_token'];
                }
                if (array_key_exists('device_type', $data)) {
                  $device_type = $data['device_type'];
                }
                
                if(isset($user_id) && isset($device_token) && isset($device_type))
                {
                           // $tok =  User::select('android_device_token','ios_device_token')->where(['id'=>$user_id])->where(['role'=>2])->first();
                         // if($device_type=="android")
                        // {
                       //      $android_array=[];
                      //      if($tok->android_device_token)
                     //      {
                    //         $android_array = json_decode($tok->android_device_token);
                            
                            
                            // if (in_array($device_token, $android_array))
                            // {
                            
                                
                                // $newArray = array_filter($android_array, function($value) use ($device_token) {
                                //         return $value !== $device_token;
                                //     });
                            //           print_r($newArray);
                            // echo "--------------efe------";
                            // print_r($android_array);
                            // dd();
                                    User::where(['id'=>$user_id])->update(['android_device_token'=>'','token'=>'']);
                            // }
                            
                         }
                   // }
                 
                     if($device_type=="ios")
                     {
                        //  $ios_array =[];
                       //  if($tok->ios_device_token)
                      //  {
                     //     $ios_array = json_decode($tok->ios_device_token);
                    //      if (in_array($device_token, $ios_array))
                   //      {
                  //         $newArray = array_filter($ios_array, function($value) use ($device_token) {
                        //                 return $value !== $device_token;
                        //      });
                                    User::where(['id'=>$user_id])->update(['ios_device_token'=>'','token'=>'']);
                     }
                      
                  $messags['msg'] ="logout successfully";
                  $messags['status']= 200;
                   $this->saveUserActivity($user_id,'Logout');
            }else{
                 $messags['msg'] ="Invalid request";
                 $messags['status']= 202;
            }
             
          
            
       }catch(\Exception $e){
       
         $messags['msg'] = $e->getMessage();
         $messags['status']= 202;
    } 
     echo json_encode($messags); die;
  }
  
  public function checkuser($id='')
  {
    try{
      $wereh = [['id','=',$id],['status','=','1'],['role','=',2]];
      $users =  User::getonedata($wereh);
      $newdata['userdata'] = $users;
    //   return json_encode($arraydata); die;
    }catch(\Exception $e){
      $newdata = [];
    } 
    echo json_encode($newdata);
    die;
  }
  
  public function getuserNotification(Request $request)
  {
       $rules = [
                'user_id' => 'required',
            ];
        $messages = [
        'user_id.required' => 'The id  is required.',
       ];
            
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return json_encode(['msg'=>'Invalid Request','status'=>201,'data'=>[]]);
        }
      if(!User::where('id', $request->user_id)->exists())
      {
           return json_encode(['msg'=>'User not exsist','status'=>201,'data'=>[]]);
      }
      $all =  Notification::where('user_id', $request->user_id)
    ->orderBy('created_at', 'desc')
    ->get();
      if($all)
      {
           return json_encode(['msg'=>'Notification list','status'=>200,'data'=>$all]);
      }else{
           return json_encode(['msg'=>'No data found','status'=>200,'data'=>[]]);
      }
      
  }
  
  public function getuserdetail(Request $request)
  {
     try{
        $jsonString = $request->getContent();
         // Use json_decode() to convert the JSON string to an array
       $data = json_decode($jsonString, true);
       if(isset($data) && count($data) > 0)
       {
            $wereh = [['id','=',$data['id']],['status','=','1'],['role','=',2]];
            $users =  User::getonedata($wereh);
            $documentsArray = UserDoc::where('user_id','=',$data['id'])->pluck('doc_id');
            $documents= Document::whereIn('id', $documentsArray)->get();
            $users->documents = $documents;
            $messags['data'] = $users;
            $messags['msg'] = 'have a data';
            $messags['status']= 202;
       }else
       {
            $messags['msg'] = 'not have a data';
            $messags['status']= 202;
       }
      }catch(\Exception $e){
      $messags['msg'] = $e->getMessage();
      $messags['status']= 202;
    } 
     echo json_encode($messags); die;
  }
  
  public function formslistall(Request $request)
  {
     try{
        $jsonString = $request->getContent();
         // Use json_decode() to convert the JSON string to an array
       $data = json_decode($jsonString, true);
        $messags['msg'] = "Your credentails doesn't match with our record.";
                $messags['status']= 202;
                 $messags['$data']= $data;
              echo json_encode($messags); die;
       $email = $data['username'];
       $password = $data['password'];
       $wereh = [['email','=',$email],['status','=','1'],['role','=',2]];
       $users =  User::getonedata($wereh);
         if($users != null){ 
         	if($request->password == Crypt::decryptString($users->password)){
                $messags['msg'] = "Logged In!!.";
          	    $messags['status']= 101;
          	    $messags['userdata']= $users;
         	}else{
                $messags['msg'] = "Your credentials doesn't match with our record.";
                $messags['status']= 202;
         	}
         }else{
                $messags['msg'] = "Your credentails doesn't match with our record.";
                $messags['status']= 202;
       }
    }catch(\Exception $e){
      $messags['msg'] = $e->getMessage();
      $messags['status']= 202;
    } 
     echo json_encode($messags); die;
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
         $jsonString = $request->getContent();
        // Use json_decode() to convert the JSON string to an array
        $data = json_decode($jsonString, true);
        $newdata['name'] = $data['name'];
        $newdata['lname'] = $data['lname'];
        $newdata['email'] = $data['email'];
         if(User::updateUser($newdata,$data['id'])) {
          $profile = User::getonedata([['id','=',$data['id']]]);
          $messags['msg'] = 'The profile has been updated successfully!!.';
          $messags['status']= 101;
          $messags['data'] = $profile;
          $this->saveUserActivity($data['id'],'Update Profile');
        }else{
          $messags['msg'] = 'Oops, there is some problem, try again later!!.';
          $messags['status']= 202;
        }
     }catch(\Exception $e){
       $messags['msg'] = $e->getMessage();
       $messags['status']= 202;
    } 
      echo json_encode($messags);
      die;
  }
  
   public function updatePassword(Request $request){ 
    try{
        $jsonString = $request->getContent();
        // Use json_decode() to convert the JSON string to an array
        $data = json_decode($jsonString, true);
        
        $wereh = [['id','=',$data['id']]];
       $users =  User::getonedata($wereh);
        if($users != null && $data['currentpassword'] == Crypt::decryptString($users->password)){ 
             $updatedata['password'] = Crypt::encryptString($data['newpassword']);
            if(User::updateoption2($updatedata,array('id'=>$data['id']))){
             $messags['msg'] = 'Password has been changed successfully!!.';
             $messags['status']= 101;
             $messags['data'] = $data;
            }
       }else{
         $messags['msg'] = 'The current password does not match.';
         $messags['status']= 202;
          $messags['data'] = $data;
       }
     
     }catch(\Exception $e){
       $messags['msg'] = $e->getMessage();
       $messags['status']= 202;
        $messags['data'] = $data;
    } 
    echo json_encode($messags);
    die;
  }
  

  public function updateprofile__(Request $request){
    try{
      if($request->isMethod('post'))
      {
        $data = $request->all();
        unset($data['_token']);
       if($request->file('choosefile')){
          $data['profile'] = $this->imageUploadPost($request,'admin');
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

  public function updatepassword__(Request $request){
    try{
      if($request->isMethod('post')){
       $wereh = [['id','=',$this->user_id]];
       $users =  User::getonedata($wereh);
        if($users != null && $request->currentpassword == Crypt::decryptString($users->password)){ 
          if($request->newpassword == $request->confirmpassword){
             $updatedata['password'] = Crypt::encryptString($request->newpassword);
            if(User::updateoption2($updatedata,array('id'=>$this->user_id))){
             $userid = $users->id;
             User::where('id','=',$userid)->update(['token','=','']);
             $messags['msg'] = 'Password has been changed successfully!!.';
             $messags['erro']= 101;
             $messags['resetform'] = 'yes';
             $this->saveUserActivity($this->user_id,'Update password');
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
  
  
  public function getform($id='')
  {
     try{
      $were = [['id','=',$id]];
      $data = Form::getdetailsuserret2($were,'form_data');
      $versionid = Form::getdetailsuserret2($were,'form_version');
      $arraydata['id'] = $id;
      $arraydata['formdata'] = json_decode($data);
      $arraydata['form_version'] = $versionid;
       return json_encode($arraydata); die;
    }catch(\Exception $e){
      $newdata = [];
    } 
    echo json_encode($newdata);
    die;
  }
  
  public function getSubmittedFormDetailsByFormID($form_id)
  {

      $empty_array=[];
      $data['submissions'] = \DB::table('submittedforms')
                    ->join('forms', 'forms.id', '=', 'submittedforms.formid')
                    ->join("formversions",function($join){
                    $join->on("formversions.formid","=","submittedforms.formid")
                    ->on("formversions.formversion","=","submittedforms.form_version");
                    })
                    ->join('users', 'users.id', '=', 'submittedforms.userid')
                    ->join('assignforms', 'assignforms.formid', '=', 'submittedforms.formid')
                    ->select('submittedforms.*','formversions.form_data as form_format','forms.form_title as formtitle','forms.formid as form_display_ID','assignforms.from_title as changedtitle','users.name as user_first_name', 'users.lname as user_last_name','users.email as submitted_by')
                    ->where('submittedforms.id', '=', $form_id);
                    $data['submissions'] = $submissions = $data['submissions']->orderBy('submittedforms.id', 'desc')->first();
                    
		$datas['formdata'] = json_decode($data['submissions']->form_data);
		$datas['form_format'] = json_decode($data['submissions']->form_format);
	
        $alldata = (array)$datas['formdata'];
        
		foreach($datas['form_format']->components as $key => $d)
		{
		    if($d->type == 'textfield')
		    {
		        $newArray[] = (object) [
                        'label' => $d->label,
                        'type' => $d->type,
                        'value' => $alldata[$d->key]
                    ];
		    }
		    
		    if($d->type == 'textarea')
		    {
		        $newArray[] = (object) [
                        'label' => $d->label,
                        'type' => $d->type,
                        'value' => $alldata[$d->key]
                    ];
		    }
		    
		    if($d->type == 'selectboxes')
		    {
		        $newArray[] = (object) [
                        'label' => $d->label,
                        'type' => $d->type,
                        'value' => $alldata[$d->key],
                        'values' => $d->values
                    ];
		    }
		    
		    if($d->type == 'select')
		    {
		        $newArray[] = (object) [
                        'label' => $d->label,
                        'type' => $d->type,
                        'value' => $alldata[$d->key]
                    ];
		    }
		    
		    if($d->type == 'datetime')
		    {
		        $newArray[] = (object) [
                        'label' => $d->label,
                        'type' => $d->type,
                        'value' => $alldata[$d->key]
                    ];
		    }
		    
		    if($d->type == 'time')
		    {
		        $newArray[] = (object) [
                        'label' => $d->label,
                        'type' => $d->type,
                        'value' => $alldata[$d->key]
                    ];
		    }
		    
		    if($d->type == 'radio')
		    {
		        $newArray[] = (object) [
                        'label' => $d->label,
                        'type' => $d->type,
                        'value' => $alldata[$d->key]
                    ];
		    }
		    
		    if($d->type == 'address' && !isset($d->enableManualMode))
		    {
		        $newArray[] = (object) [
                        'label' => $d->label,
                        'type' => $d->type,
                        'value' => $alldata[$d->key]
                    ];
		    }
		    
		    if($d->type == 'address' && isset($d->enableManualMode) && $d->enableManualMode == 1)
		    {
                    $alldatas = [];
                    $count = 0;
		        foreach($d->components as $k => $c)
	        	{
	        	    $alldatas[] = (object) [
                        'label' => $c->label,
                        'type' => $c->type,
                        'value' => $alldata[$d->key.'_'.$c->key]
                    ];
                    $count++;
                    if($count == count($d->components))
                    {
                        $newArray[] = (object) [
                        'label' => $d->label,
                        'type' => $d->type,
                        'value' => $alldatas
                       ];
                    }
	        	}
		    }
		    
		    if($d->type == 'signature')
		    {
		       $newArray[] = (object) [
                        'label' => $d->label,
                        'type' => $d->type,
                        'value' => $alldata[$d->key]
                    ];
		    }
		    
		    if($d->type == 'file')
		    {
		       $newArray[] = (object) [
                        'label' => $d->label,
                        'type' => $d->type,
                        'value' => $alldata[$d->key]
                    ];
		    }
		    
		    if($d->type == 'MyNewComponent')
		    {
		       $newArray[] = (object) [
                        'label' => $d->label,
                        'type' => $d->type,
                        'value' => $alldata[$d->key]
                    ];
		    }
		    
		    if($d->type == 'MyBarcodeComponent')
		    {
		       $newArray[] = (object) [
                        'label' => $d->label,
                        'type' => $d->type,
                        'value' => $alldata[$d->key]
                    ];
		    }
		}
		$data['formdata'] = $newArray;
		
          array_push($empty_array,['id'=>$submissions->id,'form_id'=>$submissions->formid,'user_id'=>$submissions->userid,'form_data'=>$newArray,'organization_id'=>$submissions->organization_id,
          'form_location'=>$submissions->form_location,'status'=>$submissions->status,'created_at'=>$submissions->created_at]);

          return $empty_array;
      
  }
  
  
  //sync data
  
  public function makeSync(Request $request)
  { 
     $rules = [
                'user_id' => 'required',
            ];
     $messages = [
        'user_id.required' => 'The user_id  is required.',
       ];
            
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return json_encode(['msg'=>'Invalid Request','status'=>400,'data'=>[]]);
        }
        
      if(User::where('id',$request->user_id)->exists())
      {
          $allArray=[];
          $empty_array_for_submitted=[];
          $user_id = $request->user_id;
          
          $allArray["all_forms"] =  $formslist = Form::getuser_formslist($user_id);
          $allArray["user_details"] = User::getonedata([['id','=',$user_id],['status','=','1'],['role','=',2]]);
          $allArray["notificationsList"] = Notification::where('user_id','=',$user_id)->get();
          $submitted_forms = Submittedform::where('userid',$request->user_id)->limit(10)->orderBy('created_at', 'desc')->get();
          foreach($submitted_forms as $d)
          { 
              $formTitleObj = Form::select('form_title')->where('id',$d->formid)->first();
              $fromTitle = $formTitleObj->form_title;
              array_push($empty_array_for_submitted,['id'=>$d->id,'form_id'=>$d->formid,'user_id'=>$d->userid,'form_title'=>$fromTitle,'organization_id'=>$d->organization_id,
              'form_location'=>$d->form_location,'status'=>$d->status,'created_at'=>$d->created_at,"full_details"=>$this->getSubmittedFormDetailsByFormID($d->id)]);
              
          }
          
          $allArray["submitted_forms"]= $empty_array_for_submitted;
          
           return json_encode(['msg'=>'success','status'=>200,'data'=>$allArray]);
      }else{
          return json_encode(['msg'=>'User does not exist','status'=>400,'data'=>[]]);
      }
      
     
  }


}
