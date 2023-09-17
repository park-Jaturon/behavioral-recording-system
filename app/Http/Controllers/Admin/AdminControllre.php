<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\DB;

class AdminControllre extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function time_static()
    {
        $setTime = DB::table('statictime')->first();
        Debugbar::info($setTime);
        return view('admin.time-static', compact('setTime'));
    }

    public function update_time_static(Request $request)
    {
        DB::table('statictime')
            ->where('statictime_id', $request->timeid)
            ->update([
                'time_in_start' => $request->timeinstart,
                'time_in_end' => $request->timeinend,
                'time_out_start' => $request->timeoutstart,
                'time_out_end' => $request->timeoutend,
                'updated_at' => DATE(NOW())
            ]);
            return redirect()->back()->with('success','ตั้งค่าเวลามาเรียน/กลับบ้านเสร็จสิ้น');
    }
}
