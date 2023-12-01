<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\SubmissionComments;
use DB;
class Submittedform extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        
        'formid','form_version','userid','organization_id','form_data','form_location','status','created_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */


        public static function insertUser($condition='')
        {
        return Submittedform::insert($condition);
        }

        public static function updateUser($condition='',$id='')
        {
        $updateoptions = Submittedform::findOrFail($id);
        $updateoptions->update($condition);
        return back();
        }

        public static function updateoption2($condition='',$query='')
        {
        $updateoptions = Submittedform::where($query);
        $updateoptions->update($condition);
        return back();
        }


        public static function getbycondition($conditiion = '')
        {
        return Submittedform::where($conditiion)->get();
        }

        public static function getbycondition2($conditiion = '')
        {
        return Submittedform::where($conditiion)->orderBy('id', 'desc')->paginate(15);
        }

        public static function getallsubmmittedform($orgid='',$conditiion = '',$orcondition = '', $orstatus = '',$first_name = '',$surname='',$form_type='',$content='')
        {
            
              
            $conditions = \DB::table('submittedforms')
             ->join('forms', 'forms.id', '=', 'submittedforms.formid')
             ->join('users', 'users.id', '=', 'submittedforms.userid')
             ->join('assignforms', 'assignforms.formid', '=', 'submittedforms.formid')
             ->select('submittedforms.*','forms.form_title as formtitle','assignforms.from_title as changedtitle', DB::raw('JSON_UNQUOTE(JSON_EXTRACT(submittedforms.form_data, "$.firstName")) as user_first_name'),  DB::raw('JSON_UNQUOTE(JSON_EXTRACT(submittedforms.form_data, "$.lastName")) as user_last_name'))->distinct()
             ->where(function($query) use ($orgid, $conditiion,$form_type) {
                 $query->where('assignforms.organization_id', '=', $orgid)
                       ->where('submittedforms.organization_id', '=', $orgid);
                if($conditiion && $conditiion != '') {
                    $query->where(function($query) use ($conditiion) {
                        $query->where('forms.form_title','like','%' .$conditiion. '%')
                              ->orWhere('assignforms.from_title','like','%' .$conditiion. '%');
                    });
                }
                if($form_type && $form_type != '') {
                    $query->where(function($query) use ($form_type) {
                        $query->where('forms.form_title','like','%' .$form_type. '%')
                              ->orWhere('assignforms.from_title','like','%' .$form_type. '%');
                    });
                }
             });
            //   dd($conditions->get());
             
             if ($orstatus != '') {
                $conditions = $conditions->where('submittedforms.status', '=', $orstatus);
            }
              if($first_name != '') {
                $conditions = $conditions->where('submittedforms.form_data', 'like', '%"firstName":"' . $first_name . '%');
            }
             if($surname != '') {
                
                $conditions = $conditions->where('submittedforms.form_data', 'like', '%"lastName":"%' . $surname . '%');
            }
            if($content != ''){
                $conditions->where(function ($query) use ($content) {
                    $query->whereJsonContains('submittedforms.form_data', ['lastName' => $content])
                        ->orWhere('submittedforms.form_data', 'like', '%' . $content . '%');
                });
            }
             if(count($orcondition) > 0)
            {
                if(isset($orcondition['from_date']) && $orcondition['from_date'] != null){
                     $conditions = $conditions->whereDate('submittedforms.created_at', '>=', $orcondition['from_date']);
                  }
                if(isset($orcondition['to_date']) && $orcondition['to_date'] != null){
                    $conditions = $conditions->whereDate('submittedforms.created_at', '<=', $orcondition['to_date']);
                  }
            }
           $conditions = $conditions->orderBy('submittedforms.id', 'desc')->paginate(10);
        return $conditions;
        }
        
        public static function getallsubmmittedform2($conditiion = '', $orcondition = '', $orstatus = '', $first_name = '', $surname = '', $form_type = '', $content = '')
{
    $conditions = \DB::table('submittedforms')
        ->join('forms', 'forms.id', '=', 'submittedforms.formid')
        ->join('users', 'users.id', '=', 'submittedforms.userid')
        ->join('assignforms', 'assignforms.formid', '=', 'submittedforms.formid')
        ->select('submittedforms.*', 'forms.form_title as formtitle', 'assignforms.from_title as changedtitle', 'users.name as user_first_name', 'users.lname as user_last_name')->distinct()
        ->where(function ($query) use ($conditiion, $form_type) {
            if ($conditiion && $conditiion != '') {
                $query->where(function ($query) use ($conditiion) {
                    $query->where('forms.form_title', 'like', '%' . $conditiion . '%')
                        ->orWhere('assignforms.from_title', 'like', '%' . $conditiion . '%');
                });
            }
            if ($form_type && $form_type != '') {
                $query->where(function ($query) use ($form_type) {
                    $query->where('forms.form_title', 'like', '%' . $form_type . '%')
                        ->orWhere('assignforms.from_title', 'like', '%' . $form_type . '%');
                });
            }
        });

    if ($orstatus != '') {
        $conditions = $conditions->where('submittedforms.status', '=', $orstatus);
    }
    if ($first_name != '') { 
        $conditions = $conditions->where('submittedforms.form_data', 'like', '%"firstName":"'.$first_name.'%');
    }
    if ($surname != '') { 
        $conditions = $conditions->where('submittedforms.form_data', 'like', '%"lastName":"' . $surname );
    }
    if ($content != '') {
        $conditions->where(function ($query) use ($content) {
            $query->whereJsonContains('submittedforms.form_data', ['lastName' => $content])
                ->orWhere('submittedforms.form_data', 'like', '%' . $content . '%');
        });
    }
    if (count($orcondition) > 0) {
        if (isset($orcondition['from_date']) && $orcondition['from_date'] != null) {
            $conditions = $conditions->whereDate('submittedforms.created_at', '>=', $orcondition['from_date']);
        }
        if (isset($orcondition['to_date']) && $orcondition['to_date'] != null) {
            $conditions = $conditions->whereDate('submittedforms.created_at', '<=', $orcondition['to_date']);
        }
    }
    $conditions = $conditions->orderBy('submittedforms.id', 'desc')->paginate(10);
    return $conditions;
}

        
        public static function getsubmission_detail($orgid='',$submissionid='')
        {
                    $conditions = \DB::table('submittedforms')
                    ->join('forms', 'forms.id', '=', 'submittedforms.formid')
                    ->join("formversions",function($join){
                    $join->on("formversions.formid","=","submittedforms.formid")
                    ->on("formversions.formversion","=","submittedforms.form_version");
                    })
                    ->join('users', 'users.id', '=', 'submittedforms.userid')
                    ->join('assignforms', 'assignforms.formid', '=', 'submittedforms.formid')
                    ->select('submittedforms.*','formversions.form_data as form_format','forms.form_title as formtitle','forms.formid as form_display_ID','assignforms.from_title as changedtitle','users.name as user_first_name', 'users.lname as user_last_name','users.email as submitted_by')
                    ->where('assignforms.organization_id','=',$orgid)
                    ->where('submittedforms.organization_id', '=', $orgid)
                    ->where('assignforms.organization_id', '=', $orgid)
                    ->where('submittedforms.id', '=', $submissionid);
                    $conditions = $conditions->orderBy('submittedforms.id', 'desc')->first();
                    return $conditions;
        }
        
        
        public static function recent_getallsubmmittedform($orgid='')
        {
            $conditions = \DB::table('submittedforms')
             ->join('forms', 'forms.id', '=', 'submittedforms.formid')
             ->join('users', 'users.id', '=', 'submittedforms.userid')
             ->join('assignforms', 'assignforms.formid', '=', 'submittedforms.formid')
             ->select('submittedforms.*','forms.form_title as formtitle','assignforms.from_title as changedtitle','users.name as user_first_name', 'users.lname as user_last_name')->distinct()
             ->where(function($query) use ($orgid) {
                 $query->where('assignforms.organization_id', '=', $orgid)
                       ->where('submittedforms.organization_id', '=', $orgid);
             });
           $conditions = $conditions->orderBy('submittedforms.id', 'desc')->limit(5)->get();
        return $conditions;
        }
        
        
    /*    public static function admin_getsubmission_all($conditiion = '', array $orcondition = [])
        {
                    $conditions = \DB::table('submittedforms')
             ->join('forms', 'forms.id', '=', 'submittedforms.formid')
             ->join('users as user_info', 'user_info.id', '=', 'submittedforms.userid')
             ->join('users as organization_info', 'organization_info.id', '=', 'submittedforms.organization_id')
             ->join('assignforms', 'assignforms.formid', '=', 'submittedforms.formid')
             ->select([
                 'submittedforms.*',
                 'forms.form_title as formtitle',
                 'assignforms.from_title as changedtitle',
                 'user_info.name as user_first_name', 
                 'user_info.lname as user_last_name',
                 'user_info.email as user_email',
                 'organization_info.name as organization_name',
                 'organization_info.email as organization_email'
             ])->distinct(); 
             if($conditiion && $conditiion != '')
             {
                 $conditions->where('forms.form_title','like','%' .$conditiion. '%');
                 $conditions->orWhere('assignforms.from_title','like','%' .$conditiion. '%');
             }
             
              if(count($orcondition) > 0)
            {
                if(isset($orcondition['from_date']) && $orcondition['from_date'] != null){
                     $conditions = $conditions->whereDate('submittedforms.created_at', '>=', $orcondition['from_date']);
                  }
                if(isset($orcondition['to_date']) && $orcondition['to_date'] != null){
                    $conditions = $conditions->whereDate('submittedforms.created_at', '<=', $orcondition['to_date']);
                  }
            }
             $conditions = $conditions->orderBy('submittedforms.id', 'desc')->paginate(10);
          return $conditions;
        }*/
        
        public static function admin_getsubmission_all($condition = '', array $orcondition = [], $orstatus = '')	
{	
   
    $query = \DB::table('submittedforms')	
        ->join('forms', 'forms.id', '=', 'submittedforms.formid')	
        ->join('users as user_info', 'user_info.id', '=', 'submittedforms.userid')	
        ->join('users as organization_info', 'organization_info.id', '=', 'submittedforms.organization_id')	
        ->join('assignforms', 'assignforms.formid', '=', 'submittedforms.formid')	
        ->select([	
            'submittedforms.*',	
            'forms.form_title as formtitle',	
            'assignforms.from_title as changedtitle',	
            'user_info.name as user_first_name', 	
            'user_info.lname as user_last_name',	
            'user_info.email as user_email',	
            'organization_info.name as organization_name',	
            'organization_info.email as organization_email'	
        ])->distinct(); 
	
    if ($condition && $condition != '') {
        $query->where(function ($query) use ($condition) {
            $query->where('forms.form_title', 'like', '%' . $condition . '%')
                  ->orWhere('assignforms.from_title', 'like', '%' . $condition . '%')
                  ->orWhere('organization_info.name', 'like', '%' . $condition . '%')
                  ->orWhere('user_info.name', 'like', '%' . $condition . '%');
        });
    }
    
    if ($orstatus != '') {
        $query->where('submittedforms.status', $orstatus);
    }
 	
    if (count($orcondition) > 0) {	
        if (isset($orcondition['from_date']) && $orcondition['from_date'] != null) {	
            $query->whereDate('submittedforms.created_at', '>=', $orcondition['from_date']);	
        }	
        if (isset($orcondition['to_date']) && $orcondition['to_date'] != null) {	
            $query->whereDate('submittedforms.created_at', '<=', $orcondition['to_date']);	
        }	
    }	
 	
    $results = $query->orderBy('submittedforms.id', 'desc')->paginate(10);	
    // $total = $results->total();
	
    // if ($total > 0 && $total < $results->perPage()) {
    //     $results->getCollection()->splice($total, 0, []);
    //     $results->setTotal($total + ($results->perPage() - $total % $results->perPage()));
    // }
    
    return $results;	
}

public static function admin_organization_getsubmission_all($condition = '', array $orcondition = [],$orgid)	
{	
   
    $query = \DB::table('submittedforms')	
        ->join('forms', 'forms.id', '=', 'submittedforms.formid')	
        ->join('users as user_info', 'user_info.id', '=', 'submittedforms.userid')	
        ->join('users as organization_info', 'organization_info.id', '=', 'submittedforms.organization_id')	
        ->join('assignforms', 'assignforms.formid', '=', 'submittedforms.formid')
        ->where('assignforms.organization_id','=',$orgid)
        ->select([	
            'submittedforms.*',	
            'forms.form_title as formtitle',	
            'assignforms.from_title as changedtitle',	
            'user_info.name as user_first_name', 	
            'user_info.lname as user_last_name',	
            'user_info.email as user_email',	
            'organization_info.name as organization_name',	
            'organization_info.email as organization_email'	
        ])->distinct(); 
	
    if ($condition && $condition != '') {
        $query->where(function ($query) use ($condition) {
            $query->where('forms.form_title', 'like', '%' . $condition . '%')
                  ->orWhere('assignforms.from_title', 'like', '%' . $condition . '%');
        });
    }
 	
    if (count($orcondition) > 0) {	
        if (isset($orcondition['from_date']) && $orcondition['from_date'] != null) {	
            $query->whereDate('submittedforms.created_at', '>=', $orcondition['from_date']);	
        }	
        if (isset($orcondition['to_date']) && $orcondition['to_date'] != null) {	
            $query->whereDate('submittedforms.created_at', '<=', $orcondition['to_date']);	
        }	
    }	
 	
    $results = $query->orderBy('submittedforms.id', 'desc')->paginate(10);	
    $total = $results->total();
	
    if ($total > 0 && $total < $results->perPage()) {
        $results->getCollection()->splice($total, 0, []);
        $results->setTotal($total + ($results->perPage() - $total % $results->perPage()));
    }
	
    return $results;	
}

        
        
        public static function admin_getsubmission_detail($submissionid='')
        {
                    $conditions = \DB::table('submittedforms')
                    ->join('forms', 'forms.id', '=', 'submittedforms.formid')
                    ->join("formversions",function($join){
                    $join->on("formversions.formid","=","submittedforms.formid")
                    ->on("formversions.formversion","=","submittedforms.form_version");
                    })
                    ->join('users', 'users.id', '=', 'submittedforms.userid')
                    ->join('assignforms', 'assignforms.formid', '=', 'submittedforms.formid')
                    ->select('submittedforms.*','formversions.form_data as form_format','forms.form_title as formtitle','forms.formid as form_display_ID','assignforms.from_title as changedtitle','users.name as user_first_name', 'users.lname as user_last_name','users.email as submitted_by')
                    ->where('submittedforms.id', '=', $submissionid);
                    $conditions = $conditions->orderBy('submittedforms.id', 'desc')->first();
                    return $conditions;
        }
        
        
        public static function admin_user_getsubmission_all($condition = '', array $orcondition = [],$orgid,$userid)	
{	
   
    $query = \DB::table('submittedforms')	
        ->join('forms', 'forms.id', '=', 'submittedforms.formid')	
        ->join('users as user_info', 'user_info.id', '=', 'submittedforms.userid')	
        ->join('users as organization_info', 'organization_info.id', '=', 'submittedforms.organization_id')	
        ->join('assignforms', 'assignforms.formid', '=', 'submittedforms.formid')	
        ->select([	
            'submittedforms.*',	
            'forms.form_title as formtitle',	
            'assignforms.from_title as changedtitle',	
            'user_info.name as user_first_name', 	
            'user_info.lname as user_last_name',	
            'user_info.email as user_email',	
            'organization_info.name as organization_name',	
            'organization_info.email as organization_email'	
        ])->distinct(); 
        $query->where('submittedforms.organization_id',$orgid);
        $query->where('submittedforms.userid',$userid);
	
    if ($condition && $condition != '') {
        $query->where(function ($query) use ($condition) {
            $query->where('forms.form_title', 'like', '%' . $condition . '%')
                  ->orWhere('assignforms.from_title', 'like', '%' . $condition . '%');
        });
    }
 	
    if (count($orcondition) > 0) {	
        if (isset($orcondition['from_date']) && $orcondition['from_date'] != null) {	
            $query->whereDate('submittedforms.created_at', '>=', $orcondition['from_date']);	
        }	
        if (isset($orcondition['to_date']) && $orcondition['to_date'] != null) {	
            $query->whereDate('submittedforms.created_at', '<=', $orcondition['to_date']);	
        }	
    }	
 	
    $results = $query->orderBy('submittedforms.id', 'desc')->paginate(10);	
    $total = $results->total();
	
   /* if ($total > 0 && $total < $results->perPage()) {
        $results->getCollection()->splice($total, 0, []);
        $results->setTotal($total + ($results->perPage() - $total % $results->perPage()));
    }*/
	
    return $results;	
}

        

        public static function getbycondition3($conditiion = '')
        {
        return Submittedform::where($conditiion)->orderBy('id', 'desc')->limit(10)->get();
        }

        public static function getdetailsuserret2($conditiion='',$field='')
        {
            $data= Submittedform::where($conditiion)->orderBy('id', 'desc')->first();
            return $data->$field;
        }

        public static function getonedata($conditiion='')
        {
            $data= Submittedform::where($conditiion)->first();
            return $data;
        }
        
         public static function getcount($conditiion='')
         {
             $data= Submittedform::where($conditiion)->count();
            return $data;
         }

         public function comments()
         {
            $this->hasMany(SubmissionComments::class,'submission_id','id');
         }
}
