<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserAuthController;
use App\Http\Controllers\Commoncontoller;
use App\Http\Controllers\Adminpages;
use App\Http\Controllers\Adminfunction;
use App\Http\Controllers\Organisation;
use App\Http\Controllers\Nologin;
use App\Http\Controllers\Organisationpage;
use App\Http\Controllers\Organisationfunction;
use App\Http\Controllers\Userscontroller;
use App\Http\Controllers\CsvController;
use App\Http\Controllers\OrganisationCommentController;
use App\Models\Submittedform;
use App\Models\SubmissionComments;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/phpinfo', function () {
 phpinfo();
});

Route::get('/', function () {
header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
header('Pragma: no-cache');
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
if(session()->exists('admin'))
        {  
           return \redirect('/dashboard');
        }elseif(session()->exists('organization'))
        {
              return \redirect('/organization/dashboard');
        }else
        {
          $Page = 'Login';
          $data['page'] = $Page;
         return view('welcome',$data);
        }
});

Route::get('/push', [Organisationfunction::class, 'pushNotification'])->name('push.notification');

Route::get('/forgotpassword', [UserAuthController::class, 'forgotpassword'])->name('admin.forgotpassword');
Route::get('/login', [Nologin::class, 'loginconfirm'])->name('login-main');
Route::get('/login/{id}', [Nologin::class, 'loginconfirm']);
Route::get('/logout', [Nologin::class, 'signOut'])->name('admin.signOut');
Route::get('/autologout', [Nologin::class, 'autologout'])->name('auto.logout');
Route::post('custom-login', [Commoncontoller::class, 'customLogin'])->name('login.custom');
Route::post('forget-password', [Commoncontoller::class, 'forgetpassword'])->name('forgetpassword');
Route::get('/reset_password/{id}',[UserAuthController::class, 'resetPassword']);
Route::post('verify_otp',[Commoncontoller::class, 'verifyotp'])->name('verifyotp');
Route::get('/change_password/{id}',[UserAuthController::class, 'changePassword']);
Route::post('/password_change',[Commoncontoller::class, 'passwordchange'])->name('passwordchange');


/************************************************** Admin Pages **************************************************/
Route::middleware('admin')->group(function () {  
Route::get('/logoutforapp/{id}', [Adminpages::class, 'logoutforapp'])->name('logout.for.app');  
Route::post('/getComments', [Adminpages::class, 'getComments'])->name('admin.getComments');    
Route::get('/download-csv-admin', [CsvController::class, 'usercsvdownload'])->name('download.csvadmin');
//Route::middleware('autologout','activity')->group(function () { 
    
Route::get('/dashboard', [Adminpages::class, 'dashboard'])->name('admin.dashboard');
Route::post('/admin/submissionCountChart', [Adminpages::class, 'submissionCountChartForms'])->name('admin.submission.countChartForms');
Route::post('/admin/submissionCountChartMonthly', [Adminpages::class, 'submissionCountChartFormsMonthly'])->name('admin.submission.countChart.monthly');
Route::post('/admin/singlesubmissionCountChart', [Adminpages::class, 'singleSubmissionCountChartForms'])->name('admin.single.submission.countChartForms');

Route::post('/admin/submissionCountChartWeekly', [Adminpages::class, 'submissionCountChartFormsWeekly'])->name('admin.submission.countChart.weekly');
Route::get('/subadmin', [Adminpages::class, 'subadmin'])->name('subadmin.view');
Route::get('/editsubadminview/{uid}', [Adminpages::class, 'editSubadminView'])->name('edit.subadmin.view');
Route::post('/updatesubadmin', [Adminpages::class, 'updateSuborgAdmin'])->name('update.subadmin.user');
Route::get('/admin-permissions/{uid}', [Adminpages::class, 'subadminPermissions'])->name('admin.permissions');
Route::post('/adminaddpermission', [Adminpages::class, 'adminAddPermission'])->name('admin.add.permission');
Route::get('/deleteadminUser/{uid}', [Adminpages::class, 'deleteAdminUser'])->name('delete.admin.user');

Route::get('/profile', [Adminpages::class, 'profile']);
Route::get('/organisations', [Adminpages::class, 'organisations'])->name('admin.org');
Route::get('/addorganisation', [Adminpages::class, 'addorganisation']);
Route::get('/editorganisation/{id}', [Adminpages::class, 'editorganisation']);
Route::post('/getorganisationdata', [Organisation::class, 'getorganisationdata']);
Route::post('/delete-organization', [Organisation::class, 'deleteorganization'])->name('delete.organization');
Route::post('/change-organization-status', [Organisation::class, 'statusorganization'])->name('status.organization');
Route::get('/search-organizations', [Organisation::class, 'search_Organizations']);

Route::get('/perent_users', [Adminpages::class, 'allUsers'])->name('all.users');
Route::get('/add_desktop_user', [Adminpages::class, 'addDsesktopUser'])->name('add.desktop.user');
Route::post('/save_desktop_user', [Adminpages::class, 'saveDsesktopUser'])->name('add.pernt.user');


Route::get('/{id}/users', [Adminpages::class, 'users'])->name('adminorganization.users');
Route::get('/{id}/adduser', [Adminpages::class, 'adduser']);
Route::post('/{id}/addorganization-user', [Organisation::class, 'addorganization_user'])->name('add.organization.users');
Route::post('/{id}/editorganization-user/{userid}', [Organisation::class, 'editorganization_user'])->name('edit.organization.users');
Route::post('/delete-users/{id}', [Organisation::class, 'deleteusers'])->name('delete.users');
Route::post('/change-users-status/{id}', [Organisation::class, 'statususers'])->name('status.users');


Route::get('/{id}/forms/{userid}', [Adminpages::class, 'users_forms'])->name('organization.users.forms');
Route::get('/{id}/submissions/{userid}', [Adminpages::class, 'users_submissions'])->name('organization.users.submissions');
Route::get('/{id}/edituser/{userid}', [Adminpages::class, 'edituser']);
Route::get('/{id}/userdetails/{userid}', [Adminpages::class, 'userdetails']);
Route::get('/submissions', [Adminpages::class, 'submissions'])->name('admin.submissions');
Route::get('/submissionsdetails/{id}', [Adminpages::class, 'submissionsdetails'])->name('admin.submissionsdetails');
Route::get('/submission_media/{id}', [Adminpages::class, 'submissionmedia'])->name('admin.submission_media');

Route::get('/forms', [Adminpages::class, 'forms'])->name('admin.forms');
Route::get('/forms/{organizationid}', [Adminpages::class, 'organizationforms']);
Route::get('/submissions/{organizationid}', [Adminpages::class, 'organizationsubmissions']);
Route::get('/formbuilder', [Adminpages::class, 'formbuilder']);
Route::get('/formdetails/{id}', [Adminpages::class, 'formdetails']);
Route::get('/formedit/{id}', [Adminpages::class, 'formeditdetail']);
Route::post('/formedit', [Adminfunction::class, 'formedit'])->name('edit.form');
Route::post('/addform', [Adminfunction::class, 'addform'])->name('add.form');
Route::get('/getform/{id}', [Adminfunction::class, 'getform']);
Route::post('/editformtitle', [Adminfunction::class, 'editformtitle'])->name('edit.formtitle');
Route::post('/delete-forms', [Adminfunction::class, 'deleteforms'])->name('delete.form');
Route::get('/location_flag_update', [Adminfunction::class, 'location_flag_update'])->name('location_flag_update');
Route::post('/assignform', [Adminfunction::class, 'assignforms'])->name('admin.assignform');
Route::post('/deleteassignedorganization', [Adminfunction::class, 'deleteassignedorganization'])->name('admin.deleteassignedorganization');

Route::get('/search-userss/{parentid}', [Adminfunction::class, 'userssearch']);

Route::post('/update-profile', [Adminfunction::class, 'updateprofile'])->name('update.profile');
Route::post('/update-password', [Adminfunction::class, 'updatepassword'])->name('update.password');

Route::get('image-upload', [ Adminfunction::class, 'imageUpload' ])->name('image.upload');
Route::post('image-upload', [ Adminfunction::class, 'imageUploadPost' ])->name('image.upload.post');

Route::post('/add-organisation', [Organisation::class, 'addorganisation'])->name('add.organisation');
Route::post('/edit-organisation', [Organisation::class, 'editorganisation'])->name('edit.organisation');

Route::post('/submitted_from_status', [Adminfunction::class, 'submitted_from_status'])->name('submitted_from_status.admin');

Route::get('/admin-submission-csv/{id}/{parentid}', [CsvController::class, 'admin_submissiondatadownload'])->name('admin.submission.csv');

});   
    
//});
/*********************** Admin Pages END ************************/


/*********************** Organization Pages ************************/
Route::middleware(['organization'])->group(function () {
    
    
Route::get('/organization/userServiceExport', [Organisationpage::class, 'userServiceExport'])->name('user.service.export');
    
Route::post('/organization/documentuplode', [Organisationpage::class, 'uplodeDocument'])->name('uplode.document'); 

Route::post('/organization/assgindoc', [Organisationpage::class, 'assginDocUser'])->name('assgin.doc.user'); 
Route::get('/organization/assgindoc/{docid}', [Organisationpage::class, 'assginDoc'])->name('assgin.doc'); 
Route::get('/organization/document', [Organisationpage::class, 'document'])->name('document.main');    
Route::get('/organization/watchuseractivity/{id}', [Organisationpage::class, 'watchUserActivity'])->name('watch.user.activity');  
Route::get('/organization/logoutforapp/{id}', [Organisationpage::class, 'logoutforapp'])->name('logout.for.app.organistion');    
//Route::middleware('autologout','activity')->group(function () { 
Route::post('/organization/getComments', [Organisationpage::class, 'getComments'])->name('getComments');        
Route::get('/organization/dashboard', [Organisationpage::class, 'dashboard']);
Route::post('/organization/chartbar', [Organisationpage::class, 'chartCompletedForms'])->name('chart.bar');

Route::post('/organization/formStateAjax', [Organisationpage::class, 'formStateAjax'])->name('form.state.ajax');
Route::post('/organization/formSubmissionTableAjax', [Organisationpage::class, 'formSubmissionTableAjax'])->name('form.submission.table.ajax');
Route::post('/organization/interactiveMap', [Organisationpage::class, 'interactiveMap'])->name('interactive.map.ajax');

Route::post('/organization/singlesubmissionCountChart', [Organisationpage::class, 'singleSubmissionCountChartForms'])->name('single.submission.countChartForms');
Route::post('/organization/singleformSubmissionTableAjax', [Organisationpage::class, 'singleFormSubmissionTableAjax'])->name('single.form.submission.table.ajax');

Route::post('/organization/submissionCountChart', [Organisationpage::class, 'submissionCountChartForms'])->name('submission.countChartForms');

Route::post('/organization/submissionCountChartMonthly', [Organisationpage::class, 'submissionCountChartFormsMonthly'])->name('submission.countChart.monthly');
Route::post('/organization/submissionCountChartWeekly', [Organisationpage::class, 'submissionCountChartFormsWeekly'])->name('submission.countChart.weekly');

Route::post('/organization/singlesubmissionCountChart', [Organisationpage::class, 'singleSubmissionCountChartForms'])->name('single.submission.countChartForms');
Route::post('/organization/singlesubmissionCountChartMonthly', [Organisationpage::class, 'singleSubmissionCountChartFormsMonthly'])->name('single.submission.countChart.monthly');
Route::post('/organization/singlesubmissionCountChartWeekly', [Organisationpage::class, 'singleSubmissionCountChartFormsWeekly'])->name('single.submission.countChart.weekly');


Route::get('/organization/user', [Organisationpage::class, 'users']);
Route::get('/organization/suborganiser', [Organisationpage::class, 'subOrganisations'])->name('suborg.view');
Route::get('/organization/org-permissions/{uid}', [Organisationpage::class, 'orgpermissions'])->name('org.permissions');
Route::post('/organization/organizationaddpermission', [Organisationpage::class, 'organizationAddPermission'])->name('organization.add.permission');
Route::get('/organization/addsuborgview', [Organisationpage::class, 'addSuborgView'])->name('add.suborg.view');
Route::get('/organization/editsuborgview/{uid}', [Organisationpage::class, 'editSuborgView'])->name('edit.suborg.view');
Route::post('/organization/savesuborguser', [Organisationpage::class, 'saveSuborgUser'])->name('save.suborg.user');
Route::post('/organization/updatesuborguser', [Organisationpage::class, 'updateSuborgUser'])->name('update.suborg.user');
Route::get('/organization/deletesuborguser/{uid}', [Organisationpage::class, 'deleteSuborgUser'])->name('delete.suborg.user');

Route::post('/organization/change_suborg_status/', [Organisationfunction::class, 'changeSuborgStatus'])->name('status.suborg');

Route::get('/organization/inactive/today', [Organisationpage::class, 'orgInactiveTodayUser'])->name('org.inactive.today.user');

Route::get('/organization/addusers', [Organisationpage::class, 'adduser']);
Route::get('/get_UsersListing', [Organisationpage::class, 'get_UsersListing'])->name('get_UsersListing');
Route::get('/get_filtered_UsersListing', [Organisationpage::class, 'get_filtered_UsersListing'])->name('get.filtered.UsersListing');

Route::post('/addorganization-user', [Organisationfunction::class, 'addorganization_user'])->name('organization.add.users');

Route::get('/organization/editusers/{id}',  [Organisationpage::class, 'edituser']);

Route::post('/editorganization-user/{userid}', [Organisationfunction::class, 'editorganization_user'])->name('organization.edit.organization.users');

Route::get('/organization/forms', [Organisationpage::class, 'forms']);
Route::get('/search-users/{parentid}', [Userscontroller::class, 'userssearch']);
Route::post('/assignuserform', [Userscontroller::class, 'assignuserform']);
Route::post('/deleteassignedusers', [Userscontroller::class, 'deleteassignedusers']);
Route::get('/organization/formdetails/{id}', [Organisationpage::class, 'formdetails'])->name('org.form.detail');
Route::get('/organization/submissions', [Organisationpage::class, 'submissions'])->name('org.submission');
Route::get('/organization/settings', [Organisationpage::class, 'profile']);
Route::get('/organization/submissionsdetails/{id}', [Organisationpage::class, 'submissionsdetails'])->name('org.submision');
Route::get('/organization/submission_media/{id}', [Organisationpage::class, 'submissionmedia'])->name('organization.submission_media');
Route::post('/organization/update-profile', [Organisationfunction::class, 'updateprofile'])->name('organization.update.profile');
Route::post('/organization/update-password', [Organisationfunction::class, 'updatepassword'])->name('organization.update.password');

Route::post('/organization/update-subprofile', [Organisationfunction::class, 'updatesuborgprofile'])->name('organization.update.suborgprofile');
Route::post('/organization/update-subpassword', [Organisationfunction::class, 'updatesuborgpassword'])->name('organization.update.suborgpassword');


Route::get('/download-csv', [CsvController::class, 'usercsvdownload'])->name('download.csv');
Route::post('/process-csv', [CsvController::class, 'userprocessCsv'])->name('process.csv');
Route::get('/submission-csv/{id}', [CsvController::class, 'submissiondatadownload'])->name('submission.csv');

Route::post('/submitted_from_status_organization', [Organisationfunction::class, 'submitted_from_status'])->name('submitted_from_status.organization');
Route::post('/submitted_from_status_multiple', [Organisationfunction::class, 'submitted_from_status_multiple'])->name('submitted_from_status_multiple.organization');


Route::post('/submit_comment_by_organisation', [OrganisationCommentController::class, 'addComment'])->name('submit.comment.by.org');
Route::post('/addCommentbyAjax', [OrganisationCommentController::class, 'addCommentbyAjax'])->name('submit.comment.by.org.ajax');


//});
});

/***************************************************** Organization Pages END **************************************************************/

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('cache:clear');
    echo '<h1>Cache facade value cleared</h1>';
     $exitCode = Artisan::call('route:clear');
    echo '<h1>Route cache cleared</h1>';
    $exitCode = Artisan::call('view:clear');
    echo '<h1>View cache cleared</h1>';
    $exitCode = Artisan::call('config:cache');
    //return $sh = Artisan::call('schedule:run');
    
    return '<h1>Clear Config cleared</h1>';
});
