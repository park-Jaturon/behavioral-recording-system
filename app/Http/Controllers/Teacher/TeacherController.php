<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\Debugbar\Facades\Debugbar;

class TeacherController extends Controller
{
    public function home()
    {
        $users = DB::table('teachers')
            ->join('users', 'teachers.teachers_id', '=', 'users.rank_id')
            ->where('users.rank', '=', 'teacher')
            ->join('rooms', 'rooms.rooms_id', '=', 'teachers.rooms_id')
            ->where('teachers.teachers_id', '=', Auth::user()->rank_id)
            ->first();
        Debugbar::info($users);
        return view('teacher.dashboard', compact('users'));
    }

    public function room()
    {
        $users = DB::table('teachers')
            ->join('users', function ($join) {
                $join->on('teachers.teachers_id', '=', 'users.rank_id')
                    ->where('users.rank', '=', 'teacher');
            })
            ->join('rooms', 'rooms.rooms_id', '=', 'teachers.rooms_id')
            ->join('students', 'students.rooms_id', '=', 'rooms.rooms_id')
            ->select('students.number', 'students.prefix_name', 'students.first_name', 'students.last_name', 'students.status', 'students.elevate', 'rooms.room_name', 'students.student_id', 'students.school_year', 'students.level', 'students.rooms_id') //
            ->where('teachers.teachers_id', '=', Auth::user()->rank_id)
            ->where('students.level', 'like', 'อบ%')
            ->get();
        Debugbar::info($users);


        if (count($users) > 0) {
            foreach ($users as $user) {
                if ($user->elevate == 'true') {
                    // Debugbar::info('เลื่อนขั้นได้');
                    $UpClass = true;
                    break;
                } else {
                    // Debugbar::info('เลื่อนขั้นไม่ได้');
                    $UpClass = false;
                    break;
                }
            }
        } else {
            $UpClass = false;
        }
        Debugbar::info($UpClass);
        return view('teacher.home-teacher', compact('users', 'UpClass'));
    }

    public function upClass(Request $request)
    {
        // dd($request);
        if ($request->cLevel == "อบ1") {
            $students = $request->input('check');
            if (!empty($students)) {
                foreach ($students as $upclassStudent) {
                    $studentsD = Student::find($upclassStudent);
                    $studentsD->level = 'อบ2';
                    $studentsD->elevate = 'false';
                    $studentsD->school_year = $studentsD->school_year + 1;
                    if ($studentsD->rooms_id == 15) {
                        $studentsD->rooms_id = 2;
                    }
                    if ($studentsD->rooms_id == 16) {
                        $studentsD->rooms_id = 5;
                    }
                    if ($studentsD->rooms_id == 17) {
                        $studentsD->rooms_id = 1;
                    }
                    if ($studentsD->rooms_id == 18) {
                        $studentsD->rooms_id = 6;
                    }
                    if ($studentsD->rooms_id == 19) {
                        $studentsD->rooms_id = 7;
                    }
                    if ($studentsD->rooms_id == 20) {
                        $studentsD->rooms_id = 8;
                    }
                    $studentsD->save();
                }
                return redirect()->back();
            } else {
                return redirect()->back()->with('Error', 'กรุณาเลื่อกนักเรียนที่ต้องการเลื่อนขั้น');
            }
        }

        if ($request->cLevel == "อบ2") {
            $students = $request->input('check');
            if (!empty($students)) {
                foreach ($students as $upclassStudent) {
                    $studentsD = Student::find($upclassStudent);
                    $studentsD->level = 'อบ3';
                    $studentsD->elevate = 'false';
                    $studentsD->school_year = $studentsD->school_year + 1;
                    if ($studentsD->rooms_id == 2) {
                        $studentsD->rooms_id = 9;
                    }
                    if ($studentsD->rooms_id == 5) {
                        $studentsD->rooms_id = 10;
                    }
                    if ($studentsD->rooms_id == 1) {
                        $studentsD->rooms_id = 11;
                    }
                    if ($studentsD->rooms_id == 6) {
                        $studentsD->rooms_id = 12;
                    }
                    if ($studentsD->rooms_id == 7) {
                        $studentsD->rooms_id = 13;
                    }
                    if ($studentsD->rooms_id == 8) {
                        $studentsD->rooms_id = 14;
                    }
                    $studentsD->save();
                }
                return redirect()->back();
            } else {
                return redirect()->back()->with('Error', 'กรุณาเลื่อกนักเรียนที่ต้องการเลื่อนขั้น');
            }
        }
    }

    public function room_show($student_id)
    {
        $datastudents = Student::findOrFail($student_id);
        // dd( $datastudents);
        return view('teacher.room-show', compact('datastudents'));
    }

    public function room_edit($student_id)
    {
        $datastudents = Student::findOrFail($student_id);
        $TeacherRoom = Room::findOrFail($datastudents->rooms_id);
        $room = Room::all();
        return view('teacher.room-edit', compact('datastudents',));
    }

    public function room_update(Request $request, $student_id)
    {
        $request->validate([
            'prefix' => 'required|string',
            'firstname' => 'required|string|min:3|regex:/^[ก-๙]+$/u',
            'lastname' => 'required|string|min:3|regex:/^[ก-๙]+$/u',
            'birthdays' => 'required|string',
            'symbol' => 'required|string',
            'id_tags' => 'required|numeric|digits:5',
            'numberid' => 'required|regex:/^([0-9]*)$/|string',
            'father' => 'required|string|min:3',
            'mother' => 'required|string|min:3',
            'telephonenumberfather' => 'numeric|digits:10|nullable',
            'telephonenumbermother' => 'numeric|digits:10|nullable',
            'telephonenumberbus' => 'numeric|digits:10|nullable',
            'habitations' => 'required|string|min:10|max:255',
        ], [
            'prefix.required' => 'กรุณาเลือกคำนำหน้าชื่อ',
            'firstname.required' => 'กรุณาป้อน ชื่อ',
            'firstname.min' => 'ข้อมูลไม่ถูกต้อง',
            'firstname.regex' => 'ชื่อต้องเป็นภาษาไทยเท่านั้น',
            'lastname.required' => 'กรุณาป้อน นามสกุล',
            'lastname.min' => 'ข้อมูลไม่ถูกต้อง',
            'lastname.regex' => 'นามสกุลต้องเป็นภาษาไทยเท่านั้น',
            // 'birthdays.required' => 'กรุณาป้อนวันเกิด',
            'symbol.required' => 'กรุณาเลือก สัญลักษณ์',
            'id_tags.required' => 'กรุณาป้อน รหัสประจำตัว',
            'id_tags.min' => 'ข้อมูลไม่ถูกต้อง',
            'id_tags.max' => 'ข้อมูลไม่ถูกต้อง',
            'numberid.required' => 'กรุณาป้อน เลขที่',
            'numberid.regex' => 'กรุณาป้อน เลขที่ เป็นตัวเลขเท่านั้น ',
            'father.required' => 'กรุณาป้อนชื่อ – นามสกุล (บิดา)',
            'mother.required' => 'กรุณาป้อน ชื่อ – นามสกุล (มารดา)',
            'telephonenumberfather.required' => 'กรุณาป้อน เบอร์โทรบิดา ',
            'telephonenumberfather.numeric' => 'โปรดระบุเบอร์โทรบิดาเป็นตัวเลขเท่านั้น',
            'telephonenumberfather.digits' => 'เบอร์โทรบิดาต้องมี 10 ตัว',
            'telephonenumbermother.required' => 'กรุณาป้อน เบอร์โทรมารดา ',
            'telephonenumbermother.numeric' => 'โปรดระบุเบอร์โทรมารดาเป็นตัวเลขเท่านั้น',
            'telephonenumbermother.digits' => 'เบอร์โทรมารดาต้องมี 10 ตัว',
            'telephonenumberbus.required' => 'กรุณาป้อน เบอร์โทรถรับส่ง ',
            'telephonenumberbus.numeric' => 'โปรดระบุเบอร์โทรถรับส่งเป็นตัวเลขเท่านั้น',
            'telephonenumberbus.digits' => 'เบอร์โทรถรับส่งต้องมี 10 ตัว',
            'habitations.required' => 'กรุณาป้อน ที่อยู่',
            'status.required' => 'กรุณาระบุสถานะ'
        ]);

        $data = Student::findOrFail($student_id);
        $data->prefix_name = $request->prefix;
        $data->first_name = $request->firstname;
        $data->last_name = $request->lastname;
        $data->birthdays = $request->birthdays;
        $data->symbol = $request->symbol;
        $data->id_tags = $request->id_tags;
        $data->number = $request->numberid;
        $data->father = $request->father;
        $data->mother = $request->mother;
        $data->telephone_number_father = $request->telephonenumberfather;
        $data->telephone_number_mother = $request->telephonenumbermother;
        $data->telephone_number_bus = $request->telephonenumberbus;
        $data->habitations = $request->habitations;
        $data->status = $request->status;
        $data->save();
        return redirect(route('teacher.room'))->with('success', 'แก้ไขข้อมูลเสร็จสิ้น');
    }
}
