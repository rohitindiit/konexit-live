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

class Nologin extends Controller
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
    }
     return $next($request);
    });
  }


  public function headervariables($id='')
  {
    if($id == '')
    {
          $Session = Session::get('admin');
          Config::set('site_vars.profile.name', $Session->name != null ? $Session->name : '');
      Config::set('site_vars.profile.email', $Session->email);
      Config::set('site_vars.profile.profile', $Session->profile != null ? $Session->profile : url('/').'/resources/views/Admin/assets/img/user1.png');
    }else
    {
      $wereh = [['id','=',$this->user_id],['status','=','1']];
      $users =  User::getonedata($wereh);
      if($users != null){ 
      Config::set('site_vars.profile.name', $users->name != null ? $users->name : '');
      Config::set('site_vars.profile.email', $users->email);
      Config::set('site_vars.profile.profile', $users->profile != null ? $users->profile : url('/').'/resources/views/Admin/assets/img/user1.png');
      } 
    }
     return true;
  }


  public function loginconfirm($id='')
  {
    try{
    $id = base64_decode($id);
    $iparr = explode("&", $id); 
    $were = [['id','=',$iparr[0]],['status','=','0']];
    $users =  User::getonedata($were);
      if($users != null && $users != ''){
        $updatedata = ['status'=> '1'];
        User::updateoption2($updatedata,array('id'=>$iparr[0]));
       return redirect("/")->with('message', 'Your account has been verified!!.');
      }else{
          return redirect("/")->with('message2', 'Link has been expired!!.');
      }
    }catch(\Exception $e){
       return redirect("/")->with('message2', 'Link has been expired!!.');
    } 
  }



  public function signOut() {
    Session::flush();
    Auth::logout();
    return Redirect('/');
  }

//   public function autologout()
//     {
        
//          if(session()->has("organization")) {
//               $user_id = session('organization')->id;
//               $lastActivity = User::where('id','=',$user_id)->pluck('updated_at')->implode(''); 
//               $timeout = 2 * 60 * 60; // 2 hours in seconds
//               $now = \Carbon\Carbon::now();
//               if ($now->diffInSeconds($lastActivity) > $timeout) {
//                   Session::flush();
//                   Auth::logout();
//               }
//         }
        
//          if(session()->has("admin")) {
//             $user_id = session('admin')->id;
//               $lastActivity = User::where('id','=',$user_id)->pluck('updated_at')->implode(''); 
//               $timeout = 2 * 60 * 60; // 2 hours in seconds
//               $now = \Carbon\Carbon::now();
//               if ($now->diffInSeconds($lastActivity) > $timeout) {
//                   Session::flush();
//                   Auth::logout();
//               }
//         }
      
   // }
  


  

}
