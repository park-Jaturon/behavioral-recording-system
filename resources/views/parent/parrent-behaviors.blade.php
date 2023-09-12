@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-start align-items-center g-2">
                            <div class="col-auto">
                                <a class="btn btn-light" href="{{ route('home.parent') }}" role="button"><i
                                    class="bi bi-chevron-left"></i></a>
                            </div>
                            <div class="col">
                                {{ __('รายงานพฤติกรรม') }}
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
                                    <th scope="col">ชื่อ-นามสกุล</th>
                                    <th scope="col">ห้อง</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($students as $row)
                                    <tr>
                                        <th scope="row">
                                            <a href="{{ url('parent/descendant/behavior/show/' . $row->student_id) }}"
                                                style="text-decoration: none;">
                                                {{ $row->prefix_name . $row->first_name . ' ' . $row->last_name }}
                                            </a>
                                        </th>
                                        <td> {{ $row->room_name }}</td>
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
