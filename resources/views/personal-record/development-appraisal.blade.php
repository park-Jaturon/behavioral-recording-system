@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-start align-items-center g-2">
                            <div class="col-md-4 text-start">
                                <a class="btn btn-info" href="{{ route('teacher.dashboard') }}" role="button"><i
                                    class="bi bi-chevron-left"></i>กลับ</a>
                            </div>
                            <div class="col-md-4 text-center">
                                {{ __('แบบประเมินพัฒนาการ ') }}
                            </div>
                        </div>
                        
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
                                            @if ($data->level == 'อบ2')
                                                <a href="{{ url('teacher/record/appraisal/add/' . $data->student_id) }}"
                                                    style="text-decoration: none;">
                                                    {{ $data->prefix_name . $data->first_name . ' ' . $data->last_name }}
                                                </a>
                                            @else
                                                <a href="{{ url('teacher/record/appraisal/add2/' . $data->student_id) }}"
                                                    style="text-decoration: none;">
                                                    {{ $data->prefix_name . $data->first_name . ' ' . $data->last_name }}
                                                </a>
                                            @endif

                                        </td>
                                        <td class=" text-center">{{ $data->room_name }}</td>
                                        <td class=" text-center">
                                            @if ($data->level == 'อบ2')
                                                <a class="btn btn-primary"
                                                    href="{{ url('teacher/record/appraisal/show/' . $data->student_id) }}" role="button">ดูบันทึก</a>
                                                    
                                            @else
                                                <a class="btn btn-primary" href="{{ url('teacher/record/appraisal/show2/' . $data->student_id) }}" role="button">ดูบันทึก</a>
                                            @endif

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
