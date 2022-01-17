<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Admin\{
    AdminController,
    AlertsController,
    AlertsMessageController,
    AlertsMemberController
};
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
    return view('welcome');
});
    /**
     * Member confirmation
     */
    Route::get("/mailConfirmation/{email}/{token}",[AlertsMemberController::class,'status'])
    ->name("alert.member.status.confirm");

    
    /**
    * ADMIN ROUTES
    */
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/',[AdminController::class,'index'])->name('admin.home');
    Route::get('/alerts',[AlertsController::class,'index'])->name('alerts.home');
    Route::get('alerts/create',[AlertsController::class,'create'])->name('alerts.create');
    Route::post('alerts/create',[AlertsController::class,'store'])->name('alerts.store');
    Route::get('alerts/edit/{id}',[AlertsController::class,'edit'])->name('alerts.edit');
    Route::put('alerts/update/{id}',[AlertsController::class,'update'])->name('alerts.update');
    Route::delete('alerts/delete/{id}',[AlertsController::class,'delete'])->name('alerts.delete');
    Route::get('alerts/show/{id}',[AlertsController::class,'show'])->name('alerts.show');
    /**
     * Message
     */
    Route::get('alerts/message/info',[AlertsMessageController::class,'info'])
    ->name('alert.message.info');
    Route::post('alerts/message/cron/{id}',[AlertsMessageController::class,'cronstore'])
    ->name("alert.message.cronstore");
    Route::get('alerts/message/create/{id}',[AlertsMessageController::class,'create'])
    ->name('alert.message.create');
    Route::get('alerts/message/{id}',[AlertsMessageController::class,'index'])
    ->name('alert.message.index');
    Route::get('alerts/message/edit/{id}',[AlertsMessageController::class,'edit'])
    ->name('alert.message.edit');
    Route::post('alerts/message/create/{id}',[AlertsMessageController::class,'store'])
    ->name('alert.message.store');
    Route::delete('alerts/message/delete/{id}',[AlertsMessageController::class,'delete'])
    ->name('alert.message.delete');
    Route::put('alerts/message/update/{id}',[AlertsMessageController::class,'update'])
    ->name('alert.message.update');
    /**
     * Members
     */
    Route::get('alerts/member/{id}',[AlertsMemberController::class,'index'])
    ->name('alert.member.index');
    Route::get('alerts/member/create/{id}',[AlertsMemberController::class,'create'])
    ->name('alert.member.create');
    Route::post('alerts/member/create/{id}',[AlertsMemberController::class,'store'])
    ->name('alert.member.store');
    Route::get('alerts/member/edit/{id}',[AlertsMemberController::class,'edit'])
    ->name('alert.member.edit');
    Route::delete('alerts/member/delete/{id}',[AlertsMemberController::class,'delete'])
    ->name('alert.member.delete');
    Route::put('alerts/member/update/{id}',[AlertsMemberController::class,'update'])
    ->name('alert.member.update');
});


require __DIR__.'/auth.php';
