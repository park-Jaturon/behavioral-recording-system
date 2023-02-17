<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Events;

class EventsController extends Controller
{
    public function index()
    {
        $events = array();
        $bookings = Events::all();
        foreach ($bookings as $booking) {
            $events[] = [
                'eventsid' => $booking->events_id,
                'title' => $booking->title,
                'start' => $booking->start,
                'end' => $booking->end,
            ];
        }
        return view('teacher.event-index', ['events' => $events]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'start_date' => 'required',
            'end_date' => 'required'
        ]);

        $subject = Events::create([
            'title' => $request->title,
            'teachers_id' => $request->teachers_id,
            'start' => $request->start_date,
            'end' => $request->end_date,
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
