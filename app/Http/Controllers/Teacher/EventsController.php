<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Events;
use App\Models\Room;
use App\Models\Student;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class EventsController extends Controller
{
    public function index()
    {
        $events = array();
        $bookings = DB::table('teachers')
        // ->join('users', 'teachers.teachers_id', '=', 'users.users_id')
       ->where('teachers.teachers_id', '=', Auth::user()->rank_id)
       ->join('events','teachers.rooms_id','=','events.rooms_id')
       ->get();

        foreach ($bookings as $booking) {
            $events[] = [
                'eventsid' => $booking->events_id,
                'title' => $booking->title,
                'start' => $booking->start,
                'end' => $booking->end,
            ];
        }

        $room = DB::table('teachers')
        ->where('teachers.teachers_id', '=', Auth::user()->rank_id)
        ->first();
        return view('teacher.event-index', ['events' => $events],compact('room'));
    }

    public function store(Request $request)
    {
        $levelsClass = Room::findOrFail($request->rooms_id);
        $schoolYear = Student::where('rooms_id', $levelsClass->rooms_id)->first(); 
        // Debugbar::info( $schoolYear->school_year);
        $request->validate([
            'title' => 'required|string',
            'start_date' => 'required',
            'end_date' => 'required',

        ]);

        $subject = Events::create([
            'title' => $request->title,
            'rooms_id' => $request->rooms_id,
            'start' => $request->start_date,
            'end' => $request->end_date,
            'level' => $levelsClass->room_name,
            'school_year' =>$schoolYear->school_year,
        ]);
    return response()->json([
        'id' => $subject->events_id,
        'start' => $subject->start,
        'end' => $subject->end,
        'title' => $subject->title,
        'teachers_id' =>$subject->teachers_id ,

    ]);
    }

    public function update(Request $request ,$id)
    {
        $booking = Events::find($id);
        if(! $booking) {
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }
        $booking->update([
            'start' => $request->start_date,
            'end' => $request->end_date,
        ]);
        return response()->json('Event updated');
    }

    public function destroy($id)
    {
        $booking = Events::find($id);
        if(! $booking) {
            return response()->json([
                'error' => 'Unable to locate the event'
            ], 404);
        }
        $booking->delete();
        return $id;
    }
}
