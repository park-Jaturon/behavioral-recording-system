@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <a href="{{ route('register') }}" class=" btn btn-primary float-end">เพิ่ม</a>
            <div class="col-md-6 mt-3">
                <div class="card">
                    <div class="card-header">{{ __('ผู้ใช้งานครู') }}
                        
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">ชื่อผู้ใช้งาน</th>
                                        <th scope="col">ID</th>
                                        <th scope="col">ตำแหน่ง</th>
                                        <th scope="col">แก้ไข</th>
                                        <th scope="col">ลบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($userteachers as $teacher)
                                        <tr class="">
                                            <td >{{$teacher->prefix_name.$teacher->first_name.' '.$teacher->last_name}}</td>
                                            <td >{{$teacher->users_name}}</td>
                                            <td>{{$teacher->rank}}</td>
                                            <td class="text-center">
                                                <a
                                                    class="btn btn-warning "href="{{ url('admin/room/edit/' . $teacher->users_id) }}"role="button">แก้ไข</a>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger delete-item"
                                                    data-rooms_id="{{ $teacher->users_id }}">ลบ</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-6 mt-3">
                <div class="card">
                    <div class="card-header">{{ __('ผู้ใช้งานผู้ปกครอง') }}
                        
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">ชื่อผู้ใช้งาน</th>
                                        <th scope="col">ID</th>
                                        <th scope="col">ตำแหน่ง</th>
                                        <th scope="col">แก้ไข</th>
                                        <th scope="col">ลบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($userparents as $parent)
                                        <tr class="">
                                            <td >{{$parent->prefix_name.$parent->first_name.' '.$parent->last_name}}</td>
                                            <td >{{$parent->users_name}}</td>
                                            <td>{{$parent->rank}}</td>
                                            <td class="text-center">
                                                <a
                                                    class="btn btn-warning "href="{{ url('admin/room/edit/' . $parent->users_id) }}"role="button">แก้ไข</a>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger delete-item"
                                                    data-rooms_id="{{ $parent->users_id }}">ลบ</button>
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
