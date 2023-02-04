@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center"> {{ $user[0]->room_name}}</div>

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
                                        <th scope="col">เบอร์โทรบิดา</th>
                                        <th scope="col">เบอร์โทรมารดา</th>
                                        <th scope="col">เบอร์โทรถรับส่ง</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user as $users)
                                        <tr class="">
                                            <td class="text-center">{{ $users->number }}</td>
                                            <td>{{ $users->prefix_name . $users->prefix_name . ' ' . $users->last_name }}</td>
                                            <td>{{$users->telephone_number_father}}</td>
                                            <td>{{$users->telephone_number_mother}}</td>
                                            <td>{{$users->telephone_number_bus}}</td>
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
