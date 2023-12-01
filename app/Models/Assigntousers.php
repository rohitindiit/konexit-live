<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use DB;

class Assigntousers extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        
        'formid','userid','organization_id','from_title','status','created_at'
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
        return Assigntousers::insert($condition);
        }

        public static function updateUser($condition='',$id='')
        {
        $updateoptions = Assigntousers::findOrFail($id);
        $updateoptions->update($condition);
        return back();
        }

        public static function updateorcreates($matchThese='',$updatedata='')
        {
        $updateoptions = Assigntousers::updateOrCreate($matchThese,$updatedata);
     //   $updateoptions->update($condition);
        return back();
        }

        public static function updateoption2($condition='',$query='')
        {
        $updateoptions = Assigntousers::where($query);
        $updateoptions->update($condition);
        return back();
        }


        public static function getbycondition($conditiion = '')
        {
        return Assigntousers::where($conditiion)->get();
        }

        public static function getbyconditionid($conditiion = '')
        {
        return Assigntousers::where($conditiion)->pluck('organization_id')->toArray();
        }

        public static function getbycondition2($conditiion = '')
        {
        return Assigntousers::where($conditiion)->orderBy('id', 'desc')->paginate(15);
        }

        public static function getbyconditionmultiple($conditiion = '',$orcondition = '')
        {
            $conditions = Assigntousers::where($conditiion);
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
           $conditions = $conditions->orderBy('id', 'desc')->paginate(10);
        return $conditions;
        }

        public static function getbycondition3($conditiion = '')
        {
        return Assigntousers::where($conditiion)->orderBy('id', 'desc')->limit(10)->get();
        }

        public static function getdetailsuserret2($conditiion='',$field='')
        {
            $data= Assigntousers::where($conditiion)->orderBy('id', 'desc')->first();
            return $data->$field;
        }

        public static function getonedata($conditiion='')
        {
            $data= Assigntousers::where($conditiion)->first();
            return $data;
        }

         public static function getjoin($formid,$orgid)
        { 
            $users = DB::table('assigntousers')
            ->join('users', 'users.id', '=', 'assigntousers.userid')
            ->select('users.*')
            ->where('assigntousers.organization_id','=',$orgid)
            ->where('assigntousers.formid','=',$formid)
            ->where('assigntousers.status','!=','2')
            ->where('users.status','!=','3')
           // ->distinct()
            ->orderBy('assigntousers.id', 'desc')
            ->get();
             return $users;
        }
}
