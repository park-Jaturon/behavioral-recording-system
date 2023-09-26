@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row align-items-center g-2">
            <div class="col text-start">
                <a class="btn btn-info" href="{{ route('teacher.dashboard') }}" role="button"><i
                        class="bi bi-chevron-left"></i>กลับ</a>
            </div>
            <div class="col text-center">
                <h3 class="">ประกาศ</h3>
            </div>
            <div class="col text-end">
                <a href="{{ route('add.post') }}" class=" btn btn-success ">เพิ่ม</a>
            </div>

            @if ($message = Session::get('successaddpost'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
            @endif
        </div>
        <div class="row justify-content-center align-items-center g-2 ">

            <div class="col-8 mt-4 ">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">เรื่อง</th>
                            <th scope="col">สถานะ</th>
                            <th scope="col">ดูประกาศ</th>
                            <th scope="col">แก้ไข</th>
                            <th scope="col">ลบ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($post as $row)
                            <tr>
                                <th scope="row">
                                    <label for="topic">{{ $row->p_topic }}</label>
                                </th>
                                <td>
                                    <label for="status">{{ $row->status }}</label>
                                </td>
                                <td>
                                    <button type="button" id="showModal" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#exampleModal" data-id="{{ $row->posts_id }}">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </td>
                                <td>
                                    <a href="{{ url('teacher/post/edit/' . $row->posts_id) }}"
                                        class="btn btn-warning">แก้ไข</a>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger delete-item "
                                        data-posts_id="{{ $row->posts_id }}">ลบ</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <p id="modal-content-p-status" class="col-4 text-start status"></p>
                        <h1 class="col-4 modal-title fs-5 text-center" id="modal-content-p-topic"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="modal-content-p-description"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="\js\confirm-delete-post.js"></script>
    <script>
        let showModalElements = document.querySelectorAll('#showModal');
        let dataPost = {!! $post !!}
        console.log(dataPost);
        showModalElements.forEach(element => {
            element.addEventListener('click', () => {
                let dataId = element.getAttribute(
                    'data-id'); // เรียกเมธอดบน element ไม่ใช่ที่ showModalElements
                showModal(dataId);
            });
        });

        function showModal(dataId) {
            // กรองข้อมูลจาก Array โดยค้นหาข้อมูลที่มี posts_id ตรงกับ dataId
            let filteredData = dataPost.filter(item => item.posts_id == dataId);
            // console.log(filteredData);
            if (filteredData) {
                // เข้าถึง Element ที่จะแสดงข้อมูลใน Modal
                const modalContentPlaceholder = document.getElementById('modal-content-p-topic');
                const modalContentPdescription = document.getElementById('modal-content-p-description');
                const modalContentPstatus = document.getElementById('modal-content-p-status');
                // กำหนดเนื้อหาของ Modal
                modalContentPlaceholder.textContent = `${filteredData[0].p_topic}`;
                modalContentPdescription.innerHTML = `${filteredData[0].p_description}`;
                modalContentPstatus.textContent = `${filteredData[0].status}`;
                // ตรวจสอบค่าและกำหนดคลาส CSS ตามเงื่อนไข
                if (filteredData[0].status === 'show') {
                    modalContentPstatus.setAttribute("style", "color:green")
                } else {
                    modalContentPstatus.setAttribute("style", "color:red")
                }
                const modalContentImage = document.querySelector('img');
                modalContentImage.style.width = '100%';

                // เปิด Modal โดยใช้ Bootstrap
                $('#myModal').modal('show');
            }
        }
    </script>
@endsection
