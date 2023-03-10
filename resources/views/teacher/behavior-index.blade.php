@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('รายงานพฤติกรรม') }}
                        <a href="{{ route('add.behavior') }}" class=" btn btn-primary float-end">เพิ่ม</a>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">เลขที่</th>
                                    <th scope="col">ชื่อ - นามสกุล</th>
                                    <th scope="col">รายงาน</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($behavior as $data)
                                    <tr>
                                        <th scope="row">{{ $data->number }}</th>
                                        <td>{{ $data->prefix_name . $data->first_name . ' ' . $data->last_name }}</td>
                                        <td> <a
                                                href="{{ url('teacher/behavior/report/' . $data->student_id) }}" style="text-decoration: none;">{{ $data->report }}</a>
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
