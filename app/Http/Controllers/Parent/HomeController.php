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
        $student = Student::find($student_id);

        $datasemester1 = DB::table('physically')
            ->where('student_id', '=', $student_id)
            ->where('semester', 'LIKE', "%ภาคเรียน1%")
            ->first();
        $datasemester2 = DB::table('physically')
            ->where('student_id', '=', $student_id)
            ->where('semester', 'LIKE', "%ภาคเรียน2%")
            ->first();
        $dataphysicallysemester1 = DB::table('physically')
            ->where('student_id', '=', $student_id)
            ->where('semester', 'LIKE', "%ภาคเรียน1%")
            ->get();
        $dataphysicallysemester2 = DB::table('physically')
            ->where('student_id', '=', $student_id)
            ->where('semester', 'LIKE', "%ภาคเรียน2%")
            ->get();

        $datamood_mindsemester1 = DB::table('mood_mind')
            ->where('student_id', '=', $student_id)
            ->where('semester', 'LIKE', "%ภาคเรียน1%")
            ->get();
        $datamood_mindsemester2 = DB::table('mood_mind')
            ->where('student_id', '=', $student_id)
            ->where('semester', 'LIKE', "%ภาคเรียน2%")
            ->get();

        $datasocialsemester1 = DB::table('social')
            ->where('student_id', '=', $student_id)
            ->where('semester', 'LIKE', "%ภาคเรียน1%")
            ->get();
        $datasocialsemester2 = DB::table('social')
            ->where('student_id', '=', $student_id)
            ->where('semester', 'LIKE', "%ภาคเรียน2%")
            ->get();

        $dataintellectualsemester1 = DB::table('intellectual')
            ->where('student_id', '=', $student_id)
            ->where('semester', 'LIKE', "%ภาคเรียน1%")
            ->get();
        $dataintellectualsemester2 = DB::table('intellectual')
            ->where('student_id', '=', $student_id)
            ->where('semester', 'LIKE', "%ภาคเรียน2%")
            ->get();

        $commenTeacher = DB::table('comment_appraisal')
            ->where('student_id', '=', $student_id)
            ->get();

        $appraisalsemester1Physically = DB::table('physically') //ด้านร่างกายภาคเรียน1
            ->select(DB::raw('SUM(score_rate_physically) as score_physically'))
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', 'ภาคเรียน1')
            ->first();
        $appraisalsemester2Physically = DB::table('physically') //ด้านร่างกายภาคเรียน2
            ->select(DB::raw('SUM(score_rate_physically) as score_physically'))
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', 'ภาคเรียน2')
            ->first();

        $appraisalsemester1mood_mind = DB::table('mood_mind') //-ด้านอารมณ์-จิตใจภาคเรียน1
            ->select(DB::raw('SUM(score_rate_mood_mind) as score_mood_mind'))
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', 'ภาคเรียน1')
            ->first();
        $appraisalsemester2mood_mind = DB::table('mood_mind') //-ด้านอารมณ์-จิตใจภาคเรียน2
            ->select(DB::raw('SUM(score_rate_mood_mind) as score_mood_mind'))
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', 'ภาคเรียน2')
            ->first();

        $appraisalsemester1social = DB::table('social') //ด้านสังคมภาคเรียน1
            ->select(DB::raw('SUM(score_rate_social) as score_social'))
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', 'ภาคเรียน1')
            ->first();
        $appraisalsemester2social = DB::table('social') //ด้านสังคมภาคเรียน2
            ->select(DB::raw('SUM(score_rate_social) as score_social'))
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', 'ภาคเรียน2')
            ->first();

        $appraisalsemester1intellectual = DB::table('intellectual') //ด้านสติปัญญาภาคเรียน1
            ->select(DB::raw('SUM(score_rate_intellectual) as score_intellectual'))
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', 'ภาคเรียน1')
            ->first();
        $appraisalsemester2intellectual = DB::table('intellectual') //ด้านสติปัญญาภาคเรียน2
            ->select(DB::raw('SUM(score_rate_intellectual) as score_intellectual'))
            ->where('student_id', '=', $student_id)
            ->where('semester', '=', 'ภาคเรียน2')
            ->first();
        return view(
            'parent.show-behavior',
            compact(
                'commenTeacher',
                'datasemester1','datasemester2',
                'dataphysicallysemester1','dataphysicallysemester2',
                'datasocialsemester1','datasocialsemester2',
                'dataintellectualsemester1','dataintellectualsemester2',
                'appraisalsemester1Physically','appraisalsemester2Physically',
                'appraisalsemester1mood_mind','appraisalsemester2mood_mind',
                'appraisalsemester1social','appraisalsemester2social',
                'appraisalsemester1intellectual','appraisalsemester2intellectual'
            )
        );
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
        return view('parent.show-activity', compact('event'));
    }

    public function activity_showimage($id)
    {
        $eventImage = DB::table('activities')
            ->where('events_id', '=', $id)
            ->get();
        // dd($eventImage);
        return view('parent.show-activity-image', compact('eventImage'));
    }
}
