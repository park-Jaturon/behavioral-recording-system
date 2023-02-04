<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    public function home()
    {
        $user = DB::table('users')
            ->join('teachers', 'teachers.teachers_id', '=', 'users.rank_id')
            ->join('rooms','rooms.rooms_id','=','teachers.rooms_id')
            ->join('students','students.rooms_id','=','rooms.rooms_id')
            ->get();
// dd($user);
        return view('teacher.home-teacher', compact('user'));
    }
}
