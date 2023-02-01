<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Parents;
use Illuminate\Http\Request;

class ManagesparentsController extends Controller
{
    public function manageparentsindex()
    {
        $parent = Parents::all();
        return view('admin.manageparentsindex',compact('parent'));
    }

    public function addparents()
    {
        $dataParent = new Parents();
        return view('admin.parents-add',compact('dataParent'));
    }

    public function storeparents(Request $request)
    {
        
        $request->validate([
            'prefix' => 'required|string',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'relationship' => 'required|string',
            'job' => 'required|string',
        ]);

       $parent = new Parents();
       $parent->prefix_name = $request->prefix;
       $parent->first_name = $request->firstname;
       $parent->last_name = $request->lastname;
        $parent->relationship = $request->relationship;
        $parent->job = $request->job;
        $parent->save();
        return redirect()->back()->with('success', 'บันทึกข้อมูลเสร็จสิ้น');
    }

    public function editparent($parents_id)
    {
        $dataParent = Parents::findOrFail($parents_id);
        return view('admin.parents-add',compact('dataParent'));
    }

    public function update(Request $request,$parents_id)
    {
        $request->validate([
            'prefix' => 'required|string',
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'relationship' => 'required|string',
            'job' => 'required|string',
        ]);

        $parent = Parents::findOrFail($parents_id);
        $parent->prefix_name = $request->prefix;
        $parent->first_name = $request->firstname;
        $parent->last_name = $request->lastname;
         $parent->relationship = $request->relationship;
         $parent->job = $request->job;
         $parent->save();

         return redirect()->back()->with('success','แก้ไขข้อมูลเสร็จสิ้น');
    }

    public function destroy($parents_id)
    {
        Parents::destroy($parents_id);
    }
}
