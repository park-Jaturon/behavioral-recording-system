@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center g-2">
            <div class="col-md-8">
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
                            {{ $row->p_topic }}
                        </div>
                        <div class="card-body">
                            <div class="mb-3">

                                {!! $row->p_description !!}
                            </div>
                        </div>
                        @if (auth()->User()->rank == 'teacher')
                            <div class="card-footer text-end">
                                <a href="{{ url('teacher/post/edit/' . $row->posts_id) }}" class="btn btn-primary">แก้ไข</a>
                                <button type="button" class="btn btn-danger delete-item " data-posts_id="{{ $row->posts_id }}">ลบ</button>                              
                            </div>
                        @endif

                    </div>
                @endforeach
            </div>

        </div>
    </div>
   
    
@endsection

@section('script')
<script src="\js\confirm-delete-post.js"></script>
@endsection