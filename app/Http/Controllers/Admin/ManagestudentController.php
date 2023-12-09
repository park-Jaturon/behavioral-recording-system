<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Parents;
use App\Models\Room;
use App\Models\Student;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagestudentController extends Controller
{
    public function managestudentindex()
    {
            $student = Student::with(['parent'],['room'])->get();
            $studentLevel1_1 = Student::with('room', 'parent')->where('rooms_id',15)->get();
            $studentLevel1_2 = Student::with('room', 'parent')->where('rooms_id',16)->get();
            $studentLevel1_3 = Student::with('room', 'parent')->where('rooms_id',17)->get();
            $studentLevel1_4 = Student::with('room', 'parent')->where('rooms_id',18)->get();
            $studentLevel1_5 = Student::with('room', 'parent')->where('rooms_id',19)->get();
            $studentLevel1_6 = Student::with('room', 'parent')->where('rooms_id',20)->get();
            $studentLevel2_1 = Student::with('room', 'parent')->where('rooms_id',2)->get();
            $studentLevel2_2 = Student::with('room', 'parent')->where('rooms_id',5)->get();
            $studentLevel2_3 = Student::with('room', 'parent')->where('rooms_id', 1)->get();
            $studentLevel2_4 = Student::with('room', 'parent')->where('rooms_id',6)->get();
            $studentLevel2_5 = Student::with('room', 'parent')->where('rooms_id',7)->get();
            $studentLevel2_6 = Student::with('room', 'parent')->where('rooms_id',8)->get();
            $studentLevel3_1 = Student::with('room', 'parent')->where('rooms_id',9)->get();
            $studentLevel3_2 = Student::with('room', 'parent')->where('rooms_id',10)->get();
            $studentLevel3_3 = Student::with('room', 'parent')->where('rooms_id',11)->get();
            $studentLevel3_4 = Student::with('room', 'parent')->where('rooms_id',12)->get();
            $studentLevel3_5 = Student::with('room', 'parent')->where('rooms_id',13)->get();
            $studentLevel3_6 = Student::with('room', 'parent')->where('rooms_id',14)->get();
            Debugbar::info($student);
            Debugbar::info($studentLevel2_3,$studentLevel3_3);

        return view('admin.managestudentindex', 
        compact('student',
        'studentLevel1_1','studentLevel1_2','studentLevel1_3','studentLevel1_4','studentLevel1_5','studentLevel1_6',
        'studentLevel2_1','studentLevel2_2','studentLevel2_3','studentLevel2_4','studentLevel2_5','studentLevel2_6',
        'studentLevel3_1','studentLevel3_2','studentLevel3_3','studentLevel3_4','studentLevel3_5','studentLevel3_6'));//,'parent'
    }

    public function esitstudent($student_id)
    {
        $data = Student::findOrFail($student_id);
        $StudentRoom = Room::findOrFail($data->rooms_id);
        $room = Room::orderBy('room_name')->get();
        $ParentStuden = Parents::findOrFail($data->parents_id);
        $parent = Parents::all();
        Debugbar::info($ParentStuden);
        return view('admin.studentadd', compact('data', 'room', 'parent', 'StudentRoom', 'ParentStuden'));
    }

    public function addstudent()
    {
        $data = new Student();
        $room = Room::orderBy('room_name')->get();
        $parent = Parents::all();
        $ParentStuden = new Parents();
        $StudentRoom = new Room();
        Debugbar::info($room);
        Debugbar::info(date("Y") + 543);
        return view('admin.studentadd', compact('data', 'room', 'parent', 'StudentRoom', 'ParentStuden'));
    }

    public function storestudent(Request $request)
    {
        // dd($request);
        $request->validate([
            'prefix' => 'required|string',
            'firstname' => 'required|string|regex:/^[ก-๙]+$/u|min:3',
            'lastname' => 'required|string|regex:/^[ก-๙]+$/u|min:3',
            'room' => 'required',
            'birthdays' => 'required|string',
            'symbol' => 'required|string',
            'id_tags' => 'required|numeric|digits:5|unique:students',
            'numberid' => 'required|regex:/^([0-9]*)$/|string',
            'father' => 'required|string|min:3',
            'mother' => 'required|string|min:3',
            'parents' => 'required',
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
            'room.required' => 'กรุณาเลือก ห้องเรียน',
            // 'birthdays.required' => 'กรุณาป้อนวันเกิด',
            'symbol.required' => 'กรุณาเลือก สัญลักษณ์',
            'id_tags.required' => 'กรุณาป้อน รหัสประจำตัว',
            'id_tags.min' => 'ข้อมูลไม่ถูกต้อง',
            'id_tags.max' => 'ข้อมูลไม่ถูกต้อง',
            'id_tags.unique' => 'รหัสประจำตัวนี้ถูกใช้ไปแล้ว',
            'numberid.required' => 'กรุณาป้อน เลขที่',
            'numberid.regex' => 'กรุณาป้อน เลขที่ เป็นตัวเลขเท่านั้น ',
            'father.required' => 'กรุณาป้อนชื่อ – นามสกุล (บิดา)',
            'mother.required' => 'กรุณาป้อน ชื่อ – นามสกุล (มารดา)',
            'parents.required' => 'กรุณาเลือก ชื่อ – นามสกุล (ผู้ปกครอง)',
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
            'habitations.min' => 'ที่อยู่ไม่ถูกต้อง'
        ]);
        // Debugbar::info(date("Y")+543);
        if ($request->room) {
            $dRoom = Room::findOrFail($request->room);
            if ($dRoom->rooms_id == 15||$dRoom->rooms_id == 16||$dRoom->rooms_id == 17||$dRoom->rooms_id == 18||$dRoom->rooms_id == 19||$dRoom->rooms_id == 20) {
                $level = "อบ1";
            }
            if ($dRoom->rooms_id == 2||$dRoom->rooms_id == 5||$dRoom->rooms_id == 1||$dRoom->rooms_id == 6||$dRoom->rooms_id == 7||$dRoom->rooms_id == 8) {
                $level = "อบ2";
            }
            if ($dRoom->rooms_id == 9||$dRoom->rooms_id == 10||$dRoom->rooms_id == 11||$dRoom->rooms_id == 12||$dRoom->rooms_id == 13||$dRoom->rooms_id == 14) {
                $level = "อบ3";
            }
        }
        // dd($dRoom);
        Student::create([
            'prefix_name' => $request->prefix,
            'first_name' => $request->firstname,
            'last_name' => $request->lastname,
            'rooms_id' => $request->room,
            'birthdays' => $request->birthdays,
            'symbol' => $request->symbol,
            'id_tags' => $request->id_tags,
            'number' => $request->numberid,
            'father' => $request->father,
            'mother' => $request->mother,
            'parents_id' => $request->parents,
            'telephone_number_father' => $request->telephonenumberfather,
            'telephone_number_mother' => $request->telephonenumbermother,
            'telephone_number_bus' => $request->telephonenumberbus,
            'habitations' => $request->habitations,
            'level' => $level,
            'school_year' => date("Y")+543,
        ]);
        return redirect(route('index.managestudent'))->with('success','บันทึกข้อมูลเสร็จสิ้น');
    }

    public function update(Request $request, $student_id)
    {

        $request->validate([
            'prefix' => 'required|string',
            'firstname' => 'required|string|min:3|regex:/^[ก-๙]+$/u',
            'lastname' => 'required|string|min:3|regex:/^[ก-๙]+$/u',
            'room' => 'required',
            'birthdays' => 'required|string',
            'symbol' => 'required|string',
            'id_tags' => 'required|numeric|digits:5',
            'numberid' => 'required|regex:/^([0-9]*)$/|string',
            'father' => 'required|string|min:3',
            'mother' => 'required|string|min:3',
            'parents' => 'required',
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
            'room.required' => 'กรุณาเลือก ห้องเรียน',
            // 'birthdays.required' => 'กรุณาป้อนวันเกิด',
            'symbol.required' => 'กรุณาเลือก สัญลักษณ์',
            'id_tags.required' => 'กรุณาป้อน รหัสประจำตัว',
            'id_tags.min' => 'ข้อมูลไม่ถูกต้อง',
            'id_tags.max' => 'ข้อมูลไม่ถูกต้อง',
            'id_tags.unique' => 'รหัสประจำตัวนี้ถูกใช้ไปแล้ว',
            'numberid.required' => 'กรุณาป้อน เลขที่',
            'numberid.regex' => 'กรุณาป้อน เลขที่ เป็นตัวเลขเท่านั้น ',
            'father.required' => 'กรุณาป้อนชื่อ – นามสกุล (บิดา)',
            'mother.required' => 'กรุณาป้อน ชื่อ – นามสกุล (มารดา)',
            'parents.required' => 'กรุณาเลือก ชื่อ – นามสกุล (ผู้ปกครอง)',
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
        ]);
        //dd($request);
        $data = Student::findOrFail($student_id);
        $data->prefix_name = $request->prefix;
        $data->first_name = $request->firstname;
        $data->last_name = $request->lastname;
        $data->rooms_id = $request->room;
        $data->birthdays = $request->birthdays;
        $data->symbol = $request->symbol;
        $data->id_tags = $request->id_tags;
        $data->number = $request->numberid;
        $data->father = $request->father;
        $data->mother = $request->mother;
        $data->parents_id = $request->parents;
        $data->telephone_number_father = $request->telephonenumberfather;
        $data->telephone_number_mother = $request->telephonenumbermother;
        $data->telephone_number_bus = $request->telephonenumberbus;
        $data->habitations = $request->habitations;
        $data->save();
        return redirect()->back()->with('success', 'แก้ไขข้อมูลเสร็จสิ้น');
    }

    public function destroy($student_id)
    {
        Student::destroy($student_id);
    }
}
