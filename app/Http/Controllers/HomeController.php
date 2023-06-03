<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function profile($id)
    {
        // dd($id);
        $iduser = User::findOrFail($id);

        if ($iduser->rank == "teacher") {

            $username = DB::table('teachers')
                ->where('teachers.teachers_id', '=', Auth::user()->rank_id)
                ->select('prefix_name', 'first_name', 'last_name')
                ->first();
            //  dd( $username);
            return view('auth.profile', compact('username', 'iduser'));
        }
        if ($iduser->rank == "parent") {

            $username = DB::table('parents')
                ->where('teachers.parents_id', '=', Auth::user()->rank_id)
                ->select('prefix_name', 'first_name', 'last_name')
                ->first();
            // dd( $username);
            return view('auth.profile', compact('username', 'iduser'));
        }
        if($iduser->rank == "admin")
        {
            // $username = DB::table('admin')
            // ->where('teachers.teachers_id', '=', Auth::user()->rank_id)
            // ->select('prefix_name', 'first_name', 'last_name')
            // ->first();
            return view('auth.profile', compact('iduser'));
        }
        
        // return view('auth.profile',compact('username', 'iduser'));
    }

    public function update(Request $request, $id)
    {
        // dd($request);
        User::where('users_id', $id)
            ->update([
                'users_name' => $request->name,
                'password' =>  Hash::make($request->password),
            ]);

        return redirect()->back()->with('success', 'แก้ไขPasswordเสร็จสิ้น');
    }
}
