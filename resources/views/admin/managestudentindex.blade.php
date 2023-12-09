@extends('layouts.app')
@section('style')
    <style>
        .have-data {
            style.display = 'none'
        }
    </style>
@endsection
@section('content')
    <div class="container">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif
        <div class="row justify-content-start align-items-center g-2 mb-2">
            <div class="col-md-4">
                <a class="btn btn-info" href="{{ route('admindashboard') }}" role="button"><i
                        class="bi bi-chevron-left"></i>กลับ</a>
            </div>
            <div class="col-md-4 text-center">
                <h3>นักเรียน</h3>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('add.student') }}" class=" btn btn-primary float-end">เพิ่ม</a>
            </div>
        </div>
        <div class="row justify-content-end align-items-center g-2 mb-3">
            <div class="col-md-2">
                <select class="form-select" aria-label="Default select example"
                onchange="selectLevel(value)">
                <option class="text-center" value="0" selected >---ทั้งหมด---</option>
                    <option class="text-center" value="1">อบ1/1</option>
                    <option class="text-center" value="2">อบ1/2</option>
                    <option class="text-center" value="3">อบ1/3</option>
                    <option class="text-center" value="4">อบ1/4</option>
                    <option class="text-center" value="5">อบ1/5</option>
                    <option class="text-center" value="6">อบ1/6</option>
                    <option class="text-center" value="7">อบ2/1</option>
                    <option class="text-center" value="8">อบ2/2</option>
                    <option class="text-center" value="9">อบ2/3</option>
                    <option class="text-center" value="10">อบ2/4</option>
                    <option class="text-center" value="11">อบ2/5</option>
                    <option class="text-center" value="12">อบ2/6</option>
                    <option class="text-center" value="13">อบ3/1</option>
                    <option class="text-center" value="14">อบ3/2</option>
                    <option class="text-center" value="15">อบ3/3</option>
                    <option class="text-center" value="16">อบ3/4</option>
                    <option class="text-center" value="17">อบ3/5</option>
                    <option class="text-center" value="18">อบ3/6</option>
            </select>
            </div>

            <div class="col-md-2">
                <div class="search-box">
                    <input type="text" class="form-control" name="" id="live_search" aria-describedby="helpId"
                        placeholder="">
                </div>
            </div>
            {{-- <div class="col">Column</div> --}}
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table id="tbStudent" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">เลขที่</th>
                            <th class="text-center" scope="col">ชื่อ-นามสกุล</th>
                            <th class="text-center" scope="col">ห้องเรียน</th>
                            <th class="text-center" scope="col">ผู้ปกครอง</th>
                            <th class="text-center" scope="col"></th>
                            <th class="text-center" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="nested-table-body">
                        @foreach ($student as $students)
                            <tr class="result-box">
                                <td class="text-center" scope="row">{{ $students->number }}</td>
                                <td>{{ $students->prefix_name . $students->first_name . ' ' . $students->last_name }}</td>
                                <td class="text-center">
                                    {{ $students->room ? $students->room->room_name : '' }}
                                </td>
                                <td>
                                    {{ $students->parent ? $students->parent->prefix_name . $students->parent->first_name . ' ' . $students->parent->last_name : '' }}
                                </td>
                                <td class="text-center">
                                    <a
                                        class="btn btn-warning "href="{{ url('admin/student/edit/' . $students->student_id) }}"role="button">แก้ไข</a>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger delete-item"
                                        data-student_id="{{ $students->student_id }}">ลบ</button>
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
    <script>
        let availablekeywords = {!! $student !!};
        let levels1_1 = {!! $studentLevel1_1 !!};     //อบ1-1
        let levels1_2 = {!! $studentLevel1_2 !!};     //อบ1-2
        let levels1_3 = {!! $studentLevel1_3 !!};     //อบ1-3
        let levels1_4 = {!! $studentLevel1_4 !!};     //อบ1-4
        let levels1_5 = {!! $studentLevel1_5 !!};     //อบ1-5
        let levels1_6 = {!! $studentLevel1_6 !!};     //อบ1-6
        let levels2_1 = {!! $studentLevel2_1 !!};     //อบ2-1
        let levels2_2 = {!! $studentLevel2_2 !!};     //อบ2-2
        let levels2_3 = {!! $studentLevel2_3 !!};     //อบ2-3
        let levels2_4 = {!! $studentLevel2_4 !!};     //อบ2-4
        let levels2_5 = {!! $studentLevel2_5 !!};     //อบ2-5
        let levels2_6 = {!! $studentLevel2_6 !!};     //อบ2-6
        let levels3_1 = {!! $studentLevel3_1 !!};     //อบ3-1
        let levels3_2 = {!! $studentLevel3_2 !!};     //อบ3-2
        let levels3_3 = {!! $studentLevel3_3 !!};     //อบ3-3
        let levels3_4 = {!! $studentLevel3_4 !!};     //อบ3-4
        let levels3_5 = {!! $studentLevel3_5 !!};     //อบ3-5
        let levels3_6 = {!! $studentLevel3_6 !!};     //อบ3-6

        // ใช้ .map() เพื่อดึงข้อมูล prefix_name, first_name, last_name
        const studentInfoArray = availablekeywords.map((student) => {
            const {
                prefix_name,
                first_name,
                last_name
            } = student;
            return {
                name: `${prefix_name}${first_name} ${last_name}`,
                detail: student
            };
        });


        console.log(studentInfoArray);
        const resultsBox = document.querySelector(".result-box");
        const inputBox = document.getElementById("live_search");

        inputBox.onkeyup = function() {
            let result = [];
            let input = inputBox.value;
            if (input.length) {
                result = studentInfoArray.filter((keyword) => {
                    return keyword.name.toLowerCase().includes(input.toLowerCase());
                });
                display(result);
            }else{
                window.location.reload();
            }
        }

        function display(result) {
            const nestedTableBody = document.getElementById("nested-table-body");
            const content = result.map((list) => {
                // console.log(list);
                return `  <tr>
                    <td class="text-center" scope="row">${list.detail.number}</td>
                                <td>${list.name}</td>
                                <td class="text-center">
                                    ${list.detail.room.room_name}
                                </td>
                                <td class="text-center">
                                    ${list.detail.parent.prefix_name}${list.detail.parent.first_name} ${list.detail.parent.last_name}
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-warning "href=" ${$url}/admin/student/edit/${list.detail.student_id}"role="button">แก้ไข</a>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger delete-item"
                                        data-student_id="${list.detail.student_id}">ลบ</button>
                                </td>
                                </tr>
                                `;
            });
            nestedTableBody.innerHTML = content.join("");
        }

        function selectLevel(value) {
            console.log(value);

            if (value == 1) {
                text = "";
                levels1_1.forEach(myFunction);
                document.getElementById("nested-table-body").innerHTML = text;

            } else if (value == 2) {
                text = "";
                levels1_2.forEach(myFunction);
                document.getElementById("nested-table-body").innerHTML = text;
            } else if (value == 3) {
                text = "";
                levels1_3.forEach(myFunction);
                document.getElementById("nested-table-body").innerHTML = text;
            }else if (value == 4) {
                text = "";
                levels1_4.forEach(myFunction);
                document.getElementById("nested-table-body").innerHTML = text;
            }else if (value == 5) {
                text = "";
                levels1_5.forEach(myFunction);
                document.getElementById("nested-table-body").innerHTML = text;
            }else if (value == 6) {
                text = "";
                levels1_6.forEach(myFunction);
                document.getElementById("nested-table-body").innerHTML = text;
            }else if (value == 7) {
                text = "";
                levels2_1.forEach(myFunction);
                document.getElementById("nested-table-body").innerHTML = text;
            }else if (value == 8) {
                text = "";
                levels2_2.forEach(myFunction);
                document.getElementById("nested-table-body").innerHTML = text;
            }else if (value == 9) {
                text = "";
                console.log(levels2_3);
                levels2_3.forEach(myFunction);
                document.getElementById("nested-table-body").innerHTML = text;
            }else if (value == 10) {
                text = "";
                levels2_4.forEach(myFunction);
                document.getElementById("nested-table-body").innerHTML = text;
            }else if (value == 11) {
                text = "";
                levels2_5.forEach(myFunction);
                document.getElementById("nested-table-body").innerHTML = text;
            }else if (value == 12) {
                text = "";
                levels2_6.forEach(myFunction);
                document.getElementById("nested-table-body").innerHTML = text;
            }else if (value == 13) {
                text = "";
                levels3_1.forEach(myFunction);
                document.getElementById("nested-table-body").innerHTML = text;
            }else if (value == 14) {
                text = "";
                levels3_2.forEach(myFunction);
                document.getElementById("nested-table-body").innerHTML = text;
            }else if (value == 15) {
                text = "";
                console.log(levels3_3);
                levels3_3.forEach(myFunction);
                document.getElementById("nested-table-body").innerHTML = text;
            }else if (value == 16) {
                text = "";
                levels3_4.forEach(myFunction);
                document.getElementById("nested-table-body").innerHTML = text;
            }else if (value == 17) {
                text = "";
                levels3_5.forEach(myFunction);
                document.getElementById("nested-table-body").innerHTML = text;
            }else if (value == 18) {
                text = "";
                levels3_6.forEach(myFunction);
                document.getElementById("nested-table-body").innerHTML = text;
            }else if (value == 0) {
                window.location.reload();
            }
        }

        function myFunction(item) {
            console.log(item);
            text += ` <td class="text-center" scope="row">${item.number}</td>
                                <td>${item. prefix_name}${item. first_name} ${item. last_name}</td>
                                <td class="text-center">
                                    ${item.room.room_name}
                                </td>
                                <td class="text-center">
                                    ${item.parent.prefix_name}${item.parent.first_name} ${item.parent.last_name}
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-warning "href=" ${$url}/admin/student/edit/${item.student_id}"role="button">แก้ไข</a>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-danger delete-item"
                                        data-student_id="${item.student_id}">ลบ</button>
                                </td>
                                </tr>`;

        }
    </script>
@endsection
