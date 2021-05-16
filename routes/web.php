<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\users\HomeController;
use App\Http\Controllers\users\LeavementController;
use App\Http\Controllers\admin\LeavementController as AdminLeavementController;
use App\Http\Controllers\users\WorktimeController;
use App\Http\Controllers\admin\WorktimeController as AdminWorktimeController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\admin\RoleController;


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
Route::get('reload-captcha', [HomeController::class, 'reloadCaptcha']);

Route::group([/*'namespace' => 'users' ,*/'middleware'=>'auth'],function () {

    Route::get('/',[HomeController::class,'redirectUser'])->name('index');

    Route::get('/leavementdata',[LeavementController::class,'data'])->name('user.leavement.data');
    Route::get('/leavement',[LeavementController::class,'index'])->name('user.leavement.index');

    Route::get('/leavement/create',[LeavementController::class,'create'])->name('user.leavement.create');
    Route::post('/leavement/create',[LeavementController::class,'store']);

    Route::get('/leavement/edit/{leavement_id}',[LeavementController::class,'edit'])->name('user.leavement.edit');
    Route::post('/leavement/edit/{leavement_id}',[LeavementController::class,'update']);

    Route::get('/leavement/delete/{leavement_id}',[LeavementController::class,'destroy'])->name('user.leavement.delete');

    //*********worktime**********

    Route::get('/worktimedata',[WorktimeController::class,'data'])->name('user.worktime.data');
    Route::get('/worktime',[WorktimeController::class,'index'])->name('user.worktime.index');

    Route::get('/worktime/create',[WorktimeController::class,'create'])->name('user.worktime.create');
    Route::post('/worktime/create',[WorktimeController::class,'store']);

    Route::get('/worktime/edit/{worktime_id}',[WorktimeController::class,'edit'])->name('user.worktime.edit');
    Route::post('/worktime/edit/{worktime_id}',[WorktimeController::class,'update']);

    Route::get('/worktime/delete/{worktime_id}',[WorktimeController::class,'destroy'])->name('user.worktime.delete');
});

Route::group(['prefix' => 'admin','middleware'=>'admin'], function () {
    Route::view('/', 'admin.index')->name('admin');
    Route::get('/roledata',[RoleController::class,'data'])->name('admin.role.data');
    Route::get('/role',[RoleController::class,'index'])->name('admin.role.index');
    Route::get('/role/create',[RoleController::class,'create'])->name('admin.role.create');
    Route::post('/role/create',[RoleController::class,'store']);
    Route::get('/role/edit/{role_id}',[RoleController::class,'edit'])->name('admin.role.edit');
    Route::post('/role/edit/{role_id}',[RoleController::class,'update']);
    Route::get('/role/destroy/{role_id}',[RoleController::class,'destroy'])->name('admin.role.destroy');
    /***********************************************************************************/
    Route::get('/user',[UserController::class,'index'])->name('admin.user.index');
    Route::get('/userdata',[UserController::class,'data'])->name('admin.user.data');
    Route::get('/datausers',[UserController::class,'data'])->name('admin.user.data');
    Route::get('/user/create',[UserController::class,'create'])->name('admin.user.create');
    Route::post('/user/create',[UserController::class,'store']);
    Route::get('/user/edit/{user_id}',[UserController::class,'edit'])->name('admin.user.edit');
    Route::post('/user/edit/{user_id}',[UserController::class,'update']);
    Route::get('/user/delete/{user_id}',[UserController::class,'destroy'])->name('admin.user.destroy');
   /**************************************************************************************************/
    Route::get('/leavement',[AdminLeavementController::class,'index'])->name('admin.leavement.index');
    Route::get('/dataleavement',[AdminLeavementController::class,'data'])->name('admin.leavement.data');

    Route::get('/leavement/agree/{leavement_id}',[AdminLeavementController::class,'agree'])->name('admin.leavement.agree');
    Route::get('/leavement/disagree/{leavement_id}',[AdminLeavementController::class,'disagree'])->name('admin.leavement.disagree');

    Route::get('/user/{user_id}/worktime',[AdminWorktimeController::class,'index'])->name('admin.worktime.index');
    Route::get('/user/{user_id}/dataworktime',[AdminWorktimeController::class,'data'])->name('admin.user.worktime');


});

require __DIR__.'/auth.php';
