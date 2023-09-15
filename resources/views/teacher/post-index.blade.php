@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row align-items-center g-2">
            <div class="col-md-auto align-self-start">
                <a class="btn btn-light" href="{{ route('teacher.dashboard') }}" role="button"><i
                    class="bi bi-chevron-left"></i></a>
              </div>
            <div class="col-md-auto align-self-start">
                <h3>ประกาศ</h3>
            </div>
            <div class="col align-self-end">
                <a href="{{ route('add.post') }}" class=" btn btn-success float-end">เพิ่ม</a>
              </div>
           
            @if ($message = Session::get('successaddpost'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
            @endif
        </div>
        <div class="row justify-content-center align-items-center g-2 ">

            <div class="col mt-4 ">
                @foreach ($post as $row)
                    <div class="card mb-3">
                        <div class="card-header">
                            <div class="row">
                                <div class="col"><label for="topic">{{ $row->p_topic}}</label></div>
                                <div class="col text-end"> <label for="status">{{__('สถานะ').' '.':'.' '.$row->status}}</label></div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">

                                {!! $row->p_description !!}
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            @if (auth()->User()->rank == 'teacher')
                                <a href="{{ url('teacher/post/edit/' . $row->posts_id) }}" class="btn btn-primary">แก้ไข</a>
                                <button type="button" class="btn btn-danger delete-item "
                                    data-posts_id="{{ $row->posts_id }}">ลบ</button>
                            @endif
                        </div>

                    </div>
                @endforeach
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script src="\js\confirm-delete-post.js"></script>
@endsection
