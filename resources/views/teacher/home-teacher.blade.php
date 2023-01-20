@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                {{ $message }}
                            </div>
                        @endif

                        @foreach ($room as $rooms)
                            <div class="row justify-content-center align-items-center g-2 mb-2">
                                <div class="col-4 float-start mx-2">
                                    <h4 class="text-center">ครูประจำห้อง</h4>
                                    <img src="{{ asset('uploadds/aideteacher/' . $rooms->teacher_image) }}"
                                        class="rounded float-center" width="150" height="150"><br>
                                        <h3><span>{{$rooms->room_teacher}}</span></h3>
                                </div>
                                <div class="col-4 float-end mx-2">
                                    <h4 class="text-center">ครูพี่เลี้ยง</h4>
                                    <img src="{{ asset('uploadds/aideteacher/' . $rooms->aide_teacher_image) }}"
                                        class="rounded float-center" width="150" height="150"><br>
                                      <h3><span>{{$rooms->room_aide_teacher}}</span></h3>  
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
