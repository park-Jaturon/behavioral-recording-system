<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Parents;
use App\Models\Student;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;

class ManagesparentsController extends Controller
{
    public function manageparentsindex()
    {
        $parent = Parents::with('students')->get();
        // Debugbar::info($parent);
        // dd( $parent);
        return view('admin.manageparentsindex', compact('parent'));
    }

    public function addparents()
    {
        $dataParent = new Parents();
        return view('admin.parents-add', compact('dataParent'));
    }

    public function storeparents(Request $request)
    {

        $request->validate([
            'prefix' => 'required|string',
            'firstname' => 'required|string|min:3|regex:/^[ก-๙]+$/u',
            'lastname' => 'required|string|min:3|regex:/^[ก-๙]+$/u',
            'relationship' => 'required|string|min:3|regex:/^[ก-๙]+$/u',
            'job' => 'required|string|min:3|regex:/^[ก-๙]+$/u',
        ], [
            'prefix.required' => 'กรุณาเลือกคำนำหน้าชื่อ',
            'firstname.required' => 'โปรดระบุชื่อ',
            'firstname.regex' => 'ชื่อต้องเป็นภาษาไทยเท่านั้น',
            'firstname.min' => 'ชื่อไม่ถูกต้อง',
            'lastname.required' => 'โปรดระบุนามสกุล',
            'lastname.regex' => 'นามสกุลต้องเป็นภาษาไทยเท่านั้น',
            'lastname.min' => 'นามสกุลไม่ถูกต้อง',
            'relationship.required' => 'โปรดระบุความสัมพันธ์',
            'relationship.regex' => 'ความสัมพันธ์ต้องเป็นภาษาไทยเท่านั้น',
            'relationship.min' => 'ข้อมูลไม่ถูกต้อง',
            'job.required' => 'โปรดระบุอาชีพ',
            'job.regex' => 'อาชีพต้องเป็นภาษาไทยเท่านั้น',
            'job.min' => 'ข้อมูลไม่ถูกต้อง',
        ]);

        $parent = new Parents();
        $parent->prefix_name = $request->prefix;
        $parent->first_name = $request->firstname;
        $parent->last_name = $request->lastname;
        $parent->relationship = $request->relationship;
        $parent->job = $request->job;
        $parent->save();
        return redirect(route('index.manageparents'))->with('success', 'บันทึกข้อมูลเสร็จสิ้น');
    }

    public function editparent($parents_id)
    {
        // $dataParent = Parents::;
        $dataParent = Parents::with('students')->where('parents_id', $parents_id)->first();
        $parent = Parents::all();
        // dd($dataParent);
        return view('admin.parents-add', compact('dataParent', 'parent'));
    }

    public function update(Request $request, $parents_id)
    {
        $request->validate([
            'prefix' => 'required|string',
            'firstname' => 'required|string|min:3|regex:/^[ก-๙]+$/u',
            'lastname' => 'required|string|min:3|regex:/^[ก-๙]+$/u',
            'relationship' => 'required|string|min:3|regex:/^[ก-๙]+$/u',
            'job' => 'required|string|min:3|regex:/^[ก-๙]+$/u',
        ], [
            'prefix.required' => 'กรุณาเลือกคำนำหน้าชื่อ',
            'firstname.required' => 'โปรดระบุชื่อ',
            'firstname.regex' => 'ชื่อต้องเป็นภาษาไทยเท่านั้น',
            'firstname.min' => 'ชื่อไม่ถูกต้อง',
            'lastname.required' => 'โปรดระบุนามสกุล',
            'lastname.regex' => 'นามสกุลต้องเป็นภาษาไทยเท่านั้น',
            'lastname.min' => 'นามสกุลไม่ถูกต้อง',
            'relationship.required' => 'โปรดระบุความสัมพันธ์',
            'relationship.regex' => 'ความสัมพันธ์ต้องเป็นภาษาไทยเท่านั้น',
            'relationship.min' => 'ข้อมูลไม่ถูกต้อง',
            'job.required' => 'โปรดระบุอาชีพ',
            'job.regex' => 'อาชีพต้องเป็นภาษาไทยเท่านั้น',
            'job.min' => 'ข้อมูลไม่ถูกต้อง',
        ]);

        $parent = Parents::findOrFail($parents_id);
        $parent->prefix_name = $request->prefix;
        $parent->first_name = $request->firstname;
        $parent->last_name = $request->lastname;
        $parent->relationship = $request->relationship;
        $parent->job = $request->job;
        $parent->save();

        return redirect(route('index.manageparents'))->with('success', 'แก้ไขข้อมูลผู้ปกครองเสร็จสิ้น');
    }

    // public function parents_update(Request $request,)
    // {
    //     // dd($request);
    //     foreach($request->student_section as $student_id){
    //         $data = Student::findOrFail($student_id);
    //         foreach($request->parents as $parents_id){
    //             $data->parents_id = $parents_id;
    //             $data->save();
    //         }
    //     }
    //     return redirect(route('index.manageparents'))->with('successupdaterelationship', 'แก้ไขข้อมูลนักเรียนในปกครองเสร็จสิ้น');
        
    // }

    public function parent_edit(Request $request){
        $datas = $request->all();
        // dd($datas);exit();
        foreach($datas as $row){
            $data = Student::findOrFail($row['student_id']);
            $data->parents_id = $row['parent_id'];
            $data->save();
        }
        return response()->json([
            'status' => 'success',
            'message' => 'update parent successfully'
        ], 202);
    }

    public function destroy($parents_id)
    {
        Parents::destroy($parents_id);
    }
}
