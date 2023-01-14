<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageteacherController extends Controller
{
    public function manageteacherindex()
    {
        return view('admin.manageteacherindex');
    }
}
