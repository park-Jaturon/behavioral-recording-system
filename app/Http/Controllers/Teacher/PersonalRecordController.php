<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Development;
use App\Models\Student;
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
        $student = Student::findOrFail($student_id);
        //    dd($student->student_id);
        return view('personal-record.appraisal-add', compact('student'));
    }

    public function appraisal_store(Request $request, $student_id)
    {
        $request->validate(
            [
                'semester' => 'required|string',
                'developments1_behavior1_1' => 'required|int',
                'developments1_behavior1_2' => 'required|int',
                'developments1_behavior1_3' => 'required|int',
                'developments1_behavior2_1' => 'required|int',
                'developments1_behavior2_2' => 'required|int',
                'developments1_behavior2_3' => 'required|int',
                'developments1_behavior2_4' => 'required|int',
                'developments1_behavior2_5' => 'required|int',
                'developments1_behavior2_6' => 'required|int',
                'developments1_behavior3_1' => 'required|int',
                'developments1_behavior3_2' => 'required|int',
                'developments2_behavior1_1' => 'required|int',
                'developments2_behavior1_2' => 'required|int',
                'developments2_behavior1_3' => 'required|int',
                'developments2_behavior1_4' => 'required|int',
                'developments2_behavior1_5' => 'required|int',
                'developments2_behavior2_1' => 'required|int',
                'developments2_behavior2_2' => 'required|int',
                'developments2_behavior2_3' => 'required|int',
                'developments2_behavior2_4' => 'required|int',
                'developments3_behavior1_1' => 'required|int',
                'developments3_behavior1_2' => 'required|int',
                'developments3_behavior2_1' => 'required|int',
                'developments3_behavior2_2' => 'required|int',
                'developments3_behavior2_3' => 'required|int',
                'developments3_behavior2_4' => 'required|int',
                'developments4_behavior1_1' => 'required|int',
                'developments4_behavior1_2' => 'required|int',
                'developments4_behavior1_3' => 'required|int',
                'developments4_behavior1_4' => 'required|int',
                'developments5_behavior1_1' => 'required|int',
                'developments5_behavior1_2' => 'required|int',
                'developments5_behavior2_1' => 'required|int',
                'developments5_behavior2_2' => 'required|int',
                'developments5_behavior2_3' => 'required|int',
                'developments5_behavior3_1' => 'required|int',
                'developments5_behavior3_2' => 'required|int',
                'developments5_behavior4_1' => 'required|int',
                'developments5_behavior4_2' => 'required|int',
                'developments6_behavior1_1' => 'required|int',
                'developments6_behavior1_2' => 'required|int',
                'developments6_behavior1_3' => 'required|int',
                'developments6_behavior1_4' => 'required|int',
                'developments6_behavior2_1' => 'required|int',
                'developments6_behavior2_2' => 'required|int',
                'developments6_behavior2_3' => 'required|int',
                'developments6_behavior3_1' => 'required|int',
                'developments6_behavior3_2' => 'required|int',
                'developments7_behavior1_1' => 'required|int',
                'developments7_behavior1_2' => 'required|int',
                'developments7_behavior1_3' => 'required|int',
                'developments7_behavior2_1' => 'required|int',
                'developments7_behavior2_2' => 'required|int',
                'developments7_behavior2_3' => 'required|int',
                'developments7_behavior2_4' => 'required|int',
                'developments7_behavior2_5' => 'required|int',
                'developments8_behavior1_1' => 'required|int',
                'developments8_behavior1_2' => 'required|int',
                'developments8_behavior1_3' => 'required|int',
                'developments8_behavior2_1' => 'required|int',
                'developments8_behavior2_2' => 'required|int',
                'developments8_behavior2_3' => 'required|int',
                'developments8_behavior2_4' => 'required|int',
                'developments8_behavior2_5' => 'required|int',
                'developments8_behavior3_1' => 'required|int',
                'developments8_behavior3_2' => 'required|int',
                'developments8_behavior3_3' => 'required|int',
                'developments8_behavior3_4' => 'required|int',
                'developments8_behavior3_5' => 'required|int',
                'developments9_behavior1_1' => 'required|int',
                'developments9_behavior1_2' => 'required|int',
                'developments9_behavior1_3' => 'required|int',
                'developments9_behavior1_4' => 'required|int',
                'developments9_behavior1_5' => 'required|int',
                'developments9_behavior2_1' => 'required|int',
                'developments9_behavior2_2' => 'required|int',
                'developments9_behavior2_3' => 'required|int',
                'developments10_behavior1_1' => 'required|int',
                'developments10_behavior1_2' => 'required|int',
                'developments10_behavior1_3' => 'required|int',
                'developments10_behavior1_4' => 'required|int',
                'developments10_behavior1_5' => 'required|int',
                'developments10_behavior2_1' => 'required|int',
                'developments10_behavior2_2' => 'required|int',
                'developments10_behavior3_1' => 'required|int',
                'developments10_behavior3_2' => 'required|int',
                'developments10_behavior3_3' => 'required|int',
                'developments11_behavior1_1' => 'required|int',
                'developments11_behavior1_2' => 'required|int',
                'developments11_behavior2_1' => 'required|int',
                'developments11_behavior2_2' => 'required|int',
                'developments12_behavior1_1' => 'required|int',
                'developments12_behavior1_2' => 'required|int',
                'developments12_behavior1_3' => 'required|int',
                'developments12_behavior2_1' => 'required|int',
                'developments12_behavior2_2' => 'required|int',
                'developments12_behavior2_3' => 'required|int',
                'commenteacher' => 'required|string'
            ],
            [
                'developments1_behavior1_1' => 'ยังไม่ได้ประเมิน',
                'developments1_behavior1_2' => 'ยังไม่ได้ประเมิน',
                'developments1_behavior1_3' => 'ยังไม่ได้ประเมิน',
                'developments1_behavior2_1' => 'ยังไม่ได้ประเมิน',
                'developments1_behavior2_2' => 'ยังไม่ได้ประเมิน',
                'developments1_behavior2_3' => 'ยังไม่ได้ประเมิน',
                'developments1_behavior2_4' => 'ยังไม่ได้ประเมิน',
                'developments1_behavior2_5' => 'ยังไม่ได้ประเมิน',
                'developments1_behavior2_6' => 'ยังไม่ได้ประเมิน',
                'developments1_behavior3_1' => 'ยังไม่ได้ประเมิน',
                'developments1_behavior3_2' => 'ยังไม่ได้ประเมิน',
                'developments2_behavior1_1' => 'ยังไม่ได้ประเมิน',
                'developments2_behavior1_2' => 'ยังไม่ได้ประเมิน',
                'developments2_behavior1_3' => 'ยังไม่ได้ประเมิน',
                'developments2_behavior1_4' => 'ยังไม่ได้ประเมิน',
                'developments2_behavior1_5' => 'ยังไม่ได้ประเมิน',
                'developments2_behavior2_1' => 'ยังไม่ได้ประเมิน',
                'developments2_behavior2_2' => 'ยังไม่ได้ประเมิน',
                'developments2_behavior2_3' => 'ยังไม่ได้ประเมิน',
                'developments2_behavior2_4' => 'ยังไม่ได้ประเมิน',
                'developments3_behavior1_1' => 'ยังไม่ได้ประเมิน',
                'developments3_behavior1_2' => 'ยังไม่ได้ประเมิน',
                'developments3_behavior2_1' => 'ยังไม่ได้ประเมิน',
                'developments3_behavior2_2' => 'ยังไม่ได้ประเมิน',
                'developments3_behavior2_3' => 'ยังไม่ได้ประเมิน',
                'developments3_behavior2_4' => 'ยังไม่ได้ประเมิน',
                'developments4_behavior1_1' => 'ยังไม่ได้ประเมิน',
                'developments4_behavior1_2' => 'ยังไม่ได้ประเมิน',
                'developments4_behavior1_3' => 'ยังไม่ได้ประเมิน',
                'developments4_behavior1_4' => 'ยังไม่ได้ประเมิน',
                'developments5_behavior1_1' => 'ยังไม่ได้ประเมิน',
                'developments5_behavior1_2' => 'ยังไม่ได้ประเมิน',
                'developments5_behavior2_1' => 'ยังไม่ได้ประเมิน',
                'developments5_behavior2_2' => 'ยังไม่ได้ประเมิน',
                'developments5_behavior2_3' => 'ยังไม่ได้ประเมิน',
                'developments5_behavior3_1' => 'ยังไม่ได้ประเมิน',
                'developments5_behavior3_2' => 'ยังไม่ได้ประเมิน',
                'developments5_behavior4_1' => 'ยังไม่ได้ประเมิน',
                'developments5_behavior4_2' => 'ยังไม่ได้ประเมิน',
                'developments6_behavior1_1' => 'ยังไม่ได้ประเมิน',
                'developments6_behavior1_2' => 'ยังไม่ได้ประเมิน',
                'developments6_behavior1_3' => 'ยังไม่ได้ประเมิน',
                'developments6_behavior1_4' => 'ยังไม่ได้ประเมิน',
                'developments6_behavior2_1' => 'ยังไม่ได้ประเมิน',
                'developments6_behavior2_2' => 'ยังไม่ได้ประเมิน',
                'developments6_behavior2_3' => 'ยังไม่ได้ประเมิน',
                'developments6_behavior3_1' => 'ยังไม่ได้ประเมิน',
                'developments6_behavior3_2' => 'ยังไม่ได้ประเมิน',
                'developments7_behavior1_1' => 'ยังไม่ได้ประเมิน',
                'developments7_behavior1_2' => 'ยังไม่ได้ประเมิน',
                'developments7_behavior1_3' => 'ยังไม่ได้ประเมิน',
                'developments7_behavior2_1' => 'ยังไม่ได้ประเมิน',
                'developments7_behavior2_2' => 'ยังไม่ได้ประเมิน',
                'developments7_behavior2_3' => 'ยังไม่ได้ประเมิน',
                'developments7_behavior2_4' => 'ยังไม่ได้ประเมิน',
                'developments7_behavior2_5' => 'ยังไม่ได้ประเมิน',
                'developments8_behavior1_1' => 'ยังไม่ได้ประเมิน',
                'developments8_behavior1_2' => 'ยังไม่ได้ประเมิน',
                'developments8_behavior1_3' => 'ยังไม่ได้ประเมิน',
                'developments8_behavior2_1' => 'ยังไม่ได้ประเมิน',
                'developments8_behavior2_2' => 'ยังไม่ได้ประเมิน',
                'developments8_behavior2_3' => 'ยังไม่ได้ประเมิน',
                'developments8_behavior2_4' => 'ยังไม่ได้ประเมิน',
                'developments8_behavior2_5' => 'ยังไม่ได้ประเมิน',
                'developments8_behavior3_1' => 'ยังไม่ได้ประเมิน',
                'developments8_behavior3_2' => 'ยังไม่ได้ประเมิน',
                'developments8_behavior3_3' => 'ยังไม่ได้ประเมิน',
                'developments8_behavior3_4' => 'ยังไม่ได้ประเมิน',
                'developments8_behavior3_5' => 'ยังไม่ได้ประเมิน',
                'developments9_behavior1_1' => 'ยังไม่ได้ประเมิน',
                'developments9_behavior1_2' => 'ยังไม่ได้ประเมิน',
                'developments9_behavior1_3' => 'ยังไม่ได้ประเมิน',
                'developments9_behavior1_4' => 'ยังไม่ได้ประเมิน',
                'developments9_behavior1_5' => 'ยังไม่ได้ประเมิน',
                'developments9_behavior2_1' => 'ยังไม่ได้ประเมิน',
                'developments9_behavior2_2' => 'ยังไม่ได้ประเมิน',
                'developments9_behavior2_3' => 'ยังไม่ได้ประเมิน',
                'developments10_behavior1_1' => 'ยังไม่ได้ประเมิน',
                'developments10_behavior1_2' => 'ยังไม่ได้ประเมิน',
                'developments10_behavior1_3' => 'ยังไม่ได้ประเมิน',
                'developments10_behavior1_4' => 'ยังไม่ได้ประเมิน',
                'developments10_behavior1_5' => 'ยังไม่ได้ประเมิน',
                'developments10_behavior2_1' => 'ยังไม่ได้ประเมิน',
                'developments10_behavior2_2' => 'ยังไม่ได้ประเมิน',
                'developments10_behavior3_1' => 'ยังไม่ได้ประเมิน',
                'developments10_behavior3_2' => 'ยังไม่ได้ประเมิน',
                'developments10_behavior3_3' => 'ยังไม่ได้ประเมิน',
                'developments11_behavior1_1' => 'ยังไม่ได้ประเมิน',
                'developments11_behavior1_2' => 'ยังไม่ได้ประเมิน',
                'developments11_behavior2_1' => 'ยังไม่ได้ประเมิน',
                'developments11_behavior2_2' => 'ยังไม่ได้ประเมิน',
                'developments12_behavior1_1' => 'ยังไม่ได้ประเมิน',
                'developments12_behavior1_2' => 'ยังไม่ได้ประเมิน',
                'developments12_behavior1_3' => 'ยังไม่ได้ประเมิน',
                'developments12_behavior2_1' => 'ยังไม่ได้ประเมิน',
                'developments12_behavior2_2' => 'ยังไม่ได้ประเมิน',
                'developments12_behavior2_3' => 'ยังไม่ได้ประเมิน',
                'semester' => 'กรุณาเลือกภาคเรียน'
            ]
        );

        // dd($student_id);
        Development::create([
            'student_id' => $student_id,
            'semester' => $request->semester,
            'd1_b1_1' => $request->developments1_behavior1_1,
            'd1_b1_2' => $request->developments1_behavior1_2,
            'd1_b1_3' => $request->developments1_behavior1_3,
            'd1_b2_1' => $request->developments1_behavior2_1,
            'd1_b2_2' => $request->developments1_behavior2_2,
            'd1_b2_3' => $request->developments1_behavior2_3,
            'd1_b2_4' => $request->developments1_behavior2_4,
            'd1_b2_5' => $request->developments1_behavior2_5,
            'd1_b2_6' => $request->developments1_behavior2_6,
            'd1_b3_1' => $request->developments1_behavior3_1,
            'd1_b3_2' => $request->developments1_behavior3_2,
            'd2_b1_1' => $request->developments2_behavior1_1,
            'd2_b1_2' => $request->developments2_behavior1_2,
            'd2_b1_3' => $request->developments2_behavior1_3,
            'd2_b1_4' => $request->developments2_behavior1_4,
            'd2_b1_5' => $request->developments2_behavior1_5,
            'd2_b2_1' => $request->developments2_behavior2_1,
            'd2_b2_2' => $request->developments2_behavior2_2,
            'd2_b2_3' => $request->developments2_behavior2_3,
            'd2_b2_4' => $request->developments2_behavior2_4,
            'd3_b1_1' => $request->developments3_behavior1_1,
            'd3_b1_2' => $request->developments3_behavior1_2,
            'd3_b2_1' => $request->developments3_behavior2_1,
            'd3_b2_2' => $request->developments3_behavior2_2,
            'd3_b2_3' =>  $request->developments3_behavior2_3,
            'd3_b2_4' => $request->developments3_behavior2_4,
            'd4_b1_1' => $request->developments4_behavior1_1,
            'd4_b1_2' => $request->developments4_behavior1_2,
            'd4_b1_3' => $request->developments4_behavior1_3,
            'd4_b1_4' => $request->developments4_behavior1_4,
            'd5_b1_1' => $request->developments5_behavior1_1,
            'd5_b1_2' => $request->developments5_behavior1_2,
            'd5_b2_1' => $request->developments5_behavior2_1,
            'd5_b2_2' => $request->developments5_behavior2_2,
            'd5_b2_3' => $request->developments5_behavior2_3,
            'd5_b3_1' => $request->developments5_behavior3_1,
            'd5_b3_2' => $request->developments5_behavior3_2,
            'd5_b4_1' => $request->developments5_behavior4_1,
            'd5_b4_2' => $request->developments5_behavior4_2,
            'd6_b1_1' => $request->developments6_behavior1_1,
            'd6_b1_2' => $request->developments6_behavior1_2,
            'd6_b1_3' => $request->developments6_behavior1_3,
            'd6_b1_4' => $request->developments6_behavior1_4,
            'd6_b2_1' => $request->developments6_behavior2_1,
            'd6_b2_2' => $request->developments6_behavior2_2,
            'd6_b2_3' => $request->developments6_behavior2_3,
            'd6_b3_1' => $request->developments6_behavior3_1,
            'd6_b3_2' => $request->developments6_behavior3_2,
            'd7_b1_1' => $request->developments7_behavior1_1,
            'd7_b1_2' => $request->developments7_behavior1_2,
            'd7_b1_3' => $request->developments7_behavior1_3,
            'd7_b2_1' => $request->developments7_behavior2_1,
            'd7_b2_2' => $request->developments7_behavior2_2,
            'd7_b2_3' => $request->developments7_behavior2_3,
            'd7_b2_4' => $request->developments7_behavior2_4,
            'd7_b2_5' => $request->developments7_behavior2_5,
            'd8_b1_1' => $request->developments8_behavior1_1,
            'd8_b1_2' => $request->developments8_behavior1_2,
            'd8_b1_3' => $request->developments8_behavior1_3,
            'd8_b2_1' => $request->developments8_behavior2_1,
            'd8_b2_2' => $request->developments8_behavior2_2,
            'd8_b2_3' => $request->developments8_behavior2_3,
            'd8_b2_4' => $request->developments8_behavior2_4,
            'd8_b2_5' => $request->developments8_behavior2_5,
            'd8_b3_1' => $request->developments8_behavior3_1,
            'd8_b3_2' => $request->developments8_behavior3_2,
            'd8_b3_3' => $request->developments8_behavior3_3,
            'd8_b3_4' => $request->developments8_behavior3_4,
            'd8_b3_5' => $request->developments8_behavior3_5,
            'd9_b1_1' => $request->developments9_behavior1_1,
            'd9_b1_2' => $request->developments9_behavior1_2,
            'd9_b1_3' => $request->developments9_behavior1_3,
            'd9_b1_4' => $request->developments9_behavior1_4,
            'd9_b1_5' => $request->developments9_behavior1_5,
            'd9_b2_1' => $request->developments9_behavior2_1,
            'd9_b2_2' => $request->developments9_behavior2_2,
            'd9_b2_3' => $request->developments9_behavior2_3,
            'd10_b1_1' => $request->developments10_behavior1_1,
            'd10_b1_2' => $request->developments10_behavior1_2,
            'd10_b1_3' => $request->developments10_behavior1_3,
            'd10_b1_4' => $request->developments10_behavior1_4,
            'd10_b1_5' => $request->developments10_behavior1_5,
            'd10_b2_1' => $request->developments10_behavior2_1,
            'd10_b2_2' => $request->developments10_behavior2_2,
            'd10_b3_1' => $request->developments10_behavior3_1,
            'd10_b3_2' => $request->developments10_behavior3_2,
            'd10_b3_3' => $request->developments10_behavior3_3,
            'd11_b1_1' => $request->developments11_behavior1_1,
            'd11_b1_2' => $request->developments11_behavior1_2,
            'd11_b2_1' => $request->developments11_behavior2_1,
            'd11_b2_2' => $request->developments11_behavior2_2,
            'd12_b1_1' => $request->developments12_behavior1_1,
            'd12_b1_2' => $request->developments12_behavior1_2,
            'd12_b1_3' => $request->developments12_behavior1_3,
            'd12_b2_1' => $request->developments12_behavior2_1,
            'd12_b2_2' => $request->developments12_behavior2_2,
            'd12_b2_3' => $request->developments12_behavior2_3,
            'comment_t' => $request->commenteacher
        ]);

        return redirect(route('record.appraisal'))->with('successaddpost', 'บันทึกข้อมูลเสร็จสิ้น');
    }
}
