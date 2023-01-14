<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManagesparentsController extends Controller
{
    public function manageparentsindex()
    {
        return view('admin.manageparentsindex');
    }
}
