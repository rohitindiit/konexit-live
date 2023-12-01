<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class TrackUserActivity
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
            User::where('id','=',$user_id)->update(['updated_at'=>now()]);
            return $next($request);
        }
        
         if(session()->has("admin")) {
            $user_id = session('admin')->id;
            User::where('id','=',$user_id)->update(['updated_at'=>now()]);
            return $next($request);
        }
        
        return redirect()->route('login-main');
        exit();
    }
}
