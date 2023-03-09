@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @foreach ($report as $show)
                    <div class="card mb-3">
                        <div class="card-header">
                            {{ $show->type }}

                            @if (auth()->User()->rank == 'teacher')
                                
                                <button type="button" class="btn btn-danger delete-behavior float-end"
                                    data-behavior_id="{{ $show->behavior_id }}">ลบ</button>
                            @endif
                        </div>

                        <div class="card-body">
                            {!! $show->description !!}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="\js\confirm-delete-behaviors.js"></script>
@endsection
