<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;

class HomeController extends Controller
{
    public function index()
    {
        return view('parent.parent-home');
    }

    public function  descendant_show()
    {
        $students = DB::table('students')
            ->where('parents_id', '=', Auth::user()->rank_id)
            ->join('rooms','students.rooms_id','=','rooms.rooms_id')
            ->get();
            // dd( $students);
        return view('parent.pedigree',compact('students'));
    }

    public function descendant_time()
    {
        $students = DB::table('students')
        ->where('parents_id', '=', Auth::user()->rank_id)
        ->join('rooms','students.rooms_id','=','rooms.rooms_id')
        ->get();
        return view('parent.parent-time',compact('students'));
    }

    public function time_show($student_id)
    {
        $check_student = DB::table('students')
        ->join('timecards','students.student_id','=','timecards.student_id')
        ->where('timecards.student_id', '=',$student_id)
        ->get();
        // dd( $check_student);
        return view('parent.show-time-descendant',compact('check_student'));
    }

    public function descendant_post ()
    {
        $students = DB::table('students')
        ->where('parents_id', '=', Auth::user()->rank_id)
        ->join('rooms','students.rooms_id','=','rooms.rooms_id')
        ->get();

        return view('parent.parent-post',compact('students'));
    }

    public function post_show($student_id)
    {
        $student = Student::findOrFail($student_id);
        $showpost =  DB::table('teachers')
        ->where('rooms_id', '=', $student->rooms_id)
        ->join('posts','teachers.teachers_id','=','posts.teachers_id')
        ->get();
        // dd( $showpost);
        return view('parent.show-post',compact('showpost'));
    }
}
