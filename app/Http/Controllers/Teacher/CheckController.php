<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Timecards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckController extends Controller
{
    public function index()
    {
        $student = Student::all();
        $datenow = date('d/m/Y');
        //dd($student);
        return  view('teacher.check-index', compact('student', 'datenow'));
    }

    public function post_time($student_id)
    {
        $data = Student::findOrFail($student_id);
        $timenow = date('H:i:s');
        $datenow = date('d/m/Y');
        $student = DB::table('students')
        ->join('timecards','students.student_id','=','timecards.student_id')
        ->where('timecards.student_id', '=',$student_id)
        ->get();
        $check_student = DB::table('students')
        ->join('timecards','students.student_id','=','timecards.student_id')
        ->where('timecards.student_id', '=',$student_id)
        ->where( 'timecards.c_date','=', $datenow)
        ->get();
        //   dd($check_student);
        return view('teacher.post-time', compact('data', 'timenow', 'datenow','student','check_student'));    //,'student'
    }

    public function checktime(Request $request, $student_id)
    {
// dd($request);
        // $timenow = date('H:i:s');
        $datenow = date('d/m/Y');
        if (isset($request->checkin)) {
            $check_in = new Timecards();
            $check_in->student_id = $student_id;
            $check_in->c_date = $datenow;
            $check_in->c_in = $request->checkin;
            $check_in->save();
            return redirect()->back();
        }elseif(isset($request->checkout)){
             DB::table('timecards')
              ->where('student_id', $student_id)
              ->where('c_date', $datenow)
              ->update(['c_out' => $request->checkout]);
            return redirect()->back();
        }else{
            return redirect()->back()->with('error','คุณได้บันทึกเวลาวันนี้เรียบร้อยแล้ว');
        }
    }
}
