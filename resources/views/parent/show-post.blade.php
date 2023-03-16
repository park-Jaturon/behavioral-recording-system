@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ประกาศ') }}</div>

                <div class="card-body">
                    @foreach ($showpost as $row)
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
    </div>
</div>
@endsection