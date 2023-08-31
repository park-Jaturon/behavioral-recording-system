@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-center"> 
                        @php
                            if (count($users)>0) {
                               echo $users[0]->room_name;
                            }
                        @endphp
                        </div>
                    
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
                                        <th scope="col" class=" text-center">สถานะ</th>
                                        <th scope="col" class=" text-center">ดูข้อมูล</th>
                                        <th scope="col" class=" text-center">แก้ไขข้อมูล</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                    <tr class="">
                                        <td class="text-center">{{ $user->number }}</td>
                                        <td>{{ $user->prefix_name . $user->first_name . ' ' . $user->last_name }}
                                        </td>
                                        <td align="center">
                                            <div class="col-6 ">
                                                @if ($user->status == 'เรียนอยู่')
                                                    <input class="form-control" type="text"
                                                        value="{{ $user->status }}" aria-label="Disabled input example"
                                                        disabled readonly style="color: rgb(23, 187, 23);">
                                                @else
                                                    <input class="form-control" type="text"
                                                        value="{{ $user->status }}" aria-label="Disabled input example"
                                                        disabled readonly style="color: red;">
                                                @endif

                                            </div>

                                        </td>
                                        <td align="center"><a class="btn btn-primary "
                                                href="{{ url('teacher/room/show/' . $user->student_id) }}"
                                                role="button"><i class="bi bi-eye"></i></a></td>
                                        <td align="center"><a class="btn btn-primary "
                                                href="{{ url('teacher/room/edit/' . $user->student_id) }}"
                                                role="button"><i class="bi bi-tools"></i></a></td>
                                    </tr>
                                @empty
                               
                                <div class="alert alert-info text-center" role="alert">
                                  <h4><strong>ยังไม่มีนักเรียนในห้องเรียนนี้</strong> </h4>  
                                </div>
                                    
                                @endforelse
                                </tbody>
                            </table>
                            @if ($UpClass == true)
                                <div class="col text-end">
                                    <button type="button" class="btn btn-primary" onclick="upClass()">เลื่อนขั้น</button>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
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
