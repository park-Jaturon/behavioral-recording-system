@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ route('add.teacher') }}" class=" btn btn-primary float-end">เพิ่ม</a>
            </div>
            <div class="table-responsive my-3">
                <table class="table table-primary">
                    <thead>
                        <tr>
                            <th scope="col">ชื่อ</th>
                            <th scope="col">ตำแหน่ง</th>
                            <th scope="col">ห้อง</th>
                            <th scope="col">รูป</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($teacher as $teachers)
                            <tr>
                                <td>{{$teachers->prefix_name}}{{$teachers->first_name}} {{$teachers->last_name}}</td>
                                <td>{{$teachers->rank_teacher}}</td>
                                <td>{{$teachers->room_name}}</td>
                                <td><img src="{{asset('uploads/teacher/'.$teachers->teacher_image)}}" width="150" height="150" alt=""></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
