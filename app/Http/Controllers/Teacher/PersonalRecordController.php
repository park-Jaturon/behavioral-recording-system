<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PersonalRecordController extends Controller
{
    public function weight_height()
    {
        $user = DB::table('teachers')
            ->join('users', function ($join) {
                $join->on('teachers.teachers_id', '=', 'users.rank_id')
                    ->where('users.rank', '=', 'teacher');
            })
            ->join('rooms', 'teachers.rooms_id', '=', 'rooms.rooms_id')
            ->join('students', 'rooms.rooms_id', '=', 'students.rooms_id')
            ->where('users.rank_id', '=', Auth::user()->rank_id)
            // ->select('users.*', 'contacts.phone', 'orders.price')
            ->get();
        // dd($user);
        return view('personal-record.weight-height', compact('user'));
    }

    public function weight_height_show($student_id)
    {
        return view('personal-record.weight-height-show');
    }

    public function weight_height_add($student_id)
    {
        return view('personal-record.weight-height-add');
    }

    public function appraisal()
    {
        $user = DB::table('teachers')
            ->join('users', function ($join) {
                $join->on('teachers.teachers_id', '=', 'users.rank_id')
                    ->where('users.rank', '=', 'teacher');
            })
            ->join('rooms', 'teachers.rooms_id', '=', 'rooms.rooms_id')
            ->join('students', 'rooms.rooms_id', '=', 'students.rooms_id')
            ->where('users.rank_id', '=', Auth::user()->rank_id)
            ->select('students.student_id', 'students.number', 'students.prefix_name', 'students.first_name', 'students.last_name', 'rooms.room_name')
            ->get();
        //  dd($user);
        return view('personal-record.development-appraisal', compact('user'));
    }
    
    public function appraisal_show($student_id)
    {
        return view('personal-record.appraisal-show');
    }

    public function appraisal_add($student_id)
    {
        return view('personal-record.appraisal-add');
    }
}
