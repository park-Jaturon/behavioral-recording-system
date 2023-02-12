<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Events;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    public function index()
    {
        $event = Events::all();
             
         return view('teacher.activity-index',compact('event'));
    }

    public function image($events_id)
    {
        return view('teacher.activity-image',compact('events_id'));
    }

    public function show($events_id)
    {
        $event = Events::find($events_id);
  
        return response()->json($event);
    }

    public function store(Request $request)
    {
        $data = $request;
        dd($data);
    }
}
