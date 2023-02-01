<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
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
            'roomname' => 'required|string',
          
        ]);

        Room::create([
            'room_name' => $request->roomname,
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
            'roomname' => 'required|string',
          
        ]);

        $room = Room::findOrFail($rooms_id);

        $room->room_name = $request->roomname;
        $room->save();
        
        return redirect()->back()->with('success','แก้ไขข้อมูลเสร็จสิ้น');
    }

    public function delete($rooms_id)
    {
        Room::destroy($rooms_id);
    }
}
