<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        // $user = User::all();

        $userteachers = DB::table('users')
        ->join('teachers', function ($join) {
            $join->on('users.rank_id', '=', 'teachers.teachers_id')
                 ->where('users.rank', '=', 'teacher');
        })
        ->get();

        $userparents = DB::table('users')
        ->join('parents', function ($join) {
            $join->on('users.rank_id', '=', 'parents.parents_id')
                 ->where('users.rank', '=', 'parent');
        })
        ->get();
        return view('admin.user-index',compact('userteachers','userparents'));
    }

}
