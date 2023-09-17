@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center g-2">
                            <div class="col-md-4  text-start">
                                <a class="btn btn-info" href="{{ route('teacher.dashboard') }}" role="button"><i
                                        class="bi bi-chevron-left"></i>กลับ</a>
                            </div>
                            <div class="col-md-4 text-center">
                                @php
                                    if (count($users) > 0) {
                                        echo $users[0]->room_name;
                                    }
                                @endphp
                            </div>
                        </div>

                    </div>

                    <div class="card-body">
                        @if ($message = Session::get('Error'))
                            <div class="alert alert-danger" role="alert">
                                {{ $message }}
                            </div>
                        @endif
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                {{ $message }}
                            </div>
                        @endif
                        <form action="{{ route('up.class') }}" method="post">
                            @csrf
                            <div class="table-responsive">
                                <table class="table table-striped table-fixed">
                                    <thead>
                                        <tr>
                                            <th class="text-center" scope="col">เลขที่</th>
                                            <th scope="col">ชื่อ-นามสกุล</th>
                                            <th scope="col" class=" text-center">สถานะ</th>
                                            <th scope="col" class=" text-center">ดูข้อมูล</th>
                                            <th scope="col" class=" text-center">แก้ไขข้อมูล</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($users as $user)
                                            <tr class="">
                                                <td class="text-center">{{ $user->number }}</td>
                                                <td>
                                                    {{ $user->prefix_name . $user->first_name . ' ' . $user->last_name }}
                                                </td>
                                                <td align="center">
                                                    <div class="col-6 ">
                                                        @if ($user->status == 'เรียนอยู่')
                                                            <input class="form-control" type="text"
                                                                value="{{ $user->status }}"
                                                                aria-label="Disabled input example" disabled readonly
                                                                style="color: rgb(23, 187, 23);">
                                                        @else
                                                            <input class="form-control" type="text"
                                                                value="{{ $user->status }}"
                                                                aria-label="Disabled input example" disabled readonly
                                                                style="color: red;">
                                                        @endif

                                                    </div>
                                                </td>

                                                <td align="center">
                                                    <a class="btn btn-primary "
                                                        href="{{ url('teacher/room/show/' . $user->student_id) }}"
                                                        role="button"><i class="bi bi-eye"></i></a>
                                                </td>
                                                <td align="center"><a class="btn btn-primary "
                                                        href="{{ url('teacher/room/edit/' . $user->student_id) }}"
                                                        role="button"><i class="bi bi-tools"></i></a>
                                                </td>
                                                @if ($user->level == 'อบ2')
                                                    <td>
                                                        @if ($user->elevate == 'true')
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox"
                                                                    name="check[]" value="{{ $user->student_id }}"
                                                                    id="flexCheckDefault">
                                                            </div>
                                                        @endif
                                                    </td>
                                                @endif
                                                @if ($user->level == 'อบ1')
                                                    <td>
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" name="check[]"
                                                                value="{{ $user->student_id }}" id="flexCheckDefault">
                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                        @empty

                                            <div class="alert alert-info text-center" role="alert">
                                                <h4><strong>ยังไม่มีนักเรียนในห้องเรียนนี้</strong> </h4>
                                            </div>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            @if (count($users) > 0)
                                <input type="hidden" name="cLevel" value="{{ $users[0]->level }}" />
                                <input type="hidden" name="idRoom" value="{{ $users[0]->rooms_id }}" />
                            @endif

                            <div class="row justify-content-end align-items-start g-2">
                                <div class="col-auto">
                                    @if (count($users) > 0)
                                        @if ($users[0]->level == 'อบ2')
                                            @if ($UpClass == 'true')
                                                <button type="submit" class="btn btn-primary ">เลื่อนขั้น</button>
                                            @endif
                                        @endif
                                        @if ($users[0]->level == 'อบ1')
                                            <button type="submit" class="btn btn-primary ">เลื่อนขั้น</button>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        console.log(flexCheckDefault).value;

        function upClass() {
            //   document.getElementById("demo").innerHTML = "Hello World";
            // console.log({{}});

            axios.post($url + '/teacher/students/upClass', {
                    students: {!! $users !!},

                })
                .then(function(response) {
                    console.log(response);
                    window.location.reload();
                })
                .catch(function(error) {

                    console.log(error);
                });
        }
    </script>
@endsection
