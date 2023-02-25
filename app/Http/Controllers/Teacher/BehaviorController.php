<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Behavior;
use App\Models\Student;
use Illuminate\Http\Request;

class BehaviorController extends Controller
{
    public function index()
    {
        return view('teacher.behavior-index');
    }

    public function add()
    {
        $studentname = Student::all();
        return view('teacher.behavior-add', compact('studentname'));
    }

    public function uploadimage(Request $request)
    {

        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName =  time() . '.' . $extension;

            $request->file('upload')->move(public_path('uploads/behavior/'), $fileName);

            $url = asset('uploads/behavior/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }

    public function store(Request $request)
    {
        
        $url = substr($request->description,54,-11);

        Behavior::create([
            'student_id' => $request->fname,
            'type' => $request->type,
            'description' => $request->description,
            'url_images' =>$url
        ]);

        return redirect(route('index.behavior'))->with('successaddpost', 'บันทึกข้อมูลเสร็จสิ้น');
    }
}
