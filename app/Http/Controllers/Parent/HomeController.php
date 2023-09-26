<?php

namespace App\Http\Controllers\Parent;

use App\Http\Controllers\Controller;
use App\Models\Events;
use App\Models\Post;
use Illuminate\Http\Request;
use Barryvdh\Debugbar\Facades\Debugbar;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Student;

class HomeController extends Controller
{
    public function index()
    {
        $students = DB::table('students')
            ->where('parents_id', '=', Auth::user()->rank_id)
            ->join('rooms', 'students.rooms_id', '=', 'rooms.rooms_id')
            ->get();
            Debugbar::info($students);
        return view('parent.parent-home',compact('students'));
    }

    public function  descendant_show()
    {
        $students = DB::table('students')
            ->where('parents_id', '=', Auth::user()->rank_id)
            ->join('rooms', 'students.rooms_id', '=', 'rooms.rooms_id')
            ->get();
        // dd( $students);
        return view('parent.pedigree',compact('students'));
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
        $students = DB::table('students')
            ->where('student_id', '=', $student_id)
            ->first();
        $check_student = DB::table('students')
            ->join('timecards', 'students.student_id', '=', 'timecards.student_id')
            ->where('timecards.student_id', '=', $student_id)
            ->get();
            Debugbar::info($students);
        return view('parent.show-time-descendant', compact('check_student','students'));
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
        $rooms = DB::table('rooms')
            ->where('rooms_id', '=', $rooms_id)
            ->first();

        $showpost = DB::table('posts')
            ->where('rooms_id', '=', $rooms_id)
            ->orderBy('posts.created_at', 'desc')
            ->get();
        Debugbar::info($showpost,$rooms);
        return view('parent.show-post', compact('showpost','rooms'));
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
        $rooms = DB::table('rooms')
            ->where('rooms_id', '=', $rooms_id)
            ->first();

        $events = array();
        $bookings = Events::where('rooms_id', '=', $rooms_id)
            ->get();
        Debugbar::info($bookings);
        foreach ($bookings as $booking) {
            $events[] = [
                'eventsid' => $booking->events_id,
                'title' => $booking->title,
                'description' => $booking->description,
                'start' => $booking->start,
                'end' => $booking->end,
            ];
        }

        return view('parent.show-events', ['events' => $events],compact('rooms'));
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
        Debugbar::info($student);
        $rooms = DB::table('rooms')
            ->where('rooms_id', '=', $student->rooms_id)
            ->first();
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
                'datasemester1',
                'datasemester2',
                'dataphysicallysemester1',
                'dataphysicallysemester2',
                'datasocialsemester1',
                'datasocialsemester2',
                'dataintellectualsemester1',
                'dataintellectualsemester2',
                'appraisalsemester1Physically',
                'appraisalsemester2Physically',
                'appraisalsemester1mood_mind',
                'appraisalsemester2mood_mind',
                'appraisalsemester1social',
                'appraisalsemester2social',
                'appraisalsemester1intellectual',
                'appraisalsemester2intellectual',
                'student','rooms'
            )
        );
    }

    public function descendant_activity()
    {
        $students = DB::table('students')
            ->where('parents_id', '=', Auth::user()->rank_id)
            ->join('rooms', 'students.rooms_id', '=', 'rooms.rooms_id')
            ->get();
        Debugbar::info($students);
        return view('parent.parent-activity', compact('students'));
    }

    public function activity_show($id, $year, $level)          //
    {
        // Debugbar::info($id,$year,$level);
        if ($level === 'อบ1') {
            if ($id == 15) {
                $event1 = DB::table('events')
                    ->where('rooms_id', '=', $id)
                    ->where('school_year', '=', $year)
                    ->get();
                $event2 = new Events();
                $event3 = new Events();
                Debugbar::info($event1, $event2, $event3);
            } elseif ($id == 16) {
                $event1 = DB::table('events')
                    ->where('rooms_id', '=', $id)
                    ->where('school_year', '=', $year)
                    ->get();
                $event2 = new Events();
                $event3 = new Events();
                Debugbar::info($event1, $event2, $event3);
            } elseif ($id == 17) {
                $event1 = DB::table('events')
                    ->where('rooms_id', '=', $id)
                    ->where('school_year', '=', $year)
                    ->get();
                $event2 = new Events();
                $event3 = new Events();
                Debugbar::info($event1, $event2, $event3);
            } elseif ($id == 18) {
                $event1 = DB::table('events')
                    ->where('rooms_id', '=', $id)
                    ->where('school_year', '=', $year)
                    ->get();
                $event2 = new Events();
                $event3 = new Events();
                Debugbar::info($event1, $event2, $event3);
            } elseif ($id == 19) {
                $event1 = DB::table('events')
                    ->where('rooms_id', '=', $id)
                    ->where('school_year', '=', $year)
                    ->get();
                $event2 = new Events();
                $event3 = new Events();
                Debugbar::info($event1, $event2, $event3);
            } elseif ($id == 20) {
                $event1 = DB::table('events')
                    ->where('rooms_id', '=', $id)
                    ->where('school_year', '=', $year)
                    ->get();
                $event2 = new Events();
                $event3 = new Events();
                Debugbar::info($event1, $event2, $event3);
            }
        }

        if ($level === 'อบ2') {
            if ($id == 1) {
                $event1 = DB::table('events')
                    ->where('rooms_id', '=', 17)
                    ->where('school_year', '=', $year - 1)
                    ->get();

                $event2 = DB::table('events')
                    ->where('rooms_id', '=', $id)
                    ->where('school_year', '=', $year)
                    ->get();

                $event3 = new Events();
                Debugbar::info($event1, $event2, $event3);
            } elseif ($id == 2) {
                $event1 = DB::table('events')
                    ->where('rooms_id', '=', 15)
                    ->where('school_year', '=', $year - 1)
                    ->get();

                $event2 = DB::table('events')
                    ->where('rooms_id', '=', $id)
                    ->where('school_year', '=', $year)
                    ->get();

                $event3 = new Events();
                Debugbar::info($event1, $event2, $event3);
            } elseif ($id == 5) {
                $event1 = DB::table('events')
                    ->where('rooms_id', '=', 16)
                    ->where('school_year', '=', $year - 1)
                    ->get();

                $event2 = DB::table('events')
                    ->where('rooms_id', '=', $id)
                    ->where('school_year', '=', $year)
                    ->get();

                $event3 = new Events();
                Debugbar::info($event1, $event2, $event3);
            } elseif ($id == 6) {
                $event1 = DB::table('events')
                    ->where('rooms_id', '=', 18)
                    ->where('school_year', '=', $year - 1)
                    ->get();

                $event2 = DB::table('events')
                    ->where('rooms_id', '=', $id)
                    ->where('school_year', '=', $year)
                    ->get();

                $event3 = new Events();
                Debugbar::info($event1, $event2, $event3);
            } elseif ($id == 7) {
                $event1 = DB::table('events')
                    ->where('rooms_id', '=', 19)
                    ->where('school_year', '=', $year - 1)
                    ->get();

                $event2 = DB::table('events')
                    ->where('rooms_id', '=', $id)
                    ->where('school_year', '=', $year)
                    ->get();

                $event3 = new Events();
                Debugbar::info($event1, $event2, $event3);
            } elseif ($id == 8) {
                $event1 = DB::table('events')
                    ->where('rooms_id', '=', 20)
                    ->where('school_year', '=', $year - 1)
                    ->get();

                $event2 = DB::table('events')
                    ->where('rooms_id', '=', $id)
                    ->where('school_year', '=', $year)
                    ->get();

                $event3 = new Events();
                Debugbar::info($event1, $event2, $event3);
            }
        }

        if ($level === 'อบ3') {
            if ($id == 9) {
                $event3 = DB::table('events')
                    ->where('rooms_id', '=', $id)
                    ->where('school_year', '=', $year)
                    ->get();

                $event2 = DB::table('events')
                    ->where('rooms_id', '=', 2)
                    ->where('school_year', '=', $year - 1)
                    ->get();

                $event1 = DB::table('events')
                    ->where('rooms_id', '=', 15)
                    ->where('school_year', '=', $year - 2)
                    ->get();
                Debugbar::info($event1, $event2, $event3);
            } elseif ($id == 10) {
                $event3 = DB::table('events')
                    ->where('rooms_id', '=', $id)
                    ->where('school_year', '=', $year)
                    ->get();

                $event2 = DB::table('events')
                    ->where('rooms_id', '=', 5)
                    ->where('school_year', '=', $year - 1)
                    ->get();

                $event1 = DB::table('events')
                    ->where('rooms_id', '=', 16)
                    ->where('school_year', '=', $year - 2)
                    ->get();
                Debugbar::info($event1, $event2, $event3);
            } elseif ($id == 11) {
                $event3 = DB::table('events')
                    ->where('rooms_id', '=', $id)
                    ->where('school_year', '=', $year)
                    ->get();

                $event2 = DB::table('events')
                    ->where('rooms_id', '=', 1)
                    ->where('school_year', '=', $year - 1)
                    ->get();

                $event1 = DB::table('events')
                    ->where('rooms_id', '=', 17)
                    ->where('school_year', '=', $year - 2)
                    ->get();
                Debugbar::info($event1, $event2, $event3);
            } elseif ($id == 12) {
                $event3 = DB::table('events')
                    ->where('rooms_id', '=', $id)
                    ->where('school_year', '=', $year)
                    ->get();

                $event2 = DB::table('events')
                    ->where('rooms_id', '=', 6)
                    ->where('school_year', '=', $year - 1)
                    ->get();

                $event1 = DB::table('events')
                    ->where('rooms_id', '=', 18)
                    ->where('school_year', '=', $year - 2)
                    ->get();
                Debugbar::info($event1, $event2, $event3);
            } elseif ($id == 13) {
                $event3 = DB::table('events')
                    ->where('rooms_id', '=', $id)
                    ->where('school_year', '=', $year)
                    ->get();

                $event2 = DB::table('events')
                    ->where('rooms_id', '=', 7)
                    ->where('school_year', '=', $year - 1)
                    ->get();

                $event1 = DB::table('events')
                    ->where('rooms_id', '=', 19)
                    ->where('school_year', '=', $year - 2)
                    ->get();
                Debugbar::info($event1, $event2, $event3);
            } elseif ($id == 14) {
                $event3 = DB::table('events')
                    ->where('rooms_id', '=', $id)
                    ->where('school_year', '=', $year)
                    ->get();

                $event2 = DB::table('events')
                    ->where('rooms_id', '=', 8)
                    ->where('school_year', '=', $year - 1)
                    ->get();

                $event1 = DB::table('events')
                    ->where('rooms_id', '=', 20)
                    ->where('school_year', '=', $year - 2)
                    ->get();
                Debugbar::info($event1, $event2, $event3);
            }
        }

        return view('parent.show-activity', compact('event1', 'event2', 'event3', 'level', 'year'));    //  
    }

    /*public function select_yevel(Request $request)
    {
        $event = DB::table('events')
        ->where('rooms_id', '=', 2)
        ->where('school_year', '=', $request->SchoolYear)
        ->get();
        Debugbar::info($event);

        return response()->json($event);
    } */

    public function activity_showimage($id, $school_year)
    {
        $eventImage = DB::table('activities')
            ->where('events_id', '=', $id)
            ->where('school_year', '=', $school_year)
            ->get();
        // Debugbar::info( $eventImage);
        // dd($id,$school_year);
        return view('parent.show-activity-image', compact('eventImage'));
    }
}
