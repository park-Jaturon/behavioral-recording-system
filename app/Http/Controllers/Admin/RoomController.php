<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function roomindex()
    {
        return view('admin.roomindex');
    }

    public function addroom()
    {
        return view('admin.roomadd');
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
}
