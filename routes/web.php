<?php

use App\Http\Controllers\Admin\AdminControllre;
use App\Http\Controllers\Admin\ManagesparentsController;
use App\Http\Controllers\Admin\ManagestudentController;
use App\Http\Controllers\Admin\ManageteacherController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Parent\HomeController;
use App\Http\Controllers\Teacher\ActivityController;
use App\Http\Controllers\Teacher\BehaviorController;
use App\Http\Controllers\Teacher\CheckController;
use App\Http\Controllers\Teacher\EventsController;
use App\Http\Controllers\Teacher\PersonalRecordController;
use App\Http\Controllers\Teacher\PostController;
use App\Http\Controllers\Teacher\TeacherController;
use App\Http\Controllers\Teacher\AppraisalController;
use App\Models\Room;
use App\Models\TeachersComment;
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
Route::get('/profile/{id}', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');
Route::post('/profile/update/{id}', [App\Http\Controllers\HomeController::class, 'update'])->name('UpdateProfile');
Route::post('/api/parentedit', [ManagesparentsController::class, 'parent_edit']);
Route::prefix('admin')->middleware('isadmin')->group(function () {
    Route::get('dashboard', [AdminControllre::class, 'index'])->name('admindashboard');
    Route::get('setTime', [AdminControllre::class, 'time_static'])->name('admin.setTime');
    Route::post('update/setTime', [AdminControllre::class, 'update_time_static'])->name('admin.updateSetTime');
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
    Route::post('teacher/inspect/delete', [ManageteacherController::class, 'inspect']);
    /* Parents */
    Route::get('manage/parents', [ManagesparentsController::class, 'manageparentsindex'])->name('index.manageparents');
    Route::get('parents/add', [ManagesparentsController::class, 'addparents'])->name('add.parents');
    Route::post('add-parents', [ManagesparentsController::class, 'storeparents'])->name('store.parents');
    Route::get('parent/edit/{parents_id}', [ManagesparentsController::class, 'editparent'])->name('edut.parent');
    Route::put('parent/update/{parents_id}', [ManagesparentsController::class, 'update'])->name('update.parent');
    // Route::post('update/parent/',[ManagesparentsController::class, 'parents_update'])->name('update.parent.relationship');
    Route::delete('parent/delete/{parents_id}', [ManagesparentsController::class, 'destroy']);

    /* Students */
    Route::get('manage/student', [ManagestudentController::class, 'managestudentindex'])->name('index.managestudent');
    Route::get('student/add', [ManagestudentController::class, 'addstudent'])->name('add.student');
    Route::post('store-student', [ManagestudentController::class, 'storestudent'])->name('store.student');
    Route::get('student/edit/{student_id}', [ManagestudentController::class, 'esitstudent'])->name('edit.student');
    Route::put('student/update/{student_id}', [ManagestudentController::class, 'update'])->name('update.student');
    Route::delete('student/delete/{student_id}', [ManagestudentController::class, 'destroy'])->name('destroy.student');
    /* User */
    Route::get('users', [UserController::class, 'index'])->name('index.user');
    Route::get('users/edit/{id}', [UserController::class, 'edit_user']);
    Route::post('users/update/{id}', [UserController::class, 'update']);
    Route::delete('users/delete/{id}', [UserController::class, 'delete']);
    /* Admin */
    Route::get('users/admin', [UserController::class, 'admin'])->name('index.admin');
    Route::get('users/admin/add', [UserController::class, 'register_admin'])->name('registeradmin');
    Route::post('users/admin/store', [UserController::class, 'store_admin']);
    // Route::get('users/edit/{$users_id}', [UserController::class,'edit_admin'])->name('admin.edit');
    Route::post('inspect/delete', [UserController::class, 'inspectAdmin']);
    Route::delete('users/admin/delete/{id}', [UserController::class, 'destroy_admin']);
});

Route::prefix('teacher')->middleware('isteacher')->group(function () {
    Route::get('dashboard', [TeacherController::class, 'home'])->name('teacher.dashboard');
    /* Room */
    Route::get('room', [TeacherController::class, 'room'])->name('teacher.room');
    Route::get('room/show/{id}', [TeacherController::class, 'room_show'])->name('room.show');
    Route::get('room/edit/{id}', [TeacherController::class, 'room_edit'])->name('room.edit');
    Route::post('room/update/{id}', [TeacherController::class, 'room_update'])->name('room.update');
    Route::post('students/upClass', [TeacherController::class, 'upClass'])->name('up.class');
    /* Check */
    Route::get('check', [CheckController::class, 'index'])->name('index.check');
    Route::get('post-time/{student_id}', [CheckController::class, 'post_time']);
    Route::post('store/check/{student_id}', [CheckController::class, 'checktime'])->name('store.check');
    /* Post */
    Route::get('post/index', [PostController::class, 'index'])->name('index.post');
    Route::get('post/add', [PostController::class, 'add_post'])->name('add.post');
    Route::post('post/ckeditor/upload', [PostController::class, 'uploadimage'])->name('ckedditor.upload');
    Route::post('post/store/{rooms_id}', [PostController::class, 'store'])->name('store.post');
    Route::get('post/edit/{posts_id}', [PostController::class, 'edit']);
    Route::put('post/update/{posts_id}', [PostController::class, 'update']);
    Route::delete('post/delete/{posts_id}', [PostController::class, 'delete']);
    /* Event */
    Route::get('event/inddex', [EventsController::class, 'index'])->name('index.event');
    Route::post('event/add', [EventsController::class, 'store'])->name('calendar.store');
    Route::patch('event/update/{id}', [EventsController::class, 'update'])->name('calendar.update');
    Route::post('event/inspect/delete', [EventsController::class, 'inspect']);
    Route::delete('event/delete/{id}', [EventsController::class, 'destroy'])->name('calendar.destroy');
    /* Activity */
    Route::get('activity/edit/{events_id}', [ActivityController::class, 'edit'])->name('edit.activity');
    Route::post('activity/update/{events_id}', [ActivityController::class, 'update_activity'])->name('update.activity');
    Route::delete('activity/delete/{id}', [ActivityController::class, 'destroy']);
    Route::get('activity/{events_id}', [ActivityController::class, 'image'])->name('image.activity');
    Route::get('activity/add/{events_id}', [ActivityController::class, 'add'])->name('add.activity');
    Route::post('activity/store/{events_id}', [ActivityController::class, 'store_activity'])->name('store.activity');
    /* Behavior */
    Route::get('behavior', [BehaviorController::class, 'index'])->name('index.behavior');
    Route::get('behavior/add', [BehaviorController::class, 'add'])->name('add.behavior');
    Route::post('behavior/store', [BehaviorController::class, 'store'])->name('store.behavior');
    Route::post('behavior/ckeditor/upload', [BehaviorController::class, 'uploadimage'])->name('behavior.upload');
    Route::get('behavior/report/{student_id}', [BehaviorController::class, 'report'])->name('report.behavior');
    Route::delete('behavior/delete/{behavior_id}', [BehaviorController::class, 'delete']);
    /* personal record */

    //  Route::get('record/weight-height',[PersonalRecordController::class, 'weight_height'])->name('record.weight-height');
    //  Route::get('record/weight-height/show/{student_id}',[PersonalRecordController::class, 'weight_height_show']);
    //  Route::get('record/weight-height/add/{student_id}',[PersonalRecordController::class, 'weight_height_add']);

    Route::get('record/appraisal', [PersonalRecordController::class, 'appraisal'])->name('record.appraisal');
    Route::get('record/appraisal/show/{student_id}', [PersonalRecordController::class, 'appraisal_show'])->name('appraisal.show2');
    Route::get('record/appraisal/show2/{student_id}', [PersonalRecordController::class, 'appraisal_show2'])->name('appraisal.show3');
    Route::post('record/appraisal/store/{student_id}', [PersonalRecordController::class, 'appraisal_store'])->name('store.appraisal');
    Route::get('commen/edit/{id}', [PersonalRecordController::class, 'commenTeacher']);
    Route::post('commen/update/{id}', [PersonalRecordController::class, 'updatecommenTeacher']);
    Route::get('pdf/{student_id}', [PersonalRecordController::class, 'viewPDF'])->name('show.pdf');
    Route::get('pdf2/{student_id}', [PersonalRecordController::class, 'viewPDF2'])->name('show.pdf2');
    Route::get('pdf/download/{student_id}', [PersonalRecordController::class, 'exportPDF'])->name('download.pdf');
    Route::get('pdf2/download/{student_id}', [PersonalRecordController::class, 'exportPDF2'])->name('download.pdf2');
    Route::get('record/appraisal/add/{student_id}', [PersonalRecordController::class, 'appraisal_add']);
    Route::get('record/appraisal/add2/{student_id}', [PersonalRecordController::class, 'appraisal_add2']);
    //  Route::post('record/appraisal/page1/put/{student_id}', [PersonalRecordController::class, 'page1_put']);
    //  Route::get('record/appraisal/add-page2/{student_id}',[AppraisalController::class, 'page2_add'])->name('add.page2');
});

Route::prefix('parent')->middleware('isparent')->group(function () {
    /* parent home */
    Route::get('home', [HomeController::class, 'index'])->name('home.parent');
    Route::get('descendant', [HomeController::class, 'descendant_show'])->name('show.descendant');
    Route::get('descendant/time', [HomeController::class, 'descendant_time'])->name('time.descendant');
    Route::get('descendant/time/show/{student_id}', [HomeController::class, 'time_show']);
    Route::get('post', [HomeController::class, 'descendant_post'])->name('post.descendant');
    Route::get('descendant/post/show/{rooms_id}', [HomeController::class, 'post_show']);
    Route::get('events', [HomeController::class, 'descendant_events'])->name('events.descendant');
    Route::get('descendant/events/show/{rooms_id}', [HomeController::class, 'events_show']);
    Route::get('behaviors', [HomeController::class, 'descendant_behaviors'])->name('descendant.behaviors');
    Route::get('descendant/behavior/show/{student_id}', [HomeController::class, 'behavior_show'])->name('show.behavior'); //
    Route::get('activity', [HomeController::class, 'descendant_activity'])->name('activity.descendant');
    Route::get('descendant/activity/image/show/{events_id}/{school_year}', [HomeController::class, 'activity_showimage']);
    Route::get('descendant/activity/show/{rooms_id}/{school_year}/{level}', [HomeController::class, 'activity_show'])->name('show_activity');
    Route::post('selectLevel', [HomeController::class, 'select_yevel']);
});