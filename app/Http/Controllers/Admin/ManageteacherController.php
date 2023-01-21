<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManageteacherController extends Controller
{
    public function manageteacherindex()
    {
        $teacher = DB::table('teachers')
        ->join('rooms', 'teachers.rooms_id', '=', 'rooms.rooms_id')
        ->select('teachers.*', 'rooms.room_name')
        ->get();
        //dd($teacher);
        return view('admin.manageteacherindex',compact('teacher'));
    }
    
    public function addteachers()
    {
        $room = Room::all();
        return view('admin.teachersadd',compact('room'));
    }

    public function storeteacher(Request $request)
    {
       
        $request->validate([
            'prefix'=>'required|string',
            'firstname'=>'required|string',
            'lastname'=>'required|string',
            'rankteacher'=>'required|string',
            'imageteacher'=>'required|mimes:jpeg,jpg,png',
            'room'=>'required',
        ]);

       $teachers = new Teacher();
       $teachers->prefix_name = $request->prefix;
       $teachers->first_name = $request->firstname;
       $teachers->last_name = $request->lastname;
       $teachers->rank_teacher = $request->rankteacher;
       if($request->hasFile('imageteacher')){
        $file = $request->file('imageteacher');
        $filename = time(). '.' . $file->getClientOriginalExtension();
        $file->move('uploads/teacher/',$filename);
        $teachers->teacher_image = $filename;
       }
       $teachers->rooms_id = $request->room;
       $teachers->save();
        return redirect()->back()->with('success','บันทึกข้อมูลเสร็จสิ้น');
    }
}
