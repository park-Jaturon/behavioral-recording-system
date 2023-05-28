<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Barryvdh\Debugbar\Facades\Debugbar;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function roomindex()
    {
        // $room = DB::table('rooms')
        // ->join('teachers', 'rooms.rooms_id', '=', 'teachers.rooms_id')
        // ->join('students','rooms.rooms_id','=','students.rooms_id')
        // ->get();
       // dd($room);
       $room = Room::all();
    //    $teacher  = Teacher::all();
    //    $student   = Student::all();
        return view('admin.roomindex',compact('room'));     //,'teacher','student'
    }

    public function addroom()
    {
        $dataRoom = new Room();
        return view('admin.roomadd',compact('dataRoom'));
    }

    public function storeroom(Request $request)
    {
       
        $request->validate([
            'room_name' => 'required|string|regex:/^อบ[1-9]+\/+[1-9]$/|max:6|unique:rooms',//min:5
          
        ],
    [
        'room_name.required'=> 'โปรดระบุ ห้องเรียน',
        'room_name.regex'=> 'รูปแบบห้องเรียนไม่ถูกต้อง ตัวอย่าง อบ2/1 *ห้ามเว้นวรรค',
        'room_name.unique' => 'ห้องเรียนนี้มีอยู่แล้ว',
    ]);
        //  dd();
        Room::create([
            'room_name' => $request->room_name,
        ]);
        return redirect()->back()->with('success','บันทึกข้อมูลเสร็จสิ้น');
    }

    public function edit($rooms_id)
    {
        $dataRoom = Room::findOrFail($rooms_id);
        return view('admin.roomadd',compact('dataRoom'));
    }

    public function update(Request $request,$rooms_id)
    {
        $request->validate([
            'room_name' => 'required|string|regex:/^อบ[1-9]+\/+[1-9]$/|min:5|unique:rooms',
          
        ],
        [
            'room_name.required'=> 'โปรดระบุ ห้องเรียน',
            'room_name.regex'=> 'รูปแบบห้องเรียนไม่ถูกต้อง ตัวอย่าง อบ2/1 *ห้ามเว้นวรรค',
            'roomname.max' => 'ห้องเรียนนี้ถูกใช้ไปแล้ว',
        ]);

        $room = Room::findOrFail($rooms_id);

        $room->room_name = $request->room_name;
        $room->save();
        
        return redirect()->back()->with('success','แก้ไขข้อมูลเสร็จสิ้น');
    }

    

    public function delete($rooms_id)
    {
        Room::destroy($rooms_id);

        // return redirect()->while('message','park');
    }
}
