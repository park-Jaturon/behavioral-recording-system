<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
        return view('admin.user-index', compact('userteachers', 'userparents'));
    }

    public function edit_user($id)
    {
        $iduser = User::findOrFail($id);
        // dd( $iduser);
        if ($iduser->rank == "teacher") {

            $username = DB::table('teachers')
                ->join('users', 'teachers.teachers_id', '=', 'users.rank_id')
                ->where('rank', '=', 'teacher')
                ->where('teachers_id', '=', $iduser->rank_id)
                ->select('prefix_name', 'first_name', 'last_name')
                ->first();
            // dd( $username);
            return view('admin.user-edit', compact('username', 'iduser'));
        }
        if ($iduser->rank == "parent") {

            $username = DB::table('parents')
                ->join('users', 'parents.parents_id', '=', 'users.rank_id')
                ->where('rank', '=', 'parent')
                ->where('parents_id', '=', $iduser->rank_id)
                ->select('prefix_name', 'first_name', 'last_name')
                ->first();
            // dd( $username);
            return view('admin.user-edit', compact('username', 'iduser'));
        }
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        User::where('users_id', $id)
            ->update([
                'users_name' => $request->name,
                'password' =>  Hash::make($request->password),
            ]);

        return redirect(route('index.user'))->with('successupdateuser', 'แก้ไขข้อมูลเสร็จสิ้น');
    }

   

    public function delete($id)
    {
        User::destroy($id);
    }
}
