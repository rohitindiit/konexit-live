<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use Mail;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Routing\Redirector;
use App\Mail\Mailtrap;
use Redirect;


class UserAuthController extends Controller
{
    //
    public function __construct(Request $request, Redirector $redirect)
    {  
        $this->middleware(function ($request, $next){
        if(Session()->exists('admin') || Session::get('organization'))
        { 
                $admin = Session::get('admin');
                $organization = Session::get('organization');
                $userid = ($admin != null && $admin != '') ? $admin : $organization;
                $were= [['id','=',$userid['id']],['status','=','1']];
                $exists= User::getbycondition($were);
            if(count($exists) > 0)
            {  
                if($admin != null && $admin->role == 0)
                {
                  return Redirect('/dashboard'); 
                }
                elseif($organization != null && $organization->role == 0)
                {
                  return Redirect('/organization/dashboard'); 
                }
            }
             return $next($request);
        }else
        {
             return $next($request);
        }
    });
    } 

    public function forgotpassword()
    {
		$Page = 'Forgot Password';
		$data['page'] = $Page;
		return view('forgotpassword',$data);
    }

    public function resetPassword()
    {
        $Page = 'Reset Password';
        $data['page'] = $Page;
        return view('resetpassword',$data);
    }

    public function changePassword()
    {
        $Page = 'Change Password';
        $data['page'] = $Page;
        return view('changepassword',$data);
    }
    
    

    
    public function signOut() {
        Session::flush();
        Auth::logout();
        return Redirect('/');
    }


}
