<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Events;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class ActivityController extends Controller
{
    public function edit($events_id)
    {
        $activities = DB::table('activities')
            ->where('events_id', '=', $events_id)
            ->get();

        $event = DB::table('events')
            ->where('events_id', '=', $events_id)
            ->first();
        Debugbar::info($event);
        return view('teacher.activity-edit', compact('activities', 'event')); //
    }

    public function update_activity(Request $request, $events_id)
    {
        
        // dd($request,$events_id);
        Events::where('events_id', $events_id)
            ->update([
                'title' => $request->topic,
                'description' => $request->description,
                'start' => $request->starrt,
                'end' => $request->end,
            ]);
        return redirect()->back()->with('successeditactivity', 'แก้ไขข้อมูลเสร็จสิ้น');
    }

    public function destroy($id){
        $activity = Activity::findOrFail($id);
      
      
        $destination = 'uploads/activity/' . $activity->activity_images;
        if (File::exists($destination)) {
            File::delete($destination);
        }
        Activity::destroy($id);
      
    }

    public function image($events_id)
    {
        $activities = DB::table('activities')
            ->where('events_id', '=', $events_id)
            ->get();

        // $events = Events::where('events_id', '=',$events_id)->select('title')->first();
        $topic = DB::table('events')
            ->select('title')
            ->where('events_id', '=', $events_id)
            ->first();
        Debugbar::info($topic);
        return view('teacher.activity-image', compact('activities', 'events_id','topic'));
    }

    public function add($events_id)
    {
        $event = Events::findOrFail($events_id);
        return view('teacher.add-activity', compact('event'));
    }

    public function store_activity(Request $request, $events_id)
    {
        $levelsClass = Events::findOrFail($events_id);
        // Debugbar::info( $levelsClass);
        // dd($levelsClass);
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = 'image-' . time() . rand(1, 1000) . '.' . $image->extension();
                $image->move(public_path('uploads/activity/'), $imageName);
                Activity::create([
                    'events_id' => $events_id,
                    'activity_images' => $imageName,
                    'level' => $levelsClass->level,
                    'school_year' => $levelsClass->school_year,
                ]);
            }
        }

        return redirect(route('image.activity',['events_id'=>$events_id]))->with('success', 'บันทึกรูปกกิจกกรรมเสร็จสิ้น');
    }
}
