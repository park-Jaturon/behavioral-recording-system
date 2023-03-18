<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
       $post = DB::table('teachers')
       ->join('users', 'teachers.teachers_id', '=', 'users.users_id')
       ->where('teachers.teachers_id', '=', Auth::user()->rank_id)
       ->join('posts','teachers.rooms_id','=','posts.rooms_id')
       ->get();
    //    dd($post);
        return view('teacher.post-index', compact('post'));
    }

    public function add_post()
    {
        $room = DB::table('teachers')
        ->join('users', 'teachers.teachers_id', '=', 'users.users_id')
        ->where('teachers.teachers_id', '=', Auth::user()->rank_id)
        ->first();
        $data = new  Post();
        // dd($room->rooms_id);
        return view('teacher.add-post', compact('data','room'));
    }

    public function uploadimage(Request $request)
    {

        if ($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName . '_' . time() . '.' . $extension;

            $request->file('upload')->move(public_path('uploads/poster/'), $fileName);

            $url = asset('uploads/poster/' . $fileName);
            return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
        }
    }

    public function store(Request $request, $rooms_id)
    {
        // dd($request);
        Post::create([
            'rooms_id' => $rooms_id,
            'p_topic' => $request->topic,
            'p_description' => $request->description,
        ]);

        return redirect(route('index.post'))->with('successaddpost', 'บันทึกข้อมูลเสร็จสิ้น');
    }

    public function edit($posts_id)
    {
        $data = Post::findOrFail($posts_id);

        return view('teacher.add-post', compact('data'));
    }

    public function update(Request $request, $posts_id)
    {
        Post::where('posts_id', $posts_id)
            ->update([
                'p_topic' => $request->topic,
                'p_description' => $request->description,
            ]);

        return redirect(route('index.post'))->with('successaddpost', 'บันทึกข้อมูลเสร็จสิ้น');
    }

    public function delete($posts_id)
    {
        Post::destroy($posts_id);
    }
}
