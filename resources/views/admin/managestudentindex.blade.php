@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ route('add.student') }}" class=" btn btn-success float-end">เพิ่ม</a>
            </div>
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
                                <td>{{ $students->prefix_name . $students->prefix_name . ' ' . $students->last_name }}</td>
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
    <script>
        document.querySelector('#tbStudent').addEventListener('click', (e) => {
            if (e.target.matches('.delete-item')) {
                console.log(e.target.dataset.student_id);
                Swal.fire({
                    title: 'Are you sure delete?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete($url + '/admin/student/delete/' + e.target.dataset.student_id).then((
                            response) => {
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            );
                            setTimeout(() => {
                                window.location.href = $url + '/admin/manage/student';
                            }, 2000);
                        });
                    }
                });
            }
        });
    </script>
@endsection
