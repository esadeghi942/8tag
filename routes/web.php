<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\users\HomeController;
use App\Http\Controllers\users\LeavementController;
use App\Http\Controllers\admin\LeavementController as AdminLeavementController;
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

Route::group(['namespace' => 'users' ,'middleware'=>'auth'],function () {

    Route::get('/',[HomeController::class,'redirectUser'])->name('index');

    Route::get('/leavement',[LeavementController::class,'index'])->name('user.leavement');

    Route::get('/leavement/create',[LeavementController::class,'create'])->name('user.leavement.create');
    Route::post('/leavement/create',[LeavementController::class,'store']);

    Route::get('/leavement/edit/{leavement_id}',[LeavementController::class,'edit'])->name('user.leavement.edit');
    Route::get('/leavement/delete/{leavement_id}',[LeavementController::class,'delete'])->name('user.leavement.delete');

    Route::post('/leavement/edit/{leavement_id}',[LeavementController::class,'update']);
});

Route::group(['prefix' => 'admin', 'namespace' => 'admin','middleware'=>'admin'], function () {
    Route::view('/', 'admin.index')->name('admin');
    Route::get('/users',[UserController::class,'index'])->name('admin.user');

    Route::get('/user/create',[UserController::class,'create'])->name('admin.user.create');
    Route::post('/user/create',[UserController::class,'store'])->name('admin.user.store');

    Route::get('/user/edi/{user_id}',[UserController::class,'edit'])->name('admin.user.edit');
    Route::post('/user/edit/{user_id}',[UserController::class,'update'])->name('admin.user.update');
    Route::get('/user/delete/{user_id}',[UserController::class,'delete'])->name('admin.user.delete');

    Route::get('/leavement',[AdminLeavementController::class,'index'])->name('admin.leavement');

    Route::get('/leavement/agree/{leavement_id}',[AdminLeavementController::class,'action'])->name('admin.leavement.agree');
    Route::get('/leavement/disagree/{leavement_id}',[AdminLeavementController::class,'action'])->name('admin.leavement.disagree');


});

require __DIR__.'/auth.php';
