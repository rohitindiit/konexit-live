<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MobileUsersappcontroller;
use App\Http\Controllers\MobileFormcontroller;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::post('/login', [MobileUsersappcontroller::class, 'userlogin']);
Route::post('/userToken', [MobileUsersappcontroller::class, 'userToken']);

Route::post('/logout', [MobileUsersappcontroller::class, 'userlogout']);
//Route::post('/formslist', [MobileUsersappcontroller::class, 'formslistall']);
Route::post('/get_forms_list', [MobileFormcontroller::class, 'getform_list']);
Route::get('/getform/{id}', [MobileFormcontroller::class, 'getform']);
Route::get('/getformdata/{id}/{user_id}', [MobileFormcontroller::class, 'getformData']);
Route::post('/getuserdetail', [MobileUsersappcontroller::class, 'getuserdetail']);
Route::post('/getuserNotification', [MobileUsersappcontroller::class, 'getuserNotification']);
Route::post('/update-profile', [MobileUsersappcontroller::class, 'updateProfile']);
Route::post('/update-password', [MobileUsersappcontroller::class, 'updatePassword']);
Route::get('/check-user-active/{id}', [MobileUsersappcontroller::class, 'checkuser']);
Route::post('/submit-form', [MobileFormcontroller::class, 'submit_form']);
Route::post('/get_all_submitted_form_by_userid', [MobileFormcontroller::class, 'getAllSubmittedFormByUserID']);
Route::post('/get_submitted_form_details_by_form_id', [MobileFormcontroller::class, 'getSubmittedFormDetailsByFormID']);
Route::post('/getComments', [MobileFormcontroller::class, 'getComments']);
Route::post('/seenStatus', [MobileFormcontroller::class, 'seenStatus']);


Route::post('/makesync', [MobileUsersappcontroller::class, 'makeSync']);
