<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Development;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Elibyy\TCPDF\Facades\TCPDF;
use function Termwind\render;

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
        $dataphysicallysemester1 = DB::table('physically')
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', "ภาคเรียน1")
            ->get();
        $dataphysicallysemester2 = DB::table('physically')
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', "ภาคเรียน2")
            ->get();

        $datamood_mindsemester1 = DB::table('mood_mind')
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', "ภาคเรียน1")
            ->get();
        $datamood_mindsemester2 = DB::table('mood_mind')
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', "ภาคเรียน2")
            ->get();

        $datasocialsemester1 = DB::table('social')
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', "ภาคเรียน1")
            ->get();
        $datasocialsemester2 = DB::table('social')
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', "ภาคเรียน2")
            ->get();

        $dataintellectualsemester1 = DB::table('intellectual')
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', "ภาคเรียน1")
            ->get();
        $dataintellectualsemester2 = DB::table('intellectual')
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', "ภาคเรียน2")
            ->get();

        $Summary = DB::table('physically')
            ->select(DB::raw('ROUND(AVG(score_rate_physically),1) as physically'))
            ->where('student_id', '=', $student_id)
            ->get();

        $commenTeacher = DB::table('comment_appraisal')
            ->where('student_id', '=', $student_id)
            ->get();
        // dd($commenTeacher);
        return view('personal-record.appraisal-show', compact(
            'dataphysicallysemester1',
            'dataphysicallysemester2',
            'datamood_mindsemester1',
            'datamood_mindsemester2',
            'datasocialsemester1',
            'datasocialsemester2',
            'dataintellectualsemester1',
            'dataintellectualsemester2',
            'Summary',
            'commenTeacher'
        ));
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
                // 'commenteacher' => 'required|string'
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
        // Development::create([
        //     'student_id' => $student_id,
        //     'semester' => $request->semester,
        //     'd1_b1_1' => $request->developments1_behavior1_1,
        //     'd1_b1_2' => $request->developments1_behavior1_2,
        //     'd1_b1_3' => $request->developments1_behavior1_3,
        //     'd1_b2_1' => $request->developments1_behavior2_1,
        //     'd1_b2_2' => $request->developments1_behavior2_2,
        //     'd1_b2_3' => $request->developments1_behavior2_3,
        //     'd1_b2_4' => $request->developments1_behavior2_4,
        //     'd1_b2_5' => $request->developments1_behavior2_5,
        //     'd1_b2_6' => $request->developments1_behavior2_6,
        //     'd1_b3_1' => $request->developments1_behavior3_1,
        //     'd1_b3_2' => $request->developments1_behavior3_2,
        //     'd2_b1_1' => $request->developments2_behavior1_1,
        //     'd2_b1_2' => $request->developments2_behavior1_2,
        //     'd2_b1_3' => $request->developments2_behavior1_3,
        //     'd2_b1_4' => $request->developments2_behavior1_4,
        //     'd2_b1_5' => $request->developments2_behavior1_5,
        //     'd2_b2_1' => $request->developments2_behavior2_1,
        //     'd2_b2_2' => $request->developments2_behavior2_2,
        //     'd2_b2_3' => $request->developments2_behavior2_3,
        //     'd2_b2_4' => $request->developments2_behavior2_4,
        //     'd3_b1_1' => $request->developments3_behavior1_1,
        //     'd3_b1_2' => $request->developments3_behavior1_2,
        //     'd3_b2_1' => $request->developments3_behavior2_1,
        //     'd3_b2_2' => $request->developments3_behavior2_2,
        //     'd3_b2_3' =>  $request->developments3_behavior2_3,
        //     'd3_b2_4' => $request->developments3_behavior2_4,
        //     'd4_b1_1' => $request->developments4_behavior1_1,
        //     'd4_b1_2' => $request->developments4_behavior1_2,
        //     'd4_b1_3' => $request->developments4_behavior1_3,
        //     'd4_b1_4' => $request->developments4_behavior1_4,
        //     'd5_b1_1' => $request->developments5_behavior1_1,
        //     'd5_b1_2' => $request->developments5_behavior1_2,
        //     'd5_b2_1' => $request->developments5_behavior2_1,
        //     'd5_b2_2' => $request->developments5_behavior2_2,
        //     'd5_b2_3' => $request->developments5_behavior2_3,
        //     'd5_b3_1' => $request->developments5_behavior3_1,
        //     'd5_b3_2' => $request->developments5_behavior3_2,
        //     'd5_b4_1' => $request->developments5_behavior4_1,
        //     'd5_b4_2' => $request->developments5_behavior4_2,
        //     'd6_b1_1' => $request->developments6_behavior1_1,
        //     'd6_b1_2' => $request->developments6_behavior1_2,
        //     'd6_b1_3' => $request->developments6_behavior1_3,
        //     'd6_b1_4' => $request->developments6_behavior1_4,
        //     'd6_b2_1' => $request->developments6_behavior2_1,
        //     'd6_b2_2' => $request->developments6_behavior2_2,
        //     'd6_b2_3' => $request->developments6_behavior2_3,
        //     'd6_b3_1' => $request->developments6_behavior3_1,
        //     'd6_b3_2' => $request->developments6_behavior3_2,
        //     'd7_b1_1' => $request->developments7_behavior1_1,
        //     'd7_b1_2' => $request->developments7_behavior1_2,
        //     'd7_b1_3' => $request->developments7_behavior1_3,
        //     'd7_b2_1' => $request->developments7_behavior2_1,
        //     'd7_b2_2' => $request->developments7_behavior2_2,
        //     'd7_b2_3' => $request->developments7_behavior2_3,
        //     'd7_b2_4' => $request->developments7_behavior2_4,
        //     'd7_b2_5' => $request->developments7_behavior2_5,
        //     'd8_b1_1' => $request->developments8_behavior1_1,
        //     'd8_b1_2' => $request->developments8_behavior1_2,
        //     'd8_b1_3' => $request->developments8_behavior1_3,
        //     'd8_b2_1' => $request->developments8_behavior2_1,
        //     'd8_b2_2' => $request->developments8_behavior2_2,
        //     'd8_b2_3' => $request->developments8_behavior2_3,
        //     'd8_b2_4' => $request->developments8_behavior2_4,
        //     'd8_b2_5' => $request->developments8_behavior2_5,
        //     'd8_b3_1' => $request->developments8_behavior3_1,
        //     'd8_b3_2' => $request->developments8_behavior3_2,
        //     'd8_b3_3' => $request->developments8_behavior3_3,
        //     'd8_b3_4' => $request->developments8_behavior3_4,
        //     'd8_b3_5' => $request->developments8_behavior3_5,
        //     'd9_b1_1' => $request->developments9_behavior1_1,
        //     'd9_b1_2' => $request->developments9_behavior1_2,
        //     'd9_b1_3' => $request->developments9_behavior1_3,
        //     'd9_b1_4' => $request->developments9_behavior1_4,
        //     'd9_b1_5' => $request->developments9_behavior1_5,
        //     'd9_b2_1' => $request->developments9_behavior2_1,
        //     'd9_b2_2' => $request->developments9_behavior2_2,
        //     'd9_b2_3' => $request->developments9_behavior2_3,
        //     'd10_b1_1' => $request->developments10_behavior1_1,
        //     'd10_b1_2' => $request->developments10_behavior1_2,
        //     'd10_b1_3' => $request->developments10_behavior1_3,
        //     'd10_b1_4' => $request->developments10_behavior1_4,
        //     'd10_b1_5' => $request->developments10_behavior1_5,
        //     'd10_b2_1' => $request->developments10_behavior2_1,
        //     'd10_b2_2' => $request->developments10_behavior2_2,
        //     'd10_b3_1' => $request->developments10_behavior3_1,
        //     'd10_b3_2' => $request->developments10_behavior3_2,
        //     'd10_b3_3' => $request->developments10_behavior3_3,
        //     'd11_b1_1' => $request->developments11_behavior1_1,
        //     'd11_b1_2' => $request->developments11_behavior1_2,
        //     'd11_b2_1' => $request->developments11_behavior2_1,
        //     'd11_b2_2' => $request->developments11_behavior2_2,
        //     'd12_b1_1' => $request->developments12_behavior1_1,
        //     'd12_b1_2' => $request->developments12_behavior1_2,
        //     'd12_b1_3' => $request->developments12_behavior1_3,
        //     'd12_b2_1' => $request->developments12_behavior2_1,
        //     'd12_b2_2' => $request->developments12_behavior2_2,
        //     'd12_b2_3' => $request->developments12_behavior2_3,
        //     'comment_t' => $request->commenteacher
        // ]);


        $dataPhysically = [
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_physically' => $request->developments1_behavior1_1],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_physically' => $request->developments1_behavior1_2],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_physically' => $request->developments1_behavior1_3],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_physically' => $request->developments1_behavior2_1],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_physically' => $request->developments1_behavior2_2],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_physically' => $request->developments1_behavior2_3],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_physically' => $request->developments1_behavior2_4],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_physically' => $request->developments1_behavior2_5],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_physically' => $request->developments1_behavior2_6],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_physically' => $request->developments1_behavior3_1],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_physically' => $request->developments1_behavior3_2],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_physically' => $request->developments2_behavior1_1],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_physically' => $request->developments2_behavior1_2],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_physically' => $request->developments2_behavior1_3],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_physically' => $request->developments2_behavior1_4],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_physically' => $request->developments2_behavior1_5],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_physically' => $request->developments2_behavior2_1],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_physically' => $request->developments2_behavior2_2],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_physically' => $request->developments2_behavior2_3],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_physically' => $request->developments2_behavior2_4],
        ];
        DB::table('physically')->insert($dataPhysically);

        $dataMoodMind = [
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_mood_mind' => $request->developments3_behavior1_1],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_mood_mind' => $request->developments3_behavior1_2],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_mood_mind' => $request->developments3_behavior2_1],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_mood_mind' => $request->developments3_behavior2_2],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_mood_mind' => $request->developments3_behavior2_3],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_mood_mind' => $request->developments3_behavior2_4],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_mood_mind' => $request->developments4_behavior1_1],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_mood_mind' => $request->developments4_behavior1_2],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_mood_mind' => $request->developments4_behavior1_3],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_mood_mind' => $request->developments4_behavior1_4],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_mood_mind' => $request->developments5_behavior1_1],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_mood_mind' => $request->developments5_behavior1_2],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_mood_mind' => $request->developments5_behavior2_1],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_mood_mind' => $request->developments5_behavior2_2],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_mood_mind' => $request->developments5_behavior2_3],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_mood_mind' => $request->developments5_behavior3_1],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_mood_mind' => $request->developments5_behavior3_2],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_mood_mind' => $request->developments5_behavior4_1],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_mood_mind' => $request->developments5_behavior4_2],
        ];
        DB::table('mood_mind')->insert($dataMoodMind);

        $dataSocial = [
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_social' => $request->developments6_behavior1_1],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_social' => $request->developments6_behavior1_2],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_social' => $request->developments6_behavior1_3],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_social' => $request->developments6_behavior1_4],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_social' => $request->developments6_behavior2_1],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_social' => $request->developments6_behavior2_2],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_social' => $request->developments6_behavior2_3],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_social' => $request->developments6_behavior3_1],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_social' => $request->developments6_behavior3_2],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_social' => $request->developments7_behavior1_1],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_social' => $request->developments7_behavior1_2],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_social' => $request->developments7_behavior1_3],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_social' => $request->developments7_behavior2_1],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_social' => $request->developments7_behavior2_2],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_social' => $request->developments7_behavior2_3],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_social' => $request->developments7_behavior2_4],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_social' => $request->developments7_behavior2_5],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_social' => $request->developments8_behavior1_1],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_social' => $request->developments8_behavior1_2],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_social' => $request->developments8_behavior1_3],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_social' => $request->developments8_behavior2_1],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_social' => $request->developments8_behavior2_2],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_social' => $request->developments8_behavior2_3],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_social' => $request->developments8_behavior2_4],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_social' => $request->developments8_behavior2_5],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_social' => $request->developments8_behavior3_1],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_social' => $request->developments8_behavior3_2],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_social' => $request->developments8_behavior3_3],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_social' => $request->developments8_behavior3_4],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_social' => $request->developments8_behavior3_5]
        ];
        DB::table('social')->insert($dataSocial);

        $dataIntellectual = [
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_intellectual' => $request->developments9_behavior1_1],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_intellectual' => $request->developments9_behavior1_2],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_intellectual' => $request->developments9_behavior1_3],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_intellectual' => $request->developments9_behavior1_4],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_intellectual' => $request->developments9_behavior1_5],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_intellectual' => $request->developments9_behavior2_1],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_intellectual' => $request->developments9_behavior2_2],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_intellectual' => $request->developments9_behavior2_3],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_intellectual' => $request->developments10_behavior1_1],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_intellectual' => $request->developments10_behavior1_2],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_intellectual' => $request->developments10_behavior1_3],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_intellectual' => $request->developments10_behavior1_4],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_intellectual' => $request->developments10_behavior1_5],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_intellectual' => $request->developments10_behavior2_1],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_intellectual' => $request->developments10_behavior2_2],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_intellectual' => $request->developments10_behavior3_1],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_intellectual' => $request->developments10_behavior3_2],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_intellectual' => $request->developments10_behavior3_3],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_intellectual' => $request->developments11_behavior1_1],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_intellectual' => $request->developments11_behavior1_2],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_intellectual' => $request->developments11_behavior2_1],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_intellectual' => $request->developments11_behavior2_2],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_intellectual' => $request->developments12_behavior1_1],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_intellectual' => $request->developments12_behavior1_2],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_intellectual' => $request->developments12_behavior1_3],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_intellectual' => $request->developments12_behavior2_1],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_intellectual' => $request->developments12_behavior2_2],
            ['student_id' => $student_id, 'semester' => $request->semester, 'score_rate_intellectual' => $request->developments12_behavior2_3]
        ];
        DB::table('intellectual')->insert($dataIntellectual);

        DB::table('comment_appraisal')->insert([
            'student_id' => $student_id,
            'teachers_id' => Auth::user()->rank_id,
            'semester' => $request->semester,
            'comment_teacher' => $request->commenteacher,
        ]);
        return redirect(route('record.appraisal'))->with('successaddappraisal', 'บันทึกข้อมูลเสร็จสิ้น');
    }

    public function exportPDF()
    {
        // create new PDF document
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        // set margins
        $pdf::SetMargins(10, 20, 10);
        // $pdf::SetHeaderMargin(PDF_MARGIN_HEADER);
        // $pdf::SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks //ตั้งค่าตัวแบ่งหน้าอัตโนมัติ
        $pdf::SetAutoPageBreak(TRUE, 10);

        // Set font
        $pdf::SetFont('THSarabunNew', '', 16);
        // Add a page
        $pdf::AddPage();
        // set cell padding  //ช่องว่างภายใน
        $pdf::setCellPaddings(1, 1, 1, 1);

        // set cell margins ระยะขอบภายนอก
        // $pdf::setCellMargins(1, 1, 1, 1);
        $txt = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
        // --------------------------------------------------------------------------------------------
        $pdf::MultiCell(40, 33, 'พัฒนาการ', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(40, 33, 'ตัวบ่งชี้', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(50, 33, 'พฤติกรรม', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(30, 8, 'ภาคเรียนที่1', 1, 'C', false, 0, '', '', true, 0, false, true, 8, 'M');
        $pdf::MultiCell(30, 8, 'ภาคเรียนที่2', 1, 'C', false, 1, '', '', true, 0, false, true, 8, 'M');

        $pdf::MultiCell(10, 24, '3 <br/> ดี ', 1, 'C', false, 0, 140, '', true, 0, true);
        $pdf::MultiCell(10, 24, '2 <br/> ปานกลาง ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '1 <br/> ควร เสริม ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '3 <br/> ดี ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '2 <br/> ปานกลาง', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '1 <br/> ควร เสริม', 1, 'C', false, 1, '', '', true, 0, true);
        // --------------------------------------------------------------------------------------------
        $pdf::MultiCell(40, 195, '<u>พัฒนาการด้านร่างกาย</u><br/> มาตรฐานที่&nbsp;1&nbsp;ร่ายกาย เจริญเติบโตตามวัย และมีสุขนิสัยที่ดี', 1, 'L', false, 0, '', '', true, 0, true, true, 33, 'T');
        $pdf::MultiCell(40, 51, '1. มีน้ำหนักส่วนสูงตามเกณ์', 1, 'C', false, 0, '', '', true,);
        $pdf::MultiCell(50, 17, '1.1 น้ำหนักตามเณฑ์อายุของ กรมอนามัย', 1, 'L', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 17, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
        $pdf::MultiCell(10, 17, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 17, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 17, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 17, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 17, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
        $pdf::MultiCell(50, 17, '1.2 ส่วนสูงตามเกณฑ์อายุของ กรมอนามัย ', 1, 'L', false, 0, 90, '', true, 0, true);
        $pdf::MultiCell(10, 17, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
        $pdf::MultiCell(10, 17, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 17, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 17, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 17, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 17, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
        $pdf::MultiCell(50, 17, '1.3เส้นรอบศีรษะตามเกณฑ์อายุ', 1, 'L', false, 0, 90, '', true, 0, true);
        $pdf::MultiCell(10, 17, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
        $pdf::MultiCell(10, 17, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 17, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 17, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 17, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 17, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
        $pdf::MultiCell(40, 110, '2. มีสุขภาพอนามัยสุขนิสัย ที่ดี', 1, 'C', false, 0, 50, '', true,);
        $pdf::MultiCell(50, 23, '2.1 รับประทานอาหารที่มีประ โยชน์และดื่มน้ำสะอาดได้ด้วย ตนเอง', 1, 'L', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 23, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
        $pdf::MultiCell(10, 23, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 23, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 23, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 23, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 23, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
        $pdf::MultiCell(50, 23, '2.2 ล้างมือก่อนรับประทาน<br/>อาหารและหลังใช้ห้องส้วมได้ ด้วยตนเอง', 1, 'L', false, 0, 90, '', true, 0, true);
        $pdf::MultiCell(10, 23, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
        $pdf::MultiCell(10, 23, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 23, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 23, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 23, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 23, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
        $pdf::MultiCell(50, 16, '2.3 นอนพักผ่อนเป็นเวลา', 1, 'L', false, 0, 90, '', true, 0, true);
        $pdf::MultiCell(10, 16, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
        $pdf::MultiCell(10, 16, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 16, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 16, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 16, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 16, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
        $pdf::MultiCell(50, 16, '2.4 ออกกำลังกายเป็นเวลา', 1, 'L', false, 0, 90, '', true, 0, true);
        $pdf::MultiCell(10, 16, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
        $pdf::MultiCell(10, 16, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 16, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 16, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 16, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 16, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
        $pdf::MultiCell(50, 16, '2.5 อาบน้ำแต่ตัวได้แต่ไม่คล่อง', 1, 'L', false, 0, 90, '', true, 0, true);
        $pdf::MultiCell(10, 16, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
        $pdf::MultiCell(10, 16, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 16, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 16, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 16, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 16, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
        $pdf::MultiCell(50, 16, '2.6 ขับถ่ายเป็นเวลา', 1, 'L', false, 0, 90, '', true, 0, true);
        $pdf::MultiCell(10, 16, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
        $pdf::MultiCell(10, 16, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 16, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 16, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 16, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 16, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
        $pdf::MultiCell(40, 34, '3. รักษาความปลอดภัย ของตนเองและผู้อื่น', 1, 'C', false, 0, 50, '', true,);
        $pdf::MultiCell(50, 17, '3.1 เล่นและทำกิจกรรมอย่าง ปลอดภัยได้ด้วยตนเอง ', 1, 'L', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 17, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
        $pdf::MultiCell(10, 17, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 17, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 17, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 17, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 17, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
        $pdf::MultiCell(50, 17, '3.2 ระมัดระวังตนเองให้ปลอด ภัยขณะเล่นได้บางครั้ง ', 1, 'L', false, 0, 90, '', true, 0, true);
        $pdf::MultiCell(10, 17, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
        $pdf::MultiCell(10, 17, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 17, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 17, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 17, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 17, '<img src=".\image\check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
        // ---------------------------------------------------------

        //Close and output PDF document
        $pdf::Output('example_048.pdf', 'I');

        //============================================================+
        // END OF FILE
        //============================================================+
    }
}
