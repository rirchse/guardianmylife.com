<?php


use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\CallController;
use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\LeadsController;
use App\Http\Controllers\RemainderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WorkingDayHourController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\GoogleCalendarController;

Route::controller(ScheduleController::class)->group(function()
{  
  Route::get('email', 'email');

  // auto schedule
  Route::get('schedule_birthday', 'birthday');
  Route::get('schedule_marriage_day', 'marriageDay');
  Route::get('schedule_holiday', 'holiday');
  Route::get('schedule_reminder', 'reminder');
  Route::get('schedule_newsletter', 'newsletter');
  
});

Route::get('/', function ()
{
  return view('layouts.homepage');
});

Route::controller( HomeController::class )->group( function()
{
  Route::get('/mainhome', 'index')->name('main.home');
});

Route::controller(RegisterController::class)->group(function()
{
  Route::get('/signup/{code}', 'referrer');
  Route::get('/signup', 'signup')->name('signup');
  Route::post('/signup', 'signupStore')->name('signup.store');
  Route::get('/email_verify/{token}', 'emailVerify');
});

/** Cronjob Action */
Route::get('/cronjob', function(){
  Artisan::call('schedule:run');
});

Route::view('/user/verification','users.verification')->name('user.verification');
Route::post('/user/verifyemail',[UserController::class,'verifyemail'])->name('user.verifyemail');
Route::get('/user/forgotunauthpassword',[UserController::class,'forgorauthpassword'])->name('forgorauth');
Route::post('/users/authresetPassword',[UserController::class,'authresetPassword'])->name('user.authresetPassword');


/**------------------------------------------------
 * Authentication Routes:
 --------------------------------------------------
 *
 */

Auth::routes();

Route::middleware(['auth'])->group(function ()
{
  Route::get('/home', [HomeController::class, 'index'])->name('home');
  Route::resource('budget', ExpenseController::class);

  // // manually logout by ajax call
  // Route::post('/ajaxLogout', function()
  // {
  //   Auth::logout();
  //   return response()->json('/login');
  // })->name('ajaxLogout');

  // Route::get('budget',[ExpenseController::class,'index'])->name('budget.index');
  // Route::get('budget/create', [ExpenseController::class,'create'])->name('budget.create');
  // Route::post('budget', [ExpenseController::class,'store'])->name('budget.store');

  /** lead routes */
  Route::resource('lead', LeadsController::class);
  Route::controller( LeadsController::class )->group( function ()
  {
    Route::get('/lead_delete/{id}', 'deleteSingle')->name('lead.delete');
    // Route::get('leads', 'index')->name('leads.index');
    Route::get('lead_upload', 'leadUpload')->name('lead.upload');
    Route::post('/lead_store', 'uploadStore')->name('lead.upload.store');
    // Route::get('leads/delete/{id}','delete')->name('leads.delete');
    Route::get('leads/view/{id}','view')->name('leads.view');
    Route::post('leads/getLeadRecord','getLeadRecord')->name('leads.getLeadRecord');
    Route::get('employee/leadsassign','employeeleadsassign')->name('employeeleads.assign.index');
    Route::post('/assignemployeeleads/store', 'storeemployeeleadsassign')->name('assignemployeeleads.store');
  });


  Route::get('remainders',[RemainderController::class,'index'])->name('remainder.index');

  /** customers routes */
  Route::resource('customer', CustomerController::class);
  Route::controller(CustomerController::class)->group(function()
  {
    // Route::get('customers','index')->name('customers.index');
    // Route::get('customer/view/{id}','view')->name('customer.view');
    Route::get('finalcustomer/edit/{id}', 'finaledit')->name('finalcustomer.edit');
    // Route::put('customer/update/{id}', 'update')->name('customer.update');
    Route::post('finalcustomer/update/{id}', 'finalupdate')->name('finalcustomer.update');  
    
    Route::get('your-customers', 'finalcustomer')->name('finalcustomers.index');

    Route::get('calls', 'index')->name('calls.index');
  });

  /** route create by Rafiqu Islam */
  Route::resource('call', CallController::class);
  Route::post('/calls/store', [CallController::class,'store'])->name('calls.store');

  Route::controller(AppointmentController::class)->group(function()
  {
    Route::get('appointments', 'index')->name('appointments.index');
    Route::get('appointment/view/{id}', 'view')->name('appointment.view');
    Route::post('applicatant/store/{id}', 'applicanttocustomer')->name('applicant.tocustomer');
    Route::post('reappointment/{id}', 'reappointcustomer')->name('reappoint.customer');
    Route::get('applicant', 'applicantindex')->name('applicant.index');
    Route::post('applicant/store', 'applicantstore')->name('applicant.store');
    Route::get('applicant/view/{id}', 'applicantview')->name('applicant.view');
  });

  /** Route created by Rafiqul Islam */
  // Route::resource('user',  UserController::class);
  Route::controller( UserController::class )->group(function() 
  {
    Route::get('reports', 'dailysumhours')->name('reports.dailysumhours');
    Route::get('admin/hourlyreports', 'admindailysumhours')->name('reports.admindailysumhours');
    Route::get('loginlogs', 'logs')->name('logs.index');
    Route::get('users','index')->name('users.index');
    Route::get('users/edit/{id}', 'useredit')->name('user.edit');
    Route::post('users/update/{id}', 'userupdate')->name('user.update');
    Route::get('user/forgetpassword', 'forgetpassword')->name('user.forgetpassword');
    Route::post('users/resetpassword', 'resetPassword')->name('user.resetPassword');
    Route::post('users/store', 'store')->name('user.store');
    Route::get('/user/{id}', 'delete')->name('user.delete');
  });

  // Route::get('reports',[UserController::class,'dailysumhours'])->name('reports.dailysumhours');
  Route::view('admin/reports','reports.admin-reports')->name('admin.reports');

  Route::post('workingHours',[WorkingDayHourController::class,'store'])->name('workingHours');

  Route::resource('schedule', ScheduleController::class);
});


// cache clear
Route::get('reboot', function () {
  Artisan::call('cache:clear');
  Artisan::call('view:clear');
  Artisan::call('route:clear');
  Artisan::call('config:cache');
  Artisan::call('view:cache');
  dd('Done');
});

/** google api for calendar */
Route::controller(GoogleCalendarController::class)->group(function()
{
  Route::get('/google-calendar/create/{array}', 'create');
  
  Route::post('/google-calendar/connect', 'store');
  Route::get('/get-resource', 'getResources');
  
  Route::get('/google-calendar', 'index');
  Route::get('/google-calendar/{id}', 'getEvent');
  Route::get('/google-calendar_last_event/{datetime}', 'getLastEvent');
});

// Route::get('/auth/google', [GoogleCalendarController::class, 'redirectToGoogle']);
// Route::get('/auth/google/callback', [GoogleCalendarController::class, 'handleGoogleCallback']);