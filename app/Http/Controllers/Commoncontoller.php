<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use Mail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Mail\Mailtrap;
use Illuminate\Support\Facades\Config;

class Commoncontoller extends Controller
{
public function customLogin(Request $request)
{
 try{	
   	if(Session::get('admin') != '' || Session::get('organization') != ''){
   		$admin = Session::get('admin');
      $organization = Session::get('organization');
		  $messags['msg'] = "Already logged In";
		  $messags['erro']= 101;
			if($admin != null && $admin->role == 0){
		    $messags['redirecturl'] =  env('APP_URL').'dashboard';
			}
			elseif($organization != null && $organization->role == 0){
        $messags['redirecturl'] = env('APP_URL').'organization/dashboard';
			}
			 echo json_encode($messags);
		   die;
   	}
      $request->validate([
          'email' => 'required',
          'password' => 'required',
      ]);
 
      $credentials = $request->only('email', 'password');
       $email = $request->email;
       $password = $request->password;
       $wereh = [['email','=',$email],['status','=','1'],['role','!=',2]];
       $users =  User::getonedata($wereh);
         if($users != null){ 
             
         	if($request->password == Crypt::decryptString($users->password)){
         	      User::where('id','=',$users->id)->update(['updated_at'=>now()]);
         	       User::where('id','=',$users->id)->update(['last_login'=>now()]);
              if($users->role == 0 || $users->role == 3){
      					Session::put('admin',$users);
      					Session::put('adminid', $users->id);
      					Session::save();
      					$Page = ' | Dashboard';
      					$data['page'] = $Page;
      					$messags['msg'] = "";
      					$messags['erro']= 101;
      					$messags['redirecturl'] =  env('APP_URL').'dashboard';
              }elseif($users->role == 1 || $users->role == 4){
              	Session::put('organization',$users);
      					Session::put('organizationid', $users->id);
      					Session::save();
      					$Page = ' | Dashboard';
      					$data['page'] = $Page;
      					$messags['msg'] = "";
      					$messags['erro']= 101;
      					$messags['redirecturl'] = env('APP_URL').'organization/dashboard';
              }
         	}else{
         		$messags['msg'] = "Your credentials doesn't match with our record1.";
			      $messags['erro']= 202;
         	}
         }else{
		   	 $messags['msg'] = "Your credentails doesn't match with our record2.";
			   $messags['erro']= 202;
       }
   }catch(\Exception $e){
		  $messags['msg'] = $e->getMessage();
		  $messags['erro']= 202;
    } 

	echo json_encode($messags);
	die;

      return redirect("/")->withSuccess('Log in details are not valid.');
}


public function customRegistration(Request $request)
{  
    $request->validate([
       /* 'name' => 'required',*/
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6',
    ]);
       
    $data = $request->all();
    $data['role']= 0;
    $data['status'] = 1;
    $data['parent_id'] = 1;
    $check = $this->create($data);
     
    return redirect("dashboard")->withSuccess('You have signed-in');
}

public function create(array $data)
{
  return User::create([
   /* 'name' => $data['name'],*/
    'email' => $data['email'],
    'role' => $data['role'],
    'status' => $data['status'],
    'parent_id' => $data['parent_id'],
    'role' => $data['role'],
    /*'password' => Hash::make($data['password'])*/
    'password' => Crypt::encryptString($data['password'])
  ]);
}

public function forgetpassword(Request $request)
{
	try{
	if($request->isMethod('post')){
    	 $data = $request->all();
    	 $were = [['email','=',$data['email']],['status','=','1'],['role','!=',2]];
    	 $users =  User::getonedata($were);
    	 if($users != null && $users != ''){
    		$id = $users->id; 
    		$hash    = md5(uniqid(rand(), true));
    		$string  = $id."&".$hash;
    		$iv = base64_encode($string);

    		$dat['otp'] = $this->generateNumericOTP();
    		
    		if($users->name != '' && $users->name != null)
    		{ 
          $dat['name'] = $users->name.',';
    		}else{
    			$dat['name'] = '';
    		}
    		$dat['url']  = url('reset_password/'.$iv);
    		$dat['body'] = 'Your reset password OTP is:'.$dat['otp'];
    		$dat['page'] = 'emails.forgetpassword';
    		$updatedata = ['forget_pass'=> $dat['otp']];
    		if(User::updateoption2($updatedata,array('id'=>$users->id))){
    		 Mail::to($users->email)->send(new Mailtrap($dat));
    		 $messags['msg'] = 'OTP has been sent to your email address, Please check your!!';
    		 $messags['erro']= 101;
    		 $messags['redirecturl'] =  $dat['url'];
    		}else{
    			$messags['msg'] = 'Oops, there is some problem, try again later!!';
    			$messags['erro']= 202;
    		}
    	 }else{
 		    $messags['msg'] = "This email doesn't exist.";
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

    function generateNumericOTP($n=4) {
     
    $generator = "1357902468";
  
    $result = "";
  
    for ($i = 1; $i <= $n; $i++) {
        $result .= substr($generator, (rand()%(strlen($generator))), 1);
    }
    // Return result
    return $result;
  }


  public function verifyotp(Request $request)
  {
    try{
      if($request->isMethod('post')){
         $data = $request->all();
         $otp = $data['digit1'].$data['digit2'].$data['digit3'].$data['digit4'];
         $id = base64_decode($data['requesturl']);
         $iparr = explode("&", $id); 
         $were = [['forget_pass','=',$otp],['id','=',$iparr[0]],['status','=','1'],['role','!=',2]];
         $users =  User::getonedata($were);
        if($users != null && $users != ''){
            $messags['msg'] = '';
            $messags['erro']= 101;
            $messags['redirecturl'] =  url('change_password/'.$data['requesturl']);
         }else{
          $messags['msg'] = "This is OTP doesn't match, please try again.";
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

  public function passwordchange(Request $request)
  {
    try{
      if($request->isMethod('post')){
         $data = $request->all();
         $id = base64_decode($data['requesturl']);
         $iparr = explode("&", $id); 
         $were = [['id','=',$iparr[0]],['status','=','1'],['role','!=',2]];
         $users =  User::getonedata($were);
         $genotp = $this->generateNumericOTP();
         $updatedata = ['forget_pass'=> $genotp,'password'=> Crypt::encryptString($data['newpassword'])];
       if($users != null && $users != ''){
          if(User::updateoption2($updatedata,array('id'=>$iparr[0]))){
          $messags['msg'] = 'Your password has been changed successfully!!.';
          $messags['erro']= 101;
          $messags['redirecturl'] =  url('/');
          }else{
            $messags['msg'] = 'Oops, there is some problem, try again later!!.';
            $messags['erro']= 202;
          }
        }else{
          $messags['msg'] = "The Token has expired, please try again.";
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
}
