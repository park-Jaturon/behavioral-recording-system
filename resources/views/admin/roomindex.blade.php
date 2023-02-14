@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3>ห้องเรียน</h3>
            </div>
            <div class="col-md-8">
                <a href="{{ route('add.room') }}" class=" btn btn-primary float-end">เพิ่ม</a>
            </div>
            <div class="table-responsive my-3">
                <table id="tbRoom" class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ห้อง</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($room as $rooms)
                            <tr>
                                <td>{{ $rooms->room_name }}</td>
                                <td class="text-center">
                                    <a
                                        class="btn btn-warning "href="{{ url('admin/room/edit/' . $rooms->rooms_id) }}"role="button">แก้ไข</a>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger delete-item"
                                        data-rooms_id="{{ $rooms->rooms_id }}">ลบ</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script src="\js\confirm-delete-room.js"></script>
@endsection
