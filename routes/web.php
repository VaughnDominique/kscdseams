<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventAppointmentController;
use App\Http\Controllers\FitnessAppointmentController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\UserGuideController;

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
Route::get('/send-borrow-emails', [BorrowController::class, 'sendEmails'])->name('borrow.sendEmails');

Route::group(['middleware'=>['guest']], function(){
    Route::get('/', function () {
        return view('layouts.landing');
    });
    Route::get('/fitness/appointments/fetch/ee', [FitnessAppointmentController::class, 'getfitnessShowland'])->name('getfitnessShowland');
    Route::get('/check/client/events/appointments/', [EventAppointmentController::class, 'checkeventschedShow'])->name('checkeventschedShow');
    Route::get('/equip/avail', [CategoryController::class, 'getcatallRead'])->name('getcatallRead');

    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login/process', [LoginController::class, 'processLogin'])->name('processLogin');
});

Route::group(['middleware'=>['login_auth']], function(){
    Route::get('/dashboard', [DashboardController::class, 'dash'])->name('dash');
    Route::get('/logout', [DashboardController::class, 'logout'])->name('logout');

    Route::prefix('/list/inventory')->group(function () {
        Route::get('/category', [CategoryController::class, 'categoryRead'])->name('categoryRead');
        Route::post('/category/add', [CategoryController::class, 'categoryCreate'])->name('categoryCreate');
        Route::post('/category/update', [CategoryController::class, 'categoryUpdate'])->name('categoryUpdate');
        Route::post('/category/delete/{id}', [CategoryController::class, 'categoryDelete'])->name('categoryDelete');
        Route::get('/category/fetch/sports', [CategoryController::class, 'getcatSportsRead'])->name('getcatSportsRead');
        Route::get('/category/fetch/musical', [CategoryController::class, 'getcatMusicalRead'])->name('getcatMusicalRead');
        Route::get('/category/fetch/pe', [CategoryController::class, 'getcatPEequipRead'])->name('getcatPEequipRead');
        Route::get('/category/fetch/utility', [CategoryController::class, 'getcatUtilityRead'])->name('getcatUtilityRead');
    });

    Route::prefix('/list/sched')->group(function () {
        Route::get('/events/appointments', [EventAppointmentController::class, 'eventappointRead'])->name('eventappointRead');
        Route::post('/events/appointments/add', [EventAppointmentController::class, 'eventappointCreate'])->name('eventappointCreate');
        Route::post('/events/appointments/update', [EventAppointmentController::class, 'eventappointUpdate'])->name('eventappointUpdate');
        Route::post('/events/appointments/{id}', [EventAppointmentController::class, 'eventappointDelete'])->name('eventappointDelete');
        Route::get('/events/appointments/fetchtable', [EventAppointmentController::class, 'geteventschedRead'])->name('geteventschedRead');
        Route::get('/events/appointments/calendar', [EventAppointmentController::class, 'eventschedShow'])->name('eventschedShow');
        Route::get('/event/edit/{id}', [EventAppointmentController::class, 'editEvent'])->name('editEvent');
        Route::delete('/event/delete/{id}', [EventAppointmentController::class, 'deleteEvent'])->name('deleteEvent');
    });

    Route::prefix('/set/availability')->group(function () {
        Route::get('/fitness/appointments', [FitnessAppointmentController::class, 'fitnessappointRead'])->name('fitnessappointRead');
        Route::post('/fitness/appointments/add', [FitnessAppointmentController::class, 'fitnessappointCreate'])->name('fitnessappointCreate');
        Route::get('/fitness/appointments/fetch', [FitnessAppointmentController::class, 'getfitnessShow'])->name('getfitnessShow');
    }); 

    Route::prefix('/list/equipment')->group(function () {
        Route::get('/items/borrow', [BorrowController::class, 'borrowRead'])->name('borrowRead');
        Route::post('/items/borrow/add', [BorrowController::class, 'borrowCreate'])->name('borrowCreate');
        Route::get('/items/borrow/fetchlist', [BorrowController::class, 'getborrowRead'])->name('getborrowRead');
        Route::get('/items/fetch/{type}', [BorrowController::class, 'getEquipmentByType'])->name('getEquipmentByType');
        Route::post('/items/select/returned', [BorrowController::class, 'returnitemBorrow'])->name('returnitemBorrow');
        Route::get('/items/borrow/check-overdue', [BorrowController::class, 'checkOverdueItems'])->name('checkOverdueItems');
    });  

    Route::prefix('/list/logbook/borrow')->group(function () {
        Route::get('/items/perdate', [ReportsController::class, 'logselectdateRead'])->name('logselectdateRead');
        Route::get('/items/perdate/search/result', [ReportsController::class, 'logselectdateShow'])->name('logselectdateShow');
        Route::get('/items/perdate/search/result/PDF/fetch', [ReportsController::class, 'logbookPDF'])->name('logbookPDF');
    });  

    Route::prefix('/page')->group(function () {
        Route::get('/user-guide', [UserGuideController::class, 'index'])->name('userGuide');
    });  
});

