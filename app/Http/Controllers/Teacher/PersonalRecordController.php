<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Development;
use Barryvdh\Debugbar\Facades\Debugbar;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Elibyy\TCPDF\Facades\TCPDF;
use Illuminate\Support\Composer;
use Laravel\Ui\Presets\React;

use function Termwind\render;

class PersonalRecordController extends Controller
{
    // public function weight_height()
    // {
    //     $user = DB::table('teachers')
    //         ->join('users', function ($join) {
    //             $join->on('teachers.teachers_id', '=', 'users.rank_id')
    //                 ->where('users.rank', '=', 'teacher');
    //         })
    //         ->join('rooms', 'teachers.rooms_id', '=', 'rooms.rooms_id')
    //         ->join('students', 'rooms.rooms_id', '=', 'students.rooms_id')
    //         ->where('users.rank_id', '=', Auth::user()->rank_id)
    //         // ->select('users.*', 'contacts.phone', 'orders.price')
    //         ->get();
    //     // dd($user);
    //     return view('personal-record.weight-height', compact('user'));
    // }

    // public function weight_height_show($student_id)
    // {
    //     return view('personal-record.weight-height-show');
    // }

    // public function weight_height_add($student_id)
    // {
    //     return view('personal-record.weight-height-add');
    // }

    public function appraisal() //หน้าแรก
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
        return view('personal-record.development-appraisal', compact('user'));
    }

    public function appraisal_show($student_id) //ดู
    {
        $student = Student::find($student_id);

        $datasemester1 = DB::table('physically')
            ->where('student_id', '=', $student_id)
            ->where('semester', 'LIKE', "%ภาคเรียน1%")
            ->first();
        $datasemester2 = DB::table('physically')
            ->where('student_id', '=', $student_id)
            ->where('semester', 'LIKE', "%ภาคเรียน2%")
            ->first();
        // Debugbar::info( $student);

        $dataphysicallysemester1 = DB::table('physically')
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', "ภาคเรียน1")
            ->orderBy('table_section')
            ->get();
        $dataphysicallysemester2 = DB::table('physically')
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', "ภาคเรียน2")
            ->orderBy('table_section')
            ->get();

        $datamood_mindsemester1 = DB::table('mood_mind')
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', "ภาคเรียน1")
            ->orderBy('table_section')
            ->get();
        $datamood_mindsemester2 = DB::table('mood_mind')
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', "ภาคเรียน2")
            ->orderBy('table_section')
            ->get();

        $datasocialsemester1 = DB::table('social')
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', "ภาคเรียน1")
            ->orderBy('table_section')
            ->get();
        $datasocialsemester2 = DB::table('social')
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', "ภาคเรียน2")
            ->orderBy('table_section')
            ->get();

        $dataintellectualsemester1 = DB::table('intellectual')
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', "ภาคเรียน1")
            ->orderBy('table_section')
            ->get();
        $dataintellectualsemester2 = DB::table('intellectual')
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', "ภาคเรียน2")
            ->orderBy('table_section')
            ->get();

        $commenTeacher = DB::table('comment_appraisal')
            ->where('student_id', '=', $student_id)
            ->get();

        $appraisalsemester1Physically = DB::table('physically') //ด้านร่างกายภาคเรียน1
            ->select(DB::raw('SUM(score_rate_physically) as score_physically'))
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', 'ภาคเรียน1')
            ->first();
        $appraisalsemester2Physically = DB::table('physically') //ด้านร่างกายภาคเรียน2
            ->select(DB::raw('SUM(score_rate_physically) as score_physically'))
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', 'ภาคเรียน2')
            ->first();

        $appraisalsemester1mood_mind = DB::table('mood_mind') //-ด้านอารมณ์-จิตใจภาคเรียน1
            ->select(DB::raw('SUM(score_rate_mood_mind) as score_mood_mind'))
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', 'ภาคเรียน1')
            ->first();
        $appraisalsemester2mood_mind = DB::table('mood_mind') //-ด้านอารมณ์-จิตใจภาคเรียน2
            ->select(DB::raw('SUM(score_rate_mood_mind) as score_mood_mind'))
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', 'ภาคเรียน2')
            ->first();

        $appraisalsemester1social = DB::table('social') //ด้านสังคมภาคเรียน1
            ->select(DB::raw('SUM(score_rate_social) as score_social'))
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', 'ภาคเรียน1')
            ->first();
        $appraisalsemester2social = DB::table('social') //ด้านสังคมภาคเรียน2
            ->select(DB::raw('SUM(score_rate_social) as score_social'))
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', 'ภาคเรียน2')
            ->first();

        $appraisalsemester1intellectual = DB::table('intellectual') //ด้านสติปัญญาภาคเรียน1
            ->select(DB::raw('SUM(score_rate_intellectual) as score_intellectual'))
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', 'ภาคเรียน1')
            ->first();
        $appraisalsemester2intellectual = DB::table('intellectual') //ด้านสติปัญญาภาคเรียน2
            ->select(DB::raw('SUM(score_rate_intellectual) as score_intellectual'))
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', 'ภาคเรียน2')
            ->first();
        //    dd(($appraisalsemester1mood_mind->score_mood_mind / 60) * 100);
           Debugbar::info($dataphysicallysemester1,$dataphysicallysemester2);
           Debugbar::info($datamood_mindsemester1,$datamood_mindsemester2);
           Debugbar::info($datasocialsemester1,$datasocialsemester2);
           Debugbar::info($dataintellectualsemester1,$dataintellectualsemester2);
        return view(
            'personal-record.appraisal-show',
            compact(
                'dataphysicallysemester1',
                'dataphysicallysemester2',
                'datamood_mindsemester1',
                'datamood_mindsemester2',
                'datasocialsemester1',
                'datasocialsemester2',
                'dataintellectualsemester1',
                'dataintellectualsemester2',
                // 'SummaryPhysically',
                // 'SummaryMoodMind',
                // 'SummarySocial',
                // 'SummaryIntellectual',
                'commenTeacher',
                'student_id',
                'appraisalsemester1Physically',
                'appraisalsemester1mood_mind',
                'appraisalsemester1social',
                'appraisalsemester1intellectual',
                'appraisalsemester2Physically',
                'appraisalsemester2mood_mind',
                'appraisalsemester2social',
                'appraisalsemester2intellectual',
                'datasemester1',
                'datasemester2'
            )
        );
    }

    public function appraisal_add($student_id) //เพิ่มข้อมูล
    {
        $student = Student::findOrFail($student_id);
        //    dd($student->student_id);

        $table1_semester1 = DB::table('physically')
            ->where('table_no', 1)
            ->where('student_id', '=', $student_id)
            ->where('semester', 'LIKE', "%ภาคเรียน1%")
            ->get();
        $table1_semester2 = DB::table('physically')
            ->where('table_no', 1)
            ->where('student_id', '=', $student_id)
            ->where('semester', 'LIKE', "%ภาคเรียน2%")
            ->get();

        $table2_semester1 = DB::table('physically')
            ->where('table_no', 2)
            ->where('student_id', '=', $student_id)
            ->where('semester', 'LIKE', "%ภาคเรียน1%")
            ->get();
        $table2_semester2 = DB::table('physically')
            ->where('table_no', 2)
            ->where('student_id', '=', $student_id)
            ->where('semester', 'LIKE', "%ภาคเรียน2%")
            ->get();

        $table3_semester1 = DB::table('mood_mind')
            ->where('table_no', 3)
            ->where('student_id', '=', $student_id)
            ->where('semester', 'LIKE', "%ภาคเรียน1%")
            ->get();
        $table3_semester2 = DB::table('mood_mind')
            ->where('table_no', 3)
            ->where('student_id', '=', $student_id)
            ->where('semester', 'LIKE', "%ภาคเรียน2%")
            ->get();

        $table4_semester1 = DB::table('mood_mind')
            ->where('table_no', 4)
            ->where('student_id', '=', $student_id)
            ->where('semester', 'LIKE', "%ภาคเรียน1%")
            ->get();
        $table4_semester2 = DB::table('mood_mind')
            ->where('table_no', 4)
            ->where('student_id', '=', $student_id)
            ->where('semester', 'LIKE', "%ภาคเรียน2%")
            ->get();

        $table5_semester1 = DB::table('social')
            ->where('table_no', 5)
            ->where('student_id', '=', $student_id)
            ->where('semester', 'LIKE', "%ภาคเรียน1%")
            ->get();
        $table5_semester2 = DB::table('social')
            ->where('table_no', 5)
            ->where('student_id', '=', $student_id)
            ->where('semester', 'LIKE', "%ภาคเรียน2%")
            ->get();

        $table6_semester1 = DB::table('social')
            ->where('table_no', 6)
            ->where('student_id', '=', $student_id)
            ->where('semester', 'LIKE', "%ภาคเรียน1%")
            ->get();
        $table6_semester2 = DB::table('social')
            ->where('table_no', 6)
            ->where('student_id', '=', $student_id)
            ->where('semester', 'LIKE', "%ภาคเรียน2%")
            ->get();

        $table7_semester1 = DB::table('social')
            ->where('table_no', 7)
            ->where('student_id', '=', $student_id)
            ->where('semester', 'LIKE', "%ภาคเรียน1%")
            ->get();
        $table7_semester2 = DB::table('social')
            ->where('table_no', 7)
            ->where('student_id', '=', $student_id)
            ->where('semester', 'LIKE', "%ภาคเรียน2%")
            ->get();

        $table8_semester1 = DB::table('intellectual')
            ->where('table_no', 8)
            ->where('student_id', '=', $student_id)
            ->where('semester', 'LIKE', "%ภาคเรียน1%")
            ->get();
        $table8_semester2 = DB::table('intellectual')
            ->where('table_no', 8)
            ->where('student_id', '=', $student_id)
            ->where('semester', 'LIKE', "%ภาคเรียน2%")
            ->get();

        $table9_semester1 = DB::table('intellectual')
            ->where('table_no', 9)
            ->where('student_id', '=', $student_id)
            ->where('semester', 'LIKE', "%ภาคเรียน1%")
            ->get();
        $table9_semester2 = DB::table('intellectual')
            ->where('table_no', 9)
            ->where('student_id', '=', $student_id)
            ->where('semester', 'LIKE', "%ภาคเรียน2%")
            ->get();

        $table10_semester1 = DB::table('comment_appraisal')
            ->where('student_id', '=', $student_id)
            ->where('semester', 'LIKE', "%ภาคเรียน1%")
            ->get();

        $table10_semester2 = DB::table('comment_appraisal')
            ->where('student_id', '=', $student_id)
            ->where('semester', 'LIKE', "%ภาคเรียน2%")
            ->get();

        if (
            count($table1_semester1) > 0 && count($table2_semester1) > 0 && count($table3_semester1) > 0 &&
            count($table4_semester1) > 0 && count($table5_semester1) > 0 && count($table6_semester1) > 0 &&
            count($table7_semester1) > 0 && count($table8_semester1) > 0 && count($table9_semester1) > 0 &&
            count($table10_semester1) > 0
        ) {
            $check_table_semester1 = true;
        } else {
            $check_table_semester1 = false;
        }

        if (
            count($table1_semester2) > 0 && count($table2_semester2) > 0 && count($table3_semester2) > 0 &&
            count($table4_semester2) > 0 && count($table5_semester2) > 0 && count($table6_semester2) > 0 &&
            count($table7_semester2) > 0 && count($table8_semester2) > 0 && count($table9_semester2) > 0 &&
            count($table10_semester2) > 0
        ) {
            $check_table_semester2 = true;
            Student::where('student_id', '=', $student_id)
            ->update(['elevate' => 'true']);
        } else {
            $check_table_semester2 = false;
        }

        // Debugbar::warning($table1_semester1);
        // dd(NOW());
        Debugbar::info(DATE(NOW()));

        return view('personal-record.appraisal-add', compact(
            'student',
            'table1_semester1',
            'table1_semester2',
            'table2_semester1',
            'table2_semester2',
            'table3_semester1',
            'table3_semester2',
            'table4_semester1',
            'table4_semester2',
            'table5_semester1',
            'table5_semester2',
            'table6_semester1',
            'table6_semester2',
            'table7_semester1',
            'table7_semester2',
            'table8_semester1',
            'table8_semester2',
            'table9_semester1',
            'table9_semester2',
            'table10_semester1',
            'table10_semester2',
            'check_table_semester1','check_table_semester2'
        ));
    }

    public function appraisal_store(Request $request, $student_id) //บันทึก
    {
        $table_no = request()->table_no ? request()->table_no : '';
        $table_section = request()->table_section ? request()->table_section : '';
        if ($table_no && $table_no === "1") {
            // dd(request()->all());
            $request->validate(
                [
                    'semester' => 'required|string',
                    'developments_behavior1_1_1' => 'required|int',
                    'developments_behavior1_1_2' => 'required|int',
                    'developments_behavior1_1_3' => 'required|int',
                    'developments_behavior1_2_1' => 'required|int',
                    'developments_behavior1_2_2' => 'required|int',
                    'developments_behavior1_2_3' => 'required|int',
                    'developments_behavior1_2_4' => 'required|int',
                    'developments_behavior1_2_5' => 'required|int',
                    'developments_behavior1_2_6' => 'required|int',
                    'developments_behavior1_3_1' => 'required|int',
                    'developments_behavior1_3_2' => 'required|int',
                ],
                [
                    'developments_behavior1_1_1.required' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior1_1_2.required' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior1_1_3.required' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior1_2_1.required' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior1_2_2.required' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior1_2_3.required' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior1_2_4.required' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior1_2_5.required' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior1_2_6.required' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior1_3_1.required' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior1_3_2.required' => 'ยังไม่ได้ประเมิน',
                    'semester.required' => 'กรุณาเลือกภาคเรียน'
                ]
            );

            // dd('5555');
            $chk = DB::table('physically')->where('table_no', $table_no)->whereIn('table_section', $table_section)->get();
            foreach ($table_section as $section) {
                $name = 'developments_behavior' . $section;
                // dd($name);
                $chk = DB::table('physically')->where('student_id', $student_id)->where('semester', $request->semester)->where('table_no', $table_no)->where('table_section', $section)->first();
                if ($chk) {
                    // dd($chk);
                    DB::beginTransaction();
                    try {
                        $dataPhysically = [
                            'score_rate_physically' => $request->$name,
                            'updated_at' => DATE(NOW())
                        ];

                        // dd($dataPhysically, request()->all());
                        DB::table('physically')
                            ->where('student_id', $student_id)
                            ->where('semester', $request->semester)
                            ->where('table_no', $table_no)
                            ->where('table_section', $section)
                            ->update($dataPhysically);
                        DB::commit();
                    } catch (Exception $e) {
                        DB::rollBack();
                    }
                } else {
                    DB::beginTransaction();
                    try {
                        $dataPhysically = [
                            [
                                'student_id' => $student_id,
                                'semester' => $request->semester,
                                'score_rate_physically' => $request->$name,
                                'table_no' => $table_no,
                                'table_section' => $section,
                                'created_at' => DATE(NOW())
                            ]
                        ];
                        // dd($dataPhysically, request()->all());
                        DB::table('physically')->insert($dataPhysically);
                        DB::commit();
                    } catch (Exception $e) {
                        DB::rollBack();
                    }
                }
            }
        } else if ($table_no && $table_no === "2") {
            $request->validate(
                [
                    'semester' => 'required|string',
                    'developments_behavior2_1_1' => 'required|int',
                    'developments_behavior2_1_2' => 'required|int',
                    'developments_behavior2_1_3' => 'required|int',
                    'developments_behavior2_1_4' => 'required|int',
                    'developments_behavior2_1_5' => 'required|int',
                    'developments_behavior2_2_1' => 'required|int',
                    'developments_behavior2_2_2' => 'required|int',
                    'developments_behavior2_2_3' => 'required|int',
                    'developments_behavior2_2_4' => 'required|int',
                ],
                [
                    'developments_behavior2_1_1' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior2_1_2' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior2_1_3' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior2_1_4' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior2_1_5' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior2_2_1' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior2_2_2' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior2_2_3' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior2_2_4' => 'ยังไม่ได้ประเมิน',
                    'semester' => 'กรุณาเลือกภาคเรียน'
                ]
            );
            $chk = DB::table('physically')->where('table_no', $table_no)->whereIn('table_section', $table_section)->get();

            foreach ($table_section as $section) {
                $name = 'developments_behavior' . $section;
                $chk = DB::table('physically')->where('student_id', $student_id)->where('semester', $request->semester)->where('table_no', $table_no)->where('table_section', $section)->first();
                if ($chk) {
                    DB::beginTransaction();
                    try {
                        $dataPhysically = [
                            'score_rate_physically' => $request->$name,
                            'updated_at' => DATE(NOW())
                        ];

                        // dd($dataPhysically, request()->all());
                        // DB::table('physically')->update($dataPhysically);
                        DB::table('physically')
                            ->where('student_id', $student_id)
                            ->where('semester', $request->semester)
                            ->where('table_no', $table_no)
                            ->where('table_section', $section)
                            ->update($dataPhysically);
                        DB::commit();
                    } catch (Exception $e) {
                        DB::rollBack();
                    }
                } else {
                    DB::beginTransaction();
                    try {
                        $dataPhysically = [
                            [
                                'student_id' => $student_id,
                                'semester' => $request->semester,
                                'score_rate_physically' => $request->$name,
                                'table_no' => $table_no,
                                'table_section' => $section,
                                'created_at' => DATE(NOW())
                            ]
                        ];
                        // dd($dataPhysically, request()->all());
                        DB::table('physically')->insert($dataPhysically);
                        DB::commit();
                    } catch (Exception $e) {
                        DB::rollBack();
                    }
                }
            }
        } else if ($table_no && $table_no === "3") {
            $request->validate(
                [
                    'semester' => 'required|string',
                    'developments_behavior3_1_1' => 'required|int',
                    'developments_behavior3_1_2' => 'required|int',
                    'developments_behavior3_2_1' => 'required|int',
                    'developments_behavior3_2_2' => 'required|int',
                    'developments_behavior3_2_3' => 'required|int',
                    'developments_behavior3_2_4' => 'required|int',
                    'developments_behavior4_1_1' => 'required|int',
                    'developments_behavior4_1_2' => 'required|int',
                    'developments_behavior4_1_3' => 'required|int',
                    'developments_behavior4_1_4' => 'required|int',
                ],
                [
                    'developments_behavior3_1_1' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior3_1_2' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior3_2_1' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior3_2_2' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior3_2_3' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior3_2_4' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior4_1_1' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior4_1_2' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior4_1_3' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior4_1_4' => 'ยังไม่ได้ประเมิน',
                    'semester' => 'กรุณาเลือกภาคเรียน'
                ]
            );

            $chk = DB::table('mood_mind')->where('table_no', $table_no)->whereIn('table_section', $table_section)->get();

            foreach ($table_section as $section) {
                $name = 'developments_behavior' . $section;
                $chk = DB::table('mood_mind')->where('student_id', $student_id)->where('semester', $request->semester)->where('table_no', $table_no)->where('table_section', $section)->first();
                if ($chk) {
                    DB::beginTransaction();
                    try {
                        $dataMoodMind = [
                            'score_rate_mood_mind' => $request->$name,
                            'updated_at' => DATE(NOW())
                        ];

                        // dd($dataPhysically, request()->all());
                        // DB::table('mood_mind')->update($dataMoodMind);
                        DB::table('mood_mind')
                            ->where('student_id', $student_id)
                            ->where('semester', $request->semester)
                            ->where('table_no', $table_no)
                            ->where('table_section', $section)
                            ->update($dataMoodMind);
                        DB::commit();
                    } catch (Exception $e) {
                        DB::rollBack();
                    }
                } else {
                    DB::beginTransaction();
                    try {
                        $dataMoodMind = [
                            [
                                'student_id' => $student_id,
                                'semester' => $request->semester,
                                'score_rate_mood_mind' => $request->$name,
                                'table_no' => $table_no,
                                'table_section' => $section,
                                'created_at' => DATE(NOW())
                            ]
                        ];
                        // dd($dataPhysically, request()->all());
                        DB::table('mood_mind')->insert($dataMoodMind);
                        DB::commit();
                    } catch (Exception $e) {
                        DB::rollBack();
                    }
                }
            }
        } else if ($table_no && $table_no === "4") {
            $request->validate(
                [
                    'semester' => 'required|string',
                    'developments_behavior5_1_1' => 'required|int',
                    'developments_behavior5_1_2' => 'required|int',
                    'developments_behavior5_2_1' => 'required|int',
                    'developments_behavior5_2_2' => 'required|int',
                    'developments_behavior5_2_3' => 'required|int',
                    'developments_behavior5_3_1' => 'required|int',
                    'developments_behavior5_3_2' => 'required|int',
                    'developments_behavior5_4_1' => 'required|int',
                    'developments_behavior5_4_2' => 'required|int',
                ],
                [

                    'developments_behavior5_1_1' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior5_1_2' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior5_2_1' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior5_2_2' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior5_2_3' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior5_3_1' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior5_3_2' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior5_4_1' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior5_4_2' => 'ยังไม่ได้ประเมิน',
                    'semester' => 'กรุณาเลือกภาคเรียน'
                ]
            );
            $chk = DB::table('mood_mind')->where('table_no', $table_no)->whereIn('table_section', $table_section)->get();

            foreach ($table_section as $section) {
                $name = 'developments_behavior' . $section;
                $chk = DB::table('mood_mind')->where('student_id', $student_id)->where('semester', $request->semester)->where('table_no', $table_no)->where('table_section', $section)->first();
                if ($chk) {
                    DB::beginTransaction();
                    try {
                        $dataMoodMind = [
                            'score_rate_mood_mind' => $request->$name,
                            'updated_at' => DATE(NOW())
                        ];

                        // dd($dataPhysically, request()->all());
                        // DB::table('mood_mind')->update($dataMoodMind);
                        DB::table('mood_mind')
                            ->where('student_id', $student_id)
                            ->where('semester', $request->semester)
                            ->where('table_no', $table_no)
                            ->where('table_section', $section)
                            ->update($dataMoodMind);
                        DB::commit();
                    } catch (Exception $e) {
                        DB::rollBack();
                    }
                } else {
                    DB::beginTransaction();
                    try {
                        $dataMoodMind = [
                            [
                                'student_id' => $student_id,
                                'semester' => $request->semester,
                                'score_rate_mood_mind' => $request->$name,
                                'table_no' => $table_no,
                                'table_section' => $section,
                                'created_at' => DATE(NOW())
                            ]
                        ];
                        // dd($dataPhysically, request()->all());
                        DB::table('mood_mind')->insert($dataMoodMind);
                        DB::commit();
                    } catch (Exception $e) {
                        DB::rollBack();
                    }
                }
            }
        } else if ($table_no && $table_no === "5") {
            $request->validate(
                [
                    'semester' => 'required|string',
                    'developments_behavior6_1_1' => 'required|int',
                    'developments_behavior6_1_2' => 'required|int',
                    'developments_behavior6_1_3' => 'required|int',
                    'developments_behavior6_1_4' => 'required|int',
                    'developments_behavior6_2_1' => 'required|int',
                    'developments_behavior6_2_2' => 'required|int',
                    'developments_behavior6_2_3' => 'required|int',
                    'developments_behavior6_3_1' => 'required|int',
                    'developments_behavior6_3_2' => 'required|int',
                ],
                [
                    'developments_behavior6_1_1' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior6_1_2' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior6_1_3' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior6_1_4' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior6_2_1' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior6_2_2' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior6_2_3' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior6_3_1' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior6_3_2' => 'ยังไม่ได้ประเมิน',
                    'semester' => 'กรุณาเลือกภาคเรียน'
                ]
            );
            $chk = DB::table('social')->where('table_no', $table_no)->whereIn('table_section', $table_section)->get();

            foreach ($table_section as $section) {
                $name = 'developments_behavior' . $section;
                $chk = DB::table('social')->where('student_id', $student_id)->where('semester', $request->semester)->where('table_no', $table_no)->where('table_section', $section)->first();
                if ($chk) {
                    DB::beginTransaction();
                    try {
                        $dataSocial = [
                            'score_rate_social' => $request->$name,
                            'updated_at' => DATE(NOW())
                        ];

                        // dd($dataPhysically, request()->all());
                        // DB::table('social')->update($dataSocial);
                        DB::table('social')
                            ->where('student_id', $student_id)
                            ->where('semester', $request->semester)
                            ->where('table_no', $table_no)
                            ->where('table_section', $section)
                            ->update($dataSocial);
                        DB::commit();
                    } catch (Exception $e) {
                        DB::rollBack();
                    }
                } else {
                    DB::beginTransaction();
                    try {
                        $dataSocial = [
                            [
                                'student_id' => $student_id,
                                'semester' => $request->semester,
                                'score_rate_social' => $request->$name,
                                'table_no' => $table_no,
                                'table_section' => $section,
                                'created_at' => DATE(NOW())
                            ]
                        ];
                        // dd($dataPhysically, request()->all());
                        DB::table('social')->insert($dataSocial);
                        DB::commit();
                    } catch (Exception $e) {
                        DB::rollBack();
                    }
                }
            }
        } else if ($table_no && $table_no === "6") {
            $request->validate(
                [
                    'semester' => 'required|string',
                    'developments_behavior7_1_1' => 'required|int',
                    'developments_behavior7_1_2' => 'required|int',
                    'developments_behavior7_1_3' => 'required|int',
                    'developments_behavior7_2_1' => 'required|int',
                    'developments_behavior7_2_2' => 'required|int',
                    'developments_behavior7_2_3' => 'required|int',
                    'developments_behavior7_2_4' => 'required|int',
                    'developments_behavior7_2_5' => 'required|int',
                ],
                [
                    'developments_behavior7_1_1' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior7_1_2' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior7_1_3' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior7_2_1' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior7_2_2' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior7_2_3' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior7_2_4' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior7_2_5' => 'ยังไม่ได้ประเมิน',
                    'semester' => 'กรุณาเลือกภาคเรียน'
                ]
            );
            $chk = DB::table('social')->where('table_no', $table_no)->whereIn('table_section', $table_section)->get();

            foreach ($table_section as $section) {
                $name = 'developments_behavior' . $section;
                $chk = DB::table('social')->where('student_id', $student_id)->where('semester', $request->semester)->where('table_no', $table_no)->where('table_section', $section)->first();
                if ($chk) {
                    DB::beginTransaction();
                    try {
                        $dataSocial = [
                            'score_rate_social' => $request->$name,
                            'updated_at' => DATE(NOW())
                        ];

                        // dd($dataPhysically, request()->all());
                        // DB::table('social')->update($dataSocial);
                        DB::table('social')
                            ->where('student_id', $student_id)
                            ->where('semester', $request->semester)
                            ->where('table_no', $table_no)
                            ->where('table_section', $section)
                            ->update($dataSocial);
                        DB::commit();
                    } catch (Exception $e) {
                        DB::rollBack();
                    }
                } else {
                    DB::beginTransaction();
                    try {
                        $dataSocial = [
                            [
                                'student_id' => $student_id,
                                'semester' => $request->semester,
                                'score_rate_social' => $request->$name,
                                'table_no' => $table_no,
                                'table_section' => $section,
                                'created_at' => DATE(NOW())
                            ]
                        ];
                        // dd($dataPhysically, request()->all());
                        DB::table('social')->insert($dataSocial);
                        DB::commit();
                    } catch (Exception $e) {
                        DB::rollBack();
                    }
                }
            }
        } else if ($table_no && $table_no === "7") {
            $request->validate(
                [
                    'semester' => 'required|string',
                    'developments_behavior8_1_1' => 'required|int',
                    'developments_behavior8_1_2' => 'required|int',
                    'developments_behavior8_1_3' => 'required|int',
                    'developments_behavior8_2_1' => 'required|int',
                    'developments_behavior8_2_2' => 'required|int',
                    'developments_behavior8_2_3' => 'required|int',
                    'developments_behavior8_2_4' => 'required|int',
                    'developments_behavior8_2_5' => 'required|int',
                    'developments_behavior8_3_1' => 'required|int',
                    'developments_behavior8_3_2' => 'required|int',
                    'developments_behavior8_3_3' => 'required|int',
                    'developments_behavior8_3_4' => 'required|int',
                    'developments_behavior8_3_5' => 'required|int',
                ],
                [
                    'developments_behavior8_1_1' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior8_1_2' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior8_1_3' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior8_2_1' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior8_2_2' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior8_2_3' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior8_2_4' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior8_2_5' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior8_3_1' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior8_3_2' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior8_3_3' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior8_3_4' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior8_3_5' => 'ยังไม่ได้ประเมิน',
                    'semester' => 'กรุณาเลือกภาคเรียน'
                ]
            );
            $chk = DB::table('social')->where('table_no', $table_no)->whereIn('table_section', $table_section)->get();

            foreach ($table_section as $section) {
                $name = 'developments_behavior' . $section;
                $chk = DB::table('social')->where('student_id', $student_id)->where('semester', $request->semester)->where('table_no', $table_no)->where('table_section', $section)->first();
                if ($chk) {
                    DB::beginTransaction();
                    try {
                        $dataSocial = [
                            'score_rate_social' => $request->$name,
                            'updated_at' => DATE(NOW())
                        ];

                        // dd($dataPhysically, request()->all());
                        // DB::table('social')->update($dataSocial);
                        DB::table('social')
                            ->where('student_id', $student_id)
                            ->where('semester', $request->semester)
                            ->where('table_no', $table_no)
                            ->where('table_section', $section)
                            ->update($dataSocial);
                        DB::commit();
                    } catch (Exception $e) {
                        DB::rollBack();
                    }
                } else {
                    DB::beginTransaction();
                    try {
                        $dataSocial = [
                            [
                                'student_id' => $student_id,
                                'semester' => $request->semester,
                                'score_rate_social' => $request->$name,
                                'table_no' => $table_no,
                                'table_section' => $section,
                                'created_at' => DATE(NOW())
                            ]
                        ];
                        // dd($dataPhysically, request()->all());
                        DB::table('social')->insert($dataSocial);
                        DB::commit();
                    } catch (Exception $e) {
                        DB::rollBack();
                    }
                }
            }
        } else if ($table_no && $table_no === "8") {
            $request->validate(
                [
                    'semester' => 'required|string',
                    'developments_behavior9_1_1' => 'required|int',
                    'developments_behavior9_1_2' => 'required|int',
                    'developments_behavior9_1_3' => 'required|int',
                    'developments_behavior9_1_4' => 'required|int',
                    'developments_behavior9_1_5' => 'required|int',
                    'developments_behavior9_2_1' => 'required|int',
                    'developments_behavior9_2_2' => 'required|int',
                    'developments_behavior9_2_3' => 'required|int',
                    'developments_behavior10_1_1' => 'required|int',
                    'developments_behavior10_1_2' => 'required|int',
                    'developments_behavior10_1_3' => 'required|int',
                    'developments_behavior10_1_4' => 'required|int',
                    'developments_behavior10_1_5' => 'required|int',
                    'developments_behavior10_2_1' => 'required|int',
                    'developments_behavior10_2_2' => 'required|int',
                    'developments_behavior10_3_1' => 'required|int',
                    'developments_behavior10_3_2' => 'required|int',
                    'developments_behavior10_3_3' => 'required|int',
                ],
                [
                    'developments_behavior9_1_1' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior9_1_2' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior9_1_3' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior9_1_4' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior9_1_5' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior9_2_1' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior9_2_2' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior9_2_3' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior10_1_1' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior10_1_2' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior10_1_3' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior10_1_4' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior10_1_5' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior10_2_1' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior10_2_2' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior10_3_1' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior10_3_2' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior10_3_3' => 'ยังไม่ได้ประเมิน',
                    'semester' => 'กรุณาเลือกภาคเรียน'
                ]
            );

            $chk = DB::table('intellectual')->where('table_no', $table_no)->whereIn('table_section', $table_section)->get();

            foreach ($table_section as $section) {
                $name = 'developments_behavior' . $section;
                $chk = DB::table('intellectual')->where('student_id', $student_id)->where('semester', $request->semester)->where('table_no', $table_no)->where('table_section', $section)->first();
                if ($chk) {
                    DB::beginTransaction();
                    try {
                        $dataIntellectual = [
                            'score_rate_intellectual' => $request->$name,
                            'updated_at' => DATE(NOW())
                        ];

                        // dd($dataPhysically, request()->all());
                        // DB::table('intellectual')->update($dataIntellectual);
                        DB::table('intellectual')
                            ->where('student_id', $student_id)
                            ->where('semester', $request->semester)
                            ->where('table_no', $table_no)
                            ->where('table_section', $section)
                            ->update($dataIntellectual);
                        DB::commit();
                    } catch (Exception $e) {
                        DB::rollBack();
                    }
                } else {
                    DB::beginTransaction();
                    try {
                        $dataIntellectual = [
                            [
                                'student_id' => $student_id,
                                'semester' => $request->semester,
                                'score_rate_intellectual' => $request->$name,
                                'table_no' => $table_no,
                                'table_section' => $section,
                                'created_at' => DATE(NOW())
                            ]
                        ];
                        // dd($dataPhysically, request()->all());
                        DB::table('intellectual')->insert($dataIntellectual);
                        DB::commit();
                    } catch (Exception $e) {
                        DB::rollBack();
                    }
                }
            }
        } else if ($table_no && $table_no === "9") {
            $request->validate(
                [
                    'semester' => 'required|string',
                    'developments_behavior11_1_1' => 'required|int',
                    'developments_behavior11_1_2' => 'required|int',
                    'developments_behavior11_2_1' => 'required|int',
                    'developments_behavior11_2_2' => 'required|int',
                    'developments_behavior12_1_1' => 'required|int',
                    'developments_behavior12_1_2' => 'required|int',
                    'developments_behavior12_1_3' => 'required|int',
                    'developments_behavior12_2_1' => 'required|int',
                    'developments_behavior12_2_2' => 'required|int',
                    'developments_behavior12_2_3' => 'required|int',
                    // 'commenteacher' => 'required|string'
                ],
                [
                    'developments_behavior11_1_1' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior11_1_2' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior11_2_1' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior11_2_2' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior12_1_1' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior12_1_2' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior12_1_3' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior12_2_1' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior12_2_2' => 'ยังไม่ได้ประเมิน',
                    'developments_behavior12_2_3' => 'ยังไม่ได้ประเมิน',
                    'semester' => 'กรุณาเลือกภาคเรียน'
                ]
            );
            $chk = DB::table('intellectual')->where('table_no', $table_no)->whereIn('table_section', $table_section)->get();

            foreach ($table_section as $section) {
                $name = 'developments_behavior' . $section;
                $chk = DB::table('intellectual')->where('student_id', $student_id)->where('semester', $request->semester)->where('table_no', $table_no)->where('table_section', $section)->first();
                if ($chk) {
                    DB::beginTransaction();
                    try {
                        $dataIntellectual = [
                            'score_rate_intellectual' => $request->$name,
                            'updated_at' => DATE(NOW())
                        ];

                        // dd($dataPhysically, request()->all());
                        // DB::table('intellectual')->update($dataIntellectual);
                        DB::table('intellectual')
                            ->where('student_id', $student_id)
                            ->where('semester', $request->semester)
                            ->where('table_no', $table_no)
                            ->where('table_section', $section)
                            ->update($dataIntellectual);
                        DB::commit();
                    } catch (Exception $e) {
                        DB::rollBack();
                    }
                } else {
                    DB::beginTransaction();
                    try {
                        $dataIntellectual = [
                            [
                                'student_id' => $student_id,
                                'semester' => $request->semester,
                                'score_rate_intellectual' => $request->$name,
                                'table_no' => $table_no,
                                'table_section' => $section,
                                'created_at' => DATE(NOW())
                            ]
                        ];
                        // dd($dataPhysically, request()->all());
                        DB::table('intellectual')->insert($dataIntellectual);
                        DB::commit();
                    } catch (Exception $e) {
                        DB::rollBack();
                    }
                }
            }
        } else if ($table_no && $table_no === "10") {
            $request->validate(
                [
                    'commenteacher' => 'required|string',
                    'semester' => 'required|string',
                ],
                [
                    'commenteacher' => 'กรุณากรอกข้อมูล',
                    'semester' => 'กรุณาเลือกภาคเรียน'
                ]
            );
            $chk = DB::table('comment_appraisal')->where('table_no', $table_no)->where('student_id', $student_id)->where('teachers_id', Auth::user()->rank_id)->where('semester', $request->semester)->first();

            if ($chk) {
                DB::beginTransaction();
                try {
                    $dataComment = [
                        [
                            'comment_teacher' => $request->commenteacher,
                            'semester' => $request->semester,
                            'updated_at' => DATE(NOW())
                        ]
                    ];

                    // dd($dataPhysically, request()->all());
                    $chk->update($dataComment);
                    DB::table('comment_appraisal')
                        ->where('student_id', $student_id)
                        ->where('teachers_id', Auth::user()->rank_id)
                        ->where('table_no', $table_no)
                        ->update($dataComment);
                    DB::commit();
                } catch (Exception $e) {
                    DB::rollBack();
                }
            } else {
                DB::beginTransaction();
                try {
                    $dataComment = [

                        'student_id' => $student_id,
                        'teachers_id' => Auth::user()->rank_id,
                        'comment_teacher' => $request->commenteacher,
                        'table_no' => $table_no,
                        'semester' => $request->semester,
                        'created_at' => DATE(NOW())

                    ];
                    // dd($dataPhysically, request()->all());
                    DB::table('comment_appraisal')->insert($dataComment);
                    DB::commit();
                } catch (Exception $e) {
                    DB::rollBack();
                }
            }
        }


        return redirect()->back()->with('successaddappraisal', 'บันทึกข้อมูลเสร็จสิ้น');
    }




    public function commenTeacher($id)
    {

        $tcomment = DB::table('comment_appraisal')
            ->find($id);

        $student = Student::findOrFail($tcomment->student_id);
        // 
        Debugbar::info($tcomment, $student);
        // Debugbar::info($tcomment->student_id);
        return view('personal-record.commenTeacher-edit', compact('tcomment', 'student'));
    }

    public function updatecommenTeacher(Request $request, $id)
    {
        $tcomment = DB::table('comment_appraisal')
            ->find($id);
        DB::table('comment_appraisal')
            ->where('id', $id)
            ->update(['comment_teacher' => $request->commenteacher]);
        return redirect(url('teacher/record/appraisal/show/' . $tcomment->student_id));
    }

    public function viewPDF($student_id)
    {
        $student = Student::find($student_id);

        $dataphysicallysemester1 = DB::table('physically')
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', "ภาคเรียน1")
            ->get();
        $dataphysicallysemester2 = DB::table('physically')
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', "ภาคเรียน2")
            ->get();
        // dd($dataphysicallysemester2);

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

        $commenTeacher = DB::table('comment_appraisal')
            ->where('student_id', '=', $student_id)
            ->get();
        $Teacher = DB::table('students')
            ->join('teachers', 'teachers.rooms_id', '=', 'students.rooms_id')
            ->where('teachers.rooms_id', '=',  $student->rooms_id)
            ->where('teachers.rank_teacher', '=', 'ครูประจำชั้น')
            ->first();



        $SummaryPhysically = DB::table('physically')
            ->select(DB::raw('SUM(score_rate_physically) as score_physically')) //DB::raw('SUM(score_rate_physically) as score_physically
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', 'ภาคเรียน2')
            ->first();
        $SummaryPhysically2 = ($SummaryPhysically->score_physically / 60) * 100;
        // dd($SummaryPhysically->score_physically);
        // Debugbar::notice($dataphysicallysemester2);

        $SummaryMoodMind = DB::table('mood_mind')
            ->select(DB::raw('SUM(score_rate_mood_mind) as score_mood_mind'))
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', 'ภาคเรียน2')
            ->first();
        $SummaryMoodMind2 = ($SummaryMoodMind->score_mood_mind / 57) * 100;

        $SummarySocial = DB::table('social')
            ->select(DB::raw('SUM(score_rate_social) as score_social'))
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', 'ภาคเรียน2')
            ->first();
        $SummarySocial2 = ($SummarySocial->score_social / 90) * 100;

        $SummaryIntellectual = DB::table('intellectual')
            ->select(DB::raw('SUM(score_rate_intellectual) as score_intellectual'))
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', 'ภาคเรียน2')
            ->first();
        $SummaryIntellectual2 = ($SummaryIntellectual->score_intellectual / 84) * 100;
        // dd(  $SummaryMoodMind);

        // dd( $dataphysicallysemester1);
        // create new PDF document
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        // set document information
        // $pdf::SetCreator(PDF_CREATOR);
        // $pdf::SetAuthor('Nicola Asuni');
        $pdf::SetTitle($student->prefix_name . $student->first_name . ' ' . $student->last_name);
        // $pdf::SetSubject('TCPDF Tutorial');
        // $pdf::SetKeywords('TCPDF, PDF, example, test, guide');
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
        $pdf::MultiCell(36, 33, 'พัฒนาการ', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(32, 33, 'ตัวบ่งชี้', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(62, 33, 'พฤติกรรม', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(30, 8, 'ภาคเรียนที่1', 1, 'C', false, 0, '', '', true, 0, false, true, 8, 'M');
        $pdf::MultiCell(30, 8, 'ภาคเรียนที่2', 1, 'C', false, 1, '', '', true, 0, false, true, 8, 'M');

        $pdf::MultiCell(10, 24, '3 <br/> ดี ', 1, 'C', false, 0, 140, '', true, 0, true);
        $pdf::MultiCell(10, 24, '2 <br/> ปานกลาง ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '1 <br/> ควร เสริม ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '3 <br/> ดี ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '2 <br/> ปานกลาง', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '1 <br/> ควร เสริม', 1, 'C', false, 1, '', '', true, 0, true);
        // --------------------------------------------------------------------------------------------
        $pdf::MultiCell(36, 186, '<u>พัฒนาการด้านร่างกาย</u><br/> มาตรฐานที่&nbsp;1&nbsp;<br/>ร่ายกายเจริญเติบโต<br/>ตามวัยและมีสุขนิสัยที่ดี', 1, 'L', false, 0, '', '', true, 0, true, true, 33, 'T');
        $pdf::MultiCell(32, 51, '1.<br/>มีน้ำหนักส่วนสูงตามเกณ์', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(62, 17, '1.1 น้ำหนักตามเณฑ์อายุของกรมอนามัย', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[0]->score_rate_physically)) {
            if ($dataphysicallysemester1[0]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[0]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[0]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[0]->score_rate_physically)) {
            if ($dataphysicallysemester2[0]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[0]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[0]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(62, 17, '1.2 ส่วนสูงตามเกณฑ์อายุของกรม อนามัย ', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[1]->score_rate_physically)) {
            if ($dataphysicallysemester1[1]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[1]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[1]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[1]->score_rate_physically)) {
            if ($dataphysicallysemester2[1]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[1]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[1]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.3เส้นรอบศีรษะตามเกณฑ์อายุ', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[2]->score_rate_physically)) {
            if ($dataphysicallysemester1[2]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[2]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[2]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[2]->score_rate_physically)) {
            if ($dataphysicallysemester2[2]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[2]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[2]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(32, 101, '2.<br/>มีสุขภาพอนามัยสุขนิสัยที่ดี', 1, 'C', false, 0, 46, '', true, 0, true);
        $pdf::MultiCell(62, 17, '2.1 รับประทานอาหารที่มีประโยชน์และดื่มน้ำสะอาดได้ด้วยตนเอง', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[3]->score_rate_physically)) {
            if ($dataphysicallysemester1[3]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[3]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[3]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[3]->score_rate_physically)) {
            if ($dataphysicallysemester2[3]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[3]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[3]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(62, 17, '2.2 ล้างมือก่อนรับประทานอาหารและ หลังใช้ห้องส้วมได้ด้วยตนเอง', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[4]->score_rate_physically)) {
            if ($dataphysicallysemester1[4]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[4]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[4]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[4]->score_rate_physically)) {
            if ($dataphysicallysemester2[4]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[4]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[4]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(62, 16, '2.3 นอนพักผ่อนเป็นเวลา', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[5]->score_rate_physically)) {
            if ($dataphysicallysemester1[5]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 16, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 16, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 16, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[5]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 16, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 16, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 16, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[5]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 16, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 16, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 16, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 16, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 16, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 16, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[5]->score_rate_physically)) {
            if ($dataphysicallysemester2[5]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 16, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 16, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 16, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[5]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 16, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 16, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 16, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[5]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 16, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 16, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 16, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 16, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 16, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 16, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(62, 17, '2.4 ออกกำลังกายเป็นเวลา', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[6]->score_rate_physically)) {
            if ($dataphysicallysemester1[6]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[6]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[6]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[6]->score_rate_physically)) {
            if ($dataphysicallysemester2[6]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[6]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[6]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(62, 17, '2.5 อาบน้ำแต่ตัวได้แต่ไม่คล่อง', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[7]->score_rate_physically)) {
            if ($dataphysicallysemester1[7]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[7]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[7]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[7]->score_rate_physically)) {
            if ($dataphysicallysemester2[7]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[7]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[7]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(62, 17, '2.6 ขับถ่ายเป็นเวลา', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[8]->score_rate_physically)) {
            if ($dataphysicallysemester1[8]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[8]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[8]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[8]->score_rate_physically)) {
            if ($dataphysicallysemester2[8]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[8]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[8]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(32, 34, '3.<br/> รักษาความปลอดภัย ของตนเองและผู้อื่น', 1, 'C', false, 0, 46, '', true, 0, true);
        $pdf::MultiCell(62, 17, '3.1 เล่นและทำกิจกรรมอย่างปลอดภัยได้ด้วยตนเอง ', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[9]->score_rate_physically)) {
            if ($dataphysicallysemester1[9]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[9]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[9]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[9]->score_rate_physically)) {
            if ($dataphysicallysemester2[9]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[9]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[9]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(62, 17, '3.2 ระมัดระวังตนเองให้ปลอดภัยขณะ<br/>เล่นได้บางครั้ง ', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[10]->score_rate_physically)) {
            if ($dataphysicallysemester1[10]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[10]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[10]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[10]->score_rate_physically)) {
            if ($dataphysicallysemester2[10]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[10]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[10]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        // ---------------------------------------------------------------------------------------------------------------------------------------------
        $pdf::AddPage();
        // set cell padding  //ช่องว่างภายใน
        $pdf::setCellPaddings(1, 1, 1, 1);
        // --------------------------------------------------------------------------------------------
        $pdf::MultiCell(36, 33, 'พัฒนาการ', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(32, 33, 'ตัวบ่งชี้', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(62, 33, 'พฤติกรรม', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(30, 8, 'ภาคเรียนที่1', 1, 'C', false, 0, '', '', true, 0, false, true, 8, 'M');
        $pdf::MultiCell(30, 8, 'ภาคเรียนที่2', 1, 'C', false, 1, '', '', true, 0, false, true, 8, 'M');

        $pdf::MultiCell(10, 24, '3 <br/> ดี ', 1, 'C', false, 0, 140, '', true, 0, true);
        $pdf::MultiCell(10, 24, '2 <br/> ปานกลาง ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '1 <br/> ควร เสริม ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '3 <br/> ดี ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '2 <br/> ปานกลาง', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '1 <br/> ควร เสริม', 1, 'C', false, 1, '', '', true, 0, true);
        // --------------------------------------------------------------------------------------------
        $pdf::MultiCell(36, 153, '<u>พัฒนาการด้านร่างกาย</u><br/>มาตรฐานที่&nbsp;2&nbsp;<br/>กล้ามเนื้อใหญ่และ<br/>กล้ามเนื้อเล็กแข็งแรง<br/>ใช้ได้อย่างคล่องแคล่ว<br/>และประสานสัมพันธ์<br/>กัน', 1, 'L', false, 0, '', '', true, 0, true, true, 33, 'T');
        $pdf::MultiCell(32, 85, '1.<br/>เคลื่อนไหวร่างกาย อย่างคล่องแคล่ว<br/>ประสานสัมพันธ์<br/>และทรงตัวได้', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(62, 17, '1.1 เดินต่อเท้าไปข้างหน้าเป็นเส้นตรงได้ โดยไม่ต้องกางแขน', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[11]->score_rate_physically)) {
            if ($dataphysicallysemester1[11]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[11]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[11]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[11]->score_rate_physically)) {
            if ($dataphysicallysemester2[11]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[11]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[11]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.2 กระโดดขาเดียวไปอยู่กับที่ได้โดยไม่ เสียการทรงตัว', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[12]->score_rate_physically)) {
            if ($dataphysicallysemester1[12]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[12]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[12]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[12]->score_rate_physically)) {
            if ($dataphysicallysemester2[12]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[12]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[12]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.3 วิ่งหลบหลีกสิ่งกีดขวางได้', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[13]->score_rate_physically)) {
            if ($dataphysicallysemester1[13]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[13]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[13]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[13]->score_rate_physically)) {
            if ($dataphysicallysemester2[13]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[13]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[13]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.4 รับลูกบอลโดยใช้มือทั้ง 2 ข้าง', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[14]->score_rate_physically)) {
            if ($dataphysicallysemester1[14]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[14]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[14]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[14]->score_rate_physically)) {
            if ($dataphysicallysemester2[14]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[14]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[14]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.5 เดินลงบันไดสลับเท้าได้', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[15]->score_rate_physically)) {
            if ($dataphysicallysemester1[15]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[15]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[15]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[15]->score_rate_physically)) {
            if ($dataphysicallysemester2[15]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[15]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[15]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(32, 68, '2.<br/>ใช้มือ-ตาประสาท<br/>สัมพันธ์กัน', 1, 'C', false, 0, 46, '', true, 0, true);
        $pdf::MultiCell(62, 17, '2.1&nbsp;ใช้กรรไกกรตัดระดาษตามแนวเส้น ตรงได้', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[16]->score_rate_physically)) {
            if ($dataphysicallysemester1[16]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[16]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[16]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[16]->score_rate_physically)) {
            if ($dataphysicallysemester2[16]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[16]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[16]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.2&nbsp;เขียนรูปสี่เหลียมตามได้อย่างมีมุมชัดเจน', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[17]->score_rate_physically)) {
            if ($dataphysicallysemester1[17]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[17]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[17]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[17]->score_rate_physically)) {
            if ($dataphysicallysemester2[17]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[17]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[17]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.3 ร้อยวัสดุที่มีรูขนาดเส้นผ่าศูนย์กลาง 0.5 เซนติเมตรได้', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[18]->score_rate_physically)) {
            if ($dataphysicallysemester1[18]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[18]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[18]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[18]->score_rate_physically)) {
            if ($dataphysicallysemester2[18]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[18]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[18]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.4&nbsp;โยนลูกบอลไปข้างหน้าได้ไม่คล่อง<br/>แคล่ว', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[19]->score_rate_physically)) {
            if ($dataphysicallysemester1[19]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[19]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[19]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[19]->score_rate_physically)) {
            if ($dataphysicallysemester2[19]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[19]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[19]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        // --------------------------------------------------------------------------------------------
        $pdf::AddPage();
        // set cell padding  //ช่องว่างภายใน
        $pdf::setCellPaddings(1, 1, 1, 1);
        // --------------------------------------------------------------------------------------------
        $pdf::MultiCell(36, 33, 'พัฒนาการ', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(32, 33, 'ตัวบ่งชี้', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(62, 33, 'พฤติกรรม', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(30, 8, 'ภาคเรียนที่1', 1, 'C', false, 0, '', '', true, 0, false, true, 8, 'M');
        $pdf::MultiCell(30, 8, 'ภาคเรียนที่2', 1, 'C', false, 1, '', '', true, 0, false, true, 8, 'M');

        $pdf::MultiCell(10, 24, '3 <br/> ดี ', 1, 'C', false, 0, 140, '', true, 0, true);
        $pdf::MultiCell(10, 24, '2 <br/> ปานกลาง ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '1 <br/> ควร เสริม ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '3 <br/> ดี ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '2 <br/> ปานกลาง', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '1 <br/> ควร เสริม', 1, 'C', false, 1, '', '', true, 0, true);
        // --------------------------------------------------------------------------------------------
        $pdf::MultiCell(36, 102, '<u>พัฒนาการด้านอารมณ์และจิตใจ</u><br/>มาตรฐานที่&nbsp;3&nbsp;<br/>มีสุขภาพจิตดีและมี<br/>ความสุข', 1, 'L', false, 0, '', '', true, 0, true, true, 33, 'T');
        $pdf::MultiCell(32, 34, '1.<br/>แสดงออกทาง<br/>อารมณ์ได้อย่าง<br/>เหนาะสม', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(62, 17, '1.1&nbsp;แสดงอารมณ์ความรู้สึกได้ตามสถานการณ์', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($datamood_mindsemester1[0]->score_rate_mood_mind)) {
            if ($datamood_mindsemester1[0]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[0]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[0]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datamood_mindsemester2[0]->score_rate_mood_mind)) {
            if ($datamood_mindsemester2[0]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[0]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[0]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.2 ร่าเริง สดชื่น แจ่มใส และอารมณ์ดี', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datamood_mindsemester1[1]->score_rate_mood_mind)) {
            if ($datamood_mindsemester1[1]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[1]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[1]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datamood_mindsemester2[1]->score_rate_mood_mind)) {
            if ($datamood_mindsemester2[1]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[1]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[1]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(32, 68, '2.<br/>มีความรู้สึกดีต่อตน เองและผู้อื่น', 1, 'C', false, 0, 46, '', true, 0, true);
        $pdf::MultiCell(62, 17, '2.1 กล้าพูดกล้าแสดงออกอย่างเหมาะสมบางสถานการณ์', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($datamood_mindsemester1[2]->score_rate_mood_mind)) {
            if ($datamood_mindsemester1[2]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[2]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[2]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datamood_mindsemester2[2]->score_rate_mood_mind)) {
            if ($datamood_mindsemester2[2]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[2]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[2]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.2 แสดงความพอใจในผลงานและความสามารถจองตนเอง', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datamood_mindsemester1[3]->score_rate_mood_mind)) {
            if ($datamood_mindsemester1[3]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[3]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[3]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datamood_mindsemester2[3]->score_rate_mood_mind)) {
            if ($datamood_mindsemester2[3]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[3]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[3]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.3 มีความมั่นใจในตนเอง', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datamood_mindsemester1[4]->score_rate_mood_mind)) {
            if ($datamood_mindsemester1[4]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[4]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[4]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datamood_mindsemester2[4]->score_rate_mood_mind)) {
            if ($datamood_mindsemester2[4]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[4]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[4]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.4 รับรู้ความรู้สึกผู้อื่นและปลอบโยน<br/>เมื่อผู้อื่นเสียใจ', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datamood_mindsemester1[5]->score_rate_mood_mind)) {
            if ($datamood_mindsemester1[5]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[5]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[5]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datamood_mindsemester2[5]->score_rate_mood_mind)) {
            if ($datamood_mindsemester2[5]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[5]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[5]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(36, 68, '<u>พัฒนาการด้านอารมณ์  และจิตใจ</u><br/>มาตรฐานที่&nbsp;4&nbsp;<br/>ชื่นชมและแสดงออก ทางศิลปะ ครตรี และการเคลื่อนไหว', 1, 'L', false, 0, '', '', true, 0, true, true, 33, 'T');
        $pdf::MultiCell(32, 68, '1.<br/>สนใจมีความสุขและแสดงออกผ่านงาน<br/>ศิลปะคนตรีและการเคลื่อนไหว', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(62, 17, '1.1 สนใจมีความสุขและแสดงออกผ่าน<br/>งานศิลปะ', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($datamood_mindsemester1[6]->score_rate_mood_mind)) {
            if ($datamood_mindsemester1[6]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[6]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[6]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datamood_mindsemester2[6]->score_rate_mood_mind)) {
            if ($datamood_mindsemester2[6]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[6]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[6]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.2 สนใจมีความสุขและแสดงออกผ่าน<br/>เสียงเลงดนตรี', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datamood_mindsemester1[7]->score_rate_mood_mind)) {
            if ($datamood_mindsemester1[7]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[7]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[7]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datamood_mindsemester2[7]->score_rate_mood_mind)) {
            if ($datamood_mindsemester2[7]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[7]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[7]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.3 สนใจมีความสุขและแสดงท่าทาง/<br/>เคลื่อนไหวประกอบเลงจังหวะและดนตรี', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datamood_mindsemester1[8]->score_rate_mood_mind)) {
            if ($datamood_mindsemester1[8]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[8]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[8]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datamood_mindsemester2[8]->score_rate_mood_mind)) {
            if ($datamood_mindsemester2[8]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[8]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[8]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.4&nbsp;สนใจแล้วมีความสุขขณะทำงาน<br/>ศิลปะ', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datamood_mindsemester1[9]->score_rate_mood_mind)) {
            if ($datamood_mindsemester1[9]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[9]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[9]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datamood_mindsemester2[9]->score_rate_mood_mind)) {
            if ($datamood_mindsemester2[9]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[9]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[9]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        // --------------------------------------------------------------------------------------------
        $pdf::AddPage();
        // set cell padding  //ช่องว่างภายใน
        $pdf::setCellPaddings(1, 1, 1, 1);
        // --------------------------------------------------------------------------------------------
        $pdf::MultiCell(36, 33, 'พัฒนาการ', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(32, 33, 'ตัวบ่งชี้', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(62, 33, 'พฤติกรรม', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(30, 8, 'ภาคเรียนที่1', 1, 'C', false, 0, '', '', true, 0, false, true, 8, 'M');
        $pdf::MultiCell(30, 8, 'ภาคเรียนที่2', 1, 'C', false, 1, '', '', true, 0, false, true, 8, 'M');

        $pdf::MultiCell(10, 24, '3 <br/> ดี ', 1, 'C', false, 0, 140, '', true, 0, true);
        $pdf::MultiCell(10, 24, '2 <br/> ปานกลาง ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '1 <br/> ควร เสริม ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '3 <br/> ดี ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '2 <br/> ปานกลาง', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '1 <br/> ควร เสริม', 1, 'C', false, 1, '', '', true, 0, true);
        // --------------------------------------------------------------------------------------------
        $pdf::MultiCell(36, 153, '<u>พัฒนาการด้านอารมณ์และจิตใจ</u><br/>มาตรฐานที่&nbsp;5&nbsp;<br/>มีคุณธรรม จริยธรรม และ จิตใจที่ดีงาม', 1, 'L', false, 0, '', '', true, 0, true, true, 33, 'T');
        $pdf::MultiCell(32, 34, '1.<br/>ซื่อสีตย์สุจริต', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(62, 17, '1.1 ขออนุญาตหรือรอคอยเมื่อต้องการ<br/>สิ่งของของผู้อื่นเมื่อมีผู้ชี้เนะ', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($datamood_mindsemester1[10]->score_rate_mood_mind)) {
            if ($datamood_mindsemester1[10]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[10]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[10]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datamood_mindsemester2[10]->score_rate_mood_mind)) {
            if ($datamood_mindsemester2[10]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[10]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[10]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.2 รู้จักขอโทษเมื่อมีผู้ชี้เนะ', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datamood_mindsemester1[11]->score_rate_mood_mind)) {
            if ($datamood_mindsemester1[11]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[11]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[11]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datamood_mindsemester2[11]->score_rate_mood_mind)) {
            if ($datamood_mindsemester2[11]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[11]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[11]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(32, 51, '2.<br/>มีความเมตากรุณา มีน้ำใจ และช่วยเหลือแบ่งปัน', 1, 'C', false, 0, 46, '', true, 0, true);
        $pdf::MultiCell(62, 17, '2.1 แสดงความรักต่อเพื่อนและมีเมตตา<br/>ต่อสัตว์เลี้ยง', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($datamood_mindsemester1[12]->score_rate_mood_mind)) {
            if ($datamood_mindsemester1[12]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[12]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[12]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datamood_mindsemester2[12]->score_rate_mood_mind)) {
            if ($datamood_mindsemester2[12]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[12]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[12]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.2 ช่วยเหลือผู้อื่นได้เมื่อมีผู้ชี้เนะ', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datamood_mindsemester1[13]->score_rate_mood_mind)) {
            if ($datamood_mindsemester1[13]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[13]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[13]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datamood_mindsemester2[13]->score_rate_mood_mind)) {
            if ($datamood_mindsemester2[13]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[13]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[13]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.3 มีจิตสาธารณะ', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datamood_mindsemester1[14]->score_rate_mood_mind)) {
            if ($datamood_mindsemester1[14]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[14]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[14]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datamood_mindsemester2[14]->score_rate_mood_mind)) {
            if ($datamood_mindsemester2[14]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[14]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[14]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(32, 34, '3.<br/>มีความเห็นอกเห็น ใจผู้อื่น', 1, 'C', false, 0, 46, '', true, 0, true);
        $pdf::MultiCell(62, 17, '3.1&nbsp;แสดงสีหน้าท่าทางรับรู้ความรู้สิกของผู้อื่น', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($datamood_mindsemester1[15]->score_rate_mood_mind)) {
            if ($datamood_mindsemester1[15]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[15]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[15]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datamood_mindsemester2[15]->score_rate_mood_mind)) {
            if ($datamood_mindsemester2[15]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[15]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[15]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '3.2 รับรู้ความรู้ศึกผู้อื่นและปลอบโยน<br/>เมื่อผู้อื่นเสียใจ', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datamood_mindsemester1[16]->score_rate_mood_mind)) {
            if ($datamood_mindsemester1[16]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[16]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[16]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datamood_mindsemester2[16]->score_rate_mood_mind)) {
            if ($datamood_mindsemester2[16]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[16]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[16]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(32, 34, '4.<br/>มีความรับผิดชอบ', 1, 'C', false, 0, 46, '', true, 0, true);
        $pdf::MultiCell(62, 17, '4.1 ทำงานที่ได้รับมอบหมายจนสำเร็จ<br/>เมื่อมีผู้ชี้เนะ', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($datamood_mindsemester1[17]->score_rate_mood_mind)) {
            if ($datamood_mindsemester1[17]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[17]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[17]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datamood_mindsemester2[17]->score_rate_mood_mind)) {
            if ($datamood_mindsemester2[17]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[17]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[17]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '4.2 รักษาสิงของที่ใช้ร่วมกัน', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datamood_mindsemester1[18]->score_rate_mood_mind)) {
            if ($datamood_mindsemester1[18]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[18]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[18]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datamood_mindsemester2[18]->score_rate_mood_mind)) {
            if ($datamood_mindsemester2[18]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[18]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[18]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        // --------------------------------------------------------------------------------------------
        $pdf::AddPage();
        // set cell padding  //ช่องว่างภายใน
        $pdf::setCellPaddings(1, 1, 1, 1);
        // --------------------------------------------------------------------------------------------
        $pdf::MultiCell(36, 33, 'พัฒนาการ', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(32, 33, 'ตัวบ่งชี้', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(62, 33, 'พฤติกรรม', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(30, 8, 'ภาคเรียนที่1', 1, 'C', false, 0, '', '', true, 0, false, true, 8, 'M');
        $pdf::MultiCell(30, 8, 'ภาคเรียนที่2', 1, 'C', false, 1, '', '', true, 0, false, true, 8, 'M');

        $pdf::MultiCell(10, 24, '3 <br/> ดี ', 1, 'C', false, 0, 140, '', true, 0, true);
        $pdf::MultiCell(10, 24, '2 <br/> ปานกลาง ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '1 <br/> ควร เสริม ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '3 <br/> ดี ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '2 <br/> ปานกลาง', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '1 <br/> ควร เสริม', 1, 'C', false, 1, '', '', true, 0, true);
        // --------------------------------------------------------------------------------------------
        $pdf::MultiCell(36, 153, '<u>พัฒนาการด้านสังคม</u><br/>มาตรฐานที่&nbsp;6&nbsp;<br/>มีทักกษะชีวิตและ<br/>ปฎิบัติตามหลักปรัชญาของเศรษฐกิจพอเพียง', 1, 'L', false, 0, '', '', true, 0, true, true, 33, 'T');
        $pdf::MultiCell(32, 68, '1.<br/>ช่วยเหลือตนเองใน<br/>การปฎิบัติกิจวัตร<br/>ประจำวัน', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(62, 17, '1.1 แต่ตัวได้ด้วยตนเอง', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[0]->score_rate_social)) {
            if ($datasocialsemester1[0]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[0]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[0]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[0]->score_rate_social)) {
            if ($datasocialsemester2[0]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[0]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[0]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.2 รับประทานอาหารด้วนตนเอง', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[1]->score_rate_social)) {
            if ($datasocialsemester1[1]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[1]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[1]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[1]->score_rate_social)) {
            if ($datasocialsemester2[1]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[1]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[1]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.3 ใช้ห้องน้ำ ห้องส้วมด้วยตนเอง', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[2]->score_rate_social)) {
            if ($datasocialsemester1[2]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[2]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[2]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[2]->score_rate_social)) {
            if ($datasocialsemester2[2]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[2]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[2]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.4 ระมัดระวังดูแลตนเองและผู้อื่นให้<br/>ปลอดภัยโดยมีผู้อื่นคอยตักเตือนบ้าง', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[3]->score_rate_social)) {
            if ($datasocialsemester1[3]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[3]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[3]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[3]->score_rate_social)) {
            if ($datasocialsemester2[3]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[3]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[3]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(32, 51, '2.<br/>มีวินัยในตนเอง', 1, 'C', false, 0, 46, '', true, 0, true);
        $pdf::MultiCell(62, 17, '2.1 เก็บของเล่น ของใช้เข้าที่ด้วยตนเอง', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[4]->score_rate_social)) {
            if ($datasocialsemester1[4]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[4]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[4]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[4]->score_rate_social)) {
            if ($datasocialsemester2[4]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[4]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[4]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.2 เข้าแถวตามลำดับกก่อน-หลัง ได้ด้วยตนเอง', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[5]->score_rate_social)) {
            if ($datasocialsemester1[5]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[5]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[5]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[5]->score_rate_social)) {
            if ($datasocialsemester2[5]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[5]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[5]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.3 ทึ้งขยะเป็นที่ได้แต่ไม่เรียบร้อย', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[6]->score_rate_social)) {
            if ($datasocialsemester1[6]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[6]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[6]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[6]->score_rate_social)) {
            if ($datasocialsemester2[6]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[6]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[6]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(32, 34, '3.<br/>ประหยัดพอเพียง', 1, 'C', false, 0, 46, '', true, 0, true);
        $pdf::MultiCell(62, 17, '3.1 ใช้สิงของเครื่องใช้อย่างประหยัดและพอเพียงเมื่อมีผู้ชี้เนะ', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[7]->score_rate_social)) {
            if ($datasocialsemester1[7]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[7]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[7]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[7]->score_rate_social)) {
            if ($datasocialsemester2[7]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[7]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[7]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '3.2 รักกษาสิ่งของที่ใช้ร่วมกัน', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[8]->score_rate_social)) {
            if ($datasocialsemester1[8]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[8]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[8]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[8]->score_rate_social)) {
            if ($datasocialsemester2[8]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[8]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[8]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(36, 51, '<u>พัฒนาการด้านสังคม</u><br/>มาตรฐานที่&nbsp;7&nbsp;<br/>รักธรรมชาติสิ่งแวด<br/>ล้อมและความเป็นไทย', 1, 'L', false, 0, '', '', true, 0, true, true, 33, 'T');
        $pdf::MultiCell(32, 51, '1.<br/>ดูแลรักษาธรรมชาติและสิ่งแวดล้อม', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(62, 17, '1.1 มีส่วนร่วมดูแลรักษาธรรมชาติและสิ่งแวดล้อมเมื่อมีผู้ชี้แนะ', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[9]->score_rate_social)) {
            if ($datasocialsemester1[9]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[9]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[9]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[9]->score_rate_social)) {
            if ($datasocialsemester2[9]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[9]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[9]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.2 ทิ้งขยะได้ถูกที่', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[10]->score_rate_social)) {
            if ($datasocialsemester1[10]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[10]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[10]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[10]->score_rate_social)) {
            if ($datasocialsemester2[10]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[10]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[10]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.3 ปิดน้ำหลังการใช้ทันที', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[11]->score_rate_social)) {
            if ($datasocialsemester1[11]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[11]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[11]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[11]->score_rate_social)) {
            if ($datasocialsemester2[11]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[11]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[11]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        // --------------------------------------------------------------------------------------------
        $pdf::AddPage();
        // set cell padding  //ช่องว่างภายใน
        $pdf::setCellPaddings(1, 1, 1, 1);
        // --------------------------------------------------------------------------------------------
        $pdf::MultiCell(36, 33, 'พัฒนาการ', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(32, 33, 'ตัวบ่งชี้', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(62, 33, 'พฤติกรรม', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(30, 8, 'ภาคเรียนที่1', 1, 'C', false, 0, '', '', true, 0, false, true, 8, 'M');
        $pdf::MultiCell(30, 8, 'ภาคเรียนที่2', 1, 'C', false, 1, '', '', true, 0, false, true, 8, 'M');

        $pdf::MultiCell(10, 24, '3 <br/> ดี ', 1, 'C', false, 0, 140, '', true, 0, true);
        $pdf::MultiCell(10, 24, '2 <br/> ปานกลาง ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '1 <br/> ควร เสริม ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '3 <br/> ดี ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '2 <br/> ปานกลาง', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '1 <br/> ควร เสริม', 1, 'C', false, 1, '', '', true, 0, true);
        // --------------------------------------------------------------------------------------------
        $pdf::MultiCell(36, 81, ' ', 1, 'L', false, 0, '', '', true, 0, true, true, 33, 'T');
        $pdf::MultiCell(32, 81, '2.<br/>มีมารยาทตาม<br/>วัฒนธรรมไทยและ<br/>รักความเป็นไทย', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(62, 15, '2.1 ปฎิบัติตามมารยาทไทยด้วยตนเอง', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[12]->score_rate_social)) {
            if ($datasocialsemester1[12]->score_rate_social == 1) {
                $pdf::MultiCell(10, 15, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 15, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 15, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[12]->score_rate_social == 2) {
                $pdf::MultiCell(10, 15, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 15, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 15, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[12]->score_rate_social == 3) {
                $pdf::MultiCell(10, 15, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[12]->score_rate_social)) {
            if ($datasocialsemester2[12]->score_rate_social == 1) {
                $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 15, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[12]->score_rate_social == 2) {
                $pdf::MultiCell(10, 15, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 15, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 15, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[12]->score_rate_social == 3) {
                $pdf::MultiCell(10, 15, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.2&nbsp;กล่าวคำจอบคุณและขอโทษด้วยตน เอง', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[13]->score_rate_social)) {
            if ($datasocialsemester1[13]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[13]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[13]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[13]->score_rate_social)) {
            if ($datasocialsemester2[13]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[13]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[13]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.3 ยืนตรงเมื่อได้ยินเสียงเพลงชาติไทย และเพลงสรรเสริญพระบารมี', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[14]->score_rate_social)) {
            if ($datasocialsemester1[14]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[14]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[14]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[14]->score_rate_social)) {
            if ($datasocialsemester2[14]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[14]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[14]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.4 มีสัมมาคารวะและมารยาทตามวัฒนธรรมไทย', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[15]->score_rate_social)) {
            if ($datasocialsemester1[15]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[15]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[15]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[15]->score_rate_social)) {
            if ($datasocialsemester2[15]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[15]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[15]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 15, '2.5 รักความเป็นไทย', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[16]->score_rate_social)) {
            if ($datasocialsemester1[16]->score_rate_social == 1) {
                $pdf::MultiCell(10, 15, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 15, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 15, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[16]->score_rate_social == 2) {
                $pdf::MultiCell(10, 15, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 15, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 15, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[16]->score_rate_social == 3) {
                $pdf::MultiCell(10, 15, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[16]->score_rate_social)) {
            if ($datasocialsemester2[16]->score_rate_social == 1) {
                $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 15, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[16]->score_rate_social == 2) {
                $pdf::MultiCell(10, 15, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 15, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 15, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[16]->score_rate_social == 3) {
                $pdf::MultiCell(10, 15, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(36, 151, '<u>พัฒนาการด้านสังคม</u><br/>มาตรฐานที่&nbsp;8&nbsp;<br/>อยู่ร่วมกับผู้อื่นได้อย่างมีความสุขและปฎิบัติ<br/>ตนเป็นสมาชิกที่ดีของ<br/>สังคมในระบอกประชาธิปไตยอันมีพระมหา กษัตริย์ทรงเป็นประมุข', 1, 'L', false, 0, '', '', true, 0, true, true, 33, 'T');
        $pdf::MultiCell(32, 66, '1.<br/>ยอมรับความเหมือนความแตกต่างระ<br/>หว่างบุคคล', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(62, 17, '1.1 เล่นและทำกิจกรรมร่วมกกับเด็กที่<br/>แตกต่างไปจากตน', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[17]->score_rate_social)) {
            if ($datasocialsemester1[17]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[17]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[17]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[17]->score_rate_social)) {
            if ($datasocialsemester2[17]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[17]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[17]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.2 บอกกความเหมืนหรือความแตกต่างระหว่างตัวเองและผู้อื่นได้', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[18]->score_rate_social)) {
            if ($datasocialsemester1[18]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[18]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[18]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[18]->score_rate_social)) {
            if ($datasocialsemester2[18]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[18]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[18]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 32, '1.3 เล่นและทำกิจกรรมร่วมกับเด็กที่แตกต่างไปจากตนได้ เช่นต่างภาษา เชื้อชาติ<br/>พื้นเพทางสังคมหรือมีความบกพร่องทางร่างกาย', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[19]->score_rate_social)) {
            if ($datasocialsemester1[19]->score_rate_social == 1) {
                $pdf::MultiCell(10, 32, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 32, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 32, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[19]->score_rate_social == 2) {
                $pdf::MultiCell(10, 32, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 32, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 32, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[19]->score_rate_social == 3) {
                $pdf::MultiCell(10, 32, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[19]->score_rate_social)) {
            if ($datasocialsemester2[19]->score_rate_social == 1) {
                $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 32, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[19]->score_rate_social == 2) {
                $pdf::MultiCell(10, 32, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 32, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 32, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[19]->score_rate_social == 3) {
                $pdf::MultiCell(10, 32, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(32, 85, '2.<br/>มีปฎิสัมพันธ์ทีดีกับ<br/>ผู้อื่น', 1, 'C', false, 0, 46, '', true, 0, true);
        $pdf::MultiCell(62, 17, '2.1 เล่นหรือทำงานร่วมกับเพื่อนเป็นลุ่ม', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[20]->score_rate_social)) {
            if ($datasocialsemester1[20]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[20]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[20]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[20]->score_rate_social)) {
            if ($datasocialsemester2[20]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[20]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[20]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.2 ยิ้ม ทักทาย หรือพูดคุยกับผู้ใหญ่และบุคคลที่คุ้นเคยได้ด้วนตนเอง', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[21]->score_rate_social)) {
            if ($datasocialsemester1[21]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[21]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[21]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[21]->score_rate_social)) {
            if ($datasocialsemester2[21]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[21]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[21]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.3 เข้าร่วมกิจกรรมกลุ่มได้นานขึ้น', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[22]->score_rate_social)) {
            if ($datasocialsemester1[22]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[22]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[22]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[22]->score_rate_social)) {
            if ($datasocialsemester2[22]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[22]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[22]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.4 แบ่นปันกันเพื่อนและผลัดกันเล่นโดยมีผู้ใหญ่แนะนำ', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[23]->score_rate_social)) {
            if ($datasocialsemester1[23]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[23]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[23]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[23]->score_rate_social)) {
            if ($datasocialsemester2[23]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[23]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[23]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.5 ประนีประนอมแก้ไขปัญหาร่วมกับผู้นอื่นได้', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[24]->score_rate_social)) {
            if ($datasocialsemester1[24]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[24]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[24]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[24]->score_rate_social)) {
            if ($datasocialsemester2[24]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[24]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[24]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        // --------------------------------------------------------------------------------------------
        $pdf::AddPage();
        // set cell padding  //ช่องว่างภายใน
        $pdf::setCellPaddings(1, 1, 1, 1);
        // --------------------------------------------------------------------------------------------
        $pdf::MultiCell(36, 33, 'พัฒนาการ', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(32, 33, 'ตัวบ่งชี้', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(62, 33, 'พฤติกรรม', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(30, 8, 'ภาคเรียนที่1', 1, 'C', false, 0, '', '', true, 0, false, true, 8, 'M');
        $pdf::MultiCell(30, 8, 'ภาคเรียนที่2', 1, 'C', false, 1, '', '', true, 0, false, true, 8, 'M');

        $pdf::MultiCell(10, 24, '3 <br/> ดี ', 1, 'C', false, 0, 140, '', true, 0, true);
        $pdf::MultiCell(10, 24, '2 <br/> ปานกลาง ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '1 <br/> ควร เสริม ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '3 <br/> ดี ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '2 <br/> ปานกลาง', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '1 <br/> ควร เสริม', 1, 'C', false, 1, '', '', true, 0, true);
        // --------------------------------------------------------------------------------------------
        $pdf::MultiCell(36, 92, ' ', 1, 'L', false, 0, '', '', true, 0, true, true, 33, 'T');
        $pdf::MultiCell(32, 92, '3.<br/>ปฎิบัติตนเบื้องต้นในการเป็นสมาชิกที่ดี ของสังคม', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(62, 17, '3.1 มีส่วนร่วมในการสร้างข้อตกลงและ ปฎิบัติตามข้อตกลงเมื่อมีผู้ชี้แนะ', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[25]->score_rate_social)) {
            if ($datasocialsemester1[25]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[25]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[25]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[25]->score_rate_social)) {
            if ($datasocialsemester2[25]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[25]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[25]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '3.2&nbsp;ปฎิบัติตนเป็นผู้นำและผู้ตามได้ด้วน ตนเอง', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[26]->score_rate_social)) {
            if ($datasocialsemester1[26]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[26]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[26]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[26]->score_rate_social)) {
            if ($datasocialsemester2[26]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[26]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[26]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '3.3 ประนีประนอมแก้ไข้ปัญหาโดยปราศจากความรุนแรงเมื่อมีผู้ชี้แนะ', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[27]->score_rate_social)) {
            if ($datasocialsemester1[27]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[27]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[27]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[27]->score_rate_social)) {
            if ($datasocialsemester2[27]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[27]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[27]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '3.4 เยืนตรงเคารพพธงชาติร้องเพลงชาติ', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[28]->score_rate_social)) {
            if ($datasocialsemester1[28]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[28]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[28]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[28]->score_rate_social)) {
            if ($datasocialsemester2[28]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[28]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[28]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 24, '3.5 เข้าร่วมกกิจกรรมที่เกี่ยวกับสถาบัน พระมหากกษัตริย์ตามที่โรงเรียนและชุม ชนจัดขึ้น', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[29]->score_rate_social)) {
            if ($datasocialsemester1[29]->score_rate_social == 1) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[29]->score_rate_social == 2) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[29]->score_rate_social == 3) {
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[29]->score_rate_social)) {
            if ($datasocialsemester2[29]->score_rate_social == 1) {
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[29]->score_rate_social == 2) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[29]->score_rate_social == 3) {
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(36, 136, '<u>พัฒนาการด้านสติปัญญา</u><br/>มาตรฐานที่&nbsp;9&nbsp;<br/>ใช้ภาษาสื่อสารได้<br/>เหมาะสม', 1, 'L', false, 0, '', '', true, 0, true, true, 33, 'T');
        $pdf::MultiCell(32, 85, '1.<br/>สนทนาโต้ตอบและ เล่าเรื่องให้ผู้อื่นเข้า ใจ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(62, 17, '1.1 ฟังผู้อื่นพูดจนจบและสนทนาโต้ตอบสอดคล้องกับเรื่องที่ฟัง', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[0]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[0]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[0]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[0]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[0]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[0]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[0]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[0]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.2 เล่าเป็นเรื่องราวต่อเนื่องได้', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[1]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[1]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[1]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[1]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[1]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[1]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[1]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[1]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.3&nbsp;ฟังคำสัง&nbsp;2&nbsp;ขั้นตอนและสามารถ<br/>ปฎิบัติได้ ', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[2]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[2]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[2]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[2]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[2]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[2]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[2]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[2]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.4 พูดโต้ตอบและเล่าเรื่องเป็นประโยค อย่างต่อเนื่อง', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[3]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[3]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[3]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[3]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[3]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[3]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[3]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[3]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.5 ฟัง พูด โต้ตอบและแสดงความรู้สึก<br/>เกี่ยวกับเรื่องที่ฟังได้', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[4]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[4]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[4]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[4]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[4]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[4]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[4]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[4]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }


        $pdf::MultiCell(32, 51, '2.<br/>อ่านเขียนภาพและ<br/>สัญลักญณ์ได้', 1, 'C', false, 0, 46, '', true, 0, true);
        $pdf::MultiCell(62, 17, '2.1 อ่านภาพ สัญลักษณ์ คำ พร้อมทั้งชี้ หรือ กวาดตามองข้อความตามบรรทัด', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[5]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[5]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[5]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[5]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[5]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[5]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[5]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[5]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.2 เขียนคล้ายตัวอักษร', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[6]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[6]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[6]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[6]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[6]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[6]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[6]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[6]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.3 เปิดและอ่านหนังสือด้วนตนเอง', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[7]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[7]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[7]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[7]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[7]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[7]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[7]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[7]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        // --------------------------------------------------------------------------------------------
        $pdf::AddPage();
        // set cell padding  //ช่องว่างภายใน
        $pdf::setCellPaddings(1, 1, 1, 1);
        // --------------------------------------------------------------------------------------------
        $pdf::MultiCell(36, 33, 'พัฒนาการ', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(32, 33, 'ตัวบ่งชี้', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(62, 33, 'พฤติกรรม', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(30, 8, 'ภาคเรียนที่1', 1, 'C', false, 0, '', '', true, 0, false, true, 8, 'M');
        $pdf::MultiCell(30, 8, 'ภาคเรียนที่2', 1, 'C', false, 1, '', '', true, 0, false, true, 8, 'M');

        $pdf::MultiCell(10, 24, '3 <br/> ดี ', 1, 'C', false, 0, 140, '', true, 0, true);
        $pdf::MultiCell(10, 24, '2 <br/> ปานกลาง ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '1 <br/> ควร เสริม ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '3 <br/> ดี ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '2 <br/> ปานกลาง', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '1 <br/> ควร เสริม', 1, 'C', false, 1, '', '', true, 0, true);
        // --------------------------------------------------------------------------------------------
        $pdf::MultiCell(36, 198, '<u>พัฒนาการด้านสติปัญญา</u><br/>มาตรฐานที่&nbsp;10&nbsp;<br/>มีความสามารถในการคิดเป็นพื้นฐานในการ<br/>เรียนรู้', 1, 'L', false, 0, '', '', true, 0, true, true, 33, 'T');
        $pdf::MultiCell(32, 99, '1.<br/>มีความสามารถใน การคิดรวบยอด', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(62, 24, '1.1 บอกลักษณะส่วนประกอบของสิ่ง<br/>ของต่างๆจากกการสังเกตโดยใช้ประสาท<br/>สัมผัส', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[8]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[8]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[8]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[8]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[8]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[8]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[8]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[8]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 24, '1.2 จับคู่และเปรียบเทียบความแตกต่าง หรือความเหมือนของสิ่งต่างๆโดยใช้<br/>ลักษณะที่สังเกตพบเพียงลักกษณะเดียว', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[9]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[9]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[9]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[9]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[9]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[9]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[9]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[9]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.3 จำแนกและจัดกลุ่มสิ่งต่างๆ โดยใช้<br/>อย่างน้อย 1 ลักกษณะเป็นเกณฑ์', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[10]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[10]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[10]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[10]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[10]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[10]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[10]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[10]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.4 เรียงลำดับสิ่งของหรือเหตุกการณ์<br/>อย่างน้อย 4 ลำดับ', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[11]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[11]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[11]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[11]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[11]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[11]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[11]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[11]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.5 แก้ปัญหาด้วยวิธีการต่างๆ&nbsp;โดยการ ลองผิดลองถูกด้วยตนเอง', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[12]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[12]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[12]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[12]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[12]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[12]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[12]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[12]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(32, 41, '2.<br/>มีความสามารถใน การคิดเชิงเหตุผล', 1, 'C', false, 0, 46, '', true, 0, true);
        $pdf::MultiCell(62, 17, '2.1 ระบุสาเหตุหรือผผลที่เกิดขึ้นในเหตุ การณ์หรือการกระทำเมื่อมีผู้ชี้แนะ', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[13]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[13]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[13]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[13]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[13]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[13]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[13]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[13]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 24, '2.2 คาดเดาหรือคาดคะเนสิ่งที่อาดเกิน<br/>ขึ้นหรือมีส่วนร่วมในการลงความเห็นจากข้อมูล', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[14]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[14]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[14]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[14]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[14]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[14]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[14]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[14]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(32, 58, '3.<br/>มีความสามารถใน<br/>การคิดแก้ปัญหา<br/>และตัดสินใจ', 1, 'C', false, 0, 46, '', true, 0, true);
        $pdf::MultiCell(62, 17, '3.1 ตัดสินใจในเรื่องง่ายๆ&nbsp;และเริ่มเรียนรู้ผลที่เกิดขึ้น', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[15]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[15]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[15]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[15]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[15]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[15]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[15]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[15]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '3.2 ระบุปัญหาโดยลองผิดลองถูก', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[16]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[16]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[16]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[16]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[16]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[16]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[16]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[16]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 24, '3.3 ให้เตุผผลในการคาดคะแนการลง<br/>ความเห็นหรือการลงข้อสรุปเพื่ออธิบาย<br/>เกี่ยวกับสิ่งที่สังเกตหรือเรียนรู้', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[17]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[17]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[17]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[17]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[17]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[17]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[17]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[17]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        // --------------------------------------------------------------------------------------------
        $pdf::AddPage();
        // set cell padding  //ช่องว่างภายใน
        $pdf::setCellPaddings(1, 1, 1, 1);
        // --------------------------------------------------------------------------------------------
        $pdf::MultiCell(36, 33, 'พัฒนาการ', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(32, 33, 'ตัวบ่งชี้', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(62, 33, 'พฤติกรรม', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(30, 8, 'ภาคเรียนที่1', 1, 'C', false, 0, '', '', true, 0, false, true, 8, 'M');
        $pdf::MultiCell(30, 8, 'ภาคเรียนที่2', 1, 'C', false, 1, '', '', true, 0, false, true, 8, 'M');

        $pdf::MultiCell(10, 24, '3 <br/> ดี ', 1, 'C', false, 0, 140, '', true, 0, true);
        $pdf::MultiCell(10, 24, '2 <br/> ปานกลาง ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '1 <br/> ควร เสริม ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '3 <br/> ดี ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '2 <br/> ปานกลาง', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '1 <br/> ควร เสริม', 1, 'C', false, 1, '', '', true, 0, true);
        // --------------------------------------------------------------------------------------------
        $pdf::MultiCell(36, 112, '<u>พัฒนาการด้านสติปัญญา</u><br/>มาตรฐานที่&nbsp;11&nbsp;<br/>มีจินตนาการและ<br/>ความคิดสร้างสรรค์', 1, 'L', false, 0, '', '', true, 0, true, true, 33, 'T');
        $pdf::MultiCell(32, 56, '1.<br/>ทำงานศิลปะตาม<br/>จินตนาการและความคิดสร้างสรรค์', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(62, 32, '1.1 สร้างผลงานศิลปะเพื่อสื่อสานความ<br/>รู้สึกของตนเองโดยมีการดัดแปลงและ<br/>แปลกใหม่จากเดิมหรือมีรายละเอียดเพิ่มขึ้น', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[18]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[18]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 32, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 32, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 32, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[18]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 32, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 32, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 32, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[18]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 32, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[18]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[18]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 32, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[18]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 32, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 32, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 32, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[18]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 32, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 24, '1.2 เล่น/ทำงานศิลปะตามจินตนาการ<br/>ของตนเองโดนมีลักษณะคิดริเริ่มคิดคล่อง<br/>แคล่วคิดยึดหยุ่นและคิดละเอียดลออ', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[19]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[19]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[19]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[19]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[19]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[19]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[19]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[19]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(32, 56, '2.<br/>แสดงท่าทาง/เคลื่อนไหวตามจินตนาการอย่างสร้างสรรค์', 1, 'C', false, 0, 46, '', true, 0, true);
        $pdf::MultiCell(62, 24, '2.1 เคลื่อนไหวท่าทางเพพื่อสื่อสารความคิดความรู้สึกของตนเองอย่างหลากหลายหรือแปลกใหม่', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[20]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[20]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[20]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[20]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[20]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[20]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[20]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[20]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 32, '2.2 แสดงท่าทาง/เลื่อนไหว/เล่นบทบาทสมมุติตามจินตนาการของตนเองและท่าทาง/การเลื่อนไหวมีลักษณะคิดริเริ่มคิดคล่องแคล่ว คิดยึดหยุ่นและคิดละอียดลออ', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[21]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[21]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 32, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 32, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 32, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[21]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 32, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 32, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 32, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[21]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 32, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[21]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[21]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 32, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[21]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 32, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 32, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 32, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[21]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 32, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(36, 102, '<u>พัฒนาการด้านสติปัญญา</u><br/>มาตรฐานที่&nbsp;12&nbsp;<br/>มีเจคติที่ดีต่อการเรียนรู้และมีความสามารถในการแสวงหาความรู้ได้ เหมาะสมกับวัย', 1, 'L', false, 0, '', '', true, 0, true, true, 33, 'T');
        $pdf::MultiCell(32, 51, '1.<br/>มีเจคติที่ดีต่อการ<br/>เรียนรู้', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(62, 17, '1.1 สนใจซักถามเกี่ยวกับสัญลักษณ์หรือตัวหนังสือที่พบเห็น', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[22]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[22]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[22]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[22]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[22]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[22]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[22]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[22]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.2 กระตือรือร้นในการเข้าร่วมกิจกรรม', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[23]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[23]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[23]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[23]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[23]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[23]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[23]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[23]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.3 ถามคำถามและแสดงความคิดเห็น<br/>เกี่ยวกับเรื่องที่สนใจ', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[24]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[24]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[24]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[24]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[24]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[24]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[24]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[24]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(32, 51, '2.<br/>มีความสามารถใน การแสวงหาความรู้', 1, 'C', false, 0, 46, '', true, 0, true);
        $pdf::MultiCell(62, 17, '2.1 ค้นหาคำตอบของข้อสงสัยต่างๆ ตามวิธีการของตนเอง', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[25]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[25]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[25]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[25]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[25]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[25]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[25]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[25]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.2 ใช้ประโยคคำถามว่า "ที่ไหน" "ทำไม" ในการค้นหาคำตอบ', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[26]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[26]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[26]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[26]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[26]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[26]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[26]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[26]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.3 เชื่อมโยงความรู้และทักษะต่างๆใช้ในชีวิตประจำวัน', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[27]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[27]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[27]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[27]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[27]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[27]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[27]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[27]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        // --------------------------------------------------------------------------------------------
        // --------------------------------------------------------------------------------------------
        $pdf::AddPage();
        // set cell padding  //ช่องว่างภายใน
        $pdf::setCellPaddings(10, 5, 10, 5);

        // set cell margins ระยะขอบภายนอก
        // $pdf::setCellMargins(1, 20, 1, 1);
        // --------------------------------------------------------------------------------------------
        // dd( $commenTeacher);
        $comment_teacherster1 = $commenTeacher[0]->comment_teacher;
        $comment_teacherster2 = $commenTeacher[1]->comment_teacher;
        $TeacherName =  $Teacher->prefix_name . $Teacher->first_name . ' ' . $Teacher->last_name;

        $pdf::MultiCell(120, 0, 'ความเห็นครูประจำชั้น<br/>ภาคเรียนที่&nbsp;1', 1, 'C', false, 1, 50, 20, true, 0, true, true, 15, 'M');
        $pdf::MultiCell(120, 100, '<p style="border-bottom:1px dashed #000">' . $comment_teacherster1 . '</p>', 1, 'J', false, 1, 50, '', true, 0, true, true, 0, 'M');
        $pdf::MultiCell(120, 0, 'ลงชื่อ..............................................ครูประจำชั้น<br/>' . '(' . $TeacherName . ')', 0, 'C', false, 1, 50, 125, true, 0, true, true, 15, 'M');

        $pdf::MultiCell(120, 0, 'ความเห็นครูประจำชั้น<br/>ภาคเรียนที่&nbsp;2', 1, 'J', false, 1, 50, 150, true, 1, true, true, 0, 'M');
        $pdf::MultiCell(120, 100, '<p style="border-bottom:1px dashed #000">' . $comment_teacherster2 . '</p>', 1, 'J', false, 0, 50, '', true, 0, true, true, 0, 'M');
        $pdf::MultiCell(120, 0, 'ลงชื่อ..............................................ครูประจำชั้น<br/>' . '(' . $TeacherName . ')', 0, 'C', false, 1, 50, 250, true, 0, true, true, 15, 'M');
        // --------------------------------------------------------------------------------------------
        // --------------------------------------------------------------------------------------------
        $pdf::AddPage();
        // set cell padding  //ช่องว่างภายใน
        $pdf::setCellPaddings(2, 2, 2, 2);

        // set cell margins ระยะขอบภายนอก
        // $pdf::setCellMargins(1, 20, 1, 1);
        // --------------------------------------------------------------------------------------------
        $pdf::MultiCell(140, 0, 'สรุปผลการประเมินพัฒนาการเด็ก&nbsp;ปีการศึกษา............. ', 1, 'C', false, 1, 40, 20, true, 0, true, true, 15, 'M');
        $pdf::MultiCell(40, 31, 'พัฒนาการ', 1, 'C', false, 0, 40, '', true, 0, false, true, 31, 'M');
        $pdf::MultiCell(60, 0, 'ระดับคุณภาพ', 1, 'C', false, 0, '', '', true, 0, true, true, 0, 'M');
        $pdf::MultiCell(40, 31, 'หมายเหตุ', 1, 'C', false, 1, '', '', true, 0, false, true, 31, 'M');

        $pdf::MultiCell(20, 20, '3 <br/> ดี ', 1, 'C', false, 0, 80, 42, true, 0, true);
        $pdf::MultiCell(20, 20, '2 <br/> ปานกลาง ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(20, 20, '1 <br/> ควร เสริม ', 1, 'C', false, 1, '', '', true, 0, true);

        $pdf::MultiCell(40, 17, 'ด้านร่างกาย', 1, 'C', false, 0, 40, '', true,);
        if (isset($SummaryPhysically)) {
            if ($SummaryPhysically2 > 66.66 && $SummaryPhysically2 <= 100) {
                $pdf::MultiCell(20, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 'L,R', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '', 'L,R', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '', 'L,R', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(40, 17, '', 1, 'C', false, 1, '', '', true,); //หมายเหตุ
            } elseif ($SummaryPhysically2 > 33.33 && $SummaryPhysically2 <= 66.66) {
                $pdf::MultiCell(20, 17, '', 'L,R', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 'L,R', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '', 'L,R', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(40, 17, '', 1, 'C', false, 1, '', '', true,); //หมายเหตุ
            } elseif ($SummaryPhysically2 <= 33.33) {
                $pdf::MultiCell(20, 17, '', 'L,R', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '', 'L,R', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 'L,R', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(40, 17, '', 1, 'C', false, 1, '', '', true,); //หมายเหตุ
            }
        } else {
            $pdf::MultiCell(20, 17, '', 'L,R', 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(20, 17, '', 'L,R', 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(20, 17, '', 'L,R', 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(40, 17, '', 1, 'C', false, 1, '', '', true,); //หมายเหตุ
        }



        $pdf::MultiCell(40, 17, 'ด้านอารมณ์ - จิตใจ', 1, 'C', false, 0, 40, '', true,);
        if (isset($SummaryMoodMind)) {
            if ($SummaryMoodMind2 > 66.66 && $SummaryMoodMind2 <= 100) {
                $pdf::MultiCell(20, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(40, 17, '', 1, 'C', false, 1, '', '', true,); //หมายเหตุ
            } elseif ($SummaryMoodMind2 > 33.33 && $SummaryMoodMind2 <= 66.66) {
                $pdf::MultiCell(20, 17, '', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(40, 17, '', 1, 'C', false, 1, '', '', true,); //หมายเหตุ
            } elseif ($SummaryMoodMind->score_mood_mind < 33.33) {
                $pdf::MultiCell(20, 17, '', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(40, 17, '', 1, 'C', false, 1, '', '', true,); //หมายเหตุ
            }
        } else {
            $pdf::MultiCell(20, 17, '', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(20, 17, '', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(20, 17, '', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(40, 17, '', 1, 'C', false, 1, '', '', true,);
        }

        $pdf::MultiCell(40, 17, 'ด้านสังคม', 1, 'C', false, 0, 40, '', true,);
        if (isset($SummarySocial)) {
            if ($SummarySocial2 > 66.66 && $SummarySocial2 <= 100) {
                $pdf::MultiCell(20, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(40, 17, '', 1, 'C', false, 1, '', '', true,); //หมายเหตุ
            } elseif ($SummarySocial2 > 33.33 && $SummarySocial2 <= 66.66) {
                $pdf::MultiCell(20, 17, '', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(40, 17, '', 1, 'C', false, 1, '', '', true,); //หมายเหตุ
            } elseif ($SummarySocial2 < 33.33) {
                $pdf::MultiCell(20, 17, '', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(40, 17, '', 1, 'C', false, 1, '', '', true,); //หมายเหตุ
            }
        } else {
            $pdf::MultiCell(20, 17, '', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(20, 17, '', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(20, 17, '', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(40, 17, '', 1, 'C', false, 1, '', '', true,);
        }

        $pdf::MultiCell(40, 17, 'ด้านสติปัญญา', 1, 'C', false, 0, 40, '', true,);
        if (isset($SummaryIntellectual)) {
            if ($SummaryIntellectual2 > 66.66 && $SummaryIntellectual2 <= 100) {
                $pdf::MultiCell(20, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(40, 17, '', 1, 'C', false, 1, '', '', true,); //หมายเหตุ
            } elseif ($SummaryIntellectual2 > 33.33 && $SummaryIntellectual2 <= 66.66) {
                $pdf::MultiCell(20, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(40, 17, '', 1, 'C', false, 1, '', '', true,); //หมายเหตุ
            } elseif ($SummaryIntellectual2 < 33.33) {
                $pdf::MultiCell(20, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(40, 17, '', 1, 'C', false, 1, '', '', true,); //หมายเหตุ
            }
        } else {
            $pdf::MultiCell(20, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(20, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(20, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(40, 17, '', 1, 'C', false, 1, '', '', true,);
        }

        $pdf::MultiCell(48, 0, 'ระดับคุณภาพ', 1, 'C', false, 0, 40, 143, true, 0, true, true, 15, 'M');
        $pdf::MultiCell(92, 0, 'ความหมาย', 1, 'C', false, 1, '', '', true, 1, true, true, 15, 'M');
        $pdf::MultiCell(48, 0, '3 = ดี', 1, 'C', false, 0, 40, '', true, 0, true, true, 15, 'M');
        $pdf::MultiCell(92, 0, 'ปฎิบัติได้คล่องแคล่ว', 1, 'C', false, 1, '', '', true, 1, true, true, 15, 'M');
        $pdf::MultiCell(48, 0, '2 = ปานกลาง', 1, 'C', false, 0, 40, '', true, 0, true, true, 15, 'M');
        $pdf::MultiCell(92, 0, 'ปฎิบัติได้โดยมีการชี้แนะเป็นบางครั้ง', 1, 'C', false, 1, '', '', true, 1, true, true, 15, 'M');
        $pdf::MultiCell(48, 0, '1 = ควรเสริม', 1, 'C', false, 0, 40, '', true, 0, true, true, 15, 'M');
        $pdf::MultiCell(92, 0, 'แสดงพฤติกรรมที่ไม่ชัดเจนหรือต้องการชี้แนะอยู่เป็นประจำ', 1, 'C', false, 1, '', '', true, 1, true, true, 15, 'M');

        $pdf::MultiCell(10, 0, '<img src="./image/radio_button_unchecked_black_24dp.svg" width="10" height="15">', 0, 'C', false, 0, 40, 190, true, 0, true);
        $pdf::MultiCell(80, 0, 'มีความพร้อมเลื่อนชั้นได้', 0, 'L', false, 0, 48, 189, true, 0, true);

        $pdf::MultiCell(10, 0, '<img src="./image/radio_button_unchecked_black_24dp.svg" width="10" height="15">', 0, 'C', false, 0, 40, 197, true, 0, true);
        $pdf::MultiCell(80, 0, 'ข้อเสนอแนะในกรณีไม่พร้อมเลื่อนชั้น', 0, 'L', false, 0, 48, 196, true, 0, true);


        $pdf::MultiCell(120, 40, 'ลงชื่อ...................................................................................<br/>
                                 (ครูประจำชั้น)<br/> วันที่...........เดือน......................พ.ศ. ............. ', 0, 'C', false, 1, 50, 215, true, 0, true, true, 15, 'M');

        $pdf::MultiCell(120, 30, 'ลงชื่อ...................................................................................<br/>
        (ผู้อำนวยการโรงเรียนอนุบาลมหาสารคาม)<br/> วันที่...........เดือน......................พ.ศ. ............. ', 0, 'C', false, 1, 50, 252, true, 0, true, true, 15, 'M');
        // --------------------------------------------------------------------------------------------

        //Close and output PDF document
        $pdf::Output($student->prefix_name . $student->first_name . ' ' . $student->last_name . '.pdf', 'I');

        //============================================================+
        // END OF FILE
        //============================================================+
    }

    public function exportPDF($student_id) //โหลดpdf
    {
        $student = Student::find($student_id);

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

        $commenTeacher = DB::table('comment_appraisal')
            ->where('student_id', '=', $student_id)
            ->get();
        $Teacher = DB::table('students')
            ->join('teachers', 'teachers.rooms_id', '=', 'students.rooms_id')
            ->where('teachers.rooms_id', '=',  $student->rooms_id)
            ->where('teachers.rank_teacher', '=', 'ครูประจำชั้น')
            ->first();



        $SummaryPhysically = DB::table('physically')
            ->select(DB::raw('SUM(score_rate_physically) as score_physically')) //DB::raw('SUM(score_rate_physically) as score_physically
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', 'ภาคเรียน2')
            ->first();
        $SummaryPhysically2 = ($SummaryPhysically->score_physically / 60) * 100;

        $SummaryMoodMind = DB::table('mood_mind')
            ->select(DB::raw('SUM(score_rate_mood_mind) as score_mood_mind'))
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', 'ภาคเรียน2')
            ->first();
        $SummaryMoodMind2 = ($SummaryMoodMind->score_mood_mind / 57) * 100;

        $SummarySocial = DB::table('social')
            ->select(DB::raw('SUM(score_rate_social) as score_social'))
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', 'ภาคเรียน2')
            ->first();
        $SummarySocial2 = ($SummarySocial->score_social / 90) * 100;

        $SummaryIntellectual = DB::table('intellectual')
            ->select(DB::raw('SUM(score_rate_intellectual) as score_intellectual'))
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', 'ภาคเรียน2')
            ->first();
        $SummaryIntellectual2 = ($SummaryIntellectual->score_intellectual / 84) * 100;


        // dd( $dataphysicallysemester1);
        // create new PDF document
        $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);
        // set document information
        // $pdf::SetCreator(PDF_CREATOR);
        // $pdf::SetAuthor('Nicola Asuni');
        $pdf::SetTitle($student->prefix_name . $student->first_name . ' ' . $student->last_name);
        // $pdf::SetSubject('TCPDF Tutorial');
        // $pdf::SetKeywords('TCPDF, PDF, example, test, guide');
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
        $pdf::MultiCell(36, 33, 'พัฒนาการ', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(32, 33, 'ตัวบ่งชี้', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(62, 33, 'พฤติกรรม', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(30, 8, 'ภาคเรียนที่1', 1, 'C', false, 0, '', '', true, 0, false, true, 8, 'M');
        $pdf::MultiCell(30, 8, 'ภาคเรียนที่2', 1, 'C', false, 1, '', '', true, 0, false, true, 8, 'M');

        $pdf::MultiCell(10, 24, '3 <br/> ดี ', 1, 'C', false, 0, 140, '', true, 0, true);
        $pdf::MultiCell(10, 24, '2 <br/> ปานกลาง ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '1 <br/> ควร เสริม ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '3 <br/> ดี ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '2 <br/> ปานกลาง', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '1 <br/> ควร เสริม', 1, 'C', false, 1, '', '', true, 0, true);
        // --------------------------------------------------------------------------------------------
        $pdf::MultiCell(36, 186, '<u>พัฒนาการด้านร่างกาย</u><br/> มาตรฐานที่&nbsp;1&nbsp;<br/>ร่ายกายเจริญเติบโต<br/>ตามวัยและมีสุขนิสัยที่ดี', 1, 'L', false, 0, '', '', true, 0, true, true, 33, 'T');
        $pdf::MultiCell(32, 51, '1.<br/>มีน้ำหนักส่วนสูงตามเกณ์', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(62, 17, '1.1 น้ำหนักตามเณฑ์อายุของกรมอนามัย', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[0]->score_rate_physically)) {
            if ($dataphysicallysemester1[0]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[0]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[0]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[0]->score_rate_physically)) {
            if ($dataphysicallysemester2[0]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[0]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[0]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(62, 17, '1.2 ส่วนสูงตามเกณฑ์อายุของกรม อนามัย ', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[1]->score_rate_physically)) {
            if ($dataphysicallysemester1[1]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[1]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[1]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[1]->score_rate_physically)) {
            if ($dataphysicallysemester2[1]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[1]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[1]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.3เส้นรอบศีรษะตามเกณฑ์อายุ', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[2]->score_rate_physically)) {
            if ($dataphysicallysemester1[2]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[2]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[2]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[2]->score_rate_physically)) {
            if ($dataphysicallysemester2[2]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[2]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[2]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(32, 101, '2.<br/>มีสุขภาพอนามัยสุขนิสัยที่ดี', 1, 'C', false, 0, 46, '', true, 0, true);
        $pdf::MultiCell(62, 17, '2.1 รับประทานอาหารที่มีประโยชน์และดื่มน้ำสะอาดได้ด้วยตนเอง', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[3]->score_rate_physically)) {
            if ($dataphysicallysemester1[3]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[3]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[3]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[3]->score_rate_physically)) {
            if ($dataphysicallysemester2[3]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[3]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[3]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(62, 17, '2.2 ล้างมือก่อนรับประทานอาหารและ หลังใช้ห้องส้วมได้ด้วยตนเอง', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[4]->score_rate_physically)) {
            if ($dataphysicallysemester1[4]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[4]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[4]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[4]->score_rate_physically)) {
            if ($dataphysicallysemester2[4]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[4]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[4]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(62, 16, '2.3 นอนพักผ่อนเป็นเวลา', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[5]->score_rate_physically)) {
            if ($dataphysicallysemester1[5]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 16, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 16, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 16, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[5]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 16, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 16, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 16, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[5]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 16, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 16, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 16, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 16, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 16, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 16, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[5]->score_rate_physically)) {
            if ($dataphysicallysemester2[5]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 16, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 16, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 16, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[5]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 16, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 16, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 16, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[5]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 16, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 16, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 16, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 16, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 16, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 16, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(62, 17, '2.4 ออกกำลังกายเป็นเวลา', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[6]->score_rate_physically)) {
            if ($dataphysicallysemester1[6]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[6]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[6]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[6]->score_rate_physically)) {
            if ($dataphysicallysemester2[6]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[6]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[6]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(62, 17, '2.5 อาบน้ำแต่ตัวได้แต่ไม่คล่อง', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[7]->score_rate_physically)) {
            if ($dataphysicallysemester1[7]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[7]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[7]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[7]->score_rate_physically)) {
            if ($dataphysicallysemester2[7]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[7]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[7]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(62, 17, '2.6 ขับถ่ายเป็นเวลา', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[8]->score_rate_physically)) {
            if ($dataphysicallysemester1[8]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[8]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[8]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[8]->score_rate_physically)) {
            if ($dataphysicallysemester2[8]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[8]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[8]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(32, 34, '3.<br/> รักษาความปลอดภัย ของตนเองและผู้อื่น', 1, 'C', false, 0, 46, '', true, 0, true);
        $pdf::MultiCell(62, 17, '3.1 เล่นและทำกิจกรรมอย่างปลอดภัยได้ด้วยตนเอง ', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[9]->score_rate_physically)) {
            if ($dataphysicallysemester1[9]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[9]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[9]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[9]->score_rate_physically)) {
            if ($dataphysicallysemester2[9]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[9]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[9]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(62, 17, '3.2 ระมัดระวังตนเองให้ปลอดภัยขณะ<br/>เล่นได้บางครั้ง ', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[10]->score_rate_physically)) {
            if ($dataphysicallysemester1[10]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[10]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[10]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[10]->score_rate_physically)) {
            if ($dataphysicallysemester2[10]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[10]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[10]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        // ---------------------------------------------------------------------------------------------------------------------------------------------
        $pdf::AddPage();
        // set cell padding  //ช่องว่างภายใน
        $pdf::setCellPaddings(1, 1, 1, 1);
        // --------------------------------------------------------------------------------------------
        $pdf::MultiCell(36, 33, 'พัฒนาการ', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(32, 33, 'ตัวบ่งชี้', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(62, 33, 'พฤติกรรม', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(30, 8, 'ภาคเรียนที่1', 1, 'C', false, 0, '', '', true, 0, false, true, 8, 'M');
        $pdf::MultiCell(30, 8, 'ภาคเรียนที่2', 1, 'C', false, 1, '', '', true, 0, false, true, 8, 'M');

        $pdf::MultiCell(10, 24, '3 <br/> ดี ', 1, 'C', false, 0, 140, '', true, 0, true);
        $pdf::MultiCell(10, 24, '2 <br/> ปานกลาง ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '1 <br/> ควร เสริม ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '3 <br/> ดี ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '2 <br/> ปานกลาง', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '1 <br/> ควร เสริม', 1, 'C', false, 1, '', '', true, 0, true);
        // --------------------------------------------------------------------------------------------
        $pdf::MultiCell(36, 153, '<u>พัฒนาการด้านร่างกาย</u><br/>มาตรฐานที่&nbsp;2&nbsp;<br/>กล้ามเนื้อใหญ่และ<br/>กล้ามเนื้อเล็กแข็งแรง<br/>ใช้ได้อย่างคล่องแคล่ว<br/>และประสานสัมพันธ์<br/>กัน', 1, 'L', false, 0, '', '', true, 0, true, true, 33, 'T');
        $pdf::MultiCell(32, 85, '1.<br/>เคลื่อนไหวร่างกาย อย่างคล่องแคล่ว<br/>ประสานสัมพันธ์<br/>และทรงตัวได้', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(62, 17, '1.1 เดินต่อเท้าไปข้างหน้าเป็นเส้นตรงได้ โดยไม่ต้องกางแขน', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[11]->score_rate_physically)) {
            if ($dataphysicallysemester1[11]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[11]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[11]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[11]->score_rate_physically)) {
            if ($dataphysicallysemester2[11]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[11]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[11]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.2 กระโดดขาเดียวไปอยู่กับที่ได้โดยไม่ เสียการทรงตัว', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[12]->score_rate_physically)) {
            if ($dataphysicallysemester1[12]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[12]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[12]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[12]->score_rate_physically)) {
            if ($dataphysicallysemester2[12]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[12]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[12]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.3 วิ่งหลบหลีกสิ่งกีดขวางได้', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[13]->score_rate_physically)) {
            if ($dataphysicallysemester1[13]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[13]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[13]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[13]->score_rate_physically)) {
            if ($dataphysicallysemester2[13]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[13]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[13]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.4 รับลูกบอลโดยใช้มือทั้ง 2 ข้าง', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[14]->score_rate_physically)) {
            if ($dataphysicallysemester1[14]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[14]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[14]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[14]->score_rate_physically)) {
            if ($dataphysicallysemester2[14]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[14]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[14]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.5 เดินลงบันไดสลับเท้าได้', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[15]->score_rate_physically)) {
            if ($dataphysicallysemester1[15]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[15]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[15]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[15]->score_rate_physically)) {
            if ($dataphysicallysemester2[15]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[15]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[15]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(32, 68, '2.<br/>ใช้มือ-ตาประสาท<br/>สัมพันธ์กัน', 1, 'C', false, 0, 46, '', true, 0, true);
        $pdf::MultiCell(62, 17, '2.1&nbsp;ใช้กรรไกกรตัดระดาษตามแนวเส้น ตรงได้', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[16]->score_rate_physically)) {
            if ($dataphysicallysemester1[16]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[16]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[16]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[16]->score_rate_physically)) {
            if ($dataphysicallysemester2[16]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[16]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[16]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.2&nbsp;เขียนรูปสี่เหลียมตามได้อย่างมีมุมชัดเจน', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[17]->score_rate_physically)) {
            if ($dataphysicallysemester1[17]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[17]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[17]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[17]->score_rate_physically)) {
            if ($dataphysicallysemester2[17]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[17]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[17]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.3 ร้อยวัสดุที่มีรูขนาดเส้นผ่าศูนย์กลาง 0.5 เซนติเมตรได้', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[18]->score_rate_physically)) {
            if ($dataphysicallysemester1[18]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[18]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[18]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[18]->score_rate_physically)) {
            if ($dataphysicallysemester2[18]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[18]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[18]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.4&nbsp;โยนลูกบอลไปข้างหน้าได้ไม่คล่อง<br/>แคล่ว', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataphysicallysemester1[19]->score_rate_physically)) {
            if ($dataphysicallysemester1[19]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[19]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataphysicallysemester1[19]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataphysicallysemester2[19]->score_rate_physically)) {
            if ($dataphysicallysemester2[19]->score_rate_physically == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[19]->score_rate_physically == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataphysicallysemester2[19]->score_rate_physically == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        // --------------------------------------------------------------------------------------------
        $pdf::AddPage();
        // set cell padding  //ช่องว่างภายใน
        $pdf::setCellPaddings(1, 1, 1, 1);
        // --------------------------------------------------------------------------------------------
        $pdf::MultiCell(36, 33, 'พัฒนาการ', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(32, 33, 'ตัวบ่งชี้', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(62, 33, 'พฤติกรรม', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(30, 8, 'ภาคเรียนที่1', 1, 'C', false, 0, '', '', true, 0, false, true, 8, 'M');
        $pdf::MultiCell(30, 8, 'ภาคเรียนที่2', 1, 'C', false, 1, '', '', true, 0, false, true, 8, 'M');

        $pdf::MultiCell(10, 24, '3 <br/> ดี ', 1, 'C', false, 0, 140, '', true, 0, true);
        $pdf::MultiCell(10, 24, '2 <br/> ปานกลาง ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '1 <br/> ควร เสริม ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '3 <br/> ดี ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '2 <br/> ปานกลาง', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '1 <br/> ควร เสริม', 1, 'C', false, 1, '', '', true, 0, true);
        // --------------------------------------------------------------------------------------------
        $pdf::MultiCell(36, 102, '<u>พัฒนาการด้านอารมณ์และจิตใจ</u><br/>มาตรฐานที่&nbsp;3&nbsp;<br/>มีสุขภาพจิตดีและมี<br/>ความสุข', 1, 'L', false, 0, '', '', true, 0, true, true, 33, 'T');
        $pdf::MultiCell(32, 34, '1.<br/>แสดงออกทาง<br/>อารมณ์ได้อย่าง<br/>เหนาะสม', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(62, 17, '1.1&nbsp;แสดงอารมณ์ความรู้สึกได้ตามสถานการณ์', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($datamood_mindsemester1[0]->score_rate_mood_mind)) {
            if ($datamood_mindsemester1[0]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[0]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[0]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datamood_mindsemester2[0]->score_rate_mood_mind)) {
            if ($datamood_mindsemester2[0]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[0]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[0]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.2 ร่าเริง สดชื่น แจ่มใส และอารมณ์ดี', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datamood_mindsemester1[1]->score_rate_mood_mind)) {
            if ($datamood_mindsemester1[1]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[1]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[1]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datamood_mindsemester2[1]->score_rate_mood_mind)) {
            if ($datamood_mindsemester2[1]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[1]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[1]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(32, 68, '2.<br/>มีความรู้สึกดีต่อตน เองและผู้อื่น', 1, 'C', false, 0, 46, '', true, 0, true);
        $pdf::MultiCell(62, 17, '2.1 กล้าพูดกล้าแสดงออกอย่างเหมาะสมบางสถานการณ์', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($datamood_mindsemester1[2]->score_rate_mood_mind)) {
            if ($datamood_mindsemester1[2]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[2]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[2]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datamood_mindsemester2[2]->score_rate_mood_mind)) {
            if ($datamood_mindsemester2[2]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[2]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[2]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.2 แสดงความพอใจในผลงานและความสามารถจองตนเอง', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datamood_mindsemester1[3]->score_rate_mood_mind)) {
            if ($datamood_mindsemester1[3]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[3]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[3]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datamood_mindsemester2[3]->score_rate_mood_mind)) {
            if ($datamood_mindsemester2[3]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[3]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[3]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.3 มีความมั่นใจในตนเอง', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datamood_mindsemester1[4]->score_rate_mood_mind)) {
            if ($datamood_mindsemester1[4]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[4]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[4]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datamood_mindsemester2[4]->score_rate_mood_mind)) {
            if ($datamood_mindsemester2[4]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[4]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[4]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.4 รับรู้ความรู้สึกผู้อื่นและปลอบโยน<br/>เมื่อผู้อื่นเสียใจ', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datamood_mindsemester1[5]->score_rate_mood_mind)) {
            if ($datamood_mindsemester1[5]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[5]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[5]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datamood_mindsemester2[5]->score_rate_mood_mind)) {
            if ($datamood_mindsemester2[5]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[5]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[5]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(36, 68, '<u>พัฒนาการด้านอารมณ์  และจิตใจ</u><br/>มาตรฐานที่&nbsp;4&nbsp;<br/>ชื่นชมและแสดงออก ทางศิลปะ ครตรี และการเคลื่อนไหว', 1, 'L', false, 0, '', '', true, 0, true, true, 33, 'T');
        $pdf::MultiCell(32, 68, '1.<br/>สนใจมีความสุขและแสดงออกผ่านงาน<br/>ศิลปะคนตรีและการเคลื่อนไหว', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(62, 17, '1.1 สนใจมีความสุขและแสดงออกผ่าน<br/>งานศิลปะ', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($datamood_mindsemester1[6]->score_rate_mood_mind)) {
            if ($datamood_mindsemester1[6]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[6]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[6]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datamood_mindsemester2[6]->score_rate_mood_mind)) {
            if ($datamood_mindsemester2[6]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[6]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[6]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.2 สนใจมีความสุขและแสดงออกผ่าน<br/>เสียงเลงดนตรี', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datamood_mindsemester1[7]->score_rate_mood_mind)) {
            if ($datamood_mindsemester1[7]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[7]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[7]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datamood_mindsemester2[7]->score_rate_mood_mind)) {
            if ($datamood_mindsemester2[7]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[7]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[7]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.3 สนใจมีความสุขและแสดงท่าทาง/<br/>เคลื่อนไหวประกอบเลงจังหวะและดนตรี', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datamood_mindsemester1[8]->score_rate_mood_mind)) {
            if ($datamood_mindsemester1[8]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[8]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[8]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datamood_mindsemester2[8]->score_rate_mood_mind)) {
            if ($datamood_mindsemester2[8]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[8]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[8]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.4&nbsp;สนใจแล้วมีความสุขขณะทำงาน<br/>ศิลปะ', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datamood_mindsemester1[9]->score_rate_mood_mind)) {
            if ($datamood_mindsemester1[9]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[9]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[9]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datamood_mindsemester2[9]->score_rate_mood_mind)) {
            if ($datamood_mindsemester2[9]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[9]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[9]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        // --------------------------------------------------------------------------------------------
        $pdf::AddPage();
        // set cell padding  //ช่องว่างภายใน
        $pdf::setCellPaddings(1, 1, 1, 1);
        // --------------------------------------------------------------------------------------------
        $pdf::MultiCell(36, 33, 'พัฒนาการ', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(32, 33, 'ตัวบ่งชี้', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(62, 33, 'พฤติกรรม', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(30, 8, 'ภาคเรียนที่1', 1, 'C', false, 0, '', '', true, 0, false, true, 8, 'M');
        $pdf::MultiCell(30, 8, 'ภาคเรียนที่2', 1, 'C', false, 1, '', '', true, 0, false, true, 8, 'M');

        $pdf::MultiCell(10, 24, '3 <br/> ดี ', 1, 'C', false, 0, 140, '', true, 0, true);
        $pdf::MultiCell(10, 24, '2 <br/> ปานกลาง ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '1 <br/> ควร เสริม ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '3 <br/> ดี ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '2 <br/> ปานกลาง', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '1 <br/> ควร เสริม', 1, 'C', false, 1, '', '', true, 0, true);
        // --------------------------------------------------------------------------------------------
        $pdf::MultiCell(36, 153, '<u>พัฒนาการด้านอารมณ์และจิตใจ</u><br/>มาตรฐานที่&nbsp;5&nbsp;<br/>มีคุณธรรม จริยธรรม และ จิตใจที่ดีงาม', 1, 'L', false, 0, '', '', true, 0, true, true, 33, 'T');
        $pdf::MultiCell(32, 34, '1.<br/>ซื่อสีตย์สุจริต', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(62, 17, '1.1 ขออนุญาตหรือรอคอยเมื่อต้องการ<br/>สิ่งของของผู้อื่นเมื่อมีผู้ชี้เนะ', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($datamood_mindsemester1[10]->score_rate_mood_mind)) {
            if ($datamood_mindsemester1[10]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[10]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[10]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datamood_mindsemester2[10]->score_rate_mood_mind)) {
            if ($datamood_mindsemester2[10]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[10]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[10]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.2 รู้จักขอโทษเมื่อมีผู้ชี้เนะ', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datamood_mindsemester1[11]->score_rate_mood_mind)) {
            if ($datamood_mindsemester1[11]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[11]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[11]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datamood_mindsemester2[11]->score_rate_mood_mind)) {
            if ($datamood_mindsemester2[11]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[11]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[11]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(32, 51, '2.<br/>มีความเมตากรุณา มีน้ำใจ และช่วยเหลือแบ่งปัน', 1, 'C', false, 0, 46, '', true, 0, true);
        $pdf::MultiCell(62, 17, '2.1 แสดงความรักต่อเพื่อนและมีเมตตา<br/>ต่อสัตว์เลี้ยง', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($datamood_mindsemester1[12]->score_rate_mood_mind)) {
            if ($datamood_mindsemester1[12]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[12]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[12]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datamood_mindsemester2[12]->score_rate_mood_mind)) {
            if ($datamood_mindsemester2[12]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[12]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[12]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.2 ช่วยเหลือผู้อื่นได้เมื่อมีผู้ชี้เนะ', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datamood_mindsemester1[13]->score_rate_mood_mind)) {
            if ($datamood_mindsemester1[13]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[13]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[13]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datamood_mindsemester2[13]->score_rate_mood_mind)) {
            if ($datamood_mindsemester2[13]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[13]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[13]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.3 มีจิตสาธารณะ', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datamood_mindsemester1[14]->score_rate_mood_mind)) {
            if ($datamood_mindsemester1[14]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[14]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[14]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datamood_mindsemester2[14]->score_rate_mood_mind)) {
            if ($datamood_mindsemester2[14]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[14]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[14]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(32, 34, '3.<br/>มีความเห็นอกเห็น ใจผู้อื่น', 1, 'C', false, 0, 46, '', true, 0, true);
        $pdf::MultiCell(62, 17, '3.1&nbsp;แสดงสีหน้าท่าทางรับรู้ความรู้สิกของผู้อื่น', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($datamood_mindsemester1[15]->score_rate_mood_mind)) {
            if ($datamood_mindsemester1[15]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[15]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[15]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datamood_mindsemester2[15]->score_rate_mood_mind)) {
            if ($datamood_mindsemester2[15]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[15]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[15]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '3.2 รับรู้ความรู้ศึกผู้อื่นและปลอบโยน<br/>เมื่อผู้อื่นเสียใจ', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datamood_mindsemester1[16]->score_rate_mood_mind)) {
            if ($datamood_mindsemester1[16]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[16]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[16]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datamood_mindsemester2[16]->score_rate_mood_mind)) {
            if ($datamood_mindsemester2[16]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[16]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[16]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(32, 34, '4.<br/>มีความรับผิดชอบ', 1, 'C', false, 0, 46, '', true, 0, true);
        $pdf::MultiCell(62, 17, '4.1 ทำงานที่ได้รับมอบหมายจนสำเร็จ<br/>เมื่อมีผู้ชี้เนะ', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($datamood_mindsemester1[17]->score_rate_mood_mind)) {
            if ($datamood_mindsemester1[17]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[17]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[17]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datamood_mindsemester2[17]->score_rate_mood_mind)) {
            if ($datamood_mindsemester2[17]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[17]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[17]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '4.2 รักษาสิงของที่ใช้ร่วมกัน', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datamood_mindsemester1[18]->score_rate_mood_mind)) {
            if ($datamood_mindsemester1[18]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[18]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datamood_mindsemester1[18]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datamood_mindsemester2[18]->score_rate_mood_mind)) {
            if ($datamood_mindsemester2[18]->score_rate_mood_mind == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[18]->score_rate_mood_mind == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datamood_mindsemester2[18]->score_rate_mood_mind == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        // --------------------------------------------------------------------------------------------
        $pdf::AddPage();
        // set cell padding  //ช่องว่างภายใน
        $pdf::setCellPaddings(1, 1, 1, 1);
        // --------------------------------------------------------------------------------------------
        $pdf::MultiCell(36, 33, 'พัฒนาการ', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(32, 33, 'ตัวบ่งชี้', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(62, 33, 'พฤติกรรม', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(30, 8, 'ภาคเรียนที่1', 1, 'C', false, 0, '', '', true, 0, false, true, 8, 'M');
        $pdf::MultiCell(30, 8, 'ภาคเรียนที่2', 1, 'C', false, 1, '', '', true, 0, false, true, 8, 'M');

        $pdf::MultiCell(10, 24, '3 <br/> ดี ', 1, 'C', false, 0, 140, '', true, 0, true);
        $pdf::MultiCell(10, 24, '2 <br/> ปานกลาง ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '1 <br/> ควร เสริม ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '3 <br/> ดี ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '2 <br/> ปานกลาง', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '1 <br/> ควร เสริม', 1, 'C', false, 1, '', '', true, 0, true);
        // --------------------------------------------------------------------------------------------
        $pdf::MultiCell(36, 153, '<u>พัฒนาการด้านสังคม</u><br/>มาตรฐานที่&nbsp;6&nbsp;<br/>มีทักกษะชีวิตและ<br/>ปฎิบัติตามหลักปรัชญาของเศรษฐกิจพอเพียง', 1, 'L', false, 0, '', '', true, 0, true, true, 33, 'T');
        $pdf::MultiCell(32, 68, '1.<br/>ช่วยเหลือตนเองใน<br/>การปฎิบัติกิจวัตร<br/>ประจำวัน', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(62, 17, '1.1 แต่ตัวได้ด้วยตนเอง', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[0]->score_rate_social)) {
            if ($datasocialsemester1[0]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[0]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[0]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[0]->score_rate_social)) {
            if ($datasocialsemester2[0]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[0]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[0]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.2 รับประทานอาหารด้วนตนเอง', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[1]->score_rate_social)) {
            if ($datasocialsemester1[1]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[1]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[1]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[1]->score_rate_social)) {
            if ($datasocialsemester2[1]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[1]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[1]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.3 ใช้ห้องน้ำ ห้องส้วมด้วยตนเอง', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[2]->score_rate_social)) {
            if ($datasocialsemester1[2]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[2]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[2]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[2]->score_rate_social)) {
            if ($datasocialsemester2[2]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[2]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[2]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.4 ระมัดระวังดูแลตนเองและผู้อื่นให้<br/>ปลอดภัยโดยมีผู้อื่นคอยตักเตือนบ้าง', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[3]->score_rate_social)) {
            if ($datasocialsemester1[3]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[3]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[3]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[3]->score_rate_social)) {
            if ($datasocialsemester2[3]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[3]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[3]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(32, 51, '2.<br/>มีวินัยในตนเอง', 1, 'C', false, 0, 46, '', true, 0, true);
        $pdf::MultiCell(62, 17, '2.1 เก็บของเล่น ของใช้เข้าที่ด้วยตนเอง', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[4]->score_rate_social)) {
            if ($datasocialsemester1[4]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[4]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[4]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[4]->score_rate_social)) {
            if ($datasocialsemester2[4]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[4]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[4]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.2 เข้าแถวตามลำดับกก่อน-หลัง ได้ด้วยตนเอง', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[5]->score_rate_social)) {
            if ($datasocialsemester1[5]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[5]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[5]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[5]->score_rate_social)) {
            if ($datasocialsemester2[5]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[5]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[5]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.3 ทึ้งขยะเป็นที่ได้แต่ไม่เรียบร้อย', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[6]->score_rate_social)) {
            if ($datasocialsemester1[6]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[6]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[6]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[6]->score_rate_social)) {
            if ($datasocialsemester2[6]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[6]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[6]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(32, 34, '3.<br/>ประหยัดพอเพียง', 1, 'C', false, 0, 46, '', true, 0, true);
        $pdf::MultiCell(62, 17, '3.1 ใช้สิงของเครื่องใช้อย่างประหยัดและพอเพียงเมื่อมีผู้ชี้เนะ', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[7]->score_rate_social)) {
            if ($datasocialsemester1[7]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[7]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[7]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[7]->score_rate_social)) {
            if ($datasocialsemester2[7]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[7]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[7]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '3.2 รักกษาสิ่งของที่ใช้ร่วมกัน', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[8]->score_rate_social)) {
            if ($datasocialsemester1[8]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[8]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[8]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[8]->score_rate_social)) {
            if ($datasocialsemester2[8]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[8]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[8]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(36, 51, '<u>พัฒนาการด้านสังคม</u><br/>มาตรฐานที่&nbsp;7&nbsp;<br/>รักธรรมชาติสิ่งแวด<br/>ล้อมและความเป็นไทย', 1, 'L', false, 0, '', '', true, 0, true, true, 33, 'T');
        $pdf::MultiCell(32, 51, '1.<br/>ดูแลรักษาธรรมชาติและสิ่งแวดล้อม', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(62, 17, '1.1 มีส่วนร่วมดูแลรักษาธรรมชาติและสิ่งแวดล้อมเมื่อมีผู้ชี้แนะ', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[9]->score_rate_social)) {
            if ($datasocialsemester1[9]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[9]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[9]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[9]->score_rate_social)) {
            if ($datasocialsemester2[9]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[9]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[9]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.2 ทิ้งขยะได้ถูกที่', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[10]->score_rate_social)) {
            if ($datasocialsemester1[10]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[10]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[10]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[10]->score_rate_social)) {
            if ($datasocialsemester2[10]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[10]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[10]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.3 ปิดน้ำหลังการใช้ทันที', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[11]->score_rate_social)) {
            if ($datasocialsemester1[11]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[11]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[11]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[11]->score_rate_social)) {
            if ($datasocialsemester2[11]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[11]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[11]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        // --------------------------------------------------------------------------------------------
        $pdf::AddPage();
        // set cell padding  //ช่องว่างภายใน
        $pdf::setCellPaddings(1, 1, 1, 1);
        // --------------------------------------------------------------------------------------------
        $pdf::MultiCell(36, 33, 'พัฒนาการ', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(32, 33, 'ตัวบ่งชี้', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(62, 33, 'พฤติกรรม', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(30, 8, 'ภาคเรียนที่1', 1, 'C', false, 0, '', '', true, 0, false, true, 8, 'M');
        $pdf::MultiCell(30, 8, 'ภาคเรียนที่2', 1, 'C', false, 1, '', '', true, 0, false, true, 8, 'M');

        $pdf::MultiCell(10, 24, '3 <br/> ดี ', 1, 'C', false, 0, 140, '', true, 0, true);
        $pdf::MultiCell(10, 24, '2 <br/> ปานกลาง ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '1 <br/> ควร เสริม ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '3 <br/> ดี ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '2 <br/> ปานกลาง', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '1 <br/> ควร เสริม', 1, 'C', false, 1, '', '', true, 0, true);
        // --------------------------------------------------------------------------------------------
        $pdf::MultiCell(36, 81, ' ', 1, 'L', false, 0, '', '', true, 0, true, true, 33, 'T');
        $pdf::MultiCell(32, 81, '2.<br/>มีมารยาทตาม<br/>วัฒนธรรมไทยและ<br/>รักความเป็นไทย', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(62, 15, '2.1 ปฎิบัติตามมารยาทไทยด้วยตนเอง', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[12]->score_rate_social)) {
            if ($datasocialsemester1[12]->score_rate_social == 1) {
                $pdf::MultiCell(10, 15, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 15, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 15, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[12]->score_rate_social == 2) {
                $pdf::MultiCell(10, 15, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 15, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 15, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[12]->score_rate_social == 3) {
                $pdf::MultiCell(10, 15, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[12]->score_rate_social)) {
            if ($datasocialsemester2[12]->score_rate_social == 1) {
                $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 15, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[12]->score_rate_social == 2) {
                $pdf::MultiCell(10, 15, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 15, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 15, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[12]->score_rate_social == 3) {
                $pdf::MultiCell(10, 15, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.2&nbsp;กล่าวคำจอบคุณและขอโทษด้วยตน เอง', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[13]->score_rate_social)) {
            if ($datasocialsemester1[13]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[13]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[13]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[13]->score_rate_social)) {
            if ($datasocialsemester2[13]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[13]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[13]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.3 ยืนตรงเมื่อได้ยินเสียงเพลงชาติไทย และเพลงสรรเสริญพระบารมี', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[14]->score_rate_social)) {
            if ($datasocialsemester1[14]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[14]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[14]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[14]->score_rate_social)) {
            if ($datasocialsemester2[14]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[14]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[14]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.4 มีสัมมาคารวะและมารยาทตามวัฒนธรรมไทย', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[15]->score_rate_social)) {
            if ($datasocialsemester1[15]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[15]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[15]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[15]->score_rate_social)) {
            if ($datasocialsemester2[15]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[15]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[15]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 15, '2.5 รักความเป็นไทย', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[16]->score_rate_social)) {
            if ($datasocialsemester1[16]->score_rate_social == 1) {
                $pdf::MultiCell(10, 15, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 15, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 15, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[16]->score_rate_social == 2) {
                $pdf::MultiCell(10, 15, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 15, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 15, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[16]->score_rate_social == 3) {
                $pdf::MultiCell(10, 15, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[16]->score_rate_social)) {
            if ($datasocialsemester2[16]->score_rate_social == 1) {
                $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 15, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[16]->score_rate_social == 2) {
                $pdf::MultiCell(10, 15, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 15, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 15, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[16]->score_rate_social == 3) {
                $pdf::MultiCell(10, 15, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 15, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(36, 151, '<u>พัฒนาการด้านสังคม</u><br/>มาตรฐานที่&nbsp;8&nbsp;<br/>อยู่ร่วมกับผู้อื่นได้อย่างมีความสุขและปฎิบัติ<br/>ตนเป็นสมาชิกที่ดีของ<br/>สังคมในระบอกประชาธิปไตยอันมีพระมหา กษัตริย์ทรงเป็นประมุข', 1, 'L', false, 0, '', '', true, 0, true, true, 33, 'T');
        $pdf::MultiCell(32, 66, '1.<br/>ยอมรับความเหมือนความแตกต่างระ<br/>หว่างบุคคล', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(62, 17, '1.1 เล่นและทำกิจกรรมร่วมกกับเด็กที่<br/>แตกต่างไปจากตน', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[17]->score_rate_social)) {
            if ($datasocialsemester1[17]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[17]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[17]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[17]->score_rate_social)) {
            if ($datasocialsemester2[17]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[17]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[17]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.2 บอกกความเหมืนหรือความแตกต่างระหว่างตัวเองและผู้อื่นได้', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[18]->score_rate_social)) {
            if ($datasocialsemester1[18]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[18]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[18]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[18]->score_rate_social)) {
            if ($datasocialsemester2[18]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[18]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[18]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 32, '1.3 เล่นและทำกิจกรรมร่วมกับเด็กที่แตกต่างไปจากตนได้ เช่นต่างภาษา เชื้อชาติ<br/>พื้นเพทางสังคมหรือมีความบกพร่องทางร่างกาย', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[19]->score_rate_social)) {
            if ($datasocialsemester1[19]->score_rate_social == 1) {
                $pdf::MultiCell(10, 32, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 32, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 32, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[19]->score_rate_social == 2) {
                $pdf::MultiCell(10, 32, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 32, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 32, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[19]->score_rate_social == 3) {
                $pdf::MultiCell(10, 32, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[19]->score_rate_social)) {
            if ($datasocialsemester2[19]->score_rate_social == 1) {
                $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 32, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[19]->score_rate_social == 2) {
                $pdf::MultiCell(10, 32, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 32, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 32, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[19]->score_rate_social == 3) {
                $pdf::MultiCell(10, 32, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(32, 85, '2.<br/>มีปฎิสัมพันธ์ทีดีกับ<br/>ผู้อื่น', 1, 'C', false, 0, 46, '', true, 0, true);
        $pdf::MultiCell(62, 17, '2.1 เล่นหรือทำงานร่วมกับเพื่อนเป็นลุ่ม', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[20]->score_rate_social)) {
            if ($datasocialsemester1[20]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[20]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[20]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[20]->score_rate_social)) {
            if ($datasocialsemester2[20]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[20]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[20]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.2 ยิ้ม ทักทาย หรือพูดคุยกับผู้ใหญ่และบุคคลที่คุ้นเคยได้ด้วนตนเอง', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[21]->score_rate_social)) {
            if ($datasocialsemester1[21]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[21]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[21]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[21]->score_rate_social)) {
            if ($datasocialsemester2[21]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[21]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[21]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.3 เข้าร่วมกิจกรรมกลุ่มได้นานขึ้น', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[22]->score_rate_social)) {
            if ($datasocialsemester1[22]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[22]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[22]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[22]->score_rate_social)) {
            if ($datasocialsemester2[22]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[22]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[22]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.4 แบ่นปันกันเพื่อนและผลัดกันเล่นโดยมีผู้ใหญ่แนะนำ', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[23]->score_rate_social)) {
            if ($datasocialsemester1[23]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[23]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[23]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[23]->score_rate_social)) {
            if ($datasocialsemester2[23]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[23]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[23]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.5 ประนีประนอมแก้ไขปัญหาร่วมกับผู้นอื่นได้', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[24]->score_rate_social)) {
            if ($datasocialsemester1[24]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[24]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[24]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[24]->score_rate_social)) {
            if ($datasocialsemester2[24]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[24]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[24]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        // --------------------------------------------------------------------------------------------
        $pdf::AddPage();
        // set cell padding  //ช่องว่างภายใน
        $pdf::setCellPaddings(1, 1, 1, 1);
        // --------------------------------------------------------------------------------------------
        $pdf::MultiCell(36, 33, 'พัฒนาการ', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(32, 33, 'ตัวบ่งชี้', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(62, 33, 'พฤติกรรม', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(30, 8, 'ภาคเรียนที่1', 1, 'C', false, 0, '', '', true, 0, false, true, 8, 'M');
        $pdf::MultiCell(30, 8, 'ภาคเรียนที่2', 1, 'C', false, 1, '', '', true, 0, false, true, 8, 'M');

        $pdf::MultiCell(10, 24, '3 <br/> ดี ', 1, 'C', false, 0, 140, '', true, 0, true);
        $pdf::MultiCell(10, 24, '2 <br/> ปานกลาง ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '1 <br/> ควร เสริม ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '3 <br/> ดี ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '2 <br/> ปานกลาง', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '1 <br/> ควร เสริม', 1, 'C', false, 1, '', '', true, 0, true);
        // --------------------------------------------------------------------------------------------
        $pdf::MultiCell(36, 92, ' ', 1, 'L', false, 0, '', '', true, 0, true, true, 33, 'T');
        $pdf::MultiCell(32, 92, '3.<br/>ปฎิบัติตนเบื้องต้นในการเป็นสมาชิกที่ดี ของสังคม', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(62, 17, '3.1 มีส่วนร่วมในการสร้างข้อตกลงและ ปฎิบัติตามข้อตกลงเมื่อมีผู้ชี้แนะ', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[25]->score_rate_social)) {
            if ($datasocialsemester1[25]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[25]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[25]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[25]->score_rate_social)) {
            if ($datasocialsemester2[25]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[25]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[25]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '3.2&nbsp;ปฎิบัติตนเป็นผู้นำและผู้ตามได้ด้วน ตนเอง', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[26]->score_rate_social)) {
            if ($datasocialsemester1[26]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[26]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[26]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[26]->score_rate_social)) {
            if ($datasocialsemester2[26]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[26]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[26]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '3.3 ประนีประนอมแก้ไข้ปัญหาโดยปราศจากความรุนแรงเมื่อมีผู้ชี้แนะ', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[27]->score_rate_social)) {
            if ($datasocialsemester1[27]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[27]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[27]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[27]->score_rate_social)) {
            if ($datasocialsemester2[27]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[27]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[27]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '3.4 เยืนตรงเคารพพธงชาติร้องเพลงชาติ', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[28]->score_rate_social)) {
            if ($datasocialsemester1[28]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[28]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[28]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[28]->score_rate_social)) {
            if ($datasocialsemester2[28]->score_rate_social == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[28]->score_rate_social == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[28]->score_rate_social == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 24, '3.5 เข้าร่วมกกิจกรรมที่เกี่ยวกับสถาบัน พระมหากกษัตริย์ตามที่โรงเรียนและชุม ชนจัดขึ้น', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($datasocialsemester1[29]->score_rate_social)) {
            if ($datasocialsemester1[29]->score_rate_social == 1) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[29]->score_rate_social == 2) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($datasocialsemester1[29]->score_rate_social == 3) {
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($datasocialsemester2[29]->score_rate_social)) {
            if ($datasocialsemester2[29]->score_rate_social == 1) {
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[29]->score_rate_social == 2) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($datasocialsemester2[29]->score_rate_social == 3) {
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(36, 136, '<u>พัฒนาการด้านสติปัญญา</u><br/>มาตรฐานที่&nbsp;9&nbsp;<br/>ใช้ภาษาสื่อสารได้<br/>เหมาะสม', 1, 'L', false, 0, '', '', true, 0, true, true, 33, 'T');
        $pdf::MultiCell(32, 85, '1.<br/>สนทนาโต้ตอบและ เล่าเรื่องให้ผู้อื่นเข้า ใจ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(62, 17, '1.1 ฟังผู้อื่นพูดจนจบและสนทนาโต้ตอบสอดคล้องกับเรื่องที่ฟัง', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[0]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[0]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[0]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[0]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[0]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[0]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[0]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[0]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.2 เล่าเป็นเรื่องราวต่อเนื่องได้', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[1]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[1]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[1]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[1]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[1]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[1]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[1]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[1]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.3&nbsp;ฟังคำสัง&nbsp;2&nbsp;ขั้นตอนและสามารถ<br/>ปฎิบัติได้ ', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[2]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[2]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[2]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[2]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[2]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[2]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[2]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[2]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.4 พูดโต้ตอบและเล่าเรื่องเป็นประโยค อย่างต่อเนื่อง', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[3]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[3]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[3]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[3]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[3]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[3]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[3]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[3]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.5 ฟัง พูด โต้ตอบและแสดงความรู้สึก<br/>เกี่ยวกับเรื่องที่ฟังได้', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[4]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[4]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[4]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[4]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[4]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[4]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[4]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[4]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }


        $pdf::MultiCell(32, 51, '2.<br/>อ่านเขียนภาพและ<br/>สัญลักญณ์ได้', 1, 'C', false, 0, 46, '', true, 0, true);
        $pdf::MultiCell(62, 17, '2.1 อ่านภาพ สัญลักษณ์ คำ พร้อมทั้งชี้ หรือ กวาดตามองข้อความตามบรรทัด', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[5]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[5]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[5]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[5]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[5]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[5]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[5]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[5]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.2 เขียนคล้ายตัวอักษร', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[6]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[6]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[6]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[6]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[6]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[6]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[6]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[6]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.3 เปิดและอ่านหนังสือด้วนตนเอง', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[7]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[7]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[7]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[7]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[7]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[7]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[7]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[7]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        // --------------------------------------------------------------------------------------------
        $pdf::AddPage();
        // set cell padding  //ช่องว่างภายใน
        $pdf::setCellPaddings(1, 1, 1, 1);
        // --------------------------------------------------------------------------------------------
        $pdf::MultiCell(36, 33, 'พัฒนาการ', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(32, 33, 'ตัวบ่งชี้', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(62, 33, 'พฤติกรรม', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(30, 8, 'ภาคเรียนที่1', 1, 'C', false, 0, '', '', true, 0, false, true, 8, 'M');
        $pdf::MultiCell(30, 8, 'ภาคเรียนที่2', 1, 'C', false, 1, '', '', true, 0, false, true, 8, 'M');

        $pdf::MultiCell(10, 24, '3 <br/> ดี ', 1, 'C', false, 0, 140, '', true, 0, true);
        $pdf::MultiCell(10, 24, '2 <br/> ปานกลาง ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '1 <br/> ควร เสริม ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '3 <br/> ดี ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '2 <br/> ปานกลาง', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '1 <br/> ควร เสริม', 1, 'C', false, 1, '', '', true, 0, true);
        // --------------------------------------------------------------------------------------------
        $pdf::MultiCell(36, 198, '<u>พัฒนาการด้านสติปัญญา</u><br/>มาตรฐานที่&nbsp;10&nbsp;<br/>มีความสามารถในการคิดเป็นพื้นฐานในการ<br/>เรียนรู้', 1, 'L', false, 0, '', '', true, 0, true, true, 33, 'T');
        $pdf::MultiCell(32, 99, '1.<br/>มีความสามารถใน การคิดรวบยอด', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(62, 24, '1.1 บอกลักษณะส่วนประกอบของสิ่ง<br/>ของต่างๆจากกการสังเกตโดยใช้ประสาท<br/>สัมผัส', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[8]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[8]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[8]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[8]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[8]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[8]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[8]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[8]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 24, '1.2 จับคู่และเปรียบเทียบความแตกต่าง หรือความเหมือนของสิ่งต่างๆโดยใช้<br/>ลักษณะที่สังเกตพบเพียงลักกษณะเดียว', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[9]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[9]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[9]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[9]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[9]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[9]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[9]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[9]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.3 จำแนกและจัดกลุ่มสิ่งต่างๆ โดยใช้<br/>อย่างน้อย 1 ลักกษณะเป็นเกณฑ์', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[10]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[10]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[10]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[10]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[10]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[10]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[10]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[10]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.4 เรียงลำดับสิ่งของหรือเหตุกการณ์<br/>อย่างน้อย 4 ลำดับ', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[11]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[11]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[11]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[11]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[11]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[11]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[11]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[11]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.5 แก้ปัญหาด้วยวิธีการต่างๆ&nbsp;โดยการ ลองผิดลองถูกด้วยตนเอง', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[12]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[12]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[12]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[12]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[12]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[12]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[12]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[12]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(32, 41, '2.<br/>มีความสามารถใน การคิดเชิงเหตุผล', 1, 'C', false, 0, 46, '', true, 0, true);
        $pdf::MultiCell(62, 17, '2.1 ระบุสาเหตุหรือผผลที่เกิดขึ้นในเหตุ การณ์หรือการกระทำเมื่อมีผู้ชี้แนะ', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[13]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[13]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[13]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[13]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[13]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[13]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[13]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[13]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 24, '2.2 คาดเดาหรือคาดคะเนสิ่งที่อาดเกิน<br/>ขึ้นหรือมีส่วนร่วมในการลงความเห็นจากข้อมูล', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[14]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[14]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[14]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[14]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[14]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[14]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[14]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[14]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(32, 58, '3.<br/>มีความสามารถใน<br/>การคิดแก้ปัญหา<br/>และตัดสินใจ', 1, 'C', false, 0, 46, '', true, 0, true);
        $pdf::MultiCell(62, 17, '3.1 ตัดสินใจในเรื่องง่ายๆ&nbsp;และเริ่มเรียนรู้ผลที่เกิดขึ้น', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[15]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[15]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[15]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[15]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[15]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[15]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[15]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[15]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '3.2 ระบุปัญหาโดยลองผิดลองถูก', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[16]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[16]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[16]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[16]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[16]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[16]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[16]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[16]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 24, '3.3 ให้เตุผผลในการคาดคะแนการลง<br/>ความเห็นหรือการลงข้อสรุปเพื่ออธิบาย<br/>เกี่ยวกับสิ่งที่สังเกตหรือเรียนรู้', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[17]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[17]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[17]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[17]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[17]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[17]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[17]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[17]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        // --------------------------------------------------------------------------------------------
        $pdf::AddPage();
        // set cell padding  //ช่องว่างภายใน
        $pdf::setCellPaddings(1, 1, 1, 1);
        // --------------------------------------------------------------------------------------------
        $pdf::MultiCell(36, 33, 'พัฒนาการ', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(32, 33, 'ตัวบ่งชี้', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(62, 33, 'พฤติกรรม', 1, 'C', false, 0, '', '', true, 0, false, true, 33, 'M');
        $pdf::MultiCell(30, 8, 'ภาคเรียนที่1', 1, 'C', false, 0, '', '', true, 0, false, true, 8, 'M');
        $pdf::MultiCell(30, 8, 'ภาคเรียนที่2', 1, 'C', false, 1, '', '', true, 0, false, true, 8, 'M');

        $pdf::MultiCell(10, 24, '3 <br/> ดี ', 1, 'C', false, 0, 140, '', true, 0, true);
        $pdf::MultiCell(10, 24, '2 <br/> ปานกลาง ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '1 <br/> ควร เสริม ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '3 <br/> ดี ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '2 <br/> ปานกลาง', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(10, 24, '1 <br/> ควร เสริม', 1, 'C', false, 1, '', '', true, 0, true);
        // --------------------------------------------------------------------------------------------
        $pdf::MultiCell(36, 112, '<u>พัฒนาการด้านสติปัญญา</u><br/>มาตรฐานที่&nbsp;11&nbsp;<br/>มีจินตนาการและ<br/>ความคิดสร้างสรรค์', 1, 'L', false, 0, '', '', true, 0, true, true, 33, 'T');
        $pdf::MultiCell(32, 56, '1.<br/>ทำงานศิลปะตาม<br/>จินตนาการและความคิดสร้างสรรค์', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(62, 32, '1.1 สร้างผลงานศิลปะเพื่อสื่อสานความ<br/>รู้สึกของตนเองโดยมีการดัดแปลงและ<br/>แปลกใหม่จากเดิมหรือมีรายละเอียดเพิ่มขึ้น', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[18]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[18]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 32, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 32, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 32, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[18]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 32, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 32, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 32, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[18]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 32, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[18]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[18]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 32, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[18]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 32, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 32, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 32, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[18]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 32, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 24, '1.2 เล่น/ทำงานศิลปะตามจินตนาการ<br/>ของตนเองโดนมีลักษณะคิดริเริ่มคิดคล่อง<br/>แคล่วคิดยึดหยุ่นและคิดละเอียดลออ', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[19]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[19]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[19]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[19]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[19]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[19]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[19]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[19]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(32, 56, '2.<br/>แสดงท่าทาง/เคลื่อนไหวตามจินตนาการอย่างสร้างสรรค์', 1, 'C', false, 0, 46, '', true, 0, true);
        $pdf::MultiCell(62, 24, '2.1 เคลื่อนไหวท่าทางเพพื่อสื่อสารความคิดความรู้สึกของตนเองอย่างหลากหลายหรือแปลกใหม่', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[20]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[20]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[20]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[20]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[20]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[20]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[20]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[20]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 24, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 24, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 32, '2.2 แสดงท่าทาง/เลื่อนไหว/เล่นบทบาทสมมุติตามจินตนาการของตนเองและท่าทาง/การเลื่อนไหวมีลักษณะคิดริเริ่มคิดคล่องแคล่ว คิดยึดหยุ่นและคิดละอียดลออ', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[21]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[21]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 32, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 32, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 32, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[21]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 32, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 32, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 32, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[21]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 32, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[21]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[21]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 32, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[21]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 32, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 32, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 32, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[21]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 32, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 32, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(36, 102, '<u>พัฒนาการด้านสติปัญญา</u><br/>มาตรฐานที่&nbsp;12&nbsp;<br/>มีเจคติที่ดีต่อการเรียนรู้และมีความสามารถในการแสวงหาความรู้ได้ เหมาะสมกับวัย', 1, 'L', false, 0, '', '', true, 0, true, true, 33, 'T');
        $pdf::MultiCell(32, 51, '1.<br/>มีเจคติที่ดีต่อการ<br/>เรียนรู้', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(62, 17, '1.1 สนใจซักถามเกี่ยวกับสัญลักษณ์หรือตัวหนังสือที่พบเห็น', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[22]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[22]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[22]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[22]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[22]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[22]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[22]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[22]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.2 กระตือรือร้นในการเข้าร่วมกิจกรรม', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[23]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[23]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[23]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[23]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[23]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[23]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[23]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[23]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '1.3 ถามคำถามและแสดงความคิดเห็น<br/>เกี่ยวกับเรื่องที่สนใจ', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[24]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[24]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[24]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[24]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[24]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[24]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[24]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[24]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }

        $pdf::MultiCell(32, 51, '2.<br/>มีความสามารถใน การแสวงหาความรู้', 1, 'C', false, 0, 46, '', true, 0, true);
        $pdf::MultiCell(62, 17, '2.1 ค้นหาคำตอบของข้อสงสัยต่างๆ ตามวิธีการของตนเอง', 1, 'L', false, 0, '', '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[25]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[25]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[25]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[25]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[25]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[25]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[25]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[25]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.2 ใช้ประโยคคำถามว่า "ที่ไหน" "ทำไม" ในการค้นหาคำตอบ', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[26]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[26]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[26]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[26]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[26]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[26]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[26]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[26]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        $pdf::MultiCell(62, 17, '2.3 เชื่อมโยงความรู้และทักษะต่างๆใช้ในชีวิตประจำวัน', 1, 'L', false, 0, 78, '', true, 0, true);
        // ภาคเรียน1
        if (isset($dataintellectualsemester1[27]->score_rate_intellectual)) {
            if ($dataintellectualsemester1[27]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[27]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            } elseif ($dataintellectualsemester1[27]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 140, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
        }
        // ภาคเรียน2
        if (isset($dataintellectualsemester2[27]->score_rate_intellectual)) {
            if ($dataintellectualsemester2[27]->score_rate_intellectual == 1) {
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[27]->score_rate_intellectual == 2) {
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, '', 1, 'C', false, 1, '', '', true, 0, true);
            } elseif ($dataintellectualsemester2[27]->score_rate_intellectual == 3) {
                $pdf::MultiCell(10, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, 170, '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
            }
        } else {
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, 170, '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(10, 17, ' ', 1, 'C', false, 1, '', '', true, 0, true);
        }
        // --------------------------------------------------------------------------------------------
        // --------------------------------------------------------------------------------------------
        $pdf::AddPage();
        // set cell padding  //ช่องว่างภายใน
        $pdf::setCellPaddings(10, 5, 10, 5);

        // set cell margins ระยะขอบภายนอก
        // $pdf::setCellMargins(1, 20, 1, 1);
        // --------------------------------------------------------------------------------------------
        // dd( $commenTeacher);
        $comment_teacherster1 = $commenTeacher[0]->comment_teacher;
        $comment_teacherster2 = $commenTeacher[1]->comment_teacher;
        $TeacherName =  $Teacher->prefix_name . $Teacher->first_name . ' ' . $Teacher->last_name;

        $pdf::MultiCell(120, 0, 'ความเห็นครูประจำชั้น<br/>ภาคเรียนที่&nbsp;1', 1, 'C', false, 1, 50, 20, true, 0, true, true, 15, 'M');
        $pdf::MultiCell(120, 100, '<p style="border-bottom:1px dashed #000">' . $comment_teacherster1 . '</p>', 1, 'J', false, 1, 50, '', true, 0, true, true, 0, 'M');
        $pdf::MultiCell(120, 0, 'ลงชื่อ..............................................ครูประจำชั้น<br/>' . '(' . $TeacherName . ')', 0, 'C', false, 1, 50, 125, true, 0, true, true, 15, 'M');

        $pdf::MultiCell(120, 0, 'ความเห็นครูประจำชั้น<br/>ภาคเรียนที่&nbsp;2', 1, 'J', false, 1, 50, 150, true, 1, true, true, 0, 'M');
        $pdf::MultiCell(120, 100, '<p style="border-bottom:1px dashed #000">' . $comment_teacherster2 . '</p>', 1, 'J', false, 0, 50, '', true, 0, true, true, 0, 'M');
        $pdf::MultiCell(120, 0, 'ลงชื่อ..............................................ครูประจำชั้น<br/>' . '(' . $TeacherName . ')', 0, 'C', false, 1, 50, 250, true, 0, true, true, 15, 'M');
        // --------------------------------------------------------------------------------------------
        // --------------------------------------------------------------------------------------------
        $pdf::AddPage();
        // set cell padding  //ช่องว่างภายใน
        $pdf::setCellPaddings(2, 2, 2, 2);

        // set cell margins ระยะขอบภายนอก
        // $pdf::setCellMargins(1, 20, 1, 1);
        // --------------------------------------------------------------------------------------------
        $pdf::MultiCell(140, 0, 'สรุปผลการประเมินพัฒนาการเด็ก&nbsp;ปีการศึกษา............. ', 1, 'C', false, 1, 40, 20, true, 0, true, true, 15, 'M');
        $pdf::MultiCell(40, 31, 'พัฒนาการ', 1, 'C', false, 0, 40, '', true, 0, false, true, 31, 'M');
        $pdf::MultiCell(60, 0, 'ระดับคุณภาพ', 1, 'C', false, 0, '', '', true, 0, true, true, 0, 'M');
        $pdf::MultiCell(40, 31, 'หมายเหตุ', 1, 'C', false, 1, '', '', true, 0, false, true, 31, 'M');

        $pdf::MultiCell(20, 20, '3 <br/> ดี ', 1, 'C', false, 0, 80, 42, true, 0, true);
        $pdf::MultiCell(20, 20, '2 <br/> ปานกลาง ', 1, 'C', false, 0, '', '', true, 0, true);
        $pdf::MultiCell(20, 20, '1 <br/> ควร เสริม ', 1, 'C', false, 1, '', '', true, 0, true);

        $pdf::MultiCell(40, 17, 'ด้านร่างกาย', 1, 'C', false, 0, 40, '', true,);
        if (isset($SummaryPhysically)) {
            if ($SummaryPhysically2 > 66.66 && $SummaryPhysically2 <= 100) {
                $pdf::MultiCell(20, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 'L,R', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '', 'L,R', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '', 'L,R', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(40, 17, '', 1, 'C', false, 1, '', '', true,); //หมายเหตุ
            } elseif ($SummaryPhysically2 > 33.33 && $SummaryPhysically2 <= 66.66) {
                $pdf::MultiCell(20, 17, '', 'L,R', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 'L,R', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '', 'L,R', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(40, 17, '', 1, 'C', false, 1, '', '', true,); //หมายเหตุ
            } elseif ($SummaryPhysically2 <= 33.33) {
                $pdf::MultiCell(20, 17, '', 'L,R', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '', 'L,R', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 'L,R', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(40, 17, '', 1, 'C', false, 1, '', '', true,); //หมายเหตุ
            }
            // รอแก้
        } else {
            $pdf::MultiCell(20, 17, '', 'L,R', 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(20, 17, '', 'L,R', 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(20, 17, '', 'L,R', 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(40, 17, '', 1, 'C', false, 1, '', '', true,); //หมายเหตุ
        }



        $pdf::MultiCell(40, 17, 'ด้านอารมณ์ - จิตใจ', 1, 'C', false, 0, 40, '', true,);
        if (isset($SummaryMoodMind)) {
            if ($SummaryMoodMind2 > 66.66 && $SummaryMoodMind2 <= 100) {
                $pdf::MultiCell(20, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(40, 17, '', 1, 'C', false, 1, '', '', true,); //หมายเหตุ
            } elseif ($SummaryMoodMind2 > 33.33 && $SummaryMoodMind2 <= 66.66) {
                $pdf::MultiCell(20, 17, '', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(40, 17, '', 1, 'C', false, 1, '', '', true,); //หมายเหตุ
            } elseif ($SummaryMoodMind->score_mood_mind <= 33.33) {
                $pdf::MultiCell(20, 17, '', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(40, 17, '', 1, 'C', false, 1, '', '', true,); //หมายเหตุ
            }
        } else {
            $pdf::MultiCell(20, 17, '', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(20, 17, '', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(20, 17, '', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(40, 17, '', 1, 'C', false, 1, '', '', true,);
        }

        $pdf::MultiCell(40, 17, 'ด้านสังคม', 1, 'C', false, 0, 40, '', true,);
        if (isset($SummarySocial)) {
            if ($SummarySocial2 > 66.66 && $SummarySocial2 <= 100) {
                $pdf::MultiCell(20, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(40, 17, '', 1, 'C', false, 1, '', '', true,); //หมายเหตุ
            } elseif ($SummarySocial2 > 33.33 && $SummarySocial2 <= 66.66) {
                $pdf::MultiCell(20, 17, '', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(40, 17, '', 1, 'C', false, 1, '', '', true,); //หมายเหตุ
            } elseif ($SummarySocial2 <= 33.33) {
                $pdf::MultiCell(20, 17, '', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(40, 17, '', 1, 'C', false, 1, '', '', true,); //หมายเหตุ
            }
        } else {
            $pdf::MultiCell(20, 17, '', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(20, 17, '', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(20, 17, '', 'L,R,T', 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(40, 17, '', 1, 'C', false, 1, '', '', true,);
        }

        $pdf::MultiCell(40, 17, 'ด้านสติปัญญา', 1, 'C', false, 0, 40, '', true,);
        if (isset($SummaryIntellectual)) {
            if ($SummaryIntellectual2 > 66.66 && $SummaryIntellectual2 <= 100) {
                $pdf::MultiCell(20, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(40, 17, '', 1, 'C', false, 1, '', '', true,); //หมายเหตุ
            } elseif ($SummaryIntellectual2 > 33.33 && $SummaryIntellectual2 <= 66.66) {
                $pdf::MultiCell(20, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(40, 17, '', 1, 'C', false, 1, '', '', true,); //หมายเหตุ
            } elseif ($SummaryIntellectual2 < 33.33) {
                $pdf::MultiCell(20, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(20, 17, '<img src="./image/check-mark-2025986.svg" width="10" height="15">', 1, 'C', false, 0, '', '', true, 0, true);
                $pdf::MultiCell(40, 17, '', 1, 'C', false, 1, '', '', true,); //หมายเหตุ
            }
        } else {
            $pdf::MultiCell(20, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(20, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(20, 17, '', 1, 'C', false, 0, '', '', true, 0, true);
            $pdf::MultiCell(40, 17, '', 1, 'C', false, 1, '', '', true,);
        }

        $pdf::MultiCell(48, 0, 'ระดับคุณภาพ', 1, 'C', false, 0, 40, 143, true, 0, true, true, 15, 'M');
        $pdf::MultiCell(92, 0, 'ความหมาย', 1, 'C', false, 1, '', '', true, 1, true, true, 15, 'M');
        $pdf::MultiCell(48, 0, '3 = ดี', 1, 'C', false, 0, 40, '', true, 0, true, true, 15, 'M');
        $pdf::MultiCell(92, 0, 'ปฎิบัติได้คล่องแคล่ว', 1, 'C', false, 1, '', '', true, 1, true, true, 15, 'M');
        $pdf::MultiCell(48, 0, '2 = ปานกลาง', 1, 'C', false, 0, 40, '', true, 0, true, true, 15, 'M');
        $pdf::MultiCell(92, 0, 'ปฎิบัติได้โดยมีการชี้แนะเป็นบางครั้ง', 1, 'C', false, 1, '', '', true, 1, true, true, 15, 'M');
        $pdf::MultiCell(48, 0, '1 = ควรเสริม', 1, 'C', false, 0, 40, '', true, 0, true, true, 15, 'M');
        $pdf::MultiCell(92, 0, 'แสดงพฤติกรรมที่ไม่ชัดเจนหรือต้องการชี้แนะอยู่เป็นประจำ', 1, 'C', false, 1, '', '', true, 1, true, true, 15, 'M');

        $pdf::MultiCell(10, 0, '<img src="./image/radio_button_unchecked_black_24dp.svg" width="10" height="15">', 0, 'C', false, 0, 40, 190, true, 0, true);
        $pdf::MultiCell(80, 0, 'มีความพร้อมเลื่อนชั้นได้', 0, 'L', false, 0, 48, 189, true, 0, true);

        $pdf::MultiCell(10, 0, '<img src="./image/radio_button_unchecked_black_24dp.svg" width="10" height="15">', 0, 'C', false, 0, 40, 197, true, 0, true);
        $pdf::MultiCell(80, 0, 'ข้อเสนอแนะในกรณีไม่พร้อมเลื่อนชั้น', 0, 'L', false, 0, 48, 196, true, 0, true);


        $pdf::MultiCell(120, 40, 'ลงชื่อ...................................................................................<br/>
                                 (ครูประจำชั้น)<br/> วันที่...........เดือน......................พ.ศ. ............. ', 0, 'C', false, 1, 50, 215, true, 0, true, true, 15, 'M');

        $pdf::MultiCell(120, 30, 'ลงชื่อ...................................................................................<br/>
        (ผู้อำนวยการโรงเรียนอนุบาลมหาสารคาม)<br/> วันที่...........เดือน......................พ.ศ. ............. ', 0, 'C', false, 1, 50, 252, true, 0, true, true, 15, 'M');
        // --------------------------------------------------------------------------------------------

        //Close and output PDF document
        $pdf::Output($student->prefix_name . $student->first_name . ' ' . $student->last_name . '.pdf', 'D');

        //============================================================+
        // END OF FILE
        //============================================================+
    }
}
