<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Events;
use Illuminate\Console\Scheduling\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    public function index()
    {
        $event = DB::table('teachers')
        ->join('users', 'teachers.teachers_id', '=', 'users.users_id')
        ->where('teachers.teachers_id', '=', Auth::user()->rank_id)
        ->join('events','teachers.rooms_id','=','events.rooms_id')
        ->orderByRaw('events.start DESC')
        ->get();
        // dd($event);
        return view('teacher.activity-index', compact('event'));
    }

    public function image($events_id)
    {
        $activities = DB::table('activities')
        ->where('events_id', '=', $events_id)
        ->get();
        return view('teacher.activity-image', compact('activities','events_id'));
    }

    public function add($events_id)
    {
        $event = Events::findOrFail($events_id);

        return view('teacher.add-activity', compact('event'));
    }

    public function store_activity(Request $request, $events_id)
    {
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = 'image-' . time() . rand(1, 1000) . '.' . $image->extension();
                $image->move(public_path('uploads/activity/'), $imageName);
                Activity::create([
                    'events_id' => $events_id,
                    'activity_images' => $imageName
                ]);
            }
        }

        return redirect(route('index.activity'))->with('success', 'บันทึกรูปกกิจกกรรมเสร็จสิ้น');
    }
}
