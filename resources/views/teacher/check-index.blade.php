@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="width: 100%">
                    <div class="card-header">
                        <div class="row justify-content-start align-items-center g-2">
                            <div class="col-auto">
                                <a class="btn btn-light" href="{{ route('teacher.dashboard') }}" role="button"><i
                                    class="bi bi-chevron-left"></i></a>
                            </div>
                            <div class="col-auto">
                                {{ __('ตารางลงเวลา') }} {{$datenow}}
                            </div>
                        </div>
                    </div>

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
                                                    style="text-decoration: none;">{{ $students->prefix_name . $students->first_name . ' ' . $students->last_name }}</a>
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
