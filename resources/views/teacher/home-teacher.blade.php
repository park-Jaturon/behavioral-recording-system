@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center"> {{ $user[0]->room_name }}</div>

                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                {{ $message }}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table table-striped table-fixed">
                                <thead>
                                    <tr>
                                        <th class="text-center" scope="col">เลขที่</th>
                                        <th scope="col">ชื่อ-นามสกุล</th>
                                        <th scope="col" class=" text-center">ดูข้อมูล</th>
                                        <th scope="col" class=" text-center">แก้ไขข้อมูล</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user as $users)
                                        <tr class="">
                                            <td class="text-center">{{ $users->number }}</td>
                                            <td>{{ $users->prefix_name . $users->first_name . ' ' . $users->last_name }}
                                            </td>
                                            <td align="center"><a class="btn btn-primary "
                                                    href="{{ url('teacher/room/show/' . $users->student_id) }}"
                                                    role="button"><i class="bi bi-eye"></i></a></td>
                                            <td align="center"><a class="btn btn-primary "
                                                    href="{{ url('teacher/room/edit/' . $users->student_id) }}"
                                                    role="button"><i class="bi bi-tools"></i></a></td>
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
