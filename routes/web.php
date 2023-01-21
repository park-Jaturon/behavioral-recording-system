<?php

use App\Http\Controllers\Admin\AdminControllre;
use App\Http\Controllers\Admin\ManagesparentsController;
use App\Http\Controllers\Admin\ManagestudentController;
use App\Http\Controllers\Admin\ManageteacherController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Models\Room;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware('isadmin')->group(function(){
Route::get('dashboard',[AdminControllre::class, 'index'])->name('admindashboard');
Route::get('room',[RoomController::class, 'roomindex'])->name('room.index');
Route::get('room/add',[RoomController::class,'addroom'])->name('add.room');
Route::post('add-room',[RoomController::class, 'storeroom'])->name('store.room');
Route::get('manage/teacher',[ManageteacherController::class, 'manageteacherindex'])->name('index.manageteacher');
Route::get('teacher/add',[ManageteacherController::class, 'addteachers'])->name('add.teacher');
Route::post('add-teacher',[ManageteacherController::class, 'storeteacher'])->name('store.teacher');
Route::get('manage/parents',[ManagesparentsController::class,'manageparentsindex'])->name('index.manageparents');
Route::get('manage/student',[ManagestudentController::class, 'managestudentindex'])->name('index.managestudent');
});

Route::prefix('teacher')->middleware('isteacher')->group(function()
{
    Route::get('home',[TeacherController::class,'home'])->name('teacherhome');
});