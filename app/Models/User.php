<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use DB;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        
        'parent_id','name','division','lname','role','email','password','profile','phone','status','created_at','forget_pass','remember_token','user_quota','total_users'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

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
        return User::insert($condition);
        }

        public static function updateUser($condition='',$id='')
        {
        $updateoptions = User::findOrFail($id);
        $updateoptions->update($condition);
        return back();
        }

        public static function updateoption2($condition='',$query='')
        {
        $updateoptions = User::where($query);
        $updateoptions->update($condition);
        return back();
        }


        public static function getbycondition($conditiion = '')
        {
        return User::where($conditiion)->get();
        }

        public static function getbycondition2($conditiion = '')
        {
        return User::where($conditiion)->orderBy('id', 'desc')->paginate(10);
        }

        public static function getbyconditionmultiple2($conditiion = '',$orcondition = '')
        {
           // $conditions = User::where($conditiion);
            $count = 0;
            if(count($orcondition) > 0)
            {
                $conditions = User::where($conditiion)->where(function($query) use($orcondition) {
                  $query->where($orcondition[0][0], $orcondition[0][1], $orcondition[0][2])
                    ->orWhere($orcondition[1][0], $orcondition[1][1], $orcondition[1][2]);
                })->orderBy('id', 'desc')->paginate(10);
            }else
            {
                 $conditions = User::where($conditiion)->orderBy('id', 'desc')->paginate(10);
            }
       //    $conditions = $conditions->orderBy('id', 'desc')->paginate(10);
        return $conditions;
        }

        public static function getbyconditionmultiple($conditiion = '',$orcondition = '')
        {
            $conditions = User::where($conditiion);
            $count = 0;
            if(count($orcondition) > 0)
            {
                $conditions = $conditions->where(function($query) use($orcondition) {
                  $query->where($orcondition[0][0], $orcondition[0][1], $orcondition[0][2])
                    ->orWhere($orcondition[1][0], $orcondition[1][1], $orcondition[1][2]);
                });
            }
           $conditions = $conditions->orderBy('id', 'desc')->paginate(100);
        return $conditions;
        }

        public static function getbyconditionmultiplewhere($conditiion = '',$orcondition = '',$weresdate = '')
        {
          
            $conditions = User::where($conditiion);
            $count = 0;
            

            if(count($weresdate) == 2)
                {
                   $conditions = $conditions->whereBetween('created_at', [$weresdate['from_date'], $weresdate['to_date']]);
                }else
                {
                    if(isset($weresdate['from_date']) && $weresdate['from_date'] != null){
                     $conditions = $conditions->whereDate('created_at', '>=', $weresdate['from_date']);
                   }
                    if(isset($weresdate['to_date']) && $weresdate['to_date'] != null){
                     $conditions = $conditions->whereDate('created_at', '<=', $weresdate['to_date']);
                   }
                }
            if(count($orcondition) > 0)
            { 
              $conditions =  $conditions->where(function ($query) use($orcondition) {
                $count = 0;
                foreach($orcondition as $key => $rs)
                { 
                    $cond = ($count == 0) ? 'where' : 'orWhere';
                    $query->$cond($orcondition[$key][0], $orcondition[$key][1], $orcondition[$key][2]);
                     $count++;
                }
              });
            }
           $conditions = $conditions->orderBy('id', 'desc')->paginate(10000);
        return $conditions;
        }


        public static function getbyconditionmultiplewhere2($conditiion = '',$orcondition = '',$weresdate = '')
        {
          //\DB::enableQueryLog();

            $conditions = User::where($conditiion);
            if(count($weresdate) == 2)
                {
                   $conditions = $conditions->whereBetween('created_at', [$weresdate['from_date'], $weresdate['to_date']]);
                }else
                {
                    if(isset($weresdate['from_date']) && $weresdate['from_date'] != null){
                     $conditions = $conditions->whereDate('created_at', '>=', $weresdate['from_date']);
                   }
                    if(isset($weresdate['to_date']) && $weresdate['to_date'] != null){
                     $conditions = $conditions->whereDate('created_at', '<=', $weresdate['to_date']);
                   }
                }
            if(count($orcondition) > 0)
            { 
              $conditions =  $conditions->where(function ($query) use($orcondition) {
                $count = 0;
                foreach($orcondition as $key => $rs)
                { 
                    $cond = ($count == 0) ? 'where' : 'orWhere';
                    $query->$cond($orcondition[$key][0], $orcondition[$key][1], $orcondition[$key][2]);
                     $count++;
                }
              });
            }
           $conditions = $conditions->orderBy('id', 'desc')->get(['id as value', 'email as label']);
        //   dd(\DB::getQueryLog());

         return $conditions->toArray();
        }

        public static function getbycondition3($conditiion = '')
        {
        return User::where($conditiion)->orderBy('id', 'desc')->limit(10)->get();
        }

         public static function getbyIncondition($conditiion = '',$conditiion2 = '')
        {
        return User::where($conditiion)->whereIn('id', $conditiion2)->orderBy('id', 'desc')->get();
        }

        public static function getdetailsuserret2($conditiion='',$field='')
        {
            $data= User::where($conditiion)->orderBy('id', 'desc')->first();
            return $data->$field;
        }

        public static function getonedata($conditiion='')
        {
            $data= User::where($conditiion)->first();
            return $data;
        }

        public static function getcount($conditiion='')
        {
            $data= User::where($conditiion)->count();
            return $data;
        }
        
        public static function submission_by_organization($conditiion='')
        {
            $users = User::join('submittedforms', 'users.id', '=', 'submittedforms.userid')
            ->select('users.id','users.name','users.parent_id', DB::raw('COUNT(submittedforms.id) as submission_count'))
            ->where($conditiion)
            ->groupBy('users.id,users.parent_id')
            ->get();
        }
}
