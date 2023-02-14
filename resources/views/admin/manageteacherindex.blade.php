@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ route('add.teacher') }}" class=" btn btn-primary float-end">เพิ่ม</a>
            </div>
            <div class="table-responsive my-3">
                <table id="tbTeacher" class="table table-striped">
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
                                <td>{{ $teachers->prefix_name }}{{ $teachers->first_name }} {{ $teachers->last_name }}</td>
                                <td>{{ $teachers->rank_teacher }}</td>
                                <td>{{ $teachers->room_name }}</td>
                                <td><img src="{{ asset('uploads/teacher/' . $teachers->teacher_image) }}" width="100"
                                        height="120" alt=""></td>
                                <td class="text-center">
                                    <a class="btn btn-warning "
                                        href="{{ url('admin/teacher/edit/' . $teachers->teachers_id) }}"role="button">แก้ไข</a>
                                </td>
                                <td>
                                    <div class="d-grid gap-2">
                                        <button type="button" class="btn btn-danger delete-item"
                                            data-teachers_id="{{ $teachers->teachers_id }}">ลบ</button>
                                    </div>
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
<script src="\js\confirm-delete-teacher.js"></script>
@endsection

