<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Behavior;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BehaviorController extends Controller
{
    public function index()
    {
        $behavior = DB::table('behaviors')
            ->join('students', 'behaviors.student_id', '=', 'students.student_id')
            ->select('students.number','students.student_id','students.prefix_name', 'students.first_name', 'students.last_name', DB::raw('count(behaviors.student_id) as report '))
            ->groupBy('students.number','students.student_id','students.prefix_name', 'students.first_name', 'students.last_name')
            ->get();
        // dd($behavior);

        return view('teacher.behavior-index', compact('behavior'));
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

        $url = substr($request->description, 54, -11);

        Behavior::create([
            'student_id' => $request->fname,
            'type' => $request->type,
            'description' => $request->description,
        ]);

        return redirect(route('index.behavior'))->with('status', 'บันทึกข้อมูลเสร็จสิ้น');
    }

    public function report($student_id)
    {
        $report = DB::table('behaviors')
        ->where('student_id', '=', $student_id)
        ->get();
        return view('teacher.behavior-report',compact('report'));
    }

    public function delete($behavior_id)
    {
        Behavior::destroy($behavior_id);
        
    }
}
