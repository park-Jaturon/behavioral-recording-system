<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Composer;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        $post = Post::all();
       
        return view('teacher.post-index', compact('post'));
    }

    public function add_post()
    {
        $data = new  Post();
        return view('teacher.add-post', compact('data'));
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

    public function store(Request $request)
    {
        // dd($request);
        Post::create([
            'teachers_id' => Auth::user()->users_id,
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
