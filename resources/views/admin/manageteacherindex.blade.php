@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-start align-items-center g-2 mb-2">
            <div class="col-md-4">
                <a class="btn btn-info" href="{{ route('admindashboard') }}" role="button"><i class="bi bi-chevron-left"></i>กลับ</a>
            </div>
            <div class="col-md-4 text-center">
                <h3>ครู</h3>
            </div>
            <div class="col-md-4">
                <a href="{{ route('add.teacher') }}" class=" btn btn-primary float-end">เพิ่ม</a>
            </div>
        </div>
        <div class="row justify-content-end align-items-center g-2 mb-3">
            <div class="col-md-2">
                <input type="text" class="form-control" name="" id="live_search" aria-describedby="helpId"
                    placeholder="">
            </div>
            {{-- <div class="col">Column</div>
            <div class="col">Column</div> --}}
        </div>
        <div class="row justify-content-center">
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
                    <tbody id="result-box">
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
<script>
    let availablekeywords = {!! $teacher !!};

     // ใช้ .map() เพื่อดึงข้อมูล prefix_name, first_name, last_name
     const teacherInfoArray = availablekeywords.map((teacher) => {
            const {
                prefix_name,
                first_name,
                last_name
            } = teacher;
            return {
                name: `${prefix_name}${first_name} ${last_name}`,
                detail: teacher
            };
        });

        console.log(teacherInfoArray);
        const resultsBox = document.getElementById("result-box");
        const inputBox = document.getElementById("live_search");

        inputBox.onkeyup = function() {
            let result = [];
            let input = inputBox.value;
            if (input.length > 0 ) {
                result = teacherInfoArray.filter((keyword) => {
                    return keyword.name.toLowerCase().includes(input.toLowerCase());
                });
                // console.log(result);
                display(result);
            }else{
                window.location.reload();
            }
            
        }

        function display(result) {
            const content = result.map((list) => {
                console.log(list);
                return `
                <tr>
                                <td>${list.name}</td>
                                <td>${list.detail.rank_teacher}</td>
                                <td>${list.detail.room_name}</td>
                                <td>
                                    <img src="/uploads/teacher/${list.detail.teacher_image}" width="100"height="120" alt="">
                                    </td>
                                <td class="text-center">
                                    <a class="btn btn-warning "
                                        href="${$url}/admin/teacher/edit/${list.detail.teachers_id}"role="button">แก้ไข</a>
                                </td>
                                <td>
                                    <div class="d-grid gap-2">
                                        <button type="button" class="btn btn-danger delete-item"
                                            data-teachers_id="${list.detail.teachers_id}">ลบ</button>
                                    </div>
                                </td>
                            </tr>
                `
            });
            resultsBox.innerHTML = content.join("");
        }
</script>
@endsection

