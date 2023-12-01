<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
use Session,Auth;
class AutoLogout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    { 
        
       if(session()->has("organization")) {
              $user_id = session('organization')->id;
              $lastActivityObj = DB::table('users')
            ->where('id', $user_id)
            ->first();
              $timeout =  7200; // 2 hours in seconds
              $now = \Carbon\Carbon::now();
             
              $lastActivity = $lastActivityObj->updated_at;
              if ($now->diffInSeconds($lastActivity) > $timeout) {
                  Session::flush();
                  Auth::logout();
                  
              }
        }
        
         if(session()->has("admin")) {
            $user_id = session('admin')->id;
             $lastActivityObj = DB::table('users')
            ->where('id', $user_id)
            ->first();
              $timeout =  60; // 2 hours in seconds
              $now = \Carbon\Carbon::now();
             
              $lastActivity = $lastActivityObj->updated_at;
              if ($now->diffInSeconds($lastActivity) > $timeout) {
                  Session::flush();
                  Auth::logout();
                  
              }
              
         }
         
       return $next($request);
    }
}
