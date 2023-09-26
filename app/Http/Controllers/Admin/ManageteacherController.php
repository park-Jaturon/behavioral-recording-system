<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Teacher;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ManageteacherController extends Controller
{
    public function manageteacherindex()
    {
        $teacher = DB::table('teachers')
            ->join('rooms', 'teachers.rooms_id', '=', 'rooms.rooms_id')
            ->select('teachers.*', 'rooms.room_name')
            ->orderBy('room_name')
            ->get();
           
        return view('admin.manageteacherindex', compact('teacher'));
    }

    public function addteachers()
    {
        $room = Room::orderBy('room_name')->get();
        $dataTeacher =  new Teacher();
        $TeacherRoom = new Room(); ;
        return view('admin.teachersadd', compact('room', 'dataTeacher','TeacherRoom'));
    }

    public function edit($teachers_id)
    {
        $dataTeacher = Teacher::findOrFail($teachers_id);
        $TeacherRoom = Room::findOrFail($dataTeacher->rooms_id);
        $room = Room::orderBy('room_name')->get();
        Debugbar::info($TeacherRoom);
        return view('admin.teachersadd', compact('dataTeacher', 'room','TeacherRoom'));
    }

    public function storeteacher(Request $request)
    {

        $request->validate([
            'prefix' => 'required|string',
            'firstname' => 'required|string|min:3|regex:/^[ก-๙]+$/u',
            'lastname' => 'required|string|min:3|regex:/^[ก-๙]+$/u',
            'rankteacher' => 'required|string',
            'imageteacher' => 'required|mimes:jpeg,jpg,png',
            'room' => 'required',
        ],[
            'prefix.required' => 'กรุณาเลือกคำนำหน้าชื่อ',
            'firstname.required' => 'โปรดระบุชื่อ',
            'firstname.regex' => 'ชื่อต้องเป็นภาษาไทยเท่านั้น',
            'firstname.min' => 'ชื่อไม่ถูกต้อง',
            'lastname.required' => 'โปรดระบุนามสกุล',
            'lastname.regex' => 'นามสกุลต้องเป็นภาษาไทยเท่านั้น',
            'lastname.min' => 'นามสกุลไม่ถูกต้อง',
            'rankteacher.required' => 'กรุณาเลือกตำแหน่ง',
            'imageteacher.required' => 'กรุณาใส่รูป',
            'room.required' => 'กรุณาเลือกห้องเรียน',
        ]);

        $teachers = new Teacher();
        $teachers->prefix_name = $request->prefix;
        $teachers->first_name = $request->firstname;
        $teachers->last_name = $request->lastname;
        $teachers->rank_teacher = $request->rankteacher;
        if ($request->hasFile('imageteacher')) {
            $file = $request->file('imageteacher');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/teacher/', $filename);
            $teachers->teacher_image = $filename;
        }
        $teachers->rooms_id = $request->room;
        $teachers->save();
        return redirect()->back()->with('success', 'บันทึกข้อมูลเสร็จสิ้น');
    }

    public function update(Request $request, $teachers_id)
    {
        $request->validate([
            'prefix' => 'required|string',
            'firstname' => 'required|string|min:3|regex:/^[ก-๙]+$/u',
            'lastname' => 'required|string|min:3|regex:/^[ก-๙]+$/u',
            'rankteacher' => 'required|string',
            'imageteacher' => 'nullable|mimes:jpeg,jpg,png',
            // 'room' => 'required',
        ],
        [
            'prefix.required' => 'กรุณาเลือกคำนำหน้าชื่อ',
            'firstname.required' => 'โปรดระบุชื่อ',
            'firstname.regex' => 'ชื่อต้องเป็นภาษาไทยเท่านั้น',
            'firstname.min' => 'ชื่อไม่ถูกต้อง',
            'lastname.required' => 'โปรดระบุนามสกุล',
            'lastname.regex' => 'นามสกุลต้องเป็นภาษาไทยเท่านั้น',
            'lastname.min' => 'นามสกุลไม่ถูกต้อง',
            'rankteacher.required' => 'กรุณาเลือกตำแหน่ง',
            'imageteacher.required' => 'กรุณาใส่รูป',
            // 'room.required' => 'กรุณาเลือกห้องเรียน',
        ]);

        $teachers = Teacher::findOrFail($teachers_id);

        $teachers->prefix_name = $request->prefix;
        $teachers->first_name = $request->firstname;
        $teachers->last_name = $request->lastname;
        $teachers->rank_teacher = $request->rankteacher;
        if ($request->hasFile('imageteacher')) {

            $destination = 'uploads/teacher/' . $teachers->teacher_image;
            if (File::exists($destination)) {
                File::delete($destination);
            }

            $file = $request->file('imageteacher');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move('uploads/teacher/', $filename);
            $teachers->teacher_image = $filename;
        }
        // $teachers->rooms_id = $request->room;
        $teachers->save();

        return redirect()->back()->with('success', 'แก้ไขข้อมูลเสร็จสิ้น');
    }

    public function inspect(Request $request)
    {
        $dataTeacher = Teacher::findOrFail($request->teachers);

        $count = Teacher::where('rooms_id', $dataTeacher->rooms_id)->count();
         if($count > 1){
            return response()->json('1');  
         }else{
            return response()->json('0'); 
         }
        // Debugbar::info( $count);
       
    }

    public function delete($teachers_id)
    {
        $teachers = Teacher::findOrFail($teachers_id);
        $countTeacher = Teacher::where('rooms_id',$teachers->rooms_id)->count();
        // echo "p";
        // error_log( $countTeacher);
       if($countTeacher>1){
        $destination = 'uploads/teacher/' . $teachers->teacher_image;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        Teacher::destroy($teachers_id);
       }else{
        // 
       }
        
    }
}
