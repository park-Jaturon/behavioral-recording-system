<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Parents;
use Illuminate\Http\Request;

class ManagesparentsController extends Controller
{
    public function manageparentsindex()
    {
        return view('admin.manageparentsindex');
    }

    public function addparents()
    {
        return view('admin.parents-add');
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
}
