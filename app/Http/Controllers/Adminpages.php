<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use Mail;
use App\Models\User;
use App\Models\Form;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Routing\Redirector;
use App\Models\Submittedform;
use App\Mail\Mailtrap;
use Redirect;
use App\Models\SubmissionComments;
use Illuminate\Support\Facades\Config;
use DB;

class Adminpages extends Controller
{
    //
    private $user_id;

    public function __construct(Request $request, Redirector $redirect)
    {  
		$this->middleware(function ($request, $next){
		if(Session()->exists('admin')  || Session::get('organization'))
		{ 
			 $userid = (Session()->get('admin') != null && Session()->get('admin') != '') ? Session()->get('admin') : Session()->get('organization');
			$were= [['id','=',$userid['id']],['status','=','1']];
			$exists= User::getbycondition($were);
			$this->user_id = $userid['id'];
		if(count($exists) > 0)
		{  $this->headervariables($this->user_id);
			return $next($request);
		}else
		{ 
			$this->middleware('auth');
			Auth::logout();
			Session::flush();
			return Redirect('/'); 
		}
		}else
		{
			$this->middleware('auth');
			Auth::logout();
			Session::flush();
			return Redirect('/');   
		}
		 return $next($request);
		});
    }


    public function dashboard()
    { 
        if(!$this->checkAccess('dashboard'))
        { 
            $Page = ' | No Access';
            $data['page'] = $Page;
            return view('Admin/noaccess',$data);
        }
           
		$Page = ' | Dashboard';
		$data['page'] = $Page;
		$were = [['status','!=','3'],['role','=','1']];
		 $data['total_organisations'] = User::getcount($were);
		$were2 = [['status','!=','3'],['role','=','2']];
		$data['total_users'] = User::getcount($were2);
		
		$were3 = [['status','!=','2']];
		$data['total_forms'] = Form::getcount($were3);
		
		$were4 = [['status','!=','2']];
		$data['total_submissions'] = Submittedform::getcount($were4);
		
		$data['submission_by_organizations'] =  Submittedform::select('organization_id', DB::raw('COUNT(*) as count'))->groupBy('organization_id')->orderBy('count','desc')->get();
         $data['recent_organizations'] =  USER::where('role',1)->orderByDesc('created_at')->get();
         $data['submission_by_form'] =  Submittedform::select('formid', DB::raw('COUNT(*) as count'))->groupBy('formid')->orderBy('count','desc')->get();

	//	$submission_by_organizations = [['users.status','!=','3'],['users.role','=','1']];
	//	$data['submission_by_organisations'] = User::submission_by_organization($submission_by_organizations);
		
		
	//	echo '<pre>'; print_r($data); die; 
		return view('Admin/dashboard',$data);
    }
    
      public function singleSubmissionCountChartForms(Request $req)
    { 
        if($req->duration=="today")
        {
               $currentDateObj = \Carbon\Carbon::now();
               $currentDate = $currentDateObj->toDateString();
               $dayNames = [];
               
                $dayNames['allday'][$currentDate]['pending'] = Submittedform::where('formid','=',$req->id)->whereDate('created_at', $currentDate)
                ->where('status', '=', '0')
                ->count();
                
                $dayNames['allday'][$currentDate]['complete'] = Submittedform::where('formid','=',$req->id)->whereDate('created_at', $currentDate)
                ->where('status', '=', '1')
                ->count();
                
                 $dayNames['allday'][$currentDate]['needaction'] = Submittedform::where('formid','=',$req->id)->whereDate('created_at', $currentDate)
                ->where('status', '=', '2')
                ->count();
            
            return json_encode($dayNames);
        }
        
        if($req->duration=="current_week")
        {
               $currentDate = \Carbon\Carbon::now();
               $startDate = $currentDate->startOfWeek();
               $dayNames = [];
               $days=[];
            for ($day = 0; $day < 7; $day++) {
               
               $nextDay = $startDate->copy()->addDay($day);
                $dayOfWeek =$nextDay->format('D');
              
                $dayNames['allday'][$dayOfWeek]['pending'] = Submittedform::where('formid','=',$req->id)->whereDate('created_at', $nextDay)
                ->where('status', '=', '0')
                ->count();
                
                $dayNames['allday'][$dayOfWeek]['complete'] = Submittedform::where('formid','=',$req->id)->whereDate('created_at', $nextDay)
                ->where('status', '=', '1')
                ->count();
                
                 $dayNames['allday'][$dayOfWeek]['needaction'] = Submittedform::where('formid','=',$req->id)->whereDate('created_at', $nextDay)
                ->where('status', '=', '2')
                ->count();
            }
            return json_encode($dayNames);
        }
        
        if($req->duration=="last_week")
        {
               $currentDate = \Carbon\Carbon::now();
               $startDate = $currentDate->subWeek()->startOfWeek();
               $dayNames = [];
               $days=[];
            for ($day = 0; $day < 7; $day++) {
               
               $nextDay = $startDate->copy()->addDay($day);
                $dayOfWeek =$nextDay->format('D');
              
                $dayNames['allday'][$dayOfWeek]['pending'] = Submittedform::where('formid','=',$req->id)->whereDate('created_at', $nextDay)
                ->where('status', '=', '0')
                ->count();
                
                $dayNames['allday'][$dayOfWeek]['complete'] = Submittedform::where('formid','=',$req->id)->whereDate('created_at', $nextDay)
                ->where('status', '=', '1')
                ->count();
                
                 $dayNames['allday'][$dayOfWeek]['needaction'] = Submittedform::where('formid','=',$req->id)->whereDate('created_at', $nextDay)
                ->where('status', '=', '2')
                ->count();
            }
            return json_encode($dayNames);
        }
        
        if($req->duration=="this_month")
        {
            $months = [];
            $currentMonthStart = \Carbon\Carbon::now()->startOfMonth();
            $currentMonthEnd = \Carbon\Carbon::now()->endOfMonth();
            
            // Create an array to store the dates
            $dates = [];
            
            // Iterate from the start date to the end date and add each date to the array
            for ($date = $currentMonthStart; $date->lte($currentMonthEnd); $date->addDay()) {
                $dates[] = $date->toDateString();
            }
            
            // Output the dates
            foreach ($dates as $date) {
           
            $pending_count = Submittedform::where('formid','=',$req->id)->whereDate('created_at', $date)->where('status','=','0')->count();
           $completed_count =Submittedform::where('formid','=',$req->id)->whereDate('created_at', $date)->where('status','=','1')->count();
            $needaction_count =Submittedform::where('formid','=',$req->id)->whereDate('created_at', $date)->where('status','=','2')->count();
            
            if($pending_count ||$completed_count || $needaction_count )
                     {
                        $months['status'][$date]['pending']=$pending_count;
                        $months['status'][$date]['completed']=$completed_count;
                        $months['status'][$date]['needaction']=$needaction_count;
                     }
                 
            }
            
            return json_encode($months);
        }
        
        if($req->duration=="last_month")
        {
            $months = [];
            $currentMonthStart = \Carbon\Carbon::now()->startOfMonth();
            $currentMonthEnd = \Carbon\Carbon::now()->endOfMonth();
            
            // Get the start date and end date of the last month
            $lastMonthStart = $currentMonthStart->subMonth()->startOfMonth();
            $lastMonthEnd = $lastMonthStart->copy()->endOfMonth();
            
            // Create an array to store the dates
            $dates = [];
            
            // Iterate from the start date to the end date and add each date to the array
            for ($date = $lastMonthStart; $date->lte($lastMonthEnd); $date->addDay()) {
                $dates[] = $date->toDateString();
            }
            
            // Output the dates
            foreach ($dates as $date) {
           
            $pending_count = Submittedform::where('formid','=',$req->id)->whereDate('created_at', $date)->where('status','=','0')->count();
            $completed_count =Submittedform::where('formid','=',$req->id)->whereDate('created_at', $date)->where('status','=','1')->count();
            $needaction_count =Submittedform::where('formid','=',$req->id)->whereDate('created_at', $date)->where('status','=','2')->count();
            
            if($pending_count ||$completed_count || $needaction_count )
                     {
                        $months['status'][$date]['pending']=$pending_count;
                        $months['status'][$date]['completed']=$completed_count;
                        $months['status'][$date]['needaction']=$needaction_count;
                     }
                 
            }
            
            return json_encode($months);
        }
        
         if($req->duration=="yearly")
         { 
            $currentYear = \Carbon\Carbon::now()->year;
            $lastFiveYears = [];
            
            for ($i = 0; $i < 5; $i++) {
                 $year = $currentYear - $i;
                 $lastFiveYears['years'][] = $currentYear - $i;
                 $lastFiveYears['pending'][] = Submittedform::where('formid','=',$req->id)->whereYear('created_at', $year)->where('status','=','0')->count();
                 $lastFiveYears['completed'][] = Submittedform::where('formid','=',$req->id)->whereYear('created_at', $year)->where('status','=','1')->count();
                 $lastFiveYears['needaction'][] = Submittedform::where('formid','=',$req->id)->whereYear('created_at', $year)->where('status','=','2')->count();
            }
            return json_encode($lastFiveYears);
         }
         
         if($req->duration=="range")
         { 
                    $months=[];
                    $start = \Carbon\Carbon::parse($req->start_date);
                    $end = \Carbon\Carbon::parse($req->end_date);
                    
                    // Create an empty array to store the dates
                    $dates = [];
                 
                    // Loop through each date and add it to the array
                    for ($date = $start; $date->lte($end); $date->addDay()) {
                        $dates[] = $date->toDateString();
                    }
                  
                // Output the dates
                foreach ($dates as $date) {
                      
                      $pending_count = Submittedform::where('formid','=',$req->id)->whereDate('created_at', $date)->where('status','=','0')->count();
                     $completed_count=Submittedform::where('formid','=',$req->id)->whereDate('created_at', $date)->where('status','=','1')->count();
                     $needaction_count=Submittedform::where('formid','=',$req->id)->whereDate('created_at', $date)->where('status','=','2')->count();
                     
                     if($pending_count ||$completed_count || $needaction_count )
                     {
                        $months['status'][$date]['pending']=$pending_count;
                        $months['status'][$date]['completed']=$completed_count;
                        $months['status'][$date]['needaction']=$needaction_count;
                     }
                    
                        
                }
                
                return json_encode($months);
               
          }

    }
    
     // count form chart for full organistion
    
    public function submissionCountChartForms(Request $req)
    { 
        if($req->duration=="today")
        {
               $currentDateObj = \Carbon\Carbon::now();
               $currentDate = $currentDateObj->toDateString();
               $dayNames = [];
               
                $dayNames['allday'][$currentDate]['pending'] = Submittedform::whereDate('created_at', $currentDate)
                ->where('status', '=', '0')
                ->count();
                
                $dayNames['allday'][$currentDate]['complete'] = Submittedform::whereDate('created_at', $currentDate)
                ->where('status', '=', '1')
                ->count();
                
                 $dayNames['allday'][$currentDate]['needaction'] = Submittedform::whereDate('created_at', $currentDate)
                ->where('status', '=', '2')
                ->count();
            
            return json_encode($dayNames);
        }
        
        if($req->duration=="current_week")
        {
               $currentDate = \Carbon\Carbon::now();
               $startDate = $currentDate->startOfWeek();
               $dayNames = [];
               $days=[];
            for ($day = 0; $day < 7; $day++) {
               
               $nextDay = $startDate->copy()->addDay($day);
                $dayOfWeek =$nextDay->format('D');
              
                $dayNames['allday'][$dayOfWeek]['pending'] = Submittedform::whereDate('created_at', $nextDay)
                ->where('status', '=', '0')
                ->count();
                
                $dayNames['allday'][$dayOfWeek]['complete'] = Submittedform::whereDate('created_at', $nextDay)
                ->where('status', '=', '1')
                ->count();
                
                 $dayNames['allday'][$dayOfWeek]['needaction'] = Submittedform::whereDate('created_at', $nextDay)
                ->where('status', '=', '2')
                ->count();
            }
            return json_encode($dayNames);
        }
        
        if($req->duration=="last_week")
        {
               $currentDate = \Carbon\Carbon::now();
               $startDate = $currentDate->subWeek()->startOfWeek();
               $dayNames = [];
               $days=[];
            for ($day = 0; $day < 7; $day++) {
               
               $nextDay = $startDate->copy()->addDay($day);
                $dayOfWeek =$nextDay->format('D');
              
                $dayNames['allday'][$dayOfWeek]['pending'] = Submittedform::whereDate('created_at', $nextDay)
                ->where('status', '=', '0')
                ->count();
                
                $dayNames['allday'][$dayOfWeek]['complete'] = Submittedform::whereDate('created_at', $nextDay)
                ->where('status', '=', '1')
                ->count();
                
                 $dayNames['allday'][$dayOfWeek]['needaction'] = Submittedform::whereDate('created_at', $nextDay)
                ->where('status', '=', '2')
                ->count();
            }
            return json_encode($dayNames);
        }
        
        if($req->duration=="this_month")
        {
            $months = [];
            $currentMonthStart = \Carbon\Carbon::now()->startOfMonth();
            $currentMonthEnd = \Carbon\Carbon::now()->endOfMonth();
            
            // Create an array to store the dates
            $dates = [];
            
            // Iterate from the start date to the end date and add each date to the array
            for ($date = $currentMonthStart; $date->lte($currentMonthEnd); $date->addDay()) {
                $dates[] = $date->toDateString();
            }
            
            // Output the dates
            foreach ($dates as $date) {
           
            $pending_count = Submittedform::whereDate('created_at', $date)->where('status','=','0')->count();
           $completed_count =Submittedform::whereDate('created_at', $date)->where('status','=','1')->count();
            $needaction_count =Submittedform::whereDate('created_at', $date)->where('status','=','2')->count();
            
            if($pending_count ||$completed_count || $needaction_count )
                     {
                        $months['status'][$date]['pending']=$pending_count;
                        $months['status'][$date]['completed']=$completed_count;
                        $months['status'][$date]['needaction']=$needaction_count;
                     }
                 
            }
            
            return json_encode($months);
        }
        
        if($req->duration=="last_month")
        {
            $months = [];
            $currentMonthStart = \Carbon\Carbon::now()->startOfMonth();
            $currentMonthEnd = \Carbon\Carbon::now()->endOfMonth();
            
            // Get the start date and end date of the last month
            $lastMonthStart = $currentMonthStart->subMonth()->startOfMonth();
            $lastMonthEnd = $lastMonthStart->copy()->endOfMonth();
            
            // Create an array to store the dates
            $dates = [];
            
            // Iterate from the start date to the end date and add each date to the array
            for ($date = $lastMonthStart; $date->lte($lastMonthEnd); $date->addDay()) {
                $dates[] = $date->toDateString();
            }
            
            // Output the dates
            foreach ($dates as $date) {
           
            $pending_count = Submittedform::whereDate('created_at', $date)->where('status','=','0')->count();
            $completed_count =Submittedform::whereDate('created_at', $date)->where('status','=','1')->count();
            $needaction_count =Submittedform::whereDate('created_at', $date)->where('status','=','2')->count();
            
            if($pending_count ||$completed_count || $needaction_count )
                     {
                        $months['status'][$date]['pending']=$pending_count;
                        $months['status'][$date]['completed']=$completed_count;
                        $months['status'][$date]['needaction']=$needaction_count;
                     }
                 
            }
            
            return json_encode($months);
        }
        
         if($req->duration=="yearly")
         { 
            $currentYear = \Carbon\Carbon::now()->year;
            $lastFiveYears = [];
            
            for ($i = 0; $i < 5; $i++) {
                 $year = $currentYear - $i;
                 $lastFiveYears['years'][] = $currentYear - $i;
                 $lastFiveYears['pending'][] = Submittedform::whereYear('created_at', $year)->where('status','=','0')->count();
                 $lastFiveYears['completed'][] = Submittedform::whereYear('created_at', $year)->where('status','=','1')->count();
                 $lastFiveYears['needaction'][] = Submittedform::whereYear('created_at', $year)->where('status','=','2')->count();
            }
            return json_encode($lastFiveYears);
         }
         
         if($req->duration=="range")
         { 
                    $months=[];
                    $start = \Carbon\Carbon::parse($req->start_date);
                    $end = \Carbon\Carbon::parse($req->end_date);
                    
                    // Create an empty array to store the dates
                    $dates = [];
                 
                    // Loop through each date and add it to the array
                    for ($date = $start; $date->lte($end); $date->addDay()) {
                        $dates[] = $date->toDateString();
                    }
                  
                // Output the dates
                foreach ($dates as $date) {
                      
                      $pending_count = Submittedform::whereDate('created_at', $date)->where('status','=','0')->count();
                     $completed_count=Submittedform::whereDate('created_at', $date)->where('status','=','1')->count();
                     $needaction_count=Submittedform::whereDate('created_at', $date)->where('status','=','2')->count();
                     
                     if($pending_count ||$completed_count || $needaction_count )
                     {
                        $months['status'][$date]['pending']=$pending_count;
                        $months['status'][$date]['completed']=$completed_count;
                        $months['status'][$date]['needaction']=$needaction_count;
                     }
                    
                        
                }
                
                return json_encode($months);
               
          }

    }
    
     public function submissionCountChartFormsMonthly(Request $req)
    {
        $currentYear = \Carbon\Carbon::now()->year;
        $months = [];
        for ($month = 1; $month <= 12; $month++) {
            $date = \Carbon\Carbon::create($currentYear, $month, 1);
            $months['months'][] = $date->format('M');
            $months['status'][$date->format('M')]['pending'] = Submittedform::whereMonth('created_at', $month)->where('status','=','0')->count();
            $months['status'][$date->format('M')]['completed'] =Submittedform::whereMonth('created_at', $month)->where('status','=','1')->count();
            $months['status'][$date->format('M')]['needaction'] =Submittedform::whereMonth('created_at', $month)->where('status','=','2')->count();
        }
       
        return json_encode($months);
     }
     public function getComments(Request $request)
    {
         $all=[];
         $id = $request->submissionId;
         $comments =SubmissionComments::where('submission_id','=',$id)->orderByDesc('created_at')->latest('created_at') // Order by created_at in descending order
    ->take(2)              // Limit the number of results to 2
    ->get();
         foreach($comments as $single)
         {
             $id = $single->comment_by;
             $name = User::where('id',"=",$id)->pluck('name')->implode('');
             $carbonDate = \Carbon\Carbon::parse($single->created_at);

        $formattedDate = $carbonDate->format('d-M-Y g:i A');
             array_push($all,["comment"=>$single->comment,"created_at"=>$formattedDate,"name"=>$name]);
             
         }
         return json_encode($all);
    }
     
    public function submissionCountChartFormsWeekly(Request $req)
    {
          //$startDate = \Carbon\Carbon::now()->subDays(7)->startOfDay();
          $currentDate = \Carbon\Carbon::now();
           $startDate = $currentDate->startOfWeek();
        $dayNames = [];
         $days=[];
        for ($day = 0; $day < 7; $day++) {
           
           $nextDay = $startDate->copy()->addDay($day);
            $dayOfWeek =$nextDay->format('D');
          
            $dayNames['allday'][$dayOfWeek]['pending'] = Submittedform::whereDate('created_at', $nextDay)
            ->where('status', '=', '0')
            ->count();
            
            $dayNames['allday'][$dayOfWeek]['complete'] = Submittedform::whereDate('created_at', $nextDay)
            ->where('status', '=', '1')
            ->count();
            
             $dayNames['allday'][$dayOfWeek]['needaction'] = Submittedform::whereDate('created_at', $nextDay)
            ->where('status', '=', '2')
            ->count();
            
        }
        
        return json_encode($dayNames);

     }

    public function profile()
    {
         if(!$this->checkAccess('settings'))
        { 
            $Page = ' | No Access';
            $data['page'] = $Page;
            return view('Admin/noaccess',$data);
        }
        
		$Page = ' | Profile';
		$data['page'] = $Page;
		$data['profile'] = User::getonedata([['id','=',$this->user_id]]);
		return view('Admin/profile',$data);
    }

    public function organisations(Request $request)
    {
         if(!$this->checkAccess('organisations'))
        { 
            $Page = ' | No Access';
            $data['page'] = $Page;
            return view('Admin/noaccess',$data);
        }
        
    	$data = $request->all();
		$Page = ' | Organisations';
		$data['page'] = $Page;
		$were = [['status','!=','3'],['role','=','1']];
		$weres = [];
		 if(isset($data['search']) || isset($data['status'])){
        	 if(isset($data['status']) && $data['status'] != null){
              $were[] = ['status','=',$data['status']];
        	}
        	if(isset($data['search']) && $data['search'] != null){
               $weres[] = ['email','like','%' .$data['search']. '%'];
               $weres[] = ['name','like','%' .$data['search']. '%'];
        	} 
        }

		$data['organisations'] = User::getbyconditionmultiple($were,$weres);
		 if(isset($data['search']) || isset($data['status'])){
          if(isset($data['status']) && $data['status'] != null){
             $data['organisations']->appends(['status' => $data['status']]);
          }
            
         if(isset($data['search']) && $data['search'] != null){
             $data['organisations']->appends(['search' => $data['search']]);
          } 
        }
		return view('Admin/organisations',$data);
    }

    public function addorganisation()
    {
		$Page = ' | Add Organisations';
		$data['page'] = $Page;
		return view('Admin/addorganisation',$data);
    }

    public function editorganisation($id='')
    { 
		$Page = ' | Edit Organisations';
		$data['page'] = $Page;
		$data['organisation'] = User::getonedata([['id','=',$id]]);
		return view('Admin/editorganisation',$data);
    }
    
    public function allUsers()
    {
        $Page = ' | Users';
       
        $data['users'] =  User::where('role',3)->orWhere('role',4)->paginate(10);
        $data['page'] = $Page;
        return view('Admin/users',$data);
    }
    
    public function addDsesktopUser()
    {
        $Page = ' | Users';
        $data['page']=$Page;
        $data['organisations'] = User::where('role',1)->get();
        return view('Admin/add_desktop_user',$data);
    }
    
    public function saveDsesktopUser(Request $request)
    {  
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $division = $request->division;
        $useremail = $request->user_email;
        $userpassword = $request->user_password;
        $userrole = 3;
        $profile = $request->user_profile;
        $confirmstatus = $request->user_confirmation_email;
        $user = new User();
        $user->parent_id =1;
        $user->name=$first_name;
        $user->lname=$last_name;
        $user->division=$division;
        $user->role=$userrole;
        $user->email=$useremail;
        $user->	password=Crypt::encryptString($userpassword);
        $user->profile=$profile;
        $user->phone='';
        $user->user_quota=0;
        $user->total_users=0;
        $user->status='1';
        $user->save();
          if($user->id)
        {
            $createdUserId = $user->id;
            return redirect()->route('admin.permissions',$createdUserId); 
        }
        return redirect()->back()->with('success', 'User creted'); 
    }
    
     public function editSubadminView($uid)
     {
       
		$Page = ' | Edit Suborganistion';
		$data['page'] = $Page;
		$data['suborg'] =User::where('id','=',$uid)->first();
		$data['uid']=$uid;
		return view('Admin/edit_subadmin',$data);
     }
    
    public function updateSuborgAdmin(Request $request)
    { 
         $fname =  $request->user_first_name;
         $lname =  $request->user_last_name;
         $division =  $request->division;
         $user_email = $request->user_email;
         $password = $request->user_password;
         $profile = 'https://dev.indiit.solutions/konexits/resources/views/organization/assets/img/'.$request->user_profile;
         $uid = $request->uid;
        
         if($profile && $password){
            $updated_array = ['name'=>$fname,'lname'=>$lname,'email'=>$user_email,"division"=>$division,"profile"=> $profile,'password'=>Crypt::encryptString($password)];
         }elseif($profile){
              $updated_array = ['name'=>$fname,'lname'=>$lname,'email'=>$user_email,"division"=>$division,"profile"=> $profile];
         }elseif($password){
             $updated_array = ['name'=>$fname,'lname'=>$lname,'email'=>$user_email,"division"=>$division,'password'=>Crypt::encryptString($password)];
         }else{
             $updated_array = ['name'=>$fname,'lname'=>$lname,"division"=>$division,'email'=>$user_email];
         }
         
         User::where('id','=',$uid)->update($updated_array);
         return redirect()->back()->with('success', 'User updated'); 
    }
    
    public function deleteSubadmin($uid)
    {
        User::where('id','=',$uid)->delete();
         return redirect()->back()->with('success', 'User deleted'); 
    }

    public function users(Request $request,$id='')
    {
		$Page = ' | Users';
		$data = $request->all();
		$data['page'] = $Page;
		$data['organisation'] = User::getonedata([['id','=',$id]]);
		$were = [['parent_id','=',$id],['status','!=','3']];
		$weres = [];
		$weresdate = [];
		 if(isset($data['search']) || isset($data['status'])|| isset($data['from_date']) || isset($data['to_date'])) {
        	if(isset($data['status']) && $data['status'] != null){
              $were[] = ['status','=',$data['status']];
        	}
        	if(isset($data['search']) && $data['search'] != null){
               $weres[] = ['email','like','%' .$data['search']. '%'];
               $weres[] = ['name','like','%' .$data['search']. '%'];
               $weres[] = ['lname','like','%' .$data['search']. '%'];
        	} 

        	 if(isset($data['from_date']) && $data['from_date'] != null){
              $weresdate['from_date'] = $data['from_date'];
        	}
        	 if(isset($data['to_date']) && $data['to_date'] != null){
              $weresdate['to_date'] = $data['to_date'];
        	}
        }
       

		$data['users'] = User::getbyconditionmultiplewhere($were,$weres,$weresdate);
		 if(isset($data['search']) || isset($data['status']) || isset($data['from_date']) || isset($data['to_date'])){
          if(isset($data['status']) && $data['status'] != null){
             $data['users']->appends(['status' => $data['status']]);
          }
            
         if(isset($data['search']) && $data['search'] != null){
             $data['users']->appends(['search' => $data['search']]);
          } 

           if(isset($data['from_date']) && $data['from_date'] != null){
              $data['users']->appends(['from_date' => $data['from_date']]);
        	}
        	 if(isset($data['to_date']) && $data['to_date'] != null){
              $data['users']->appends(['to_date' => $data['to_date']]);
        	}
        }
		return view('Admin/users',$data);
    }


    public function adduser($id='')
    {
		$Page = ' | Add Users';
		$data['page'] = $Page;
		$data['organisation'] = User::getonedata([['id','=',$id]]);
		return view('Admin/adduser',$data);
    }

     public function edituser($id='',$userid='')
    {
		$Page = ' | Edit Users';
		$data['page'] = $Page;
		$data['organisation'] = User::getonedata([['id','=',$id]]);
		$data['userdetail'] = User::getonedata([['id','=',$userid]]);
		return view('Admin/edituser',$data);
    }

     public function userdetails($id='',$userid='')
    {
		$Page = ' | User Details';
		$data['page'] = $Page;
		$data['userdetail'] = User::getonedata([['id','=',$userid]]);
		return view('Admin/userdetails',$data);
    }

   public function organizationforms(Request $request,$orgid='')
    {
         if(!$this->checkAccess('forms'))
        { 
            $Page = ' | No Access';
            $data['page'] = $Page;
            return view('Admin/noaccess',$data);
        }
        
    	$data = $request->all();
		$Page = ' | Forms';
		$data['page'] = $Page;
		$were = [['forms.status','!=','2']];
		$weres = [];
		 if(isset($data['search']) || isset($data['from_date']) || isset($data['to_date'])) {
		 	
            if(isset($data['from_date']) && $data['from_date'] != null){
              $weres['from_date'] = $data['from_date'];
        	}
        	 if(isset($data['to_date']) && $data['to_date'] != null){
              $weres['to_date'] = $data['to_date'];
        	}
        	if(isset($data['search']) && $data['search'] != null){
               $were[] = ['forms.form_title','like','%' .$data['search']. '%'];
        	} 
        }

		 $data['forms'] = Form::getbyconditionmultipleorganization($were,$weres,$orgid);
		 if(isset($data['search']) || isset($data['from_date']) || isset($data['to_date'])){
           if(isset($data['search']) && $data['search'] != null){
             $data['forms']->appends(['search' => $data['search']]);
          } 
          if(isset($data['from_date']) && $data['from_date'] != null){
             $data['forms']->appends(['from_date' => $data['from_date']]);
          }
          if(isset($data['to_date']) && $data['to_date'] != null){
             $data['forms']->appends(['to_date' => $data['to_date']]);
          }  
        }
        $data['orgid'] = $orgid;
		return view('Admin/formorganization',$data);
    }
    
    public function organizationsubmissions(Request $request,$orgid='')
    {
         if(!$this->checkAccess('submissions'))
        { 
            $Page = ' | No Access';
            $data['page'] = $Page;
            return view('Admin/noaccess',$data);
        }
        
    	$data = $request->all();
		$Page = ' | Organization Submissions';
		$data['page'] = $Page;
		
		 $were = '';
		 $weres = [];
		 if(isset($data['search']) || isset($data['from_date']) || isset($data['to_date'])) {
            if(isset($data['from_date']) && $data['from_date'] != null){
              $weres['from_date'] = $data['from_date'];
        	}
        	 if(isset($data['to_date']) && $data['to_date'] != null){
              $weres['to_date'] = $data['to_date'];
        	}
        	if(isset($data['search']) && $data['search'] != null){
               $were = $data['search'];
        	} 
        }
        $data['submissions'] = Submittedform::admin_organization_getsubmission_all($were,$weres,$orgid);
		 if(isset($data['search']) || isset($data['from_date']) || isset($data['to_date'])){
           if(isset($data['search']) && $data['search'] != null){
             $data['submissions']->appends(['search' => $data['search']]);
          } 
          if(isset($data['from_date']) && $data['from_date'] != null){
             $data['submissions']->appends(['from_date' => $data['from_date']]);
          }
          if(isset($data['to_date']) && $data['to_date'] != null){
             $data['submissions']->appends(['to_date' => $data['to_date']]);
          }  
        }
        $data['orgid'] = $orgid;
		return view('Admin/submissionorganization',$data);
    }

    public function forms(Request $request)
    {
        if(!$this->checkAccess('forms'))
        { 
            $Page = ' | No Access';
            $data['page'] = $Page;
            return view('Admin/noaccess',$data);
        }
        
    	$data = $request->all();
		$Page = ' | Forms';
		$data['page'] = $Page;
// 		$were = [['status','!=','2']];
	   $status = '';
		$were = [];
		$first_name = '';
		$surname = '';
		$weres = [];
		$form_type = '';
		$content = '';
		 if(isset($data['search']) || isset($data['from_date']) || isset($data['content']) || isset($data['form_type']) || isset($data['to_date']) || isset($data['status']) || isset($data['first_name']) || isset($data['surname'])) {
		 	
            if(isset($data['from_date']) && $data['from_date'] != null){
              $weres['from_date'] = $data['from_date'];
        	}
        	 if(isset($data['to_date']) && $data['to_date'] != null){
              $weres['to_date'] = $data['to_date'];
        	}
        // 	if(isset($data['search']) && $data['search'] != null){
        //       $were[] = ['form_title','like','%' .$data['search']. '%'];
        // 	} 
        	if(isset($data['search']) && $data['search'] != null){
                   $were[] = ['form_title','like','%' .$data['search']. '%'];
        	}
        	if(isset($data['first_name']) && $data['first_name'] != null){
               $first_name = $data['first_name'];
        	}
        	if(isset($data['surname']) && $data['surname'] != null){
               $surname = $data['surname'];
        	}
        	if(isset($data['status']) && $data['status'] != null){
               $status = $data['status'];
        	} 
        	if(isset($data['form_type']) && $data['form_type'] != null){
               $form_type = $data['form_type'];
        	}
        	if(isset($data['content']) && $data['content'] != null){
               $content = $data['content'];
        	}
        }

		$data['forms'] = Form::getbyconditionmultiple($were,$weres,$status,$first_name,$surname,$form_type,$content);
		$data['form_name'] = Form::select('form_title')->pluck('form_title')->unique();
		 if(isset($data['search']) || isset($data['from_date']) || isset($data['to_date'])){
           if(isset($data['search']) && $data['search'] != null){
             $data['forms']->appends(['search' => $data['search']]);
          } 
          if(isset($data['from_date']) && $data['from_date'] != null){
             $data['forms']->appends(['from_date' => $data['from_date']]);
          }
          if(isset($data['to_date']) && $data['to_date'] != null){
             $data['forms']->appends(['to_date' => $data['to_date']]);
          }  
        }
		return view('Admin/forms',$data);
    }

     public function formbuilder()
    {
		$Page = ' | Form Builder';
		$data['page'] = $Page;
		if($_GET['title'] != '' && $_GET['title'] != null && ($_GET['status'] != '' && $_GET['status'] != null))
		{
			$data['title'] = $_GET['title'];
			$data['status'] = $_GET['status'];
			return view('Admin/formbuilder',$data);
		}else
		{
			return Redirect()->back();
		}
		
    }

    public function formeditdetail($id='')
    {
		$Page = ' | Form Builder Editor';
		$data['page'] = $Page;
		$data['forms'] = Form::getonedata([['id','=',$id],['status','!=','2']]);
		return view('Admin/formeditbuilder',$data);
    }

     public function formdetails($id='')
    {
		$Page = ' | Form Detail';
		$data['page'] = $Page;
		$were = [['id','=',$id]];
		$data['forms'] = Form::getonedata($were);
		return view('Admin/formdetails',$data);
    }

    public function submissions(Request $request)
    {
    	$data = $request->all();
		$Page = ' | Submissions';
		$data['page'] = $Page;
		
		 $were = '';
		 $status = '';
		 	$first_name = '';
		$surname = '';
		$form_type = '';
		$content = '';
		 $weres = [];
		 if(isset($data['search']) || isset($data['status']) || isset($data['from_date']) || isset($data['to_date']) || isset($data['first_name']) || isset($data['form_type']) || isset($data['content'])) {
            if(isset($data['from_date']) && $data['from_date'] != null){
              $weres['from_date'] = $data['from_date'];
        	}
        	 if(isset($data['to_date']) && $data['to_date'] != null){
              $weres['to_date'] = $data['to_date'];
        	}
        	if(isset($data['search']) && $data['search'] != null){
               $were = $data['search'];
        	}
        	if(isset($data['first_name']) && $data['first_name'] != null){
               $first_name = $data['first_name'];
        	}
        	if(isset($data['surname']) && $data['surname'] != null){
               $surname = $data['first_name'];
        	}
        	if(isset($data['status']) && $data['status'] != null){
               $status = $data['status'];
        	} 
        	if(isset($data['form_type']) && $data['form_type'] != null){
               $form_type = $data['form_type'];
        	}
        	if(isset($data['content']) && $data['content'] != null){
               $content = $data['content'];
        	}
        }
 
	    //$data['forms'] = Form::getbyconditionmultiple($were,$weres);
	    	$data['submissions'] = Submittedform::getallsubmmittedform2($were,$weres,$status,$first_name,$surname,$form_type,$content);
	//	$data['submissions'] = Submittedform::admin_getsubmission_all($were,$weres,$status);
		 if(isset($data['search']) || isset($data['from_date']) || isset($data['to_date'])){
           if(isset($data['search']) && $data['search'] != null){
             $data['submissions']->appends(['search' => $data['search']]);
          } 
          if(isset($data['status']) && $data['status'] != null){
             $data['submissions']->appends(['status' => $data['status']]);
          } 
          if(isset($data['from_date']) && $data['from_date'] != null){
             $data['submissions']->appends(['from_date' => $data['from_date']]);
          }
          if(isset($data['to_date']) && $data['to_date'] != null){
             $data['submissions']->appends(['to_date' => $data['to_date']]);
          }  
        }
        $conditions = \DB::table('assignforms')
                     ->join('forms', 'forms.id', '=', 'assignforms.formid')
                     ->select('forms.form_title as formTitle')
                     ->where('forms.status', '!=', '2')
                     ->distinct()
                  ->pluck('formTitle')->unique();
         $data['form_name'] = $conditions;
//	echo '<pre>'; print_r($data['submissions']); die; 
		return view('Admin/submissions',$data);
    }

    public function submissionsdetails($id)
    {
		$Page = ' | Submissions Details';
		$data['page'] = $Page;
		$data['submissions'] = Submittedform::admin_getsubmission_detail($id);
        $data['comments'] =SubmissionComments::where('submission_id','=',$id)->orderByDesc('created_at')->get();
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
		return view('Admin/submissionsdetails',$data);
    }
    
     public function submissionmedia($id)
    {
		$Page = ' Submissions | Submissions Media';
		$data['page'] = $Page;
		$data['submissions'] = Submittedform::admin_getsubmission_detail($id);
		$datas['formdata'] = json_decode($data['submissions']->form_data);
		$datas['form_format'] = json_decode($data['submissions']->form_format);
		$alldata = (array)$datas['formdata'];
        
		 $componentsToProcess = [
        'textfield',
        'textarea',
        'select',
        'datetime',
        'time',
        'radio',
        'address',
        'signature',
        'file',
        'MyNewComponent',
        'MyBarcodeComponent'
    ];
    
    foreach ($datas['form_format']->components as $key => $d) {
        if (!in_array($d->type, $componentsToProcess)) {
            continue;
        }
        
        $componentData = [
            'label' => $d->label,
            'type' => $d->type,
        ];
        
        switch ($d->type) {
            case 'address':
                if (isset($d->enableManualMode) && $d->enableManualMode == 1) {
                    $addressData = [];
                    foreach ($d->components as $k => $c) {
                        $addressData[] = [
                            'label' => $c->label,
                            'type' => $c->type,
                            'value' => $alldata[$d->key . '_' . $c->key]
                        ];
                    }
                    $componentData['value'] = $addressData;
                } else {
                    $componentData['value'] = $alldata[$d->key];
                }
                break;
            default:
                $componentData['value'] = $alldata[$d->key];
                break;
        }
        
        $newArray[] = (object) $componentData;
    }
    
   // $data['newArray'] = $newArray;
   // return $data;
		$data['formdata'] = $newArray;
		return view('Admin/submission_media',$data);
    }
    
     public function users_forms(Request $request,$orgid,$userid)
    {
        
        
        	$data = $request->all();
		$Page = ' | Forms';
		$data['page'] = $Page;
		$were = [['forms.status','!=','2']];
		$weres = [];
		 if(isset($data['search']) || isset($data['from_date']) || isset($data['to_date'])) {
		 	
            if(isset($data['from_date']) && $data['from_date'] != null){
              $weres['from_date'] = $data['from_date'];
        	}
        	 if(isset($data['to_date']) && $data['to_date'] != null){
              $weres['to_date'] = $data['to_date'];
        	}
        	if(isset($data['search']) && $data['search'] != null){
               $were[] = ['forms.form_title','like','%' .$data['search']. '%'];
        	} 
        }

		$data['forms'] = Form::getbyconditionmultipleorganization_users($were,$weres,$orgid,$userid);
	
		 if(isset($data['search']) || isset($data['from_date']) || isset($data['to_date'])){
           if(isset($data['search']) && $data['search'] != null){
             $data['forms']->appends(['search' => $data['search']]);
          } 
          if(isset($data['from_date']) && $data['from_date'] != null){
             $data['forms']->appends(['from_date' => $data['from_date']]);
          }
          if(isset($data['to_date']) && $data['to_date'] != null){
             $data['forms']->appends(['to_date' => $data['to_date']]);
          }  
        }
        $data['orgid'] = $orgid;
	/*	return view('Admin/forms',$data);
		
		
		$Page = ' Organization | User Froms';
		$data['page'] = $Page;
		$data['forms'] = Form::get_desktop_user_formslist($userid);*/
		$data['parent_id'] = $orgid;
		$data['userid'] = $userid;
		$data['url'] = $orgid.'/forms/'.$userid;
	//	echo '<pre>'; print_r($data); die; 
	//	echo '<pre>'; print_r($data['forms']); die; 
		return view('Admin/users_forms',$data);
		
		
		/* 
		  	$data = $request->all();
		$Page = ' | Forms';
		$data['page'] = $Page;
		$were = [['status','!=','2']];
		$weres = [];
		 if(isset($data['search']) || isset($data['from_date']) || isset($data['to_date'])) {
		 	
            if(isset($data['from_date']) && $data['from_date'] != null){
              $weres['from_date'] = $data['from_date'];
        	}
        	 if(isset($data['to_date']) && $data['to_date'] != null){
              $weres['to_date'] = $data['to_date'];
        	}
        	if(isset($data['search']) && $data['search'] != null){
               $were[] = ['form_title','like','%' .$data['search']. '%'];
        	} 
        }

		$data['forms'] = Form::getbyconditionmultiple($were,$weres);
		 if(isset($data['search']) || isset($data['from_date']) || isset($data['to_date'])){
           if(isset($data['search']) && $data['search'] != null){
             $data['forms']->appends(['search' => $data['search']]);
          } 
          if(isset($data['from_date']) && $data['from_date'] != null){
             $data['forms']->appends(['from_date' => $data['from_date']]);
          }
          if(isset($data['to_date']) && $data['to_date'] != null){
             $data['forms']->appends(['to_date' => $data['to_date']]);
          }  
        }
        
		*/
    }
    
     public function users_submissions(Request $request,$org,$userid)
    {
			$data = $request->all();
		$Page = ' | Organization Users Submissions';
		$data['page'] = $Page;
		$data['org'] = $org;
		$data['userid'] = $userid;
		$data['url'] = $org.'/submissions/'.$userid;
		
		 $were = '';
		 $weres = [];
		 if(isset($data['search']) || isset($data['from_date']) || isset($data['to_date'])) {
            if(isset($data['from_date']) && $data['from_date'] != null){
              $weres['from_date'] = $data['from_date'];
        	}
        	 if(isset($data['to_date']) && $data['to_date'] != null){
              $weres['to_date'] = $data['to_date'];
        	}
        	if(isset($data['search']) && $data['search'] != null){
               $were = $data['search'];
        	} 
        }
         $orgid = $this->user_id;
	//	$data['forms'] = Form::getbyconditionmultiple($were,$weres);
		$data['submissions'] = Submittedform::admin_user_getsubmission_all($were,$weres,$org,$userid);
		
	
              
		 if(isset($data['search']) || isset($data['from_date']) || isset($data['to_date'])){
           if(isset($data['search']) && $data['search'] != null){
             $data['submissions']->appends(['search' => $data['search']]);
          } 
          if(isset($data['from_date']) && $data['from_date'] != null){
             $data['submissions']->appends(['from_date' => $data['from_date']]);
          }
          if(isset($data['to_date']) && $data['to_date'] != null){
             $data['submissions']->appends(['to_date' => $data['to_date']]);
          }  
        }
        	 
         
         return $data;
//	echo '<pre>'; print_r($data['submissions']); die; 
		return view('Admin/user_submissions',$data);
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
	
	public function subadmin()
	{
	     if(!$this->checkAccess('subAdmin'))
        { 
            $Page = ' | No Access';
            $data['page'] = $Page;
            return view('Admin/noaccess',$data);
        }
        
	    $Page = ' | Subadmin';
       
        $data['users'] =  User::where('role',3)->paginate(10);
        $data['page'] = $Page;
        return view('Admin/subadmin',$data);
	   
	}
	
	  public function subadminPermissions($uid)
     {
        $permission=[];
		$Page = ' | permissions';
		$data['page'] = $Page;
		$data['uid'] = $uid;
		$prepermissions = User::select('permissions')->where('id','=',$uid)->first();
		if($prepermissions->permissions)
		{
		    $permission = json_decode($prepermissions->permissions);
		}
	
	    $data['permisons']= $permission;
		
		return view('Admin/admin_permissions',$data);
     }
     
     public function adminAddPermission(Request $request)
     {   
             $permision=[];
             $userid =$request->user_id;
        
            if(isset($request->Dashboard)){$permision[]="dashboard";}
            if(isset($request->Organisations)){$permision[]="organisations";}
            if(isset( $request->SubAdmin)){$permision[]="subAdmin";}
            if(isset( $request->Forms)){$permision[]="forms";}
            if(isset($request->Submissions)){$permision[]="submissions";}
            if(isset( $request->Settings)){$permision[]="settings";}
            User::where('id','=',$userid)->Update(['permissions'=>'']);
            User::where('id','=',$userid)->Update(['permissions'=>json_encode( $permision)]);
            return redirect()->back()->with('success', 'permissions updated');   
       
     }
     
     public function deleteAdminUser($uid)
     {
         User::where('id','=',$uid)->delete();
         return redirect()->back()->with('success', 'User deleted'); 
     }
     
      public function checkAccess($page)
      {
             $role = \Session::get('admin')->role;
             $all_permisions=[];
             if($role=='3')
             {
                 $user_id= \Session::get('admin')->id;
                 $permisionObj = User::select('permissions')->where('id','=',$user_id)->first();
              
                 if($permisionObj->permissions)
                 {
                     $all_permisions = json_decode($permisionObj->permissions);
                 }
             }
             else
             {
                 $all_permisions=['dashboard','organisations','subAdmin','forms','submissions','settings'];
             }
             
             if(in_array($page,$all_permisions))
             {
                 return true;
             }
             else
             {
                 return false;
             }
       }
   
    public function logoutforapp($id)
    { 
        User::where('id','=',$id)->update(['token'=>'']);
        return redirect()->back();
    }


}
