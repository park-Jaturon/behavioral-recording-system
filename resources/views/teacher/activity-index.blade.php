@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">วันที่</th>
                            <th scope="col">เรื่อง</th>
                            <th scope="col">เพื่มรูป</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($event as $events)
                            <tr class="">
                                <td scope="row">{{ date('d-m-Y ', strtotime($events->start)) }}</td>
                                <td><a href="{{ url('teacher/activity/' . $events->events_id) }}">{{ $events->title }}</a>
                                </td>
                                <td>
                                    <a href="{{ url('teacher/activity/add/' . $events->events_id) }}" class="btn btn-info">เพิ่ม</a>
                                       
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
