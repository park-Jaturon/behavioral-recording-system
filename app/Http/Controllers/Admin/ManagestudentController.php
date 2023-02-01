<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Parents;
use App\Models\Room;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagestudentController extends Controller
{
    public function managestudentindex()
    {
        $student = DB::table('students')
        ->join('rooms', 'students.rooms_id', '=', 'rooms.rooms_id')
        ->select('students.student_id','students.number','students.prefix_name','students.first_name','students.last_name','rooms.room_name',)
        ->get();
        //dd( $student);
        return view('admin.managestudentindex',compact('student'));
    }

    public function esitstudent($student_id)
    {
        $data = Student::findOrFail($student_id);
        $room = Room::all();
        $parent = Parents::all();
        //dd(  $data);
        return view('admin.studentadd',compact('data','room','parent'));
    }

    public function addstudent()
    {
        $data = new Student();
        $room = Room::all();
        $parent = Parents::all();
        return view('admin.studentadd',compact('data','room','parent'));
    }

    public function update(Request $request,$student_id)
    {
       
        $request->validate([
            'prefix' => 'required|string',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'room' => 'required',
            'birthdays' => 'required|string',
            'symbol' => 'required|string',
            'idtags' => 'required|string',
            'numberid' => 'required|string',
            'father' => 'required|string',
            'mother' => 'required|string',
            'parents' => 'required',
            'telephonenumberfather' => 'required|string',
            'telephonenumbermother' => 'required|string',
            'telephonenumberbus' => 'required|string',
            'habitations' => 'required|string',
        ]);
        //dd($request);
        $data = Student::findOrFail($student_id);
          $data->prefix_name = $request->prefix;
          $data->first_name = $request->firstname;
          $data->last_name = $request->lastname;
          $data->rooms_id = $request->room;
          $data->birthdays = $request->birthdays;
          $data->symbol = $request->symbol;
          $data->id_tags = $request->idtags;
          $data->number = $request->numberid;
          $data->father = $request->father;
          $data->mother = $request->mother;
          $data->parents_id = $request->parents;
          $data->telephone_number_father = $request->telephonenumberfather;
          $data->telephone_number_mother = $request->telephonenumbermother;
          $data->telephone_number_bus = $request->telephonenumberbus;
          $data->habitations = $request->habitations;
          $data->save();
        return redirect()->back()->with('success','แก้ไขข้อมูลเสร็จสิ้น');
    }

    public function storestudent(Request $request)
    {
        $request->validate([
            'prefix' => 'required|string',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'room' => 'required',
            'birthdays' => 'required|string',
            'symbol' => 'required|string',
            'idtags' => 'required|string',
            'numberid' => 'required|string',
            'father' => 'required|string',
            'mother' => 'required|string',
            'parents' => 'required',
            'telephonenumberfather' => 'required|string',
            'telephonenumbermother' => 'required|string',
            'telephonenumberbus' => 'required|string',
            'habitations' => 'required|string',
        ]);
        //dd($request);
        Student::create([
            'prefix_name' => $request->prefix,
            'first_name' => $request->firstname,
            'last_name' => $request->lastname,
            'rooms_id' => $request->room,
            'birthdays' => $request->birthdays,
            'symbol' => $request->symbol,
            'id_tags' => $request->idtags,
            'number' => $request->numberid,
            'father' => $request->father,
            'mother' => $request->mother,
            'parents_id' => $request->parents,
            'telephone_number_father' => $request->telephonenumberfather,
            'telephone_number_mother' => $request->telephonenumbermother,
            'telephone_number_bus' => $request->telephonenumberbus,
            'habitations' => $request->habitations,
        ]);
        return redirect()->back()->with('success','บันทึกข้อมูลเสร็จสิ้น');
    }

    public function destroy($student_id)
    {
        Student::destroy($student_id);
    }
}
