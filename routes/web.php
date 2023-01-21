<?php

use App\Models\RoleUser;
use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

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


Route::get('/', function () {
    return view('auth.login');
});


Auth::routes(['verify'=>true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');



Route::resource('user',App\Http\Controllers\UserController::class);
Route::resource('narration',App\Http\Controllers\NarrationController::class);
Route::resource('currency',App\Http\Controllers\CurrencyController::class);
Route::resource('region',\App\Http\Controllers\RegionController::class);
Route::resource('role',App\Http\Controllers\RoleController::class);
Route::resource('status',App\Http\Controllers\StatusController::class);
Route::resource('roleUser',App\Http\Controllers\RoleUserController::class);
Route::resource('deptUser',App\Http\Controllers\DepartmentUserController::class);
Route::resource('deposit',App\Http\Controllers\DepositController::class)->middleware('auth');

Route::resource('comment',App\Http\Controllers\CommentController::class);
Route::get('getComments/{ticket}',[\App\Http\Controllers\CommentController::class,'getComments']);

Route::resource('useractivity',App\Http\Controllers\UserActivityLogController::class);
Route::resource('newsletter',\App\Http\Controllers\NewsletterController::class);
Route::resource('sla',\App\Http\Controllers\ServiceLevelAgreementController::class);

Route::get('/addDeptForm/{id}',[App\Http\Controllers\DepartmentUserController::class, 'addDeptForm'])->name('add.user.dept');
Route::get('/addRoleForm/{id}',[App\Http\Controllers\RoleUserController::class, 'addRoleForm'])->name('add.user.role');
Route::get('/unassignRole/{user}/{id}',[App\Http\Controllers\RoleUserController::class, 'unassign'])->name('remove.user.role');
Route::get('/unassignDept/{user}/{id}',[App\Http\Controllers\DepartmentUserController::class, 'unassign'])->name('remove.user.dept');
Route::get('/userlog/{user}/',[App\Http\Controllers\UserActivityLogController::class, 'individualLogs'])->name('view.user.activity');

Route::get('/user/auth/{id}',[\App\Http\Controllers\UserController::class,'authoriseUser'])->name('user.authorised');
Route::get('/user/unauth/{id}',[\App\Http\Controllers\UserController::class,'unAuthoriseUser'])->name('user.unauthorise');

Route::get('/closeTicket/{id}',[App\Http\Controllers\DepositController::class, 'closeTicket'])->name('close.ticket');
Route::get('/reOpenTicket/{id}',[App\Http\Controllers\DepositController::class, 'reOpenTicket'])->name('reOpen.ticket');

Route::get('/assignTicketForm/{ticket}',[App\Http\Controllers\DepositController::class, 'assignTicketForm'])->name('ticket.assign');
Route::post('/assignTicket',[App\Http\Controllers\DepositController::class, 'assignTicket'])->name('ticket.agent.assign');
//Reporting
Route::get('/report/daily',[\App\Http\Controllers\ReportController::class,'daily'])->name('report.daily');
Route::get('/report/monthly',[\App\Http\Controllers\ReportController::class,'monthly'])->name('report.monthly');
Route::get('/report/weekly',[\App\Http\Controllers\ReportController::class,'weekly'])->name('report.weekly');
Route::get('/report/range',[\App\Http\Controllers\ReportController::class,'range'])->name('report.range');
Route::post('/report/range',[\App\Http\Controllers\ReportController::class,'rangeReport'])->name('report.range.display');

//Attachments

Route::get('/ticketFileDownload/{ticket}',[\App\Http\Controllers\TicketFileController::class,'download'])->name('download');
Route::get('/newsletterFileDownload/{ticket}',[\App\Http\Controllers\NewsletterFileController::class,'download'])->name('news.download');

//User Profile

Route::get('/userProfile', [\App\Http\Controllers\UserController::class,'profile'])->name('user.profile')->middleware('auth');
Route::post('/changePassword', [\App\Http\Controllers\UserController::class,'changePassword'])->name('user.password');

//Reports

Route::get('/viewReport',[\App\Http\Controllers\ReportController::class,'dailyReport'])->name('report.agents');

Route::get('/getUsers',[\App\Http\Controllers\UserController::class,'getAllUsers']);


