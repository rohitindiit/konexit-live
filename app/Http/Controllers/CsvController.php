<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Models\User;
use App\Models\Submittedform;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Routing\Redirector;
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;


class CsvController extends Controller
{
    
    
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
  
    
  public function usercsvdownload()
    {
        // Create an array of data for the CSV file
        $csvData = [
            ['First_Name', 'Last_Name', 'Email', 'Password'], // Header row
            ['John', 'Doe', 'john@example.com', 'Test@123'], // Example data row
            ['Demo', 'User', 'special@example.com', 'Test@4321'], // Special data row
        ];

        // Generate the CSV content
        $csvContent = '';
        foreach ($csvData as $row) {
            $csvContent .= implode(',', $row) . "\n";
        }

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="data.csv"',
        ];

        return Response::make($csvContent, 200, $headers);
    }   
    
    public function submissiondatadownload($id)
    {
        
        $data['submissions'] = Submittedform::getsubmission_detail($this->user_id,$id);
		$datas['formdata'] = json_decode($data['submissions']->form_data);
		$datas['form_format'] = json_decode($data['submissions']->form_format);
		
		$alldata = (array)$datas['formdata'];
		
		 $csvData = [];
$csvData[] = []; // Empty row for headers

foreach ($datas['form_format']->components as $key => $d) {
    if ($d->type == 'textfield' || $d->type == 'textarea' || $d->type == 'select' || $d->type == 'datetime' || $d->type == 'time' || $d->type == 'radio' || $d->type == 'MyBarcodeComponent') {
        $csvData[0][$d->label] = $alldata[$d->key];
    }
    
    if($d->type == 'selectboxes' && $alldata[$d->key] != '')
    {
        $val = [];
        
        foreach($alldata[$d->key] as $k)
        {
        
        $val [] = $k->label;
        
        if(count($val) == count($alldata[$d->key]))
        { 
            $csvData[0][$d->label] = implode(', ', $val);
        
          }
        }
                                     
    }
}

$csvData[0]['Submission Id'] = $data['submissions']->id;
$csvData[0]['Submitted By'] = $data['submissions']->submitted_by;
$csvData[0]['Form Name'] = $data['submissions']->formtitle;
$csvData[0]['Form ID'] = $data['submissions']->form_display_ID;
$csvData[0]['Submitted On'] = date('j M Y', strtotime($data['submissions']->created_at)).' '.date('g:i A', strtotime($data['submissions']->created_at));

// Generate the CSV content
$csvContent = '';
foreach ($csvData as $row) {
    $csvContent .= implode(',', $row) . "\n";
}

$filename = 'submissiondata_' . $id . '.csv'; // Name of the CSV file

$fp = fopen($filename, 'w'); // Open the file for writing

// Write the header row
fputcsv($fp, array_keys($csvData[0]));

// Write the data rows
foreach ($csvData as $row) {
    fputcsv($fp, $row);
}

fclose($fp); // Close the file

// Force download the CSV file
header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename="' . $filename . '"');
readfile($filename);

     /*   $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="submissiondata_'.$id.'.csv"',
        ];

        return Response::make($csvContent, 200, $headers);*/
    } 
    
    public function admin_submissiondatadownload($id,$parentid)
    {
        
        $data['submissions'] = Submittedform::getsubmission_detail($parentid,$id);
		$datas['formdata'] = json_decode($data['submissions']->form_data);
		$datas['form_format'] = json_decode($data['submissions']->form_format);
		
		$alldata = (array)$datas['formdata'];
		
		 $csvData = [];
$csvData[] = []; // Empty row for headers

foreach ($datas['form_format']->components as $key => $d) {
    if ($d->type == 'textfield' || $d->type == 'textarea' || $d->type == 'select' || $d->type == 'datetime' || $d->type == 'time' || $d->type == 'radio' || $d->type == 'MyBarcodeComponent') {
        $csvData[0][$d->label] = $alldata[$d->key];
    }
    
    if($d->type == 'selectboxes' && $alldata[$d->key] != '')
    {
        $val = [];
        
        foreach($alldata[$d->key] as $k)
        {
        
        $val [] = $k->label;
        
        if(count($val) == count($alldata[$d->key]))
        { 
            $csvData[0][$d->label] = implode(', ', $val);
        
          }
        }
                                     
    }
}

$csvData[0]['Submission Id'] = $data['submissions']->id;
$csvData[0]['Submitted By'] = $data['submissions']->submitted_by;
$csvData[0]['Form Name'] = $data['submissions']->formtitle;
$csvData[0]['Form ID'] = $data['submissions']->form_display_ID;
$csvData[0]['Submitted On'] = date('j M Y', strtotime($data['submissions']->created_at)).' '.date('g:i A', strtotime($data['submissions']->created_at));

// Generate the CSV content
$csvContent = '';
foreach ($csvData as $row) {
    $csvContent .= implode(',', $row) . "\n";
}

$filename = 'submissiondata_' . $id . '.csv'; // Name of the CSV file

$fp = fopen($filename, 'w'); // Open the file for writing

// Write the header row
fputcsv($fp, array_keys($csvData[0]));

// Write the data rows
foreach ($csvData as $row) {
    fputcsv($fp, $row);
}

fclose($fp); // Close the file

// Force download the CSV file
header('Content-Type: application/csv');
header('Content-Disposition: attachment; filename="' . $filename . '"');
readfile($filename);

     /*   $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="submissiondata_'.$id.'.csv"',
        ];

        return Response::make($csvContent, 200, $headers);*/
    }
    
   public function download()
    {
        // Create an array of data for the CSV file
        $csvData = [
            ['Organisation_Name', 'Email', 'User_Quota'], // Header row
            ['John Doe', 'john@example.com', '50'], // Example data row
            ['Special Value', 'special@example.com', '40'], // Special data row
        ];

        // Generate the CSV content
        $csvContent = '';
        foreach ($csvData as $row) {
            $csvContent .= implode(',', $row) . "\n";
        }

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="data.csv"',
        ];

        return Response::make($csvContent, 200, $headers);
    }
    
    public function userprocessCsv(Request $request)
{
    try{
    // Validate the uploaded file
    $validator = Validator::make($request->all(), [
        'csv_file' => 'required|mimes:csv,txt',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator->errors());
        

    }

    // Get the uploaded CSV file
    $file = $request->file('csv_file');

    // Read the CSV file
    $csvData = array_map('str_getcsv', file($file->getPathname()));

    // Remove the header row
    $header = array_shift($csvData);

    $parentUser = User::find($this->user_id);
    $userQuota = $parentUser->user_quota;
    $totalUsers = $parentUser->total_users;

    // Calculate the remaining quota
    $remainingQuota = $userQuota - $totalUsers;
    
    // Check if the CSV data exceeds the limit
    if (count($csvData) > 500) {
        return redirect()->back()->withErrors(['error' => 'CSV record limit exceeded.']);
    }

    // Process each data row
    foreach ($csvData as $row) {
        $userData = array_combine($header, $row);

        // Check if the remaining quota is zero or negative
        if ($remainingQuota <= 0) {
           /* return redirect()->back()->withErrors('User quota exceeded.');*/
            return redirect()->back()->withErrors(['error' => 'User quota exceeded.']);
        }
        
        // Check if the user with the same email already exists
        if (User::where('email', $userData['Email'])->exists()) {
            continue; // Skip this user and proceed to the next iteration
        }

        // Create a new user record
        User::create([
            'name' => $userData['First_Name'],
            'lname' => $userData['Last_Name'],
            'email' => $userData['Email'],
            'password' => Crypt::encryptString($userData['Password']),
            'role' => 2,
            'parent_id' => $this->user_id,
            'status' => '1'
        ]);

        // Increment the total users count
        $totalUsers++;

        // Decrement the remaining quota
        $remainingQuota--;
    }

    // Update the total users count in the parent user record
    $parentUser->total_users = $totalUsers;
    $parentUser->save();

    return redirect()->back()->with('success', 'CSV data has been processed successfully.');
    }catch(\Exception $e){
          return redirect()->back()->withErrors(['error' => $e->getMessage()]);
     } 
}


    public function userprocessCsv2(Request $request)
    {
        // Validate the uploaded file
        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|mimes:csv,txt',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        // Get the uploaded CSV file
        $file = $request->file('csv_file');

        // Read the CSV file
        $csvData = array_map('str_getcsv', file($file->getPathname()));

        // Remove the header row
        $header = array_shift($csvData);

        // Process each data row
        foreach ($csvData as $row) {
            $userData = array_combine($header, $row);
            // Create a new user record
            User::create([
                'name' => $userData['First_Name'],
                'lname' => $userData['Last_Name'],
                'email' => $userData['Email'],
                'password' => Crypt::encryptString($userData['Password']),
                'role' => 2,
                'parent_id' => $this->user_id,
                'status' => '1'
            ]);
        }
        return redirect()->back()->with('success', 'CSV data has been processed successfully.');
    } 
    
   public function processCsv(Request $request)
    {
        // Validate the uploaded file
        $validator = Validator::make($request->all(), [
            'csv_file' => 'required|mimes:csv,txt',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        // Get the uploaded CSV file
        $file = $request->file('csv_file');

        // Read the CSV file
        $csvData = array_map('str_getcsv', file($file->getPathname()));

        // Remove the header row
        $header = array_shift($csvData);

        // Process each data row
        foreach ($csvData as $row) {
            $userData = array_combine($header, $row);
            // Create a new user record
            User::create([
                'name' => $userData['Organisation_Name'],
                'email' => $userData['Email'],
                'user_quota' => $userData['User_Quota'],
                'role' => 2,
                'parent_id' => 1,
                'status' => '1'
            ]);
        }
        return redirect()->back()->with('success', 'CSV data has been processed successfully.');
    }    
    
    
    
    
    public function headervariables($id='')
  {
    if($id == '')
    {
        if(Session()->exists('admin'))
		{
          $Session = Session::get('admin');
		}
		
		if(Session()->exists('organization'))
		{
          $Session = Session::get('organization');
		}
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
    

}
