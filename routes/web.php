<?php

use App\Http\Controllers\Admin\AdminControllre;
use App\Http\Controllers\Admin\ManagesparentsController;
use App\Http\Controllers\Admin\ManagestudentController;
use App\Http\Controllers\Admin\ManageteacherController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\Teacher\ActivityController;
use App\Http\Controllers\Teacher\CheckController;
use App\Http\Controllers\Teacher\EventsController;
use App\Http\Controllers\Teacher\PostController;
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

// Route::get('/', function () {
//     return view('home');
// });

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('admin')->middleware('isadmin')->group(function () {
    Route::get('dashboard', [AdminControllre::class, 'index'])->name('admindashboard');
    /* Room */
    Route::get('room', [RoomController::class, 'roomindex'])->name('room.index');
    Route::get('room/add', [RoomController::class, 'addroom'])->name('add.room');
    Route::post('add-room', [RoomController::class, 'storeroom'])->name('store.room');
    Route::get('room/edit/{rooms_id}', [RoomController::class, 'edit']);
    Route::put('room/update/{rooms_id}', [RoomController::class, 'update']);
    Route::delete('room/delete/{rooms_id}', [RoomController::class, 'delete']);
    /* Teachers */
    Route::get('manage/teacher', [ManageteacherController::class, 'manageteacherindex'])->name('index.manageteacher');
    Route::get('teacher/add', [ManageteacherController::class, 'addteachers'])->name('add.teacher');
    Route::post('add-teacher', [ManageteacherController::class, 'storeteacher'])->name('store.teacher');
    Route::get('teacher/edit/{teachers_id}', [ManageteacherController::class, 'edit']);
    Route::put('teacher/update/{teachers_id}', [ManageteacherController::class, 'update']);
    Route::delete('teacher/delete/{teachers_id}', [ManageteacherController::class, 'delete']);
    /* Parents */
    Route::get('manage/parents', [ManagesparentsController::class, 'manageparentsindex'])->name('index.manageparents');
    Route::get('parents/add', [ManagesparentsController::class, 'addparents'])->name('add.parents');
    Route::post('add-parents', [ManagesparentsController::class, 'storeparents'])->name('store.parents');
    Route::get('parent/edit/{parents_id}', [ManagesparentsController::class, 'editparent'])->name('edut.parent');
    Route::put('parent/update/{parents_id}', [ManagesparentsController::class, 'update'])->name('update.parent');
    Route::delete('parent/delete/{parents_id}', [ManagesparentsController::class, 'destroy']);
    /* Students */
    Route::get('manage/student', [ManagestudentController::class, 'managestudentindex'])->name('index.managestudent');
    Route::get('student/add', [ManagestudentController::class, 'addstudent'])->name('add.student');
    Route::post('store-student', [ManagestudentController::class, 'storestudent'])->name('store.student');
    Route::get('student/edit/{student_id}', [ManagestudentController::class, 'esitstudent']);
    Route::put('student/update/{student_id}', [ManagestudentController::class, 'update'])->name('update.student');
    Route::delete('student/delete/{student_id}', [ManagestudentController::class, 'destroy'])->name('destroy.student');
    /* User */
    Route::get('users', [UserController::class, 'index'])->name('index.user');
});

Route::prefix('teacher')->middleware('isteacher')->group(function () {
    Route::get('home', [TeacherController::class, 'home'])->name('teacherhome');
    /* Check */
    Route::get('check',[CheckController::class, 'index'])->name('index.check');
    Route::get('post-time/{student_id}',[CheckController::class, 'post_time']);
    Route::post('store/check/{student_id}',[CheckController::class, 'checktime'])->name('store.check');
    /* Post */
    Route::get('post/index',[PostController::class, 'index'])->name('index.post');
    Route::get('post/add',[PostController::class, 'add_post'])->name('add.post');
    Route::post('post/store',[PostController::class, 'store'])->name('store.post');
    Route::get('post/edit/{posts_id}',[PostController::class, 'edit']);
    Route::put('post/update/{posts_id}',[PostController::class, 'update']);
    Route::delete('post/delete/{posts_id}',[PostController::class, 'delete']);
    /* Event */ 
    Route::get('event/inddex',[EventsController::class, 'index'] )->name('index.event');
    Route::post('event/add',[EventsController::class, 'store'])->name('calendar.store');
    Route::patch('event/update/{id}', [EventsController::class, 'update'])->name('calendar.update');
    Route::delete('event/delete/{id}', [EventsController::class, 'destroy'])->name('calendar.destroy');
    /* Activity */ 
    Route::get('activity/index',[ActivityController::class, 'index'])->name('index.activity');
    Route::get('activity/{events_id}',[ActivityController::class, 'image'])->name('image.activity');
    Route::get('activity/show/{events_id}',[ActivityController::class, 'show'])->name('show.activity');
    Route::post('activity/store',[ActivityController::class, 'store'])->name('store.activity');
});
