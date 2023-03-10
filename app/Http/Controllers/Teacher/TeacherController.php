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
        
        return view('teacher.dashboard');
    }

    public function room()
    {
        $user = DB::table('teachers')
        ->join('users', function ($join) {
            $join->on('teachers.teachers_id', '=', 'users.rank_id')
                ->where('users.rank', '=', 'teacher');
        })
            ->join('rooms','rooms.rooms_id','=','teachers.rooms_id')
            ->join('students','students.rooms_id','=','rooms.rooms_id')
            ->where('teachers.teachers_id', '=', Auth::user()->rank_id)
            
            ->get();
// dd($user);
        return view('teacher.home-teacher', compact('user'));
    }
}
