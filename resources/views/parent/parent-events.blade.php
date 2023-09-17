@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-start align-items-center g-2">
                            <div class="col-md-4">
                                <a class="btn btn-info" href="{{ route('home.parent') }}" role="button"><i
                                    class="bi bi-chevron-left"></i>กลับ</a>
                            </div>
                            <div class="col-md-4 text-center">
                                {{ __('ตารางเรียน') }}
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
                                            {{ $row->prefix_name . $row->first_name . ' ' . $row->last_name }}
                                        </th>
                                        <td> <a href="{{ url('parent/descendant/events/show/' . $row->rooms_id) }}"
                                                style="text-decoration: none;">{{ $row->room_name }}</a></td>
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
