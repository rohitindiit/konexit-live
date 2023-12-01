<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Formversion extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        
        'formid','form_data','form_title','formversion','created_at'
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
        return Formversion::insert($condition);
        }

        public static function updateUser($condition='',$id='')
        {
        $updateoptions = Formversion::findOrFail($id);
        $updateoptions->update($condition);
        return back();
        }

        public static function updateoption2($condition='',$query='')
        {
        $updateoptions = Formversion::where($query);
        $updateoptions->update($condition);
        return back();
        }


        public static function getbycondition($conditiion = '')
        {
        return Formversion::where($conditiion)->get();
        }

        public static function getbycondition2($conditiion = '')
        {
        return Formversion::where($conditiion)->orderBy('id', 'desc')->paginate(15);
        }

        public static function getbycondition3($conditiion = '')
        {
        return Formversion::where($conditiion)->orderBy('id', 'desc')->limit(10)->get();
        }

        public static function getdetailsuserret2($conditiion='',$field='')
        {
            $data= Formversion::where($conditiion)->orderBy('id', 'desc')->first();
            return $data->$field;
        }

        public static function getonedata($conditiion='')
        {
            $data= Formversion::where($conditiion)->first();
            return $data;
        }
}
