@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{-- @foreach ($user as $users)
                            {{ __('บันทึกน้ำหนัก - ส่วนสูง ห้อง') . $users->room_name }}
                        @endforeach --}}
                        {{ __('บันทึกน้ำหนัก - ส่วนสูง ') }}
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">เลขที่</th>
                                    <th scope="col">ชื่อ - นามสกุล</th>
                                    <th scope="col">ห้อง</th>
                                    <th scope="col">น้ำหนัก - ส่วนสูง</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $data)
                                    <tr>
                                        <th scope="row">{{ $data->number }}</th>
                                        <td>
                                            <a href="{{url('teacher/record/weight-height/add/'.$data->student_id)}}" style="text-decoration: none;">
                                                {{ $data->prefix_name . $data->first_name . ' ' . $data->last_name }}
                                            </a>
                                        </td>
                                        <td>{{ $data->room_name }}</td>
                                        <td>
                                            <a class="btn btn-primary" href="{{url('teacher/record/weight-height/show/'.$data->student_id)}}" role="button">ดูบันทึก</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
