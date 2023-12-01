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
use Illuminate\Support\Facades\Config;
use Mail;
use App\Mail\Mailtrap;

class Organisation extends Adminfunction
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

  public function addorganisation(Request $request)
  {
    try{
      if($request->isMethod('post'))
      {
         $data = $request->all();
        unset($data['_token']);
        if($request->password == $request->confirmpassword){
        $were = [['email','=',$data['email']],['status','!=','3'],['role','!=',2]];
        $users =  User::getonedata($were);
        if($users == null){
          $alldata = [
                'name' => $data['name'],
                'email' => $data['email'],
                'division' => $data['division'],
                'role' => 1,
                'status' => isset($data['confirmation_email']) ? '0' : '1',
                'parent_id' => 1,
                'password' => Crypt::encryptString($data['password']),
                'user_quota' => $data['user_quota'],
                'desktop_quota' => $data['desktop_quota']
              ];
              if($request->file('choosefile')){
              $alldata['profile'] = $this->imageUploadPost($request,'organization');
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
                $dat['url']  = url('login/'.$iv);
                $dat['body'] = 'Your account has been added as an organization. Your login credentials are Email:'.$data['email'].' and Password:'.$data['password'].'. Confirm your account by below link.';
                $dat['page'] = 'emails.confimationemail';
                $dat['buttoname'] = 'Confirm Acount';
                $messags['msg'] = 'The organization has been added successfully and confirmation has been sent to the organization user!!.';
               }else
               {
                $dat['url']  = url('login/');
                $dat['body'] = 'Your account has been added as an organization. Your login credentials are Email:'.$data['email'].' and Password:'.$data['password'].'. Login your account by below link.';
                $dat['buttoname'] = 'Login';
                $messags['msg'] = 'The organization has been added successfully and confirmation has been sent to the organization user!!.';
               }
               $dat['page'] = 'emails.confimationemail';
               Mail::to($data['email'])->send(new Mailtrap($dat));
               $messags['erro']= 101;
               $messags['redirecturl'] =  url('/organisations');
               //$messags['msg'] = 'Organization has been added successfully!!.';
               $messags['erro']= 101;
            }else
            {
              $messags['msg'] = 'Oops, there is some problem, try again later!!.';
              $messags['erro']= 202;
            }
           }else
           {
             $messags['msg'] = 'The organization user has been already existing in record with this same email!!.';
              $messags['erro']= 202;
           }
          }else{
            $messags['msg'] = 'Confirm password does not match with a new password.';
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

  public function getorganisationdata(Request $request)
  {
    try{
      if($request->isMethod('post'))
      {
        $data = $request->all();
        echo '<pre>'; print_r($data); die;
      }
      }catch(\Exception $e){
       $messags['msg'] = $e->getMessage();
       $messags['erro']= 202;
    } 
      echo json_encode($messags);
      die;
  }


  public function editorganisation(Request $request)
  {
    try{
      if($request->isMethod('post'))
      {
        $data = $request->all();
        unset($data['_token']);
        unset($data['id']);
        $were = [['email','=',$data['email']],['status','!=','3'],['id','!=',$request->id],['role','!=',2]];
        $users =  User::getonedata($were);
        if($users == null){
          $userd =  User::getonedata([['id','=',$request->id]]);
          if((int)$data['user_quota'] < (int)$userd->total_users)
          {
            $messags['msg'] = "You can't change the user quota because the organization has more users than this.";
            $messags['erro']= 202;
            echo json_encode($messags); die;
          }else
          {
             $alldata = [
                'name' => $data['name'],
                'email' => $data['email'],
                'division' => $data['division'],
                'user_quota' => $data['user_quota'],
                'desktop_quota' => $data['desktop_quota']
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
              $alldata['profile'] = $this->imageUploadPost($request,'organization');
               $this->removeprofilepic([['id','=',$request->id]]);
               unset($data['choosefile']);
              }else{
               unset($data['choosefile']);
              }
            if(User::updateoption2($alldata,[['id','=',$request->id]]))
            {
               $messags['redirecturl'] =  url('/organisations');
               $messags['msg'] = 'The organization has been updated successfully!!.';
               $messags['erro']= 101;
            }else
            {
              $messags['msg'] = 'Oops, there is some problem, try again later!!.';
              $messags['erro']= 202;
            }
          }
       }else
       {
         $messags['msg'] = 'Organization user has been already existing in record with this same email!!.';
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


  public function deleteorganization(Request $request)
  {
    try{
       if($request->isMethod('post')){
         $data = $request->all();
         $newdata['status'] = '3';
         User::updateoption2($newdata,[['id','=',$data['id']]]);
         return redirect()->back()->with('message', 'The Organization has been deleted successfully!!.');
       }
    }catch(\Exception $e){
       return redirect("/")->with('message2', 'Oops, there is some problem, try again later!!.');
    } 
  }

 public function addorganization_user(Request $request,$id='')
 {
   try{
     if($request->isMethod('post')){
      $organizationdata = User::getonedata([['id','=',$id]]);
     // return $organizationdata->user_quota;
      if($organizationdata->user_quota == $organizationdata->total_users)
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
              'status' => $data['status'],
               'role' => 2,
               'parent_id'=> $id
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
                $messags['msg'] = 'The User has been added successfully and confirmation has been sent to the organization user!!.';
                $dat['page'] = 'emails.confimationemail';
                Mail::to($data['email'])->send(new Mailtrap($dat));
               }
               User::updateoption2(['total_users'=> User::getcount([['parent_id','=',$id]])],[['id','=',$id]]);
               $messags['erro']= 101;
               $messags['redirecturl'] =  url('/'.$id.'/users');
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

 public function editorganization_user(Request $request,$id='',$userid='')
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
               $messags['redirecturl'] =  url('/'.$id.'/users');
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

 public function deleteusers(Request $request,$id='')
 {
  try{
     if($request->isMethod('post')){
      $data = $request->all();
      $newdata['status'] = '3';
      User::updateoption2($newdata,[['id','=',$data['id']],['parent_id','=',$id]]);
      return redirect()->back()->with('message', 'The user has been deleted successfully!!.');
     }
     }catch(\Exception $e){
       return redirect("/")->with('message2', 'Oops, there is some problem, try again later!!.');
    } 
 }


 public function statusorganization(Request $request,$id='')
  {
  try{
     if($request->isMethod('post')){
      $data = $request->all();
      $newdata['status'] = $data['status'];
      User::updateoption2($newdata,[['id','=',$data['id']]]);
      return redirect()->back()->with('message', 'The status has been changed successfully!!.');
     }
     }catch(\Exception $e){
       return redirect("/")->with('message2', 'Oops, there is some problem, try again later!!.');
    } 
 }

  public function statususers(Request $request,$id='')
  {
     
  try{
     if($request->isMethod('post')){
      $data = $request->all();
      $newdata['status'] = $data['status'];
      User::updateoption2($newdata,[['id','=',$data['id']],['parent_id','=',$id]]);
      return redirect()->back()->with('message', 'The status has been changed successfully!!.');
     }
     }catch(\Exception $e){
      return redirect("/")->with('message2', 'Oops, there is some problem, try again later!!.');
    } 
 }

 public function search_Organizations(Request $request)
{
    try {
        $data = $request->all();
         $ktxNumber=0;
        if (strpos($data['query'], "KXT") === 0) {
            // The string starts with "KXT", so remove it
            $ktxNumber = str_replace("KXT", "", $data['query']);
        }
        
        if (strpos($data['query'], "kxt") === 0) {
            // The string starts with "KXT", so remove it
            $ktxNumber = str_replace("kxt", "", $data['query']);
        }
  
        // Rest of your code
        $obj = User::where('status', '!=', '3')
            ->where(function ($query) use ($data) {
                $query->where('role', 1)
                    ->orWhere('role', 4);
            })
            ->where(function ($query) use ($data, $ktxNumber) {
                $query->where('email', 'like', '%' . $data['query'] . '%')
                    ->orWhere('name', 'like', '%' . $data['query'] . '%')
                    ->orWhere('id', $ktxNumber);
            })
            ->orderBy('id', 'desc')
            ->get();

        $arr = [];
        foreach ($obj as $ob) {
            $index1 = $formatted_number = sprintf("%03d", $ob->id);
            $arr[] = [
                'value' => $ob->id,
                'label' => $ob->email . ' ' . $ob->name . ' ' . 'KXT' . $index1
            ];
        }

        $data['users'] = $arr;
        return json_encode($data['users']);
    } catch (\Exception $e) {
        $messags['msg'] = $e->getMessage();
        $messags['erro'] = 202;
        echo json_encode($messags);
        die;
    }
}

 


}
