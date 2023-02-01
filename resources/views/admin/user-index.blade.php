@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('ผู้ใช้งาน') }}
                        <a href="{{ route('register') }}" class=" btn btn-primary float-end">เพิ่ม</a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">ชื่อผู้ใช้งาน</th>
                                        <th scope="col">ตำแหน่ง</th>
                                        <th scope="col">แก้ไข</th>
                                        <th scope="col">ลบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user as $users)
                                        <tr class="">
                                            <td >{{$users->users_name}}</td>
                                            <td>{{$users->rank}}</td>
                                            <td class="text-center">
                                                <a
                                                    class="btn btn-warning "href="{{ url('admin/room/edit/' . $users->users_id) }}"role="button">แก้ไข</a>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger delete-item"
                                                    data-rooms_id="{{ $users->users_id }}">ลบ</button>
                                                @vite(['resources/js/confirm-delete-room.js'])
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
