<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\users\HomeController;
use App\Http\Controllers\users\LeavementController;
use App\Http\Controllers\admin\LeavementController as AdminLeavementController;
use App\Http\Controllers\users\WorktimeController;
use App\Http\Controllers\admin\WorktimeController as AdminWorktimeController;
use App\Http\Controllers\admin\UserController;


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
Route::get('reload-captcha', [Ho::class, 'reloadCaptcha']);

Route::group(['namespace' => 'users' ,'middleware'=>'auth'],function () {

    Route::get('/',[HomeController::class,'redirectUser'])->name('index');

   // Route::resource('user.leavement',LeavementController::class);
    Route::get('/leavement',[LeavementController::class,'index'])->name('user.leavement.index');

    Route::get('/leavement/create',[LeavementController::class,'create'])->name('user.leavement.create');
    Route::post('/leavement/create',[LeavementController::class,'store']);

    Route::get('/leavement/edit/{leavement_id}',[LeavementController::class,'edit'])->name('user.leavement.edit');
    Route::post('/leavement/edit/{leavement_id}',[LeavementController::class,'update']);

    Route::get('/leavement/delete/{leavement_id}',[LeavementController::class,'delete'])->name('user.leavement.delete');

    //*********worktime**********

    //Route::resource('user.worktime',WorktimeController::class);
    Route::get('/worktime',[WorktimeController::class,'index'])->name('user.worktime.index');

    Route::get('/worktime/create',[WorktimeController::class,'create'])->name('user.worktime.create');
    Route::post('/worktime/create',[WorktimeController::class,'store']);

    Route::get('/worktime/edit/{worktime_id}',[WorktimeController::class,'edit'])->name('user.worktime.edit');
    Route::post('/worktime/edit/{worktime_id}',[WorktimeController::class,'update']);

    Route::get('/worktime/delete/{worktime_id}',[WorktimeController::class,'delete'])->name('user.worktime.delete');
});

Route::group(['prefix' => 'admin', 'namespace' => 'admin','middleware'=>'admin'], function () {
    Route::view('/', 'admin.index')->name('admin');
    Route::get('/users',[UserController::class,'index'])->name('admin.user');
    Route::get('/datausers',[UserController::class,'data'])->name('admin.user.data');

    Route::get('/user/create',[UserController::class,'create'])->name('admin.user.create');
    Route::post('/user/create',[UserController::class,'store'])->name('admin.user.store');

    Route::get('/user/edit/{user_id}',[UserController::class,'edit'])->name('admin.user.edit');
    Route::post('/user/edit/{user_id}',[UserController::class,'update'])->name('admin.user.update');
    Route::get('/user/delete/{user_id}',[UserController::class,'delete'])->name('admin.user.delete');

    Route::get('/leavement',[AdminLeavementController::class,'index'])->name('admin.leavement');

    Route::get('/leavement/agree/{leavement_id}',[AdminLeavementController::class,'agree'])->name('admin.leavement.agree');
    Route::get('/leavement/disagree/{leavement_id}',[AdminLeavementController::class,'disagree'])->name('admin.leavement.disagree');

    Route::get('/worktime',[AdminWorktimeController::class,'index'])->name('admin.worktime');

});

require __DIR__.'/auth.php';
