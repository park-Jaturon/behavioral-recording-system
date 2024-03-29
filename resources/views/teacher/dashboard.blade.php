@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-start align-items-center g-2">
                            <div class="col-md-6 text-start">
                                {{ __('Dashboard') }}
                            </div>
                            <div class="col-md-6 text-end">
                                <span style="font-size:16px;">{{$users->rank_teacher.': '.$users->prefix_name.$users->first_name.' '.$users->last_name}}</span>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                {{ $message }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">ห้องเรียน</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{ route('teacher.room') }}">View
                                            Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">ลงเวลา</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{ route('index.check') }}">View
                                            Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">ประกาศ</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{ route('index.post') }}">View
                                            Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">ปฏิทินกิจกรรม</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="{{ route('index.event') }}">View
                                            Details</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            @if (strstr($users->room_name, 'อบ2') || strstr($users->room_name, 'อบ3'))
                                <div class="col-xl-3 col-md-6">
                                    <div class="card  text-white mb-4" style="background-color: #60cfae;">
                                        <div class="card-body">แบบประเมินพัฒนาการ</div>
                                        <div class="card-footer d-flex align-items-center justify-content-between">
                                            <a class="small text-white stretched-link"
                                                href="{{ route('record.appraisal') }}">View Details</a>
                                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
