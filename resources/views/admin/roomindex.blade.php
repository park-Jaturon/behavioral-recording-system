@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-auto align-self-start">
                <a class="btn btn-light" href="{{ route('admindashboard') }}" role="button"><i
                    class="bi bi-chevron-left"></i></a>
              </div>
              <div class="col-md-auto align-self-start">
                <h3>ห้องเรียน</h3>
              </div>
              <div class="col align-self-end">
                <a href="{{ route('add.room') }}" class=" btn btn-primary float-end">เพิ่ม</a>
              </div>
          </div>
        <div class="row justify-content-center align-items-center g-2">
            <div class="col">
                <div class="table-responsive my-3">
                    <table id="tbRoom" class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col" class="text-center">ห้อง</th>
                                <th scope="col" class="text-center">แก้ไข</th>
                                <th scope="col">ลบ</th>
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
    </div>
@endsection

@section('script')
    <script src="\js\confirm-delete-room.js"></script>
@endsection
