@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row align-items-center g-2 mb-2">
            <div class="col-md-auto align-self-start">
                <a class="btn btn-light" href="{{ route('admindashboard') }}" role="button"><i class="bi bi-chevron-left"></i></a>
            </div>
            <div class="col-md-auto align-self-start">
                <h3>ผู้ใช้งาน</h3>
            </div>
            <div class="col align-self-ent">
                <a href="{{ route('register') }}" class=" btn btn-primary float-end">เพิ่ม</a>
            </div>
            <div class="row justify-content-center align-items-center g-2">
                <div class="col-md-8 mt-3">
                    @if ($message = Session::get('successupdateuser'))
                        <div class="alert alert-success">
                            {{ $message }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row justify-content-center align-items-start g-2">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        {{ __('ผู้ใช้งานครู') }}
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tbUser1" class="table table-striped">
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
                                            <td>{{ $teacher->prefix_name . $teacher->first_name . ' ' . $teacher->last_name }}
                                            </td>
                                            <td>{{ $teacher->users_name }}</td>
                                            <td>{{ $teacher->rank }}</td>
                                            <td class="text-center">
                                                <a
                                                    class="btn btn-warning "href="{{ url('admin/users/edit/' . $teacher->users_id) }}"role="button">แก้ไข</a>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger delete-item"
                                                    data-users_id="{{ $teacher->users_id }}">ลบ</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('ผู้ใช้งานผู้ปกครอง') }}

                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tbUser2" class="table table-striped">
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
                                            <td>{{ $parent->prefix_name . $parent->first_name . ' ' . $parent->last_name }}
                                            </td>
                                            <td>{{ $parent->users_name }}</td>
                                            <td>{{ $parent->rank }}</td>
                                            <td class="text-center">
                                                <a
                                                    class="btn btn-warning "href="{{ url('admin/users/edit/' . $parent->users_id) }}"role="button">แก้ไข</a>
                                            </td>
                                            <td>
                                                <button type="button" class="btn btn-danger delete-item"
                                                    data-users_id="{{ $parent->users_id }}">ลบ</button>
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

@section('script')
    <script>
        document.querySelector('#tbUser1').addEventListener('click', (e) => {
            if (e.target.matches('.delete-item')) {
                console.log(e.target.dataset.users_id);
                Swal.fire({
                    title: 'คุณแน่ใจน่ะว่าจะลบจริงๆ',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ใช้ฉันต้องการลบ',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete($url + '/admin/users/delete/' + e.target.dataset.users_id).then((
                            response) => {
                            Swal.fire(
                                'ลบแล้ว!',
                                'ข้อมูลของคุณถูกลบไปแล้ว',
                                'success'
                            );
                            setTimeout(() => {
                                window.location.href = $url + '/admin/users';
                            }, 2000);
                        });
                    }
                });
            }
        });

        document.querySelector('#tbUser2').addEventListener('click', (e) => {
            if (e.target.matches('.delete-item')) {
                console.log(e.target.dataset.users_id);
                Swal.fire({
                    title: 'คุณแน่ใจน่ะว่าจะลบจริงๆ',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ใช้ฉันต้องการลบ',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete($url + '/admin/users/delete/' + e.target.dataset.users_id).then((
                            response) => {
                            Swal.fire(
                                'ลบแล้ว!',
                                'ข้อมูลของคุณถูกลบไปแล้ว',
                                'success'
                            );
                            setTimeout(() => {
                                window.location.href = $url + '/admin/users';
                            }, 2000);
                        });
                    }
                });
            }
        });
    </script>
@endsection
