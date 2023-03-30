<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\Events;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;

class HomeController extends Controller
{
    public function index()
    {
        return view('parent.parent-home');
    }

    public function  descendant_show()
    {
        $students = DB::table('students')
            ->where('parents_id', '=', Auth::user()->rank_id)
            ->join('rooms', 'students.rooms_id', '=', 'rooms.rooms_id')
            ->get();
        // dd( $students);
        return view('parent.pedigree', compact('students'));
    }

    public function descendant_time()
    {
        $students = DB::table('students')
            ->where('parents_id', '=', Auth::user()->rank_id)
            ->join('rooms', 'students.rooms_id', '=', 'rooms.rooms_id')
            ->get();
        return view('parent.parent-time', compact('students'));
    }

    public function time_show($student_id)
    {
        $check_student = DB::table('students')
            ->join('timecards', 'students.student_id', '=', 'timecards.student_id')
            ->where('timecards.student_id', '=', $student_id)
            ->get();
        // dd( $check_student);
        return view('parent.show-time-descendant', compact('check_student'));
    }

    public function descendant_post()
    {
        $students = DB::table('students')
            ->where('parents_id', '=', Auth::user()->rank_id)
            ->join('rooms', 'students.rooms_id', '=', 'rooms.rooms_id')
            ->get();

        return view('parent.parent-post', compact('students'));
    }

    public function post_show($rooms_id)
    {
        $showpost = Post::where('rooms_id', '=', $rooms_id)
            ->get();

        return view('parent.show-post', compact('showpost'));
    }

    public function descendant_events()
    {
        $students = DB::table('students')
            ->where('parents_id', '=', Auth::user()->rank_id)
            ->join('rooms', 'students.rooms_id', '=', 'rooms.rooms_id')
            ->get();
        return view('parent.parent-events', compact('students'));
    }

    public function events_show($rooms_id)
    {
        $events = array();
        $bookings = Events::where('rooms_id', '=', $rooms_id)
            ->get();

        foreach ($bookings as $booking) {
            $events[] = [
                'eventsid' => $booking->events_id,
                'title' => $booking->title,
                'start' => $booking->start,
                'end' => $booking->end,
            ];
        }

        return view('parent.show-events', ['events' => $events]);
    }

    public function descendant_behaviors()
    {
        $students = DB::table('students')
            ->where('parents_id', '=', Auth::user()->rank_id)
            ->join('rooms', 'students.rooms_id', '=', 'rooms.rooms_id')
            ->get();


        return view('parent.parrent-behaviors', compact('students'));
    }

    public function behavior_show($student_id)
    {
        $report = DB::table('behaviors')
        ->where('student_id', '=', $student_id)
        ->get();
        return view('parent.show-behavior',compact('report'));
    }

    public function descendant_activity()
    {
        $students = DB::table('students')
        ->where('parents_id', '=', Auth::user()->rank_id)
        ->join('rooms', 'students.rooms_id', '=', 'rooms.rooms_id')
        ->get();

        return view('parent.parent-activity', compact('students'));
    }

    public function activity_show($id)
    {
        $event = DB::table('events')
        ->where('rooms_id', '=', $id)
        ->get();
        // dd($event);
        return view('parent.show-activity',compact('event'));
    }

    public function activity_showimage($id)
    {
        $eventImage = DB::table('activities')
        ->where('events_id', '=', $id)
        ->get();
        // dd($eventImage);
        return view('parent.show-activity-image',compact('eventImage'));
    }
}
