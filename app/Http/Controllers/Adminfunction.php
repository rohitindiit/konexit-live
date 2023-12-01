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
use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;

class Adminfunction extends Controller
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




//update location status if required or not

    function location_flag_update(Request $request)
    {
      $form = Form::find($request->id);
        if($form)
        {
          if($form->location_required == '0'){
              $location_required = '1';
          }else{
              $location_required = '0';
          } 
          $input['location_required'] = $location_required;
          $done = $form->update($input);

          if($done){
          return response()->json([
            'code'    => 200,
            'message' => 'Location Status Updated Successfully!'
          ]);
        }else{
          return response()->json([
            'code'    => 500,
            'message' => 'Form not Found!'
          ]);
        }
    }
    }

  public function imageUpload(){
    return view('imageUpload');
  }

  public function imageUploadPost(Request $request,$folder){
      try{    
        $extension = $request->file('choosefile')->getClientOriginalExtension();
         //new filename
         $new_filename = $folder.'/'.time().'.'.$extension;
         $normal = Image::make($request->file('choosefile'))->resize(200,200)->encode($extension);
          //Upload File
          Storage::disk('s3')->put($new_filename, (string)$normal, $folder);
           $path = Storage::disk('s3')->url($new_filename);
          return $path; 
          }catch(\Exception $e){
          $messags['msg'] = $e->getMessage();
          $messags['erro']= 202;
     } 
      echo json_encode($messags);
      die;
  }

  public function removeprofilepic($condition){
   try{
    $image = User::getdetailsuserret2($condition,'profile');
     if($image != 'undefined' && $image != null && $image != ''){
      Storage::disk('s3')->delete(parse_url($image));
     }
    return true;
   }catch(\Exception $e){
    $messags['msg'] = $e->getMessage();
    $messags['erro']= 202;
   } 
      echo json_encode($messags);
      die;
    }


  public function updateprofile(Request $request){
    try{
      if($request->isMethod('post'))
      {
        $data = $request->all();
        unset($data['_token']);
       if($request->file('choosefile')){
          $data['profile'] = $this->imageUploadPost($request,'admin');
           $this->removeprofilepic([['id','=',$this->user_id]]);
           unset($data['choosefile']);
        }else{
          unset($data['choosefile']);
        }
        if(User::updateUser($data,$this->user_id)){
          $page = ' | Profile';
          $profile = User::getonedata([['id','=',$this->user_id]]);
          $messags['msg'] = 'The profile has been updated successfully!!.';
          $messags['erro']= 101;
          $messags['data'] = $data;
           $messags['htmlclass'] = 'profile';
           if($request->file('choosefile')){
            $messags['htmlid'] = 'profileimage';
            $messags['html'] = $data['profile'];
          }
        }else{
          $messags['msg'] = 'Oops, there is some problem, try again later!!.';
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

  public function updatepassword(Request $request){
    try{
      if($request->isMethod('post')){
       $wereh = [['id','=',$this->user_id]];
       $users =  User::getonedata($wereh);
        if($users != null && $request->currentpassword == Crypt::decryptString($users->password)){ 
          if($request->newpassword == $request->confirmpassword){
             $updatedata['password'] = Crypt::encryptString($request->newpassword);
            if(User::updateoption2($updatedata,array('id'=>$this->user_id))){
             $messags['msg'] = 'Password has been changed successfully!!.';
             $messags['erro']= 101;
             $messags['resetform'] = 'yes';
            }
          }else{
            $messags['msg'] = 'Confirm password does not match with a new password.';
            $messags['erro']= 202;
          }
       }else{
         $messags['msg'] = 'The current password does not match.';
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

  public function signOut() {
    Session::flush();
    Auth::logout();
    return Redirect('/');
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


  public function addform(Request $request)
  { 
    try{
    $data = json_decode($request->getContent());
    $newdata['form_version'] = 1;
    $newdata['status'] = 1;
    $newdata['form_data'] = json_encode($data->eventData);
    $newdata['form_title'] = $data->title;
    $newdata['default_status'] = $data->defaultstatus;
    if($data->formid != '' && $data->formid != null)
    {
      Form::updateoption2($newdata,[['id','=',$data->formid]]);
      $id = $data->formid;
    }else
    {
      $id = Form::create($newdata)->id;
    }
    
    if($id)
    { 
      unset($newdata['form_version']);
      unset($newdata['status']);
      $newdata['formid'] = $id;
      
      if($data->formversionid != '' && $data->formversionid != null)
      {
        Formversion::updateoption2($newdata,[['id','=',$data->formversionid]]);
        $formversionid = $data->formversionid;
      }else
      {
        $formversionid = Formversion::create($newdata)->id;
      }
     if($formversionid)
     {
        $messags['msg'] = 'Form has been added successfully!!.';
        $messags['erro']= 101;
        $messags['formid'] = $id;
        $messags['formversionid'] = $formversionid;
     }else
     {
        $messags['msg'] = 'Oops, there is some problem, try again later!!.';
        $messags['erro']= 202;
     }
    }else
    {
        $messags['msg'] = 'Oops, there is some problem, try again later!!.';
        $messags['erro']= 202;
    }
    }catch(\Exception $e){
       $messags['msg'] = $e->getMessage();
       $messags['erro']= 202;
    } 
    echo json_encode($messags);
    die;
  }


  public function formedit(Request $request)
  { 
    try{
    $data = json_decode($request->getContent());
  //  echo '<pre>'; print_r($data); die; 
    $forms = Form::getonedata([['id','=',$data->formid],['status','!=','2']]);
    if($forms != null)
    {
      if($data->formversionid == null)
      {
        $newdata['form_version'] = ($forms->form_version)+1;
      }
    $newdata['form_data'] = json_encode($data->eventData);
    if($data->formid != '' && $data->formid != null)
    {
      Form::updateoption2($newdata,[['id','=',$data->formid]]);
      $id = $data->formid;
    }
    
    if($id)
    { 
      if($data->formversionid == null)
      {
         $newdata['formversion'] = $newdata['form_version'];
         $newdata['form_title'] = $forms->form_title;
      }
      unset($newdata['form_version']);
      unset($newdata['status']);
      $newdata['formid'] = $id;
      if($data->formversionid != '' && $data->formversionid != null)
      {
        Formversion::updateoption2($newdata,[['id','=',$data->formversionid]]);
        $formversionid = $data->formversionid;
      }else
      {
        $formversionid = Formversion::create($newdata)->id;
      }
     if($formversionid)
     {
        $messags['msg'] = 'Form has been updated successfully!!.';
        $messags['erro']= 101;
        $messags['formid'] = $id;
        $messags['formversionid'] = $formversionid;
     }else
     {
        $messags['msg'] = 'Oops, there is some problem, try again later!!.';
        $messags['erro']= 202;
     }
    }else
    {
        $messags['msg'] = 'Oops, there is some problem, try again later!!.';
        $messags['erro']= 202;
    }
    }else
    {
      $messags['msg'] = 'Oops, there is some problem, try again later!!.';
      $messags['erro']= 202;
    }
    }catch(\Exception $e){
       $messags['msg'] = $e->getMessage();
       $messags['erro']= 202;
    } 
    echo json_encode($messags);
    die;
  }

  public function getform($id='')
  {
     try{
      $were = [['id','=',$id]];
      $data = Form::getdetailsuserret2($were,'form_data');
       return json_decode($data); die;
    }catch(\Exception $e){
      $newdata = [];
    } 
    echo json_encode($newdata);
    die;
  }

  public function editformtitle(Request $request)
  { 
     try{
      if($request->isMethod('post')){
      $data = $request->all();
      $forms = Form::getonedata([['id','=',$data['formid']],['status','!=','2']]);
    if($forms != null)
    {
      
     $newdata['form_version'] = ($forms->form_version)+1;
     $newdata['form_title'] = $data['title'];
     $newdata['default_status'] = $data['status'];
    
      Form::updateoption2($newdata,[['id','=',$data['formid']]]);
      $newdata2 = [ 
        'formid' => $data['formid'],
        'form_data' => $forms->form_data,
        'form_title' => $newdata['form_title'],
        'formversion' => $newdata['form_version'],
        'default_status'=>$newdata['default_status'],
      ];
     
      Formversion::create($newdata2);
      return redirect()->back()->with('message', 'The form Title has been updated successfully!!.');
    }else
    {
      return redirect()->back()->with('message2', 'Oops, there is some problem, try again later!!.');
    }
    }
    }catch(\Exception $e){
       return redirect("/")->with('message2', 'Oops, there is some problem, try again later!!.');
    } 
    
  }

 public function deleteforms(Request $request)
 {
    try{
       if($request->isMethod('post')){
         $data = $request->all();
         $newdata['status'] = '2';
         Form::updateoption2($newdata,[['id','=',$data['id']]]);
         return redirect()->back()->with('message', 'The form has been deleted successfully!!.');
       }
    }catch(\Exception $e){
       return redirect("/")->with('message2', 'Oops, there is some problem, try again later!!.');
    } 
 }

 public function assignforms(Request $request)
 { 
    try{
      if($request->isMethod('post')){
      $data = $request->all();
      if(isset($data['ids']) && $data['ids'] != null)
      {
        $ids = explode(",",$data['ids']);
        $newd = Assignform::getbyconditionid([['formid','=',$data['formid']]]);
        if(count($ids) > 0)
        {
          $updata['formid'] = $data['formid'];
          $count = 0;
          foreach ($ids as $key => $value) {
           $updata['organization_id'] = $value;
           Assignform::updateorcreates([['organization_id','=',$value],['formid','=',$data['formid']],['status','!=','2']],$updata);
           $count++;
           if($count == count($ids))
           {
            $this->getassignforms($request);
           }
          }
        }else
        {
          $this->getassignforms($request);
        }
      }else
      {
         $this->getassignforms($request);
      }
    }
    }catch(\Exception $e){
       //$newdata = [];
        $messags['msg'] = $e->getMessage();
       $messags['erro']= 202;
    } 
    echo json_encode($messags);
    die;
 }

 public function getassignforms(Request $request)
 {
   try{
     
      $data = $request->all();
       $formid = $data['formid'];
       $users = Assignform::getjoin($formid);
     /* $formassigns = Assignform::getbyconditionid([['formid','=',$data['formid']]]);
      $were = [['status','!=','3']];
      $users =User::getbyIncondition($were,$formassigns);*/
     
      $html = view('pages.assignuserslist', compact('users','formid'))->render();

    //  return json_encode($data['users']); 
       $messags['data'] = $users;
       $messags['msg'] = '';
       $essags['msg'] = '';

        $messags['htmlclass'] = 'assignedusers';
         $messags['html'] = $html;
           

       $messags['erro']= 101;
     }catch(\Exception $e){
       //return [];
       $messags['msg'] = $e->getMessage();
       $messags['erro']= 202;
    } 
      echo json_encode($messags);
    die;
 }

 public function deleteassignedorganization(Request $request)
 {
   try{
      if($request->isMethod('post')){
      $data = $request->all();
      if(isset($data['formid']) && $data['formid'] != null && isset($data['userid']) && $data['userid'] != null)
      {
        $were = [['formid','=',$data['formid']],['organization_id','=',$data['userid']]];
        $updatedata['status'] = '2';
         Assignform::updateoption2($updatedata,$were);
          $this->getassignforms($request);
       }
      {
         $this->getassignforms($request);
      }
    }
    }catch(\Exception $e){
       //$newdata = [];
        $messags['msg'] = $e->getMessage();
       $messags['erro']= 202;
    } 
    echo json_encode($messags);
    die;
 }
 
 public function userssearch(Request $request,$parentid='')
 {
   try{
      $data = $request->all();
      $were = [['status','!=','3'],['role','=',2],['parent_id','=',$parentid]];
      $weres = [];
      $weresdate = [];
       if(isset($data['query']) || isset($data['query'])) {
          if(isset($data['query']) && $data['query'] != null){
               $weres[] = ['email','like','%' .$data['query']. '%'];
               $weres[] = ['name','like','%' .$data['query']. '%'];
               $weres[] = ['lname','like','%' .$data['query']. '%'];
          } 
        }
      $data['users'] = User::getbyconditionmultiplewhere2($were,$weres,$weresdate);
      if($data['users'])
      {
        return json_encode($data['users']);   
      }else
      {
          return [];
      }
    // echo '<pre>'; print_r($data); die;
     }catch(\Exception $e){
     //  return [];
        $messags['msg'] = $e->getMessage();
       $messags['erro']= 202;
    } 
    echo json_encode($messags);
      die;
 }
 
 public function submitted_from_status(Request $request)
 {
   try{
      $data = $request->all();
     if($data['value'] === 2)
     {
        $data['value'] = '2'; 
     }
     if($data['value'] === 1)
     {
        $data['value'] = '1'; 
     }
     if($data['value'] === 0)
     {
        $data['value'] = '0'; 
     }
     
     $were = [['id','=',$data['submissionId']]];
        $updatedata['status'] = $data['value'];
      
      if(Submittedform::updateoption2($updatedata,$were))
      {
           $messags['msg'] = 'Status has been changed';
          $messags['erro']= 101;
      }
     }catch(\Exception $e){
        $messags['msg'] = $e->getMessage();
       $messags['erro']= 202;
    } 
    echo json_encode($messags);
      die;
   
 }

}
