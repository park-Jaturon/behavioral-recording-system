<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Timecards;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CheckController extends Controller
{
    public function index()
    {
        // $student = Student::all();
        $student = DB::table('teachers')
        ->join('rooms', 'teachers.rooms_id', '=', 'rooms.rooms_id')
        ->where('teachers.teachers_id', '=', Auth::user()->rank_id)
        ->join('students', 'rooms.rooms_id', '=', 'students.rooms_id')
        // ->select('users.*', 'contacts.phone', 'orders.price')
        ->get();
        $datenow = date('d/m/Y');
        // dd($student);
        return  view('teacher.check-index', compact('student', 'datenow'));
    }

    public function post_time($student_id)
    {
        $data = Student::findOrFail($student_id);
        $timenow = date('H.i');
        $datenow = date('Y-m-d');
        $student = DB::table('students')
        ->join('timecards','students.student_id','=','timecards.student_id')
        ->select('timecards.c_date','timecards.c_in','timecards.c_out')
        ->where('timecards.student_id', '=',$student_id)
        ->orderByRaw('timecards.c_date DESC')
        ->get();
        Debugbar::info( $student);
        $check_student = DB::table('students')
        ->join('timecards','students.student_id','=','timecards.student_id')
        ->where('timecards.student_id', '=',$student_id)
        ->where( 'timecards.c_date','=', $datenow)
        ->get();
        $latest_date = DB::table('timecards')
        ->where('timecards.student_id', '=',$student_id)
        ->max('c_date');
        
        //    dd( $latest_date);
        return view('teacher.post-time', compact('data', 'timenow', 'datenow','student','check_student','latest_date'));    //,'student'
    }

    public function checktime(Request $request, $student_id)
    {
// dd($request);
        // $timenow = date('H:i:s');
        $datenow = date('Y/m/d');
        if (isset($request->checkin)) {
            $check_in = new Timecards();
            $check_in->student_id = $student_id;
            $check_in->c_date = $datenow;
            $check_in->c_in = $request->checkin;
            $check_in->save();
            return redirect()->back()->with('Messages','คุณได้บันทึกเวลามาโรงเรียนเรียบร้อยแล้ว');
        }elseif(isset($request->checkout)){
             DB::table('timecards')
              ->where('student_id', $student_id)
              ->where('c_date', $datenow)
              ->update(['c_out' => $request->checkout]);
            return redirect()->back()->with('Messages','คุณได้บันทึกเวลากลับบ้านเรียบร้อยแล้ว');
        }else{
            return redirect()->back()->with('Messages','คุณไม่สามารถบันทึกเวลาได้ในขณะนี้ ');
        }
    }
}
