<?php

namespace App\Console\Commands;
use App\Models\User;
use Illuminate\Console\Command;

class AutoLogout extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:logout';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
    //   if(session()->has("organization")) {
    //           $user_id = session('organization')->id;
            //   $lastActivity = User::where('id','=',$user_id)->pluck('updated_at')->implode(''); 
            //   $timeout = 2 * 60 * 60; // 2 hours in seconds
            //   $now = \Carbon\Carbon::now();
            //   if ($now->diffInSeconds($lastActivity) > $timeout) {
            //       Session::flush();
            //       Auth::logout();
            //   }
            User::where('id','=','10')->update(['phone'=>'000000']);
           
        //}
        
         if(session()->has("admin")) {
            $user_id = session('admin')->id;
            //   $lastActivity = User::where('id','=',$user_id)->pluck('updated_at')->implode(''); 
            //   $timeout = 2 * 60 * 60; // 2 hours in seconds
            //   $now = \Carbon\Carbon::now();
            //   if ($now->diffInSeconds($lastActivity) > $timeout) {
            //       Session::flush();
            //       Auth::logout();
            //   }
            User::where('id','=',$user_id)->update(['phone'=>'000000']);
        }

        
    }
}
