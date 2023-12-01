<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Illuminate\Routing\Redirector;
use App\Models\User;
use App\Models\Form;
use App\Models\Formversion;
use App\Models\Assignform;
use App\Models\Submittedform;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Validator;
use Aws\S3\S3Client;
use Aws\Exception\AwsException;
use App\Models\Assigntousers;
use App\Models\SubmissionComments;
use App\Models\UserActivity;
use App\Models\Notification;


class MobileFormcontroller extends Controller
{
    //
     private $user_id;

 public function __construct(Request $request, Redirector $redirect) {  

  }
  
  public function saveUserActivity($user,$activity)
  {
      $activitysave = new UserActivity();
      $activitysave->user_id =$user;
      $activitysave->activity =$activity;
      $activitysave->save();
  }
  
  
  public function getform($id='')
  {
     try{
      $were = [['id','=',$id]];
      $data = Form::getdetailsuserret2($were,'form_data');
      $versionid = Form::getdetailsuserret2($were,'form_version');
      $formtitle = Form::getdetailsuserret2($were,'form_title');
      $arraydata['id'] = $id;
      $arraydata['formdata'] = json_decode($data);
      $arraydata['form_version'] = $versionid;
      $arraydata['form_title'] = $formtitle;
       return json_encode($arraydata); die;
    }catch(\Exception $e){
      $newdata = [];
    } 
    echo json_encode($newdata);
    die;
  }
  
  public function getformData($id='',$user_id='')
  {
     try{
      $were = [['id','=',$id]];
       $data = Form::select('form_data')->where('id','=',$id)->first();
      $versionid = Form::getdetailsuserret2($were,'form_version');
      $formtitle = Form::getdetailsuserret2($were,'form_title');
      $location_required	 = Form::getdetailsuserret2($were,'location_required');
      $arraydata['id'] = $id;
      if($data)
      {
            $arraydata['formdata'] = $data->form_data;
      }else{
           $arraydata['formdata'] = '';
      }
    
      $arraydata['form_version'] = $versionid;
      $arraydata['form_title'] = $formtitle;
       $arraydata['location_required'] = $location_required;
       $org_id =  Assigntousers::select('organization_id')->where(['userid'=>$user_id,'formid'=>$id])->first();
   
       if($org_id)
       {
            $arraydata['organization_id'] = $org_id['organization_id'];
       }else{
            $arraydata['organization_id'] ='';
       }
      $arraydataObj = ["msg"=>"Success","status"=>200,'data'=>$arraydata];
       return json_encode($arraydataObj); die;
    }catch(\Exception $e){
      $newdata = [];
    } 
     
    echo json_encode($newdata);
    die;
  }
  
  public function getS3Url($base64ImageData)
  {
     
        $fileExtension = image_type_to_extension(exif_imagetype($base64ImageData));
        
        // Extract the mime type and data from the base64 string
        list($mime, $data) = explode(';', $base64ImageData);
        list(, $data) = explode(',', $data);
       
           switch ($mime)
           {
                    case 'data:audio/mp3':
                        $fileExtension = '.mp3';
                        break;
                    case 'data:audio/wav':
                        $fileExtension = '.wav';
                        break;
                    default:
                      $fileExtension=$fileExtension;
                    break;
            }
    
        // Convert base64 data to binary
        $imageBinaryData = base64_decode($data);

   
        $s3Client = new S3Client([
                    'version'     => 'latest',
                    'region'      => 'us-east-2', // Replace with your S3 bucket's region (e.g., 'us-east-1')
                    'credentials' => [
                        'key'    => 'AKIAWKDONHBQ4G7CYIGO',
                        'secret' => 'EuyHw+9yxMz33RJBbWDBoyejBvYkfXZeLBlU+arP',
                    ],
                ]); 

        $fileKey = rand()+time().$fileExtension;
        
        $bucketName="chargeeasy";
        
        
            try{
                   $result = $s3Client->putObject([
                        'Bucket' => $bucketName,
                        'Key'    => $fileKey,
                        'Body' => $imageBinaryData,
                        'ContentType' => $mime,
                    ]);
                
                   return $uploadedLink = $result['ObjectURL'];
                   
                } catch (AwsException $e) {
                    return 0;
                }
  }
  

  
  public function submit_form(Request $request)
  { 
     //return $this->getS3Url($request->string);
        
            //echo '<pre>'; print_r($request->all()); die;
        try{
                   $jsonString = $request->getContent();
                    // Use json_decode() to convert the JSON string to an array
                    $data = json_decode($jsonString);   
                   
                    if (json_last_error() !== JSON_ERROR_NONE) {
                        $messags['msg'] = "Some uploded files are corrupted";
                        $messags['status']= 202;
                        return $messags;
                    }
                  
                    
             
               
                 $formdataObject =  $data->form_data;
                
                
                
              if(isset($formdataObject->file) && $formdataObject->file!='')
              {
                   
                   
                    if(gettype($formdataObject->file)=="array")
                    {
                        $fileObjectArray=[];
                        
                        foreach($formdataObject->file as $each)
                        {
                           $url = $this->getS3Url($each);
                           if($url){
                               $fileObjectArray[] = $url ;
                           }
                        }
                       
                       if(count($fileObjectArray))
                       {
                            $formdataObject->file='';
                             $formdataObject->file =  $fileObjectArray;
                       }
                        
                    }
                    else
                    { 
                        $url = $this->getS3Url($formdataObject->file);
                        if($url)
                        {
                             $formdataObject->file='';
                             $formdataObject->file =  $url;
                        }
                        
                    }
                }
            
              if(isset($formdataObject->myNewComponent) && $formdataObject->myNewComponent!='')
              {
                    if(gettype($formdataObject->myNewComponent)=="array")
                    {
                        $fileObjectArray=[];
                        
                        foreach($formdataObject->myNewComponent as $each)
                        {
                           $url = $this->getS3Url($each);
                           if($url){
                               $fileObjectArray[] = $url ;
                           }
                        }
                       
                       if(count($fileObjectArray))
                       {
                            $formdataObject->myNewComponent='';
                             $formdataObject->myNewComponent =  $fileObjectArray;
                       }
                        
                    }
                    else
                    { 
                        $url = $this->getS3Url($formdataObject->myNewComponent);
                        if($url)
                        {
                             $formdataObject->myNewComponent='';
                             $formdataObject->myNewComponent =  $url;
                        }
                        
                    }
                }
                
              if(isset($formdataObject->signature) && $formdataObject->signature!='')
              {
                    if(gettype($formdataObject->signature)=="array")
                    {
                        $fileObjectArray=[];
                        
                        foreach($formdataObject->signature as $each)
                        {
                           $url = $this->getS3Url($each);
                           if($url){
                               $fileObjectArray[] = $url ;
                           }
                        }
                       
                       if(count($fileObjectArray))
                       {
                            $formdataObject->signature='';
                             $formdataObject->signature =  $fileObjectArray;
                       }
                        
                    }
                    else
                    { 
                        $url = $this->getS3Url($formdataObject->signature);
                        if($url)
                        {
                             $formdataObject->signature='';
                             $formdataObject->signature =  $url;
                        }
                        
                    }
                }
                
              for($i=1;$i<$formdataObject->allFiles;$i++)
              {
                    $file = "file".$i;
                     if(isset($formdataObject->$file) && $formdataObject->$file!='')
                     {
                        if(gettype($formdataObject->$file)=="array")
                        {
                            $fileObjectArray=[];
                            
                            foreach($formdataObject->$file as $each)
                            {
                              $url = $this->getS3Url($each);
                              if($url){
                                  $fileObjectArray[] = $url ;
                              }
                            }
                           
                            if(count($fileObjectArray))
                            {
                                $formdataObject->$file='';
                                 $formdataObject->$file =  $fileObjectArray;
                            }
                        
                        }
                        else
                        { 
                            $url = $this->getS3Url($formdataObject->$file);
                            if($url)
                            {
                                 $formdataObject->$file='';
                                 $formdataObject->$file =  $url;
                            }
                            
                        }
                     }
                   
                   
              }
               
              for($i=1;$i<$formdataObject->allMyNewComponents;$i++)
              {
                    $myNewComponent = "myNewComponent".$i;
                    if(isset($formdataObject->$myNewComponent) && $formdataObject->$myNewComponent!='')
                     {
                        if(gettype($formdataObject->$myNewComponent)=="array")
                        {
                            $fileObjectArray=[];
                            
                            foreach($formdataObject->$myNewComponent as $each)
                            {
                              $url = $this->getS3Url($each);
                              if($url){
                                  $fileObjectArray[] = $url ;
                              }
                            }
                           
                          if(count($fileObjectArray))
                          {
                                $formdataObject->$myNewComponent='';
                                 $formdataObject->$myNewComponent =  $fileObjectArray;
                          }
                            
                        }
                        else
                        { 
                            $url = $this->getS3Url($formdataObject->$myNewComponent);
                            if($url)
                            {
                                 $formdataObject->$myNewComponent='';
                                 $formdataObject->$myNewComponent =  $url;
                            }
                            
                        }
                     }
                   
              }
               
              for($i=1;$i<$formdataObject->allSignatures;$i++)
              {
                     $file = "signature".$i;
                     if(isset($formdataObject->$file) && $formdataObject->$file!='')
                     {
                        if(gettype($formdataObject->$file)=="array")
                        {
                            $fileObjectArray=[];
                            
                            foreach($formdataObject->$file as $each)
                            {
                              $url = $this->getS3Url($each);
                              if($url){
                                  $fileObjectArray[] = $url ;
                              }
                            }
                           
                            if(count($fileObjectArray))
                            {
                                $formdataObject->$file='';
                                $formdataObject->$file =  $fileObjectArray;
                            }
                            
                        }
                        else
                        { 
                            $url = $this->getS3Url($formdataObject->$file);
                            if($url)
                            {
                                 $formdataObject->$file='';
                                 $formdataObject->$file =  $url;
                            }
                            
                        }
                     }
              }
                
                 $defaultstatus =  Form::where('id','=',$data->formid)->pluck('default_status')->implode('');
                $newdata['formid'] = $data->formid;
                $newdata['form_version'] = $data->form_version;
              
                $newdata['userid'] = $data->userid;
         
                $newdata['organization_id'] = $data->organization_id;
                $newdata['status'] =$defaultstatus;
                $newdata['form_data'] = json_encode($formdataObject);
                $newdata['form_location'] = json_encode($data->form_location);
                $id = Submittedform::create($newdata)->id;
                if($id)
                { 
                    
                     
                     $this->saveUserActivity($data->userid,'Submit a form');
                   $messags['msg'] = 'Form has been submitted successfully!!.';
                   $messags['erro']= 101;
                }else
                {
                   $messags['msg'] = 'Oops, there is some problem, try again later!!.';
                   $messags['erro']= 202;
                }
            }catch(\Exception $e){
                $messags['msg'] = $e->getMessage();
                $messags['status']= 202;
            } 
            if($messags['erro']==101){
                 $this->pushNotification($data->userid);
            }
            echo json_encode($messags); die;
  }
  
   public function pushNotification($user_id)
         {
            $tok =  User::select('android_device_token','ios_device_token')->where(['id'=>$user_id])->first();
         
         
            $allTokens=[];
             
            if($tok->android_device_token)
                {
                    $allTokens[] = json_decode($tok->android_device_token);
                }
            if($tok->ios_device_token)
                {
                    $allTokens[] = json_decode($tok->ios_device_token);
                }
        
             
             
             foreach($allTokens as $token)
             { 
                 $API_ACCESS_KEY = "AAAAs9O_3Fg:APA91bEHU3oRa-HB-NLMHZGsxbw7sS5DU9ml5DjlvLpjPAkvWMgpKAzU943SKc82mN7buTQCTuUwoxJ5Zi3M4cmYEzMJC0s40Ab_ya2DnoTkWFfUPvlFLkhU1wAdSny0mpbZbYhfsNJF";
                  $fcmUrl = 'https://fcm.googleapis.com/fcm/send';
                 
                    $notification = [
                        'title' =>'Form submission',
                        'body' => 'Form Submitted successfully',
                        'icon' =>'myIcon', 
                        'sound' => 'mySound',
                      
                    ];
                    $extraNotificationData = ["message" => $notification];
            
                    $fcmNotification = [
                        //'registration_ids' => $tokenList, //multple token array
                        'to'        => $token, //single token
                        'notification' => $notification,
                        'data' => $extraNotificationData
                    ];
            
                    $headers = [
                        'Authorization: key=' . $API_ACCESS_KEY,
                        'Content-Type: application/json'
                    ];
            
            
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL,$fcmUrl);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
                    $result = curl_exec($ch);
                    curl_close($ch);
            
                    
                 
             }
             
            
             
             return 1;
         }
  
  public function getform_list(Request $request)
  {
      
      try{
        $jsonString = $request->getContent();
         // Use json_decode() to convert the JSON string to an array
       $data = json_decode($jsonString, true);
       if(isset($data) && count($data) > 0)
       {
            $formslist = Form::getuser_formslist($data['id']);
            $messags['data'] = $formslist;
            $messags['msg'] = 'have a data';
            $messags['status']= 202;
       }else
       {
            $messags['msg'] = 'not have a data';
            $messags['status']= 202;
       }
      }catch(\Exception $e){
      $messags['msg'] = $e->getMessage();
      $messags['status']= 202;
    } 
     echo json_encode($messags); die;
  }
  
  public function getSubmittedFormDetailsByFormID(Request $request)
  {
      //return $request->all();
      $rules = [
                'id' => 'required',
            ];
        $messages = [
        'form_id.required' => 'The id  is required.',
       ];
            
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return json_encode(['msg'=>'Invalid Request','status'=>400,'data'=>[]]);
        }


      $empty_array=[];
      $data['submissions'] = \DB::table('submittedforms')
                    ->join('forms', 'forms.id', '=', 'submittedforms.formid')
                    ->join("formversions",function($join){
                    $join->on("formversions.formid","=","submittedforms.formid")
                    ->on("formversions.formversion","=","submittedforms.form_version");
                    })
                    ->join('users', 'users.id', '=', 'submittedforms.userid')
                    ->join('assignforms', 'assignforms.formid', '=', 'submittedforms.formid')
                    ->select('submittedforms.*','formversions.form_data as form_format','forms.form_title as formtitle','forms.formid as form_display_ID','assignforms.from_title as changedtitle','users.name as user_first_name', 'users.lname as user_last_name','users.email as submitted_by')
                    ->where('submittedforms.id', '=', $request->id);
                    $data['submissions'] = $submissions = $data['submissions']->orderBy('submittedforms.id', 'desc')->first();
                    
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
		        if( $alldata[$d->key]=="")
		        {
		             $do = [];
		        }else{
		             $do = $alldata[$d->key];
		        }
		        $newArray[] = (object) [
                        'label' => $d->label,
                        'type' => $d->type,
                        'value' => $do,
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
		
          array_push($empty_array,['id'=>$submissions->id,'form_id'=>$submissions->formid,'user_id'=>$submissions->userid,'form_data'=>$newArray,'organization_id'=>$submissions->organization_id,
          'form_location'=>$submissions->form_location,'status'=>$submissions->status,'created_at'=>$submissions->created_at]);

            return json_encode(['msg'=>'success','status'=>200,'data'=>$empty_array]);
      
  }

public function getAllSubmittedFormByUserID(Request $request)
  {
      $rules = [
                'user_id' => 'required',
                'page' => 'required',
              ];
              
      $messages = [
        'user_id.required' => 'The user_id  is required.',
        'page.required' => 'The page is required.',
       ];
            
     $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return json_encode(['msg'=>'Invalid Request','status'=>400,'data'=>[]]);
        }


      $empty_array=[];
       $data = Submittedform::where('userid',$request->user_id)->orderBy('created_at', 'desc')->get();
      foreach($data as $d)
      {
         $formTitleObj = Form::select('form_title')->where('id',$d->formid)->first();
         $fromTitle = $formTitleObj->form_title;
         array_push($empty_array,['id'=>$d->id,'form_id'=>$d->formid,'user_id'=>$d->userid,'form_title'=>$fromTitle,'organization_id'=>$d->organization_id,
          'form_location'=>$d->form_location,'status'=>$d->status,'created_at'=>$d->created_at]);
      }
    
      $collection = new Collection($empty_array);
      $perPage = 10;
        
        // Get the current page from the request or set a default value
        $page = request()->get('page',$request->page);
        
        // Paginate the collection
        $paginatedData = $collection->slice(($page - 1) * $perPage, $perPage)->all();
        
        // Create a LengthAwarePaginator instance
        $paginator = new LengthAwarePaginator(
            array_values($paginatedData),
            count($collection),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );
      return json_encode(['msg'=>'success','status'=>200,'data'=>$paginator]);
      
  }
  
  public function getComments(Request $request)
  { 
      $all=[];
       $rules = [
                'submission_id' => 'required',
              ];
              
      $messages = [
        'submission_id.required' => 'The Submission id  is required.',
       
       ];
            
     $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return json_encode(['msg'=>'Invalid Request','status'=>400,'data'=>[]]);
        }
    $comments =SubmissionComments::where('submission_id','=',$request->submission_id)->where('user_view','=','1')->orderByDesc('created_at')
    ->get();
    SubmissionComments::where('submission_id','=',$request->submission_id)->update(['app_seen'=>'1']);
         foreach($comments as $single)
         {
             $id = $single->comment_by;
             $name = User::where('id',"=",$id)->pluck('name')->implode('');
             $lname = User::where('id',"=",$id)->pluck('lname')->implode('');
             $carbonDate = \Carbon\Carbon::parse($single->created_at);

        $formattedDate = $carbonDate->format('d-M-Y g:i A');
             array_push($all,["comment"=>$single->comment,"created_at"=>$formattedDate,"name"=>$name,"lname"=>$lname]);
             
         }
          return json_encode(['msg'=>'success','status'=>200,'data'=>$all]);
         
  }
  
    public function seenStatus(Request $request)
      { 
          $all=[];
           $rules = [
                    'comment_id' => 'required',
                  ];
                  
          $messages = [
            'comment_id.required' => 'The comment  id  is required.',
           
           ];
                
         $validator = Validator::make($request->all(), $rules, $messages);
            if ($validator->fails()) {
                return json_encode(['msg'=>'Invalid Request','status'=>400,'data'=>[]]);
            }
        SubmissionComments::where('id','=',$request->comment_id)->update(['app_seen'=>'1']);
    
              return json_encode(['msg'=>'success','status'=>200,'data'=>$all]);
             
      }

}
