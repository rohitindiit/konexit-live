<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Form extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        
        'form_data','form_title','default_status','form_sub_title','form_version','status','location_required','created_at'
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
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


        public static function insertUser($condition='')
        {
           return Form::insert($condition);
        }

        public static function updateUser($condition='',$id='')
        {
            $updateoptions = Form::findOrFail($id);
            $updateoptions->update($condition);
            return back();
        }

        public static function updateoption2($condition='',$query='')
        {
            $updateoptions = Form::where($query);
            $updateoptions->update($condition);
            return back();
        }


        public static function getbycondition($conditiion = '')
        {
          return Form::where($conditiion)->get();
        }

        public static function getbycondition2($conditiion = '')
        {
          return Form::where($conditiion)->orderBy('id', 'desc')->paginate(15);
        }

        public static function getbyconditionmultiple($conditiion = '',$orcondition = '',$status='',$first_name='',$surname='',$form_type='',$content='')
        {
            $conditions = Form::where($conditiion);
            // dd($orcondition);
            $count = 0;
            if(count($orcondition) > 0)
            {
                if(count($orcondition) == 2)
                {
                   $conditions = $conditions->whereBetween('created_at', [$orcondition['from_date'], $orcondition['to_date']]);
                }else
                {
                    if(isset($orcondition['from_date']) && $orcondition['from_date'] != null){
                     $conditions = $conditions->whereDate('created_at', '>=', $orcondition['from_date']);
                   }
                    if(isset($orcondition['to_date']) && $orcondition['to_date'] != null){
                     $conditions = $conditions->whereDate('created_at', '<=', $orcondition['to_date']);
                   }
                }
            }
             if(isset($orcondition['from_date']) && $orcondition['from_date'] != null){
                     $conditions = $conditions->whereDate('created_at', '>=', $orcondition['from_date']);
                   }
                    if(isset($orcondition['to_date']) && $orcondition['to_date'] != null){
                     $conditions = $conditions->whereDate('created_at', '<=', $orcondition['to_date']);
                   }
            if($first_name != '') {
                $conditions->where(function ($query) use ($first_name) {
                    $query->whereJsonContains('form_data', ['components' => [['key' => 'firstName', 'label' => $first_name]]])
                        ->orWhere('form_data', 'like', '%' . $first_name . '%');
                });
            }
            //  dd($surname);
            if($surname != '') {
                // dd($surname);
                $conditions->where(function ($query) use ($surname) {
                    $query->whereJsonContains('form_data', ['components' => [['key' => 'lastName', 'label' => $surname]]])
                        ->orWhere('form_data', 'like', '%' . $surname . '%');
                });
            }
            if($content != ''){
                $conditions->where(function ($query) use ($content) {
                    $query->whereRaw("JSON_UNQUOTE(JSON_EXTRACT(form_data, '$.components[0].label')) = ?", $content)
                        ->orWhere('form_data', 'like', '%' . $content . '%');
                });
            }
            if($status != '') {
                $conditions->where('default_status', $status);
            }
            if($form_type != '') {
                $conditions->where('form_title', $form_type);
            }
            // dd($conditions->get());
           $conditions = $conditions->orderBy('id', 'desc')->paginate(10);
           return $conditions;
        }

         public static function getbyconditionmultipleorganization($conditiion = '',$orcondition = '',$orgid='')
         { 
            $conditions = \DB::table('forms')
             ->join('assignforms', 'assignforms.formid', '=', 'forms.id')
             ->select('forms.*','assignforms.created_at as assigndate')
             ->where('assignforms.organization_id','=',$orgid)
             ->where($conditiion);
            //$conditions = Form::where($conditiion);
            $count = 0;
            if(count($orcondition) > 0)
            {
                if(count($orcondition) == 2)
                {
                   $conditions = $conditions->whereBetween('forms.created_at', [$orcondition['from_date'], $orcondition['to_date']]);
                }else
                {
                    if(isset($orcondition['from_date']) && $orcondition['from_date'] != null){
                     $conditions = $conditions->whereDate('forms.created_at', '>=', $orcondition['from_date']);
                   }
                    if(isset($orcondition['to_date']) && $orcondition['to_date'] != null){
                     $conditions = $conditions->whereDate('forms.created_at', '<=', $orcondition['to_date']);
                   }
                }
            }
           $conditions = $conditions->orderBy('forms.id', 'desc')->get()->toArray();
           return $conditions;
         }
         
          public static function getbyconditionmultipleorganization2($conditiion = '',$orcondition = '',$orgid='')
         { 
            $conditions = \DB::table('forms')
             ->join('assignforms', 'assignforms.formid', '=', 'forms.id')
             ->select('forms.*','assignforms.created_at as assigndate')
             ->where('assignforms.organization_id','=',$orgid)
             ->where($conditiion);
            //$conditions = Form::where($conditiion);
            $count = 0;
            if(count($orcondition) > 0)
            {
                if(count($orcondition) == 2)
                {
                   $conditions = $conditions->whereBetween('assignforms.created_at', [$orcondition['from_date'], $orcondition['to_date']]);
                }else
                {
                    if(isset($orcondition['from_date']) && $orcondition['from_date'] != null){
                     $conditions = $conditions->whereDate('assignforms.created_at', '>=', $orcondition['from_date']);
                   }
                    if(isset($orcondition['to_date']) && $orcondition['to_date'] != null){
                     $conditions = $conditions->whereDate('assignforms.created_at', '<=', $orcondition['to_date']);
                   }
                }
            }
           $conditions = $conditions->orderBy('forms.id', 'desc')->get()->toArray();
           return $conditions;
         }
        
         public static function getbyconditionmultipleorganization_users($conditiion = '',$orcondition = '',$orgid='',$userid)
        {
            $conditions = \DB::table('forms')
             ->join('assigntousers', 'assigntousers.formid', '=', 'forms.id')
             ->select('forms.*','assigntousers.created_at as assigndate')
             ->where('assigntousers.organization_id','=',$orgid)
             ->where('assigntousers.userid','=',$userid)
             ->where($conditiion);
            //$conditions = Form::where($conditiion);
            $count = 0;
            if(count($orcondition) > 0)
            {
                if(count($orcondition) == 2)
                {
                   $conditions = $conditions->whereBetween('assigntousers.created_at', [$orcondition['from_date'], $orcondition['to_date']]);
                }else
                {
                    if(isset($orcondition['from_date']) && $orcondition['from_date'] != null){
                     $conditions = $conditions->whereDate('assigntousers.created_at', '>=', $orcondition['from_date']);
                   }
                    if(isset($orcondition['to_date']) && $orcondition['to_date'] != null){
                     $conditions = $conditions->whereDate('assigntousers.created_at', '<=', $orcondition['to_date']);
                   }
                }
            }
           $conditions = $conditions->orderBy('forms.id', 'desc')->paginate(10);
           return $conditions;
        }
        
        public static function get_desktop_user_formslist($userid='')
        {
            $conditions = \DB::table('assigntousers')
            ->join('forms', 'forms.id', '=', 'assigntousers.formid')
            ->select('forms.*','assigntousers.organization_id')
            ->where('assigntousers.userid','=',$userid)
            ->where('assigntousers.status','=','0')
            ->where('forms.status','=','0');
            $conditions = $conditions->orderBy('assigntousers.id', 'desc')->paginate(10);;
            return $conditions;
        }
        
        public static function getuser_formslist($userid='')
        {
            $conditions = \DB::table('assigntousers')
            ->join('forms', 'forms.id', '=', 'assigntousers.formid')
            ->select('forms.*','assigntousers.organization_id')
            ->where('assigntousers.userid','=',$userid)
            ->where('assigntousers.status','=','0')
            ->where('forms.status','=','0');
            $conditions = $conditions->orderBy('assigntousers.id', 'desc')->get()->toArray();
            return $conditions;
        }

        public static function getbycondition3($conditiion = '')
        {
          return Form::where($conditiion)->orderBy('id', 'desc')->limit(10)->get();
        }

        public static function getdetailsuserret2($conditiion='',$field='')
        {
            $data= Form::where($conditiion)->orderBy('id', 'desc')->first();
            return $data->$field;
        }

        public static function getonedata($conditiion='')
        {
            $data= Form::where($conditiion)->first();
            return $data;
        }
        
         public static function getcount($conditiion='')
         {
             $data= Form::where($conditiion)->count();
            return $data;
         }
}
