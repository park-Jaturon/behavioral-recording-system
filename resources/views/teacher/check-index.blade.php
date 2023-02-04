@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="width: 100%">
                    <div class="card-header">{{ __('ตารางลงเวลา') }} {{$datenow}}</div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">เลขที่</th>
                                        <th  scope="col">ชื่อ-นามสกุล</th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($student as $students)
                                        <tr class="">
                                            <td class="text-center" scope="row">{{ $students->number }}</td>
                                            <td >
                                                <a href="{{ url('teacher/post-time/' . $students->student_id) }}"
                                                    style="text-decoration: none;">{{ $students->prefix_name . $students->prefix_name . ' ' . $students->last_name }}</a>
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
    </div>
@endsection
