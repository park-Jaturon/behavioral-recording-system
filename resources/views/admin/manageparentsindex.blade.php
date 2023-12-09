@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif
    @if ($message = Session::get('successupdaterelationship'))
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
                <h3>ผู้ปกครอง</h3>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('add.parents') }}" class=" btn btn-primary float-end">เพิ่ม</a>
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
            <div class="col-md-8">
                <table id="tbParent" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">ชื่อ-นามสกุล</th>
                            <th class="text-center" scope="col">นักเรียนในปกครอง</th>
                            <th class="text-center" scope="col">อาชีพ</th>
                            <th class="text-center" scope="col"></th>
                            <th class="text-center" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="result-box">
                        @foreach ($parent as $parents)
                            <tr>
                                <td>{{ $parents->prefix_name . $parents->first_name . ' ' . $parents->last_name }}</td>
                                <td>
                                    @foreach ($parents->students as $Dstuden)
                                    <p>{{ $Dstuden->prefix_name . $Dstuden->first_name . ' ' . $Dstuden->last_name }}</p>
                                        {{-- <a href="{{ route('edit.student', ['student_id' => $Dstuden->student_id]) }}" style="text-decoration: none;">{{ $Dstuden->prefix_name . $Dstuden->first_name . ' ' . $Dstuden->last_name }}</a>
                                        <br> --}}
                                    @endforeach
                                </td>
                                <td class="text-center">{{ $parents->job }}</td>
                                <td class="text-center">
                                    <a
                                        class="btn btn-warning "href="{{ url('admin/parent/edit/' . $parents->parents_id) }}"role="button">แก้ไข</a>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger delete-item"
                                        data-parents_id="{{ $parents->parents_id }}">ลบ</button>

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
    <script src="\js\confirm-delete-parents.js"></script>
    <script>
        let availablekeywords = {!! $parent !!};

        // ใช้ .map() เพื่อดึงข้อมูล prefix_name, first_name, last_name
        const parentInfoArray = availablekeywords.map((parent) => {
            const {
                prefix_name,
                first_name,
                last_name
            } = parent;
            return {
                name: `${prefix_name}${first_name} ${last_name}`,
                detail: parent,
            };
        });

        console.log(parentInfoArray);
        const resultsBox = document.getElementById("result-box");
        const inputBox = document.getElementById("live_search");

        inputBox.onkeyup = function() {
            let result = [];
            let input = inputBox.value;
            if (input.length > 0 ) {
                result = parentInfoArray.filter((keyword) => {
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
                // ตรวจสอบว่าข้อมูล list.detail.students มีค่าหรือไม่
                if (list.detail.students && list.detail.students.length > 0) {
                    const studentName = list.detail.students.map((student) => {
                        return `<a href="${$url}/admin/student/edit/${student.student_id}" style="text-decoration: none;">${student.prefix_name}${student.first_name} ${student.last_name}</a>`;
                    }).join("<br>");
                    return `<tr>
                    <td class="text-center" scope="row">${list.name}</td>
                    <td>${studentName}</td>
                    <td class="text-center">${list.detail.job}</td>
                    <td class="text-center">
                        <a class="btn btn-warning" href="${$url}/admin/parent/edit/${list.detail.parents_id}" role="button">แก้ไข</a>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-danger delete-item" data-parents_id="${list.detail.parents_id}">ลบ</button>
                    </td>
                </tr>`;
                } else {
                    // ถ้าไม่มีข้อมูล student ให้แสดงเป็นข้อมูลว่าง
                    return `
                <tr>
                    <td class="text-center" scope="row">${list.name}</td>
                    <td></td>
                    <td class="text-center">${list.detail.job}</td>
                    <td class="text-center">
                        <a class="btn btn-warning" href="${$url}/admin/parent/edit/${list.detail.parents_id}" role="button">แก้ไข</a>
                    </td>
                    <td class="text-center">
                        <button type="button" class="btn btn-danger delete-item" data-parents_id="${list.detail.parents_id}">ลบ</button>
                    </td>
                </tr>
            `;
                }
            });
            resultsBox.innerHTML = content.join("");
        }
    </script>
@endsection
