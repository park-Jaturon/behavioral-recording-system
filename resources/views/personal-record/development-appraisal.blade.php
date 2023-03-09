@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('แบบประเมินพัฒนาการ ') }}
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
                                    <th scope="col" class=" text-center">เลขที่</th>
                                    <th scope="col" class=" text-center">ชื่อ - นามสกุล</th>
                                    <th scope="col" class=" text-center">ห้อง</th>
                                    <th scope="col" class=" text-center">แบบประเมินพัฒนาการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $data)
                                    <tr>
                                        <th scope="row" class=" text-center">{{ $data->number }}</th>
                                        <td>
                                            <a href="{{url('teacher/record/appraisal/add/'.$data->student_id)}}" style="text-decoration: none;">
                                                {{ $data->prefix_name . $data->first_name . ' ' . $data->last_name }}
                                            </a>
                                        </td>
                                        <td class=" text-center">{{ $data->room_name }}</td>
                                        <td class=" text-center">
                                            <a class="btn btn-primary" href="{{url('teacher/record/appraisal/show/'.$data->student_id)}}" role="button">ดูบันทึก</a>
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
