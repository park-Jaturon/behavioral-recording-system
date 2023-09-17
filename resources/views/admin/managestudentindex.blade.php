@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-start align-items-center g-2">
            <div class="col-md-4">
                <a class="btn btn-info" href="{{ route('admindashboard') }}" role="button"><i class="bi bi-chevron-left"></i>กลับ</a>
            </div>
            <div class="col-md-4 text-center">
                <h3>นักเรียน</h3>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('add.student') }}" class=" btn btn-success float-end">เพิ่ม</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table id="tbStudent" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">เลขที่</th>
                            <th class="text-center" scope="col">ชื่อ-นามสกุล</th>
                            <th class="text-center" scope="col">ห้องเรียน</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($student as $students)
                            <tr>
                                <td class="text-center" scope="row">{{ $students->number }}</td>
                                <td>{{ $students->prefix_name . $students->first_name . ' ' . $students->last_name }}</td>
                                <td class="text-center">{{ $students->room_name }}</td>
                                <td class="text-center">
                                    <a
                                        class="btn btn-warning "href="{{ url('admin/student/edit/' . $students->student_id) }}"role="button">แก้ไข</a>
                                </td>
                                <td>
                                    <div class="d-grid gap-2">
                                        <button type="button" class="btn btn-danger delete-item"
                                            data-student_id="{{ $students->student_id }}">ลบ</button>
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
<script src="\js\confirm-delete.js"></script>
@endsection