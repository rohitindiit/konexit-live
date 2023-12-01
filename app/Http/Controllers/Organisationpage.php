<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use DB;
use Mail;
use App\Models\User;
use App\Models\Form;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Routing\Redirector;
use App\Models\Submittedform;
use App\Models\Assignform;
use App\Mail\Mailtrap;
use Redirect;
use Illuminate\Support\Facades\Config;
use App\Models\SubmissionComments;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use App\Models\Assigntousers;
use App\Models\Notification;
use App\Models\UserActivity;
use App\Models\Document;
use App\Models\UserDoc;
use Aws\S3\S3Client;
class Organisationpage extends Controller
{
    //
    private $user_id;
    private $checkuser;
    public function __construct(Request $request, Redirector $redirect)
    {  
		$this->middleware(function ($request, $next){
		if(Session()->exists('admin') || Session::exists('organization'))
		{ 
			 $log_user = (Session()->get('admin') != null && Session()->get('admin') != '') ? Session()->get('admin') : Session()->get('organization');
		     $this->checkuser = (Session()->get('admin') != null && Session()->get('admin') != '') ? Session()->get('admin') : Session()->get('organization');
			$were= [['id','=',$log_user['id']],['status','=','1']];
			$exists= User::getbycondition($were);
            if($log_user['role']=='4'){
                $this->user_id = $log_user['parent_id'];
            }else{
                $this->user_id = $log_user['id'];
            }
		    	
		
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
    
    public function logoutforapp($id)
    { 
        User::where('id','=',$id)->update(['token'=>'']);
        return redirect()->back();
    }
    
    public function assginDocUser(Request $request)
    {
       
        if($request->type=="add")
        {
             $user_doc = new UserDoc();
             $user_doc->user_id =$request->user_id;
             $user_doc->doc_id =$request->docid;
             $user_doc->save();
             return 1;
        }else{
            UserDoc::where(['user_id'=>$request->user_id,'doc_id'=>$request->docid])->delete();
             return 1;
        }
        
    }
    
    
    public function assginDoc($docid)
    {
        $main = [];
        $Page = ' | Assgin  Documents';
         $role =  Session::get('organization')->role;
             $id =  Session::get('organization')->id;
            // Database query to fetch user data (replace with your own code)
            if($role=="4")
            {
               $parent = User::select('parent_id')->where('id','=',$id)->first();
               $id = $parent->parent_id;
            }
        $users = User::where('parent_id','=',$id)->where('role','=','2')->paginate(10);
        $userids = UserDoc::where('doc_id','=',$docid)->pluck('user_id');
      if($userids)
      {
         $main =  $userids->toArray();
      }
        $data['page'] = $Page;
        $data['users'] = $users;
        $data['docid']=$docid;
        $data['ids']=$main;
       return view('organization/AssignDocuments',$data);
    }
    
    public function document()
    {
        $Page = ' | Organistion Documents';
         $role =  Session::get('organization')->role;
             $id =  Session::get('organization')->id;
            // Database query to fetch user data (replace with your own code)
            if($role=="4")
            {
               $parent = User::select('parent_id')->where('id','=',$id)->first();
               $id = $parent->parent_id;
            }
        $documents = Document::where('user_id','=',$id)->get();
        $data['page'] = $Page;
        $data['documents'] = $documents;
       return view('organization/document',$data);
    }
    
    public function uplodeDocument(Request $request)
    {
        
        if(isset($_FILES['documentp']))
        {
             $role =  Session::get('organization')->role;
             $id =  Session::get('organization')->id;
            // Database query to fetch user data (replace with your own code)
            if($role=="4")
            {
               $parent = User::select('parent_id')->where('id','=',$id)->first();
               $id = $parent->parent_id;
            }
        
             $file =  $_FILES['documentp'];
          $fileName = time().$file['name'];

         $s3Client = new S3Client([
                    'version'     => 'latest',
                    'region'      => 'us-east-2', // Replace with your S3 bucket's region (e.g., 'us-east-1')
                    'credentials' => [
                        'key'    => 'AKIAWKDONHBQ4G7CYIGO',
                        'secret' => 'EuyHw+9yxMz33RJBbWDBoyejBvYkfXZeLBlU+arP',
                    ],
                ]);
               
                
            try{
                   $result = $s3Client->putObject([
                            'Bucket' => 'chargeeasy',
                            'Key' => $fileName,
                            'Body' => fopen($file['tmp_name'], 'r'),
                        ]);
                                    
                   $uploadedLink = $result['ObjectURL'];
                   $document  = new Document();
                   $document->user_id = $id;
                   $document->uploded_by =Session::get('organization')->id;
                   $document->link = $uploadedLink;
                   $document->type = $request->type;
                  
                   $document->save();
                   return redirect()->back();
                } catch (AwsException $e) {
                   return redirect()->back();
                }
        }else{
            return redirect()->back();
        }
         
        
    }
    
    public function userServiceExport()
    {
         $role =  Session::get('organization')->role;
         $id =  Session::get('organization')->id;
        // Database query to fetch user data (replace with your own code)
        if($role=="4")
        {
           $parent = User::select('parent_id')->where('id','=',$id)->first();
           $id = $parent->parent_id;
        }
        
        $userData =User::where('role','=','2')->where('parent_id','=',$id)->get();
        
        // Create CSV data
        $csvData = "App-ID,Last-Activity,Last-Login,Division,First-Name,Last-Name,Email,Created-at\n";
        foreach ($userData as $user) {
            $last_login = $user->last_login?$user->last_login:'N/A';
            $appid =  $formatted_number = sprintf("%03d",$user->id);
           $division =  $user->divisio?$user->division:'N/A';
            $formattedDate ='N/A';
           $activity = UserActivity::where('user_id','=',$user->id)->latest()->first();
           if($activity)
           {
                 $dateTime = \Carbon\Carbon::parse($activity->created_at);

                // Format the date in the desired format
                $formattedDate = $dateTime->format('d M Y h:i A');
           }
           $csvData .= 'APP'.$appid .',"'.$last_login. '","' .',"'.$formattedDate. '","' .$division . '","' . $user->name . '","' . $user->lname . '","' . $user->email . '","' . $user->created_at . "\"\n";

        }
        
        // Set headers
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="users.csv"');
        
        // Output CSV data
        echo $csvData;
        
        // Exit to prevent further output
        exit;
    }
    
    public function watchUserActivity($id)
    {
        //return $id;
        $Page = ' | User Activity';
        $data['page'] = $Page;
        
       
        $activity =  UserActivity::where('user_id','=',$id)->paginate(10);
        
        $data['users']=$activity;
        return view('organization/useractivity',$data);
    }

    public function interactiveMap(Request $req)
    { 
      $id = $req->id;
      $empty_lat_array=[];
      
       if($req->duration=='today' || $req->duration=='yesterday' )
       {
           if($req->duration=='today'){
               $Date = \Carbon\Carbon::now();
           }else{
                $Date = \Carbon\Carbon::today()->subDay();
           }
            
            $Submittedform= Submittedform::select('form_location','id')->where('formid','=',$id)->where('organization_id','=',$this->user_id)->whereDate('created_at', $Date->toDateString())->get();
            
        }
       
       if($req->duration=='current_week' || $req->duration=='last_week')
       {
            if($req->duration=='current_week'){
            $currentWeekStart = \Carbon\Carbon::now()->startOfWeek();
            $Submittedform= Submittedform::select('form_location','id')->where('formid','=',$id)->where('organization_id','=',$this->user_id)->where('created_at', '>=', $currentWeekStart)->get();
                
            }else{
                $lastWeekStart = \Carbon\Carbon::now()->subWeek()->startOfWeek();
                $lastWeekEnd = \Carbon\Carbon::now()->subWeek()->endOfWeek();
                
                $Submittedform= Submittedform::select('form_location','id')->where('formid','=',$id)->where('organization_id','=',$this->user_id)->whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])->get();
                
            }
            
            
       }
       
       if($req->duration=='this_month' || $req->duration=='last_month')
       {  
          
          
           if($req->duration=='this_month'){
                $currentMonthStart = \Carbon\Carbon::now()->startOfMonth();
                $currentMonthEnd = \Carbon\Carbon::now()->endOfMonth();
                
                $Submittedform= Submittedform::select('form_location','id')->where('formid','=',$id)->where('organization_id','=',$this->user_id)->whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])->get();
                
           }else{ 
                $lastMonthStart =  \Carbon\Carbon::now()->subMonth()->startOfMonth();
                $lastMonthEnd =  \Carbon\Carbon::now()->subMonth()->endOfMonth();
          
                $Submittedform= Submittedform::select('form_location','id')->where('formid','=',$id)->where('organization_id','=',$this->user_id)->whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])->get();
           }
           
       }
        
     
       if($req->duration=='31_days')
       {
           $start = \Carbon\Carbon::parse($req->start_date);
           $end = \Carbon\Carbon::parse($req->endDate);
           
           $Submittedform= Submittedform::select('form_location','id')->where('formid','=',$id)->where('organization_id','=',$this->user_id)->whereBetween('created_at', [$start, $end])->get();
            
       }
       if($req->duration=='by_year')
       {
             $currentYear = \Carbon\Carbon::now()->year;
             $Submittedform= Submittedform::select('form_location','id')->where('formid','=',$id)->where('organization_id','=',$this->user_id) ->whereYear('created_at', '=', $currentYear)->get();
             
       }
       
        foreach($Submittedform as $form)
        {
            if(isset($form->form_location) AND $form->form_location!='')
            {
             $latlngObj =  json_decode($form->form_location);
             if( $latlngObj ){
                  $empty_lat_array[$form->id][] =  [ $latlngObj->latitude => $latlngObj->longitude];
             }
            }
        }
        
        return json_encode($empty_lat_array);
    }
    public function dashboard()
    { 
        
             
        if(!$this->checkAccess('dashboard'))
        { 
            $Page = ' | No Access';
            $data['page'] = $Page;
            return view('organization/noaccess',$data);
           
        }
        
		$Page = ' | Dashboard';
		$data['page'] = $Page;
	
		$were = [['status','!=','3'],['role','=','2'],['parent_id','=',$this->user_id]];
		 $data['total_users'] = User::getcount($were);
		$data['quota'] = User::where('id','=',$this->user_id)->pluck('user_quota')->implode('');
		
		  $percentage_used =  ($data['total_users'] /	$data['quota']) * 100;
		 $data['percentage']=intval($percentage_used);
		
		$were2 = [['status','!=','2'],['organization_id','=',$this->user_id]];
		$data['total_forms'] = Assignform::getcount($were2);
		
		$were3 = [['status','!=','2'],['organization_id','=',$this->user_id]];
		$data['submission_total'] = Submittedform::getcount($were3);
		
		$data['recent_submission'] = Submittedform::recent_getallsubmmittedform($this->user_id);
		
		 $empty_array=[];
		 
	      $thisOrgUsers = User::where('parent_id','=',$this->user_id)->where('role','=','4')->pluck('id');
          $comment_data =  SubmissionComments::select('comment_by','submission_id','comment','created_at')->where('comment_by','=',$this->user_id)->orWhereIn('comment_by',$thisOrgUsers)->orderBy('created_at', 'desc')->take(5)->get();
         
         foreach($comment_data as $cd)
         { 
            // $user_id =  Submittedform::where('id','=',$cd->submission_id)->pluck('userid')->implode('');
            $formid =  $cd->submission_id;
            $empty_array[] =['user_id'=>$cd->comment_by,'formid'=>$formid,'comment'=>$cd->comment,'time'=>$cd->created_at]; 
         }
         
         $data['commentlisting']= $empty_array;
         
         
       
         $countByUserId =DB::table('submittedforms')
    ->select('userid', DB::raw('COUNT(userid) as count'))
    ->where('organization_id', $this->user_id)
    ->whereDate('created_at', '=', \Carbon\Carbon::now()->toDateString())
    ->groupBy('userid')
    ->get();
        $d = \Carbon\Carbon::now();
      //return "select `userid`, COUNT(userid) as count from `submittedforms` where `organization_id` = $this->user_id and `created_at` = $d group by `userid";

     
       // return \Carbon\Carbon::now();
         $data['usercount']= $countByUserId;
         
         $topfiveform = DB::table('submittedforms')
            ->select('formid', DB::raw('COUNT(formid) as count'), DB::raw('COUNT(DISTINCT userid) as user_count'))->where('organization_id','=',$this->user_id)->whereDate('created_at', \Carbon\Carbon::now()->toDateString())
            ->groupBy('formid')->orderBy('count', 'desc')
             ->limit(5)
            ->get();
            $final=[];
            foreach($topfiveform as $top){
          $total_assign =  DB::table('assigntousers')
                ->select('formid', DB::raw('COUNT(formid) as count'))
                ->where('organization_id', '=', $this->user_id)
                ->where('formid', '=', $top->formid)
                ->groupBy('formid')
                ->first();
              
                $Inactive = $total_assign->count -$top->user_count;
                 $final[]=['formtitle'=>Form::where('id','=',$top->formid)->pluck('form_title')->implode(''),'totalsubmission'=>$top->count,'active'=>$top->user_count,'inactive'=>$Inactive];
                
        }
        
        $data['formstate']= $final;
     
//	echo '<pre>'; print_r($data); die; 
		
		return view('organization/dashboard',$data);
    }
    
    public function formStateAjax(Request $req)
    {
       if($req->duration=='today' || $req->duration=='yesterday' )
       {
           
           if($req->duration=='today'){
               $Date = \Carbon\Carbon::now();
           }else{
                $Date = \Carbon\Carbon::today()->subDay();
           }
           // return  $Date; 
             $topfiveform = DB::table('submittedforms')
            ->select('formid', DB::raw('COUNT(formid) as count'), DB::raw('COUNT(DISTINCT userid) as user_count'))->where('organization_id','=',$this->user_id)->whereDate('created_at', $Date->toDateString())
            ->groupBy('formid')->orderBy('count', 'desc')
             ->limit(5)
            ->get();  
            
       }
       
       if($req->duration=='current_week' || $req->duration=='last_week')
       {
            if($req->duration=='current_week'){
            $currentWeekStart = \Carbon\Carbon::now()->startOfWeek();
            $topfiveform = DB::table('submittedforms')
                ->select('formid', DB::raw('COUNT(formid) as count'), DB::raw('COUNT(DISTINCT userid) as user_count'))
                ->where('organization_id', '=', $this->user_id)
                ->where('created_at', '>=', $currentWeekStart)
                ->groupBy('formid')
                ->orderBy('count', 'desc')
                ->limit(5)
                ->get(); 
            }else{
                $lastWeekStart = \Carbon\Carbon::now()->subWeek()->startOfWeek();
                $lastWeekEnd = \Carbon\Carbon::now()->subWeek()->endOfWeek();
                $topfiveform = DB::table('submittedforms')
                    ->select('formid', DB::raw('COUNT(formid) as count'), DB::raw('COUNT(DISTINCT userid) as user_count'))
                    ->where('organization_id', '=', $this->user_id)
                    ->whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])
                    ->groupBy('formid')
                    ->orderBy('count', 'desc')
                    ->limit(5)
                    ->get();
            }
            
            
       }
       
       if($req->duration=='this_month' || $req->duration=='last_month')
       {  
           if($req->duration=='this_month'){
                $currentMonthStart = \Carbon\Carbon::now()->startOfMonth();
                $currentMonthEnd = \Carbon\Carbon::now()->endOfMonth();
                $topfiveform = DB::table('submittedforms')
                    ->select('formid', DB::raw('COUNT(formid) as count'), DB::raw('COUNT(DISTINCT userid) as user_count'))
                    ->where('organization_id', '=', $this->user_id)
                    ->whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])
                    ->groupBy('formid')
                    ->orderBy('count', 'desc')
                    ->limit(5)
                    ->get();
           }else{ 
                $lastMonthStart =  \Carbon\Carbon::now()->subMonth()->startOfMonth();
                $lastMonthEnd =  \Carbon\Carbon::now()->subMonth()->endOfMonth();
                $topfiveform = DB::table('submittedforms')
                    ->select('formid', DB::raw('COUNT(formid) as count'), DB::raw('COUNT(DISTINCT userid) as user_count'))
                    ->where('organization_id', '=', $this->user_id)
                    ->whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])
                    ->groupBy('formid')
                    ->orderBy('count', 'desc')
                    ->limit(5)
                    ->get();
           }
           
       }
     
       if($req->duration=='31_days')
       {
           $start = \Carbon\Carbon::parse($req->start_date);
           $end = \Carbon\Carbon::parse($req->endDate);
             $topfiveform = DB::table('submittedforms')
                    ->select('formid', DB::raw('COUNT(formid) as count'), DB::raw('COUNT(DISTINCT userid) as user_count'))
                    ->where('organization_id', '=', $this->user_id)
                    ->whereBetween('created_at', [$start, $end])
                    ->groupBy('formid')
                    ->orderBy('count', 'desc')
                    ->limit(5)
                    ->get();
            
       }
       if($req->duration=='by_year')
       {
             $currentYear = \Carbon\Carbon::now()->year;
             $topfiveform = DB::table('submittedforms')
                ->select('formid', DB::raw('COUNT(formid) as count'), DB::raw('COUNT(DISTINCT userid) as user_count'))
                ->where('organization_id', '=', $this->user_id)
                ->whereYear('created_at', '=', $currentYear)
                ->groupBy('formid')
                ->orderBy('count', 'desc')
                ->limit(5)->get();
             
       }
       $final=[];
        foreach($topfiveform as $top){
          $total_assign =  DB::table('assigntousers')
                ->select('formid', DB::raw('COUNT(formid) as count'))
                ->where('organization_id', '=', $this->user_id)
                ->where('formid', '=', $top->formid)
                ->groupBy('formid')
                ->first();
              
                $Inactive = $total_assign->count -$top->user_count;
                 $final[]=['formtitle'=>Form::where('id','=',$top->formid)->pluck('form_title')->implode(''),'totalsubmission'=>$top->count,'active'=>$top->user_count,'inactive'=>$Inactive];
                
        }
        return json_encode($final);
    }
    
     public function formSubmissionTableAjax(Request $req)
    {
       if($req->duration=='today' || $req->duration=='yesterday' )
       {
           if($req->duration=='today'){
               $Date = \Carbon\Carbon::now()->toDateString();
           }else{
                $kDate = \Carbon\Carbon::today()->subDay();
                $Date =  $kDate->toDateString();
           }
          
        $tableSubmission =DB::table('submittedforms')
        ->select('userid', DB::raw('COUNT(userid) as count'))->where('organization_id','=',$this->user_id)->whereDate('created_at', '=',$Date)
        ->groupBy('userid')
        ->get();
        
    //     DB::table('submittedforms')
    // ->select('userid', DB::raw('COUNT(userid) as count'))
    // ->where('organization_id', $this->user_id)
    // ->whereDate('created_at', '=', \Carbon\Carbon::now()->toDateString())
    // ->groupBy('userid')
    // ->get();
            
       }
       
       if($req->duration=='current_week' || $req->duration=='last_week')
       {
            if($req->duration=='current_week'){
            $currentWeekStart = \Carbon\Carbon::now()->startOfWeek();
                $tableSubmission =DB::table('submittedforms')
            ->select('userid', DB::raw('COUNT(userid) as count'))->where('organization_id','=',$this->user_id)->where('created_at', '>=', $currentWeekStart)
            ->groupBy('userid')
            ->get(); 
            }else{
                $lastWeekStart = \Carbon\Carbon::now()->subWeek()->startOfWeek();
                $lastWeekEnd = \Carbon\Carbon::now()->subWeek()->endOfWeek();
                $tableSubmission =DB::table('submittedforms')
                ->select('userid', DB::raw('COUNT(userid) as count'))->where('organization_id','=',$this->user_id)->whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])
                ->groupBy('userid')
                ->get();
            }
            
            
       }
       
       if($req->duration=='this_month' || $req->duration=='last_month')
       {  
           if($req->duration=='this_month'){
                $currentMonthStart = \Carbon\Carbon::now()->startOfMonth();
                $currentMonthEnd = \Carbon\Carbon::now()->endOfMonth();
                $tableSubmission =DB::table('submittedforms')
                ->select('userid', DB::raw('COUNT(userid) as count'))->where('organization_id','=',$this->user_id)->whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])
                ->groupBy('userid')
                ->get();
           }else{ 
                $lastMonthStart =  \Carbon\Carbon::now()->subMonth()->startOfMonth();
                $lastMonthEnd =  \Carbon\Carbon::now()->subMonth()->endOfMonth();
                $tableSubmission =DB::table('submittedforms')
                ->select('userid', DB::raw('COUNT(userid) as count'))->where('organization_id','=',$this->user_id)->whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])
                ->groupBy('userid')
                ->get();
           }
           
       }
       
     
       if($req->duration=='31_days')
       {
           $start = \Carbon\Carbon::parse($req->start_date);
           $end = \Carbon\Carbon::parse($req->endDate);
            $tableSubmission =DB::table('submittedforms')
                ->select('userid', DB::raw('COUNT(userid) as count'))->where('organization_id','=',$this->user_id) ->whereBetween('created_at', [$start, $end])
                ->groupBy('userid')
                ->get();
            
       }
       if($req->duration=='by_year')
       {
             $currentYear = \Carbon\Carbon::now()->year;
             $tableSubmission =DB::table('submittedforms')
                ->select('userid', DB::raw('COUNT(userid) as count'))->where('organization_id','=',$this->user_id)->whereYear('created_at', '=', $currentYear)
                ->groupBy('userid')
                ->get();
             
       }
      $finaldata=[];
        foreach($tableSubmission as $top){
        
        $finaldata[]=['user_name'=>User::where('id','=',$top->userid)->pluck('name')->implode(''),'user_email'=>User::where('id','=',$top->userid)->pluck('email')->implode(''),'count'=>$top->count];
                
        }
        return json_encode($finaldata);
    }
    
     public function singleFormSubmissionTableAjax(Request $req)
    {
       if($req->duration=='today' || $req->duration=='yesterday' )
       {
           if($req->duration=='today'){
               $Date = \Carbon\Carbon::now();
           }else{
                $Date = \Carbon\Carbon::today()->subDay();
           }
            
        $tableSubmission =DB::table('submittedforms')
        ->select('userid', DB::raw('COUNT(userid) as count'))->where('organization_id','=',$this->user_id)->where('formid','=',$req->id)->whereDate('created_at', '=',$Date)
        ->groupBy('userid')
        ->get();
            
       }
       
       if($req->duration=='current_week' || $req->duration=='last_week')
       {
            if($req->duration=='current_week'){
            $currentWeekStart = \Carbon\Carbon::now()->startOfWeek();
                $tableSubmission =DB::table('submittedforms')
            ->select('userid', DB::raw('COUNT(userid) as count'))->where('formid','=',$req->id)->where('organization_id','=',$this->user_id)->where('created_at', '>=', $currentWeekStart)
            ->groupBy('userid')
            ->get(); 
            }else{
                $lastWeekStart = \Carbon\Carbon::now()->subWeek()->startOfWeek();
                $lastWeekEnd = \Carbon\Carbon::now()->subWeek()->endOfWeek();
                $tableSubmission =DB::table('submittedforms')
                ->select('userid', DB::raw('COUNT(userid) as count'))->where('formid','=',$req->id)->where('organization_id','=',$this->user_id)->whereBetween('created_at', [$lastWeekStart, $lastWeekEnd])
                ->groupBy('userid')
                ->get();
            }
            
            
       }
       
       if($req->duration=='this_month' || $req->duration=='last_month')
       {  
           if($req->duration=='this_month'){
                $currentMonthStart = \Carbon\Carbon::now()->startOfMonth();
                $currentMonthEnd = \Carbon\Carbon::now()->endOfMonth();
                $tableSubmission =DB::table('submittedforms')
                ->select('userid', DB::raw('COUNT(userid) as count'))->where('formid','=',$req->id)->where('organization_id','=',$this->user_id)->whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])
                ->groupBy('userid')
                ->get();
           }else{ 
                $lastMonthStart =  \Carbon\Carbon::now()->subMonth()->startOfMonth();
                $lastMonthEnd =  \Carbon\Carbon::now()->subMonth()->endOfMonth();
                $tableSubmission =DB::table('submittedforms')
                ->select('userid', DB::raw('COUNT(userid) as count'))->where('formid','=',$req->id)->where('organization_id','=',$this->user_id)->whereBetween('created_at', [$lastMonthStart, $lastMonthEnd])
                ->groupBy('userid')
                ->get();
           }
           
       }
     
       if($req->duration=='31_days')
       {
           $start = \Carbon\Carbon::parse($req->start_date);
           $end = \Carbon\Carbon::parse($req->endDate);
           $tableSubmission =DB::table('submittedforms')
                ->select('userid', DB::raw('COUNT(userid) as count'))->where('organization_id','=',$this->user_id) ->whereBetween('created_at', [$start, $end])
                ->groupBy('userid')
                ->get();
            
       }
       if($req->duration=='by_year')
       {
             $currentYear = \Carbon\Carbon::now()->year;
             $tableSubmission =DB::table('submittedforms')
                ->select('userid', DB::raw('COUNT(userid) as count'))->where('organization_id','=',$this->user_id)->whereYear('created_at', '=', $currentYear)
                ->groupBy('userid')
                ->get();
             
       }
      $finaldata=[];
        foreach($tableSubmission as $top){
        
        $finaldata[]=['user_name'=>User::where('id','=',$top->userid)->pluck('name')->implode(''),'user_email'=>User::where('id','=',$top->userid)->pluck('email')->implode(''),'count'=>$top->count];
                
        }
        return json_encode($finaldata);
    }
    
    public function chartCompletedForms(Request $request)
    {
        
         if($request->duration=="current_week")
         {
            $currentDate = \Carbon\Carbon::now();
            $startDate = $currentDate->startOfWeek();
            $counts = [];
            $days=[];
            
            for ($day = 0; $day < 7; $day++) {
                
                $nextDay = $startDate->copy()->addDay($day);
                $dayOfWeek =$nextDay->format('D');
                $days[]=$dayOfWeek;
                $counts[] = Submittedform::where('organization_id','=',$this->user_id)->whereDate('created_at', $nextDay)
                ->where('status', '=', '1')
                ->count();
            }
             return json_encode(['days'=>$days,'count'=>$counts]);
        }
        
         if($request->duration=="last_week")
        {
            $currentDate = \Carbon\Carbon::now();
            $startDate = $currentDate->subWeek()->startOfWeek();
            $counts = [];
            $days=[];
            
            for ($day = 0; $day < 7; $day++) {
                
                $nextDay = $startDate->copy()->addDay($day);
                $dayOfWeek =$nextDay->format('D');
                $days[]=$dayOfWeek;
                $counts[] = Submittedform::where('organization_id','=',$this->user_id)->whereDate('created_at', $nextDay)
                ->where('status', '=', '1')
                ->count();
            }
            return json_encode(['days'=>$days,'count'=>$counts]);
        }
        
         if($request->duration=="this_month")
         { 
            $counts = [];
            $days=[];
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
                   
                    
                    $singlecount = Submittedform::where('organization_id','=',$this->user_id)->whereDate('created_at', $date)
                    ->where('status', '=', '1')
                    ->count();
                    if($singlecount){
                           $date1 = \Carbon\Carbon::createFromFormat('Y-m-d', $date);
                        $date2 = $date1->format('d-m-Y');
                       $days[]=$date2;
                       $counts[]=$singlecount;
                    }
            }
            
            return json_encode(['days'=>$days,'count'=>$counts]);
         }
         
         if($request->duration=="last_month")
         { 
            $counts = [];
            $days=[];
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
                   
                   
                    $singlecount = Submittedform::where('organization_id','=',$this->user_id)->whereDate('created_at', $date)
                    ->where('status', '=', '1')
                    ->count();
                    if($singlecount){
                        $date1 = \Carbon\Carbon::createFromFormat('Y-m-d', $date);
                        $date2 = $date1->format('d-m-Y');
                       $days[]=$date2;
                       $counts[]=$singlecount;
                    }
                    
            }
            
            return json_encode(['days'=>$days,'count'=>$counts]);
         }
         if($request->duration=="by_year")
         { 
             $currentYear = \Carbon\Carbon::now()->year;
             $days = [];
            
                for ($i = 5; $i >= 0; $i--) {
                     $year = $currentYear - $i;
                     $days[] = $currentYear - $i;
                     $counts[] = Submittedform::where('organization_id','=',$this->user_id)->whereYear('created_at', $year)->where('status','=','1')->count();
                    
                }
                  return json_encode(['days'=>$days,'count'=>$counts]);
         }
         
           if($request->duration=="range")
           { 
                $start = \Carbon\Carbon::parse($request->start_date);
                    $end = \Carbon\Carbon::parse($request->end_date);
                     
                    // Create an empty array to store the dates
                    $dates = [];
                    $days=[];
                    $counts=[];
                    // Loop through each date and add it to the array
                    for ($date = $start; $date->lte($end); $date->addDay()) {
                        $dates[] = $date->toDateString();
                    }
                 
                // Output the dates
                foreach ($dates as $date) {
                      
                        $singlecount = Submittedform::where('organization_id','=',$this->user_id)->whereDate('created_at', $date)
                        ->where('status', '=', '1')
                        ->count();
                        if($singlecount){
                            $date1 = \Carbon\Carbon::createFromFormat('Y-m-d', $date);
                        $date2 = $date1->format('d-m-Y');
                           $days[]=$date2;
                           $counts[]=$singlecount;
                        }
                        
                }
                
                return json_encode(['days'=>$days,'count'=>$counts]);
               
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
               
                $dayNames['allday'][$currentDate]['pending'] = Submittedform::where('organization_id','=',$this->user_id)->whereDate('created_at', $currentDate)
                ->where('status', '=', '0')
                ->count();
                
                $dayNames['allday'][$currentDate]['complete'] = Submittedform::where('organization_id','=',$this->user_id)->whereDate('created_at', $currentDate)
                ->where('status', '=', '1')
                ->count();
                
                 $dayNames['allday'][$currentDate]['needaction'] = Submittedform::where('organization_id','=',$this->user_id)->whereDate('created_at', $currentDate)
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
              
                $dayNames['allday'][$dayOfWeek]['pending'] = Submittedform::where('organization_id','=',$this->user_id)->whereDate('created_at', $nextDay)
                ->where('status', '=', '0')
                ->count();
                
                $dayNames['allday'][$dayOfWeek]['complete'] = Submittedform::where('organization_id','=',$this->user_id)->whereDate('created_at', $nextDay)
                ->where('status', '=', '1')
                ->count();
                
                 $dayNames['allday'][$dayOfWeek]['needaction'] = Submittedform::where('organization_id','=',$this->user_id)->whereDate('created_at', $nextDay)
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
              
                $dayNames['allday'][$dayOfWeek]['pending'] = Submittedform::where('organization_id','=',$this->user_id)->whereDate('created_at', $nextDay)
                ->where('status', '=', '0')
                ->count();
                
                $dayNames['allday'][$dayOfWeek]['complete'] = Submittedform::where('organization_id','=',$this->user_id)->whereDate('created_at', $nextDay)
                ->where('status', '=', '1')
                ->count();
                
                 $dayNames['allday'][$dayOfWeek]['needaction'] = Submittedform::where('organization_id','=',$this->user_id)->whereDate('created_at', $nextDay)
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
           
            $pending_count = Submittedform::where('organization_id','=',$this->user_id)->whereDate('created_at', $date)->where('status','=','0')->count();
           $completed_count =Submittedform::where('organization_id','=',$this->user_id)->whereDate('created_at', $date)->where('status','=','1')->count();
            $needaction_count =Submittedform::where('organization_id','=',$this->user_id)->whereDate('created_at', $date)->where('status','=','2')->count();
            
            if($pending_count ||$completed_count || $needaction_count )
                     {
                         $date1 = \Carbon\Carbon::createFromFormat('Y-m-d', $date);
                   $date = $date1->format('d-m-Y');

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
           
            $pending_count = Submittedform::where('organization_id','=',$this->user_id)->whereDate('created_at', $date)->where('status','=','0')->count();
            $completed_count =Submittedform::where('organization_id','=',$this->user_id)->whereDate('created_at', $date)->where('status','=','1')->count();
            $needaction_count =Submittedform::where('organization_id','=',$this->user_id)->whereDate('created_at', $date)->where('status','=','2')->count();
            
            if($pending_count ||$completed_count || $needaction_count )
                     {
                          $date1 = \Carbon\Carbon::createFromFormat('Y-m-d', $date);
                   $date = $date1->format('d-m-Y');
                   
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
                 $lastFiveYears['pending'][] = Submittedform::where('organization_id','=',$this->user_id)->whereYear('created_at', $year)->where('status','=','0')->count();
                 $lastFiveYears['completed'][] = Submittedform::where('organization_id','=',$this->user_id)->whereYear('created_at', $year)->where('status','=','1')->count();
                 $lastFiveYears['needaction'][] = Submittedform::where('organization_id','=',$this->user_id)->whereYear('created_at', $year)->where('status','=','2')->count();
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
                      
                      $pending_count = Submittedform::where('organization_id','=',$this->user_id)->whereDate('created_at', $date)->where('status','=','0')->count();
                     $completed_count=Submittedform::where('organization_id','=',$this->user_id)->whereDate('created_at', $date)->where('status','=','1')->count();
                     $needaction_count=Submittedform::where('organization_id','=',$this->user_id)->whereDate('created_at', $date)->where('status','=','2')->count();
                     
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
    
  public function singleSubmissionCountChartForms(Request $req)
    {  
        if($req->duration=="today")
        {
               $currentDateObj = \Carbon\Carbon::now();
               $currentDate = $currentDateObj->toDateString();
               $dayNames = [];
               
                $dayNames['allday'][$currentDate]['pending'] = Submittedform::where('organization_id','=',$this->user_id)->where('formid','=',$req->id)->whereDate('created_at', $currentDate)
                ->where('status', '=', '0')
                ->count();
                
                $dayNames['allday'][$currentDate]['complete'] = Submittedform::where('organization_id','=',$this->user_id)->where('formid','=',$req->id)->whereDate('created_at', $currentDate)
                ->where('status', '=', '1')
                ->count();
                
                 $dayNames['allday'][$currentDate]['needaction'] = Submittedform::where('organization_id','=',$this->user_id)->where('formid','=',$req->id)->whereDate('created_at', $currentDate)
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
              
                $dayNames['allday'][$dayOfWeek]['pending'] = Submittedform::where('organization_id','=',$this->user_id)->where('formid','=',$req->id)->whereDate('created_at', $nextDay)
                ->where('status', '=', '0')
                ->count();
                
                $dayNames['allday'][$dayOfWeek]['complete'] = Submittedform::where('organization_id','=',$this->user_id)->where('formid','=',$req->id)->whereDate('created_at', $nextDay)
                ->where('status', '=', '1')
                ->count();
                
                 $dayNames['allday'][$dayOfWeek]['needaction'] = Submittedform::where('organization_id','=',$this->user_id)->where('formid','=',$req->id)->whereDate('created_at', $nextDay)
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
              
                $dayNames['allday'][$dayOfWeek]['pending'] = Submittedform::where('organization_id','=',$this->user_id)->where('formid','=',$req->id)->whereDate('created_at', $nextDay)
                ->where('status', '=', '0')
                ->count();
                
                $dayNames['allday'][$dayOfWeek]['complete'] = Submittedform::where('organization_id','=',$this->user_id)->where('formid','=',$req->id)->whereDate('created_at', $nextDay)
                ->where('status', '=', '1')
                ->count();
                
                 $dayNames['allday'][$dayOfWeek]['needaction'] = Submittedform::where('organization_id','=',$this->user_id)->where('formid','=',$req->id)->whereDate('created_at', $nextDay)
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
           
            $pending_count = Submittedform::where('organization_id','=',$this->user_id)->where('formid','=',$req->id)->whereDate('created_at', $date)->where('status','=','0')->count();
            $completed_count =Submittedform::where('organization_id','=',$this->user_id)->where('formid','=',$req->id)->whereDate('created_at', $date)->where('status','=','1')->count();
            $needaction_count =Submittedform::where('organization_id','=',$this->user_id)->where('formid','=',$req->id)->whereDate('created_at', $date)->where('status','=','2')->count();
        
            $date2 = \Carbon\Carbon::createFromFormat('Y-m-d', $date);
             $date = $date2->format('d-m-Y');

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
           
            $pending_count = Submittedform::where('organization_id','=',$this->user_id)->where('formid','=',$req->id)->whereDate('created_at', $date)->where('status','=','0')->count();
            $completed_count =Submittedform::where('organization_id','=',$this->user_id)->where('formid','=',$req->id)->whereDate('created_at', $date)->where('status','=','1')->count();
            $needaction_count =Submittedform::where('organization_id','=',$this->user_id)->where('formid','=',$req->id)->whereDate('created_at', $date)->where('status','=','2')->count();
            
             $date2 = \Carbon\Carbon::createFromFormat('Y-m-d', $date);
             $date = $date2->format('d-m-Y');
           
            if($pending_count ||$completed_count || $needaction_count )
                     {
                        $months['status'][$date]['pending']=$pending_count;
                        $months['status'][$date]['completed']=$completed_count;
                        $months['status'][$date]['needaction']=$needaction_count;
                     }
                 
            } 
            if(isset($months['status']) && count($months['status'])=="1")
            {
                        $months['status']["00-00-00"]['pending']=0;
                        $months['status']["00-00-00"]['completed']=0;
                        $months['status']["00-00-00"]['needaction']=0;
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
                 $lastFiveYears['pending'][] = Submittedform::where('organization_id','=',$this->user_id)->where('formid','=',$req->id)->whereYear('created_at', $year)->where('status','=','0')->count();
                 $lastFiveYears['completed'][] = Submittedform::where('organization_id','=',$this->user_id)->where('formid','=',$req->id)->whereYear('created_at', $year)->where('status','=','1')->count();
                 $lastFiveYears['needaction'][] = Submittedform::where('organization_id','=',$this->user_id)->where('formid','=',$req->id)->whereYear('created_at', $year)->where('status','=','2')->count();
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
                      
                      $pending_count = Submittedform::where('organization_id','=',$this->user_id)->where('formid','=',$req->id)->whereDate('created_at', $date)->where('status','=','0')->count();
                     $completed_count=Submittedform::where('organization_id','=',$this->user_id)->where('formid','=',$req->id)->whereDate('created_at', $date)->where('status','=','1')->count();
                     $needaction_count=Submittedform::where('organization_id','=',$this->user_id->where('formid','=',$req->id))->whereDate('created_at', $date)->where('status','=','2')->count();
                     
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
     
     // count form chart for single form

    

    public function profile()
    { 
        if(!$this->checkAccess('settings'))
        { 
            $Page = ' | No Access';
            $data['page'] = $Page;
            return view('organization/noaccess',$data);
           
        }
        
		$Page = ' | Profile';
		$data['page'] = $Page;
		 $role = \Session::get('organization')->role;
         $all_permisions=[];
         if($role=='4')
         {
           $user_id= \Session::get('organization')->id;
		   $data['profile'] = User::getonedata([['id','=',$user_id]]);
         }else{
             $user_id= \Session::get('organization')->id;
		     $data['profile'] = User::getonedata([['id','=',$this->user_id]]);
         }
		return view('organization/settings',$data);
    }

    public function organisations(Request $request)
    {
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

    public function adduser()
    {
		$Page = ' | Add User';
		$data['page'] = $Page;
		$data['id'] =$this->user_id;
		return view('organization/adduser',$data);
    }

    public function edituser($id='')
    { 
		$Page = ' | Edit User';
		$data['page'] = $Page;
		$data['organisation'] = User::getonedata([['id','=',$id]]);
		return view('organization/edituser',$data);
    }

    public function users()
    {
         if(!$this->checkAccess('users'))
        { 
            $Page = ' | No Access';
            $data['page'] = $Page;
            return view('organization/noaccess',$data);
           
        }
        
		$Page = ' | Users';
		$data['page'] = $Page;
		$were = [['parent_id','=',$this->user_id],['status','!=','3'],['role','!=','4']];
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
        
         $data['mydata'] = User::getonedata([['id','=',$this->user_id]]);
		return view('organization/users',$data);
    }
    
     public function subOrganisations()
    {
         if(!$this->checkAccess('sub_organisations'))
        { 
            $Page = ' | No Access';
            $data['page'] = $Page;
            return view('organization/noaccess',$data);
           
        }
        
		$Page = ' | SubOrganisations';
		$data['page'] = $Page;
// 		$were = [['parent_id','=',$this->user_id],['status','!=','3']];
// 		$weres = [];
// 		$weresdate = [];
// 		 if(isset($data['search']) || isset($data['status'])|| isset($data['from_date']) || isset($data['to_date'])) {
//         	if(isset($data['status']) && $data['status'] != null){
//               $were[] = ['status','=',$data['status']];
//         	}
//         	if(isset($data['search']) && $data['search'] != null){
//               $weres[] = ['email','like','%' .$data['search']. '%'];
//               $weres[] = ['name','like','%' .$data['search']. '%'];
//               $weres[] = ['lname','like','%' .$data['search']. '%'];
//         	} 

//         	 if(isset($data['from_date']) && $data['from_date'] != null){
//               $weresdate['from_date'] = $data['from_date'];
//         	}
//         	 if(isset($data['to_date']) && $data['to_date'] != null){
//               $weresdate['to_date'] = $data['to_date'];
//         	}
//         }
       

// 		$data['users'] = User::getbyconditionmultiplewhere($were,$weres,$weresdate);
// 		 if(isset($data['search']) || isset($data['status']) || isset($data['from_date']) || isset($data['to_date'])){
//           if(isset($data['status']) && $data['status'] != null){
//              $data['users']->appends(['status' => $data['status']]);
//           }
            
//          if(isset($data['search']) && $data['search'] != null){
//              $data['users']->appends(['search' => $data['search']]);
//           } 

//           if(isset($data['from_date']) && $data['from_date'] != null){
//               $data['users']->appends(['from_date' => $data['from_date']]);
//         	}
//         	 if(isset($data['to_date']) && $data['to_date'] != null){
//               $data['users']->appends(['to_date' => $data['to_date']]);
//         	}
//         }
//         $data['mydata'] = User::getonedata([['id','=',$this->user_id]]);
        
         $data['users']= User::select('*')->where('role','=','4')->where('parent_id','=',$this->user_id)->paginate(100);
        
		return view('organization/suborganisations',$data);
    }
    
    public function orgInactiveTodayUser()
    {
		$Page = ' | Inactive Users';
		$data['page'] = $Page;
		$were = [['parent_id','=',$this->user_id],['status','!=','3']];
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
        $data['mydata'] = User::getonedata([['id','=',$this->user_id]]);
        $today = \Carbon\Carbon::now()->toDateString();
         $totalusers =User::where('parent_id', $this->user_id)->distinct('userid')->pluck('id')->toArray();
        
         $today_submit = Submittedform::where('organization_id', $this->user_id)->whereDate('created_at',$today)->distinct('userid')->pluck('userid')->toArray();
        $data['inactive']  = array_diff($totalusers, $today_submit);
                           
		return view('organization/inactive_user',$data);
    }
    
      public function orgpermissions($uid)
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
		
		return view('organization/org_permissions',$data);
    }
    
    public function addSuborgView()
    { 
        $permission=[];
		$Page = ' | Add Suborganistion';
		$data['page'] = $Page;

		
		return view('organization/add_suborg',$data);
    }
    
    public function saveSuborgUser(Request $request)
    { 
        $userQota =  User::where('id','=',$this->user_id)->pluck('desktop_quota')->implode(', ');
        if($userQota<=User::where('role','=','4')->where('parent_id','=',$this->user_id)->count())
        { 
          return redirect()->back()->with('error', 'You have reached the limit of add users for this particular organization.'); 
        } 
       
        $first_name = $request->user_first_name;
        $last_name = $request->user_last_name;
        $useremail = $request->user_email;
        $userpassword = $request->user_password;
        $division = $request->division;
        $userrole = 4;
        $userorg = $this->user_id;
        $profile = $request->user_profile;
        $confirmstatus = $request->user_confirmation_email;
        
       if (User::where('email', '=', $useremail)->count() > 0) {
         return redirect()->back()->with('failed', 'Email already exsist !!');
       }
       
        $user = new User();
        $user->parent_id = $userorg?$userorg:1;
        $user->name=$first_name;
        $user->lname=$last_name;
        $user->role=$userrole;
        $user->email=$useremail;
        $user->division=$division;
        $user->password=Crypt::encryptString($userpassword);
        $user->profile='https://dev.indiit.solutions/konexits/resources/views/organization/assets/img/'.$profile;
        $user->phone='';
        $user->user_quota=0;
        $user->total_users=0;
        $user->status=1;
        $user->save();
        
        if($user->id)
        {
            $createdUserId = $user->id;
            $dat['url']  = url('login/');
            if(isset($request->user_confirmation_email))
            {       
                    $dat['name'] = $first_name.' '.$last_name;
                    $dat['body'] = 'Your account has been added as an SubOrganiser user. Your login credentials are Email:'.$useremail.' and Password:'.$userpassword.'. Login your account by below link.';
                    $dat['buttoname'] = 'Login';
                    $messags['msg'] = 'The User has been added successfully and confirmation has been sent to the organization user!!.';
                    $dat['page'] = 'emails.confimationemail';
                    Mail::to($useremail)->send(new Mailtrap($dat));
            }
         
            return redirect()->route('org.permissions',$createdUserId);
        }
        
        return redirect()->back()->with('Failed', 'Opration failed !!'); 
         
    }
    
     public function editSuborgView($uid)
     {
       
		$Page = ' | Edit Suborganistion';
		$data['page'] = $Page;
		$data['suborg'] =User::where('id','=',$uid)->first();
		$data['uid']=$uid;
		return view('organization/edit_suborg',$data);
     }
    
    public function updateSuborgUser(Request $request)
    {
         $fname =  $request->user_first_name;
         $lname =  $request->user_last_name;
         $user_email = $request->user_email;
          $division = $request->division;
         $password = $request->user_password;
         $profile = 'https://dev.indiit.solutions/konexits/resources/views/organization/assets/img/'.$request->user_profile;
         $uid = $request->uid;
        
         if($profile && $password){
            $updated_array = ['name'=>$fname,'lname'=>$lname,'email'=>$user_email,"profile"=> $profile,'password'=>Crypt::encryptString($password),'division'=>$division];
         }elseif($profile){
              $updated_array = ['name'=>$fname,'lname'=>$lname,'email'=>$user_email,"profile"=> $profile,'division'=>$division];
         }elseif($password){
             $updated_array = ['name'=>$fname,'lname'=>$lname,'email'=>$user_email,'password'=>Crypt::encryptString($password),'division'=>$division];
         }else{
             $updated_array = ['name'=>$fname,'lname'=>$lname,'email'=>$user_email,'division'=>$division];
         }
         
         User::where('id','=',$uid)->update($updated_array);
         return redirect()->back()->with('success', 'User updated'); 
    }
    
    public function deleteSuborgUser($uid)
    {
        User::where('id','=',$uid)->delete();
         return redirect()->back()->with('success', 'User deleted'); 
    }
    
    public function organizationAddPermission(Request $request)
    {
        $permision=[];
        $userid =$request->user_id;
        
        if(isset($request->Dashboard)){$permision[]="dashboard";}
        if(isset($request->Users)){$permision[]="users";}
        if(isset( $request->Sub_Organisations)){$permision[]="sub_organisations";}
        if(isset( $request->Forms)){$permision[]="forms";}
        if(isset($request->Submissions)){$permision[]="submissions";}
        if(isset( $request->Settings)){$permision[]="settings";}
         if(isset( $request->Bluckedit)){$permision[]="bluckedit";}
        User::where('id','=',$userid)->Update(['permissions'=>'']);
        User::where('id','=',$userid)->Update(['permissions'=>json_encode( $permision)]);
        return redirect()->back()->with('success', 'permissions updated');   
       
    }
    

    function get_UsersListing(Request $request)
    {
      
        $columns = array( 
                            0 => 'name',
                            1 => 'lname',
                            2 => 'email',
                            3 => 'status',
                            4 => 'created_at',
                            5 => 'last_login',
                            6=>  'id',
                        );

        $data = User::select('*');
        if($request->has('name')){
            $data->where(function($query) use($request) {
                $query->where('users.id',$request->get('name'))
                    ->orWhere('users.email', 'like', "%{$request->get('name')}%")
                    ->orWhere('users.name', 'like', "%{$request->get('name')}%")
                    ->orWhere('users.lname', 'like', "%{$request->get('name')}%");
            });
        }

        /*Search by audit_status*/
        if ($request->has('status') and $request->get('status') != '') {
            $data = $data->where('users.status',$request->get('status'));
        }

        $totalData = $data->count();
            
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        $posts = $data->offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
                         
      

        $data = array();
        if(!empty($posts))
        {
            foreach ($posts as $post)
            {  
                   //condition code for action starts
                   $action = 'View';
                    // $action = '<div class="td-content">
                    //  <div class="dropdown actiondrop2 actiondrop">
                    //     <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    //     Action <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down2.svg"/>
                    //     </a>
                    //     <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                    //       <a class="dropdown-item" href="{{url('/')}}/organization/editusers/{{$post->id}}"><img src="{{url('/')}}/resources/views/organization/assets/img/edit.svg"/> Edit</a>
                    //       <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/organization/assets/img/delete.svg"/> Delete</a>
                    //     </div>
                    //  </div>
                    // </div>';
                    
                //   $status = '<div class="td-content switchstatus">
                //                              <label class="switch s-success">
                //                              <input type="checkbox" data-id="{{$post->id}}" data-table="users" data-url="{{url('/change-users-status/'.$post->parent_id)}}" data-toggle="modal" data-target="#exampleModal2" class="changestatus"  @if($post->status == '1') checked @endif>
                //                              <span class="slider round"></span>		
                //                              <span class="active">Active</span> 												
                //                              <span  class="inactive">Inactive</span> 												
                //                              </label>
                //                           </div>';
                   
                 //condition code for action ends
                
                $nestedData['action'] = $action;
                
                $nestedData['id'] = !empty(@$post->id) ? @$post->id : "N/A";
                $nestedData['name'] = !empty(@$post->lname) ? @$post->name : "N/A";
                $nestedData['lname'] = !empty(@$post->lname) ? @$post->lname : "N/A";
                $nestedData['email'] = !empty(@$post->email) ? @$post->email : "N/A";
                $nestedData['status'] = $post->status;
                $nestedData['last_login'] = !empty(@$post->last_login) ? @$post->last_login : "N/A";
                $nestedData['created_at'] = !empty(@$post->created_at) ? 
                         \Carbon\Carbon::parse($post->created_at)->isoFormat('D MMM YYYY') : "N/A";
                $data[] = $nestedData;

            }
           
        }
          
        $json_data = array(
                    "draw"            => intval($request->input('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data   
                    );
            
        return json_encode($json_data);
    }
    

     public function userdetails()
    {
		$Page = ' | User Details';
		$data['page'] = $Page;
		return view('Admin/userdetails',$data);
    }


    public function forms(Request $request)
    {
       if(!$this->checkAccess('forms'))
        { 
            $Page = ' | No Access';
            $data['page'] = $Page;
            return view('organization/noaccess',$data);
           
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
        	if(isset($data['search']) && $data['search'] != null &&  $data['search']!='' ){
               $were[] = ['forms.form_title','like','%' .$data['search']. '%'];
        	} 
        }
     
         $role =  Session::get('organization')->role;
               $id = $this->user_id;
            // Database query to fetch user data (replace with your own code)
            // if($role=="4")
            // {
              
            //   $id = Session::get('organization')->id;
            // }
        
        
        
		 $data['forms'] = Form::getbyconditionmultipleorganization2($were,$weres,$id);
		//echo '<pre>'; print_r($data['forms'] ); die;
// 		 if(isset($data['search']) || isset($data['from_date']) || isset($data['to_date'])){
//           if(isset($data['search']) && $data['search'] != null){
//              $data['forms']->appends(['search' => $data['search']]);
//           } 
//           if(isset($data['from_date']) && $data['from_date'] != null){
//              $data['forms']->appends(['from_date' => $data['from_date']]);
//           }
//           if(isset($data['to_date']) && $data['to_date'] != null){
//              $data['forms']->appends(['to_date' => $data['to_date']]);
//           }  
//         }
        $array =$data['forms']; 

        // Current page number (e.g., retrieved from the request)
        $page = request()->get('page', 1);
        
        // Number of items to display per page
        $perPage = 10;
        
        // Create a collection from the array
        $collection = collect($array);
        
        // Slice the collection to get the items for the current page
        $currentPageItems = $collection->slice(($page - 1) * $perPage, $perPage);
        
        // Create a paginator instance
        $paginator = new LengthAwarePaginator(
            $currentPageItems,
            $collection->count(),
            $perPage,
            $page,
            ['path' => url()->current()] // URL path for generating links
        );
        
      $conditions = \DB::table('assignforms')
                     ->join('forms', 'forms.id', '=', 'assignforms.formid')
                     ->select('forms.form_title as formTitle')
                     ->where('forms.status', '!=', '2')
                     ->distinct()
                     ->where(function($query) use ($id) {
                  $query->where('assignforms.organization_id', '=', $id);
                   
              })->pluck('formTitle')->unique();
        $form_name = $conditions;
       
		return view('organization/forms',['paginator'=>$paginator,'page'=>'Forms','organizationid'=>$this->user_id,'form_name'=>$form_name]);
    }
    
    

    public function formdetails($id='')
    {
        if(\Session::get('organization')->role=="4")
		{
		   $org = \Session::get('organization')->parent_id;
		}else{
		     $org = $this->user_id;
		}
        $empty_lat_array=[];
         
               $Date = \Carbon\Carbon::now();
       
        $Submittedform= Submittedform::select('form_location','id')->where('formid','=',$id)->where('organization_id','=',$org)->whereDate('created_at', $Date->toDateString())->get();
        foreach($Submittedform as $form)
        {
            if(isset($form->form_location) AND $form->form_location!='')
            {
             $latlngObj =  json_decode($form->form_location);
             if( $latlngObj ){
                  $empty_lat_array[$form->id][] =  [ $latlngObj->latitude => $latlngObj->longitude];
             }
             
              
            }
        }
       // return $empty_lat_array;
       
		$Page = ' | Form Detail';
		$data['page'] = $Page;
		$data['full_detail'] = Form::where('id','=',$id)->first();
		
	
		$data['pending']=Submittedform::where('organization_id','=',$org)->where('formid','=',$id)->where('status','=',"0")->count();
		$data['needaction']=Submittedform::where('organization_id','=',$org)->where('formid','=',$id)->where('status','=',"2")->count();
		 $countByUserId = DB::table('submittedforms')
        ->select('userid', DB::raw('COUNT(userid) as count'))->where('formid','=',$id)->where('organization_id','=',$this->user_id)->whereDate('created_at', '>=',\Carbon\Carbon::now())
        ->groupBy('userid')
        ->get();
       // return  \Carbon\Carbon::now()->subDays(30);
         $data['usercount']= $countByUserId;
         $data['lat_lng']=json_encode($empty_lat_array);
         $data['id']=$id;
        
		return view('organization/formdetails',$data);
    }

    public function submissions(Request $request)
    { 
        
        if(!$this->checkAccess('submissions'))
        { 
            $Page = ' | No Access';
            $data['page'] = $Page;
            return view('organization/noaccess',$data);
           
        }
        
        $data = $request->all();
		$Page = ' | Submissions';
		$data['page'] = $Page;
		$status = '';
		$were = '';
		$first_name = '';
		$surname = '';
		$form_type = '';
		$content = '';
		 $weres = [];
		 if(isset($data['search']) || isset($data['status']) || isset($data['surname']) || isset($data['from_date']) || isset($data['to_date']) || isset($data['first_name']) || isset($data['form_type']) || isset($data['content'])) {
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
        // 	dd("dsdsd--".$data['surname']);
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
       
    
		$data['submissions'] = Submittedform::getallsubmmittedform($this->user_id,$were,$weres,$status,$first_name,$surname,$form_type,$content);
		$orgid = $this->user_id;
// 		dd($orgid);
// 		 $conditions = \DB::table('submittedforms')
//              ->join('forms', 'forms.id', '=', 'submittedforms.formid')
//              ->join('assignforms', 'assignforms.formid', '=', 'submittedforms.formid')
//              ->select('forms.form_title')->distinct()
//              ->where(function($query) use ($orgid) {
//                  $query->where('assignforms.organization_id', '=', $orgid)
//                       ->where('submittedforms.organization_id', '=', $orgid);
//              })->get();
        
            $conditions = \DB::table('assignforms')
                     ->join('forms', 'forms.id', '=', 'assignforms.formid')
                     ->select('forms.form_title as formTitle')
                     ->where('forms.status', '!=', '2')
                     ->distinct()
                     ->where(function($query) use ($orgid) {
                  $query->where('assignforms.organization_id', '=', $orgid);
                   
              })->pluck('formTitle')->unique();
              
             

		 if(isset($data['search']) || isset($data['from_date']) || isset($data['to_date']) || isset($data['first_name'])){
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
         
        //   if(isset($data['first_name']) && $data['first_name'] != null){
        //      $data['first_name']->appends(['first_name' => $data['first_name']]);
        //   }  
        }
        
          $role = \Session::get('organization')->role;
          $all_permisions=[];
         if($role=='4')
         {
             $user_id= \Session::get('organization')->id;
              $permisionObj = \App\Models\User::select('permissions')->where('id','=',$user_id)->first();
          
             if($permisionObj->permissions)
             {
                 $data['permisions']= $all_permisions = json_decode($permisionObj->permissions);
             }
         }else{
              $data['permisions']=['dashboard','users','sub_organisations','forms','submissions','settings','bluckedit'];
         }
        
        $data['form_name'] = $conditions;
		return view('organization/submissions',$data);
    }

    public function submissionsdetails($id)
    {
		$Page = ' | Submissions Details';
		$data['page'] = $Page;
		$data['submissions'] = Submittedform::getsubmission_detail($this->user_id,$id);
		 if($this->checkuser['role']=='4'){
		      $commented_user = $this->checkuser['id'];
		      $data['comments'] =SubmissionComments::where('submission_id','=',$id)->orderByDesc('created_at')->get();
		  }else{
		     
		      $data['comments'] =SubmissionComments::where('submission_id','=',$id)->orderByDesc('created_at')->get();
		  }
       
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
                        'value' => isset($alldata[$d->key])?$alldata[$d->key]:''
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
		
        //echo '<pre>'; 	echo '<pre>'; print_r($data ); die;
	 
		return view('organization/submissionsdetails',$data);
    }
    
    public function submissionmedia($id)
    {
		$Page = 'organization Submissions | Submissions Media';
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
    
		$data['formdata'] = $newArray;
		return view('organization/submission_media',$data);
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
  
   // profile
   
   public function checkAccess($page)
   {
         $role = \Session::get('organization')->role;
         $all_permisions=[];
         if($role=='4')
         {
             $user_id= \Session::get('organization')->id;
             $permisionObj = User::select('permissions')->where('id','=',$user_id)->first();
          
             if($permisionObj->permissions)
             {
                 $all_permisions = json_decode($permisionObj->permissions);
             }
         }else{
             $all_permisions=['dashboard','users','sub_organisations','forms','submissions','settings'];
         }
         
         if(in_array($page,$all_permisions))
         {
             return true;
         }else{
             return false;
         }
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
    
   

}
