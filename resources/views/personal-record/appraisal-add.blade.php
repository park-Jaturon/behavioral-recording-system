@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $student->prefix_name . $student->first_name . ' ' . $student->last_name }}
                    </div>

                    <div class="card-body">
                        <form action="{{ url('teacher/record/appraisal/store/' . $student->student_id) }}" method="post">
                            @csrf
                            <table class="table table-bordered border-dark">
                                <thead>
                                    <tr>
                                        <th scope="col" class=" text-center" valign="middle">พัฒนาการ</th>
                                        <th scope="col" class=" text-center" valign="middle">ตัวบ่งชี้</th>
                                        <th scope="col" class=" text-center" valign="middle">พฤติกรรม</th>
                                        <th scope="col" class=" text-center" valign="middle" width="200px">
                                            <select class="form-select" aria-label="Default select example" name="semester">
                                                <option selected value=" ">ภาคเรียนที่</option>
                                                <option value="ภาคเรียน1">ภาคเรียน 1</option>
                                                <option value="ภาคเรียน2">ภาคเรียน 2</option>
                                            </select>
                                            @error('semester')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </th>
                                    </tr>

                                </thead>

                                <tbody>
                                    <tr>
                                        <th scope="row" rowspan="11">
                                            <u>พัฒนาการด้านร่างกาย</u> <br>
                                            <label for="">มาตรฐานที่ 1</label><br>
                                            <label for="">ร่ายกายเจริญเติบโตตามวัยและมีสุขนิสัยที่ดี</label>
                                        </th>
                                        <td rowspan="3">
                                            1.มีน้ำหนักส่วนสูงตามเกณ์
                                        </td>
                                        <td>
                                            1.1 น้ำหนักตามเณฑ์อายุของกรมอนามัย
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments1_behavior1_1">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments1_behavior1_1')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            1.2 ส่วนสูงตามเกณฑ์อายุของกรมอนามัย
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments1_behavior1_2">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments1_behavior1_2')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            1.3 เส้นรอบศีรษะตามเกณฑ์อายุ
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments1_behavior1_3">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments1_behavior1_3')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="6">
                                            2.มีสุขภาพอนามัยสุขนิสัยที่ดี
                                        </td>
                                        <td>
                                            2.1 รับประทานอาหารที่มีประโยชน์และดื่มน้ำสะอาดได้ด้วยตนเอง
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments1_behavior2_1">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments1_behavior2_1')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            2.2 ล้างมือก่อนรับประทานอาหารและหลังใช้ห้องส้วมได้ด้วยตนเอง
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments1_behavior2_2">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments1_behavior2_2')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            2.3 นอนพักผ่อนเป็นเวลา
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments1_behavior2_3">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments1_behavior2_3')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            2.4 ออกกำลังกายเป็นเวลา
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments1_behavior2_4">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments1_behavior2_4')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            2.5 อาบน้ำแต่ตัวได้แต่ไม่คล่อง
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments1_behavior2_5">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments1_behavior2_5')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            2.6 ขับถ่ายเป็นเวลา
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments1_behavior2_6">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments1_behavior2_6')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2">
                                            3.รักษาความปลอดภัยของตนเองและผู้อื่น
                                        </td>
                                        <td>
                                            3.1 เล่นและทำกิจกรรมอย่างปลอดภัยได้ด้วยตนเอง
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments1_behavior3_1">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments1_behavior3_1')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            3.2 ระมัดระวังตนเองให้ปลอดภัยขณะเล่นได้บางครั้ง
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments1_behavior3_2">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments1_behavior3_2')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" rowspan="9">
                                            <u>พัฒนาการด้านร่างกาย</u> <br>
                                            <label for="">มาตรฐานที่ 2</label><br>
                                            <label for="">กล้ามเนื้อใหณ่และกล้ามเนื้อเล็กแข็งแรง
                                                ใช้ได้อย่างคล่องแคล่วและประสานสัมพันธ์กัน</label>
                                        </th>
                                        <td rowspan="5">
                                            1.เคลื่อนไหวร่างกายอย่างคล่องแคล่วประสานสัมพันธ์และทรงตัวได้
                                        </td>
                                        <td>
                                            1.1 เดินต่อเท้าไปข้างหน้าเป็นเส้นตรงได้โดยไม่ต้องกางแขน
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments2_behavior1_1">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments2_behavior1_1')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            1.2 กระโดดขาเดียวไปอยู่กับที่ได้โดยไม่เสียการทรงตัว
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments2_behavior1_2">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments2_behavior1_2')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            1.3 วิ่งหลบหลีกสิ่งกีดขวางได้
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments2_behavior1_3">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments2_behavior1_3')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            1.4 รับลูกบอลโดยใช้มือทั้ง 2 ข้าง
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments2_behavior1_4">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments2_behavior1_4')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            1.5 เดินลงบันไดสลับเท้าได้
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments2_behavior1_5">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments2_behavior1_5')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="4">
                                            2.ใช้มือ-ตาประสาทสัมพันธ์กัน
                                        </td>
                                        <td>
                                            2.1 ใช้กรรไกกรตัดระดาษตามแนวเส้นตรงได้
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments2_behavior2_1">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments2_behavior2_1')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            2.2 เขียนรูปสี่เหลียมตามได้อย่างมีมุมชัดเจน
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments2_behavior2_2">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments2_behavior2_2')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            2.3 ร้อยวัสดุที่มีรูขนาดเส้นผ่าศูนย์กลาง 0.5 เซนติเมตรได้
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments2_behavior2_3">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments2_behavior2_3')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            2.4 โยนลูกบอลไปข้างหน้าได้ไม่คล่องแคล่ว
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments2_behavior2_4">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments2_behavior2_4')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" rowspan="6">
                                            <u>พัฒนาการด้านอารมณ์และจิตใจ</u> <br>
                                            <label for="">มาตรฐานที่ 3</label><br>
                                            <label for="">มีสุขภาพจิตดีและมีความสุข</label>
                                        </th>
                                        <td rowspan="2">
                                            1.แสดงออกทางอารมณ์ได้อย่างเหนาะสม
                                        </td>
                                        <td>
                                            1.1 แสดงอารมณ์ความรู้สึกได้ตามสถานการณ์
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments3_behavior1_1">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments3_behavior1_1')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            1.2 ร่าเริง สดชื่น แจ่มใส และอารมณ์ดี
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments3_behavior1_2">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments3_behavior1_2')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="4">
                                            2.มีความรู้สึกดีต่อตนเองและผู้อื่น
                                        </td>
                                        <td>
                                            2.1 กล้าพูด กล้าแสดงออกอย่างเหมาะสมบางสถานการณ์
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments3_behavior2_1">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments3_behavior2_1')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            2.2 แสดงความพอใจในผลงานและความสามารถจองตนเอง
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments3_behavior2_2">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments3_behavior2_2')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            2.3 มีความมั่นใจในตนเอง
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments3_behavior2_3">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments3_behavior2_3')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            2.4 รับรู้ความรู้สึกผู้อื่นและปลอบโยนเมื่อผู้อื่นเสียใจ
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments3_behavior2_4">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments3_behavior2_4')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" rowspan="4">
                                            <u>พัฒนาการด้านอารมณ์และจิตใจ</u> <br>
                                            <label for="">มาตรฐานที่ 4</label><br>
                                            <label for="">ชื่นชมและแสดงออกทางศิลปะ ครตรี และการเคลื่อนไหว</label>
                                        </th>
                                        <td rowspan="4">
                                            1. สนใจมีความสุขและแสดงออกผ่านงานศิลปะคนตรีและการเคลื่อนไหว
                                        </td>
                                        <td>
                                            1.1 สนใจ มีความสุขและแสดงออผ่านงานศิลปะ
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments4_behavior1_1">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments4_behavior1_1')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            1.2 สนใจ มีความสุขและแสดงออกผ่านเสียงเลงดนตรี
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments4_behavior1_2">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments4_behavior1_2')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            1.3 สนใจ มีความสุขและแสดงท่าทาง/เคลื่อนไหวประกอบเลงจังหวะและดนตรี
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments4_behavior1_3">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments4_behavior1_3')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            1.4สนใจแล้วมีความสุขขณะทำงานศิลปะ
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments4_behavior1_4">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments4_behavior1_4')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" rowspan="9">
                                            <u>พัฒนาการด้านอารมณ์และจิตใจ</u> <br>
                                            <label for="">มาตรฐานที่ 5</label><br>
                                            <label for="">มีคุณธรรม จริยธรรม และ จิตใจที่ดีงาม</label>
                                        </th>
                                        <td rowspan="2">
                                            1.ซื่อสีตย์สุจริต
                                        </td>
                                        <td>
                                            1.1 ขออนุญาตหรือรอคอยเมื่อต้องการสิ่งของของผู้อื่นเมื่อมีผู้ชี้เนะ
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments5_behavior1_1">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments5_behavior1_1')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            1.2 รู้จักขอโทษเมื่อมีผู้ชี้เนะ
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments5_behavior1_2">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments5_behavior1_2')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="3">
                                            2.มีความเมตากรุณา มีน้ำำใจ และช่วยเหลือแบ่งปัน
                                        </td>
                                        <td>
                                            2.1 แสดงความรักต่อเพื่อนและมีเมตตาต่อสัตว์เลี้ยง
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments5_behavior2_1">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments5_behavior2_1')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            2.2 ช่วยเหลือผู้อื่นได้เมื่อมีผู้ชี้เนะ
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments5_behavior2_2">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments5_behavior2_2')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            2.3 มีจิตสาธารณะ
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments5_behavior2_3">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments5_behavior2_3')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2">
                                            3.มีความเห็นอกเห็นใจผู้อื่น
                                        </td>
                                        <td>
                                            3.1 แสดงสีหน้าท่าทางรับรู้ความรู้สิกของผู้อื่น
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments5_behavior3_1">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments5_behavior3_1')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            3.2 รับรู้ความรู้ศึกผู้อื่นและปลอบโยนเมื่อผู้อื่นเสียใจ
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments5_behavior3_2">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments5_behavior3_2')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2">
                                            4.มีความรับผิดชอบ
                                        </td>
                                        <td>
                                            4.1 ทำงานที่ได้รับมอบหมายจนสำเร็จเมื่อมีผู้ชี้เนะ
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments5_behavior4_1">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments5_behavior4_1')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            4.2 รักษาสิงของที่ใช้ร่วมกัน
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments5_behavior4_2">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments5_behavior4_2')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" rowspan="9">
                                            <u>พัฒนาการด้านสังคม</u> <br>
                                            <label for="">มาตรฐานที่ 6</label><br>
                                            <label
                                                for="">มีทักกษะชีวิตและปฎิบัติตามหลักปรัชญาของเศรษฐกิจพอเพียง</label>
                                        </th>
                                        <td rowspan="4">
                                            1.ช่วยเหลือตนเองในการปฎิบัติกิจวัตรประจำวัน
                                        </td>
                                        <td>
                                            1.1 แต่ตัวได้ด้วยตนเอง
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments6_behavior1_1">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments6_behavior1_1')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            1.2 รับประทานอาหารด้วนตนเอง
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments6_behavior1_2">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments6_behavior1_2')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            1.3 ใช้ห้องน้ำ ห้องส้วมด้วยตนเอง
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments6_behavior1_3">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments6_behavior1_3')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            1.4 ระมัดระวังดูแลตนเองและผู้อื่นให้ปลอดภัยโดยมีผู้อื่นคอยตักเตือนบ้าง
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments6_behavior1_4">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments6_behavior1_4')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="3">
                                            2.มีวินัยในตนเอง
                                        </td>
                                        <td>
                                            2.1 เก็บของเล่น ของใช้เข้าที่ด้วยตนเอง
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments6_behavior2_1">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments6_behavior2_1')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            2.2 เข้าแถวตามลำดับกก่อน-หลัง ได้ด้วยตนเอง
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments6_behavior2_2">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments6_behavior2_2')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            2.3 ทึ้งขยะเป็นที่ได้แต่ไม่เรียบร้อย
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments6_behavior2_3">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments6_behavior2_3')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2">
                                            3.ประหยัดพอเพียง
                                        </td>
                                        <td>
                                            3.1 ใช้สิงของเครื่องใช้อย่างประหยัดและพพอเพียงเมื่อมีผู้ชี้เนะ
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments6_behavior3_1">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments6_behavior3_1')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            3.2 รักกษาสิ่งของที่ใช้ร่วมกัน
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments6_behavior3_2">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments6_behavior3_2')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" rowspan="8">
                                            <u>พัฒนาการด้านสังคม</u> <br>
                                            <label for="">มาตรฐานที่ 7</label><br>
                                            <label for="">รักธรรมชาติสิ่งแวดล้อมและความเป็นไทย</label>
                                        </th>
                                        <td rowspan="3">
                                            1.ดูแลรักษาธรรมชาติและสิ่งแวดล้อม
                                        </td>
                                        <td>
                                            1.1 มีส่วนร่วมดูแลรักษาธรรมชาติและสิ่งแวดล้อมเมื่อมีผู้ชี้แนะ
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments7_behavior1_1">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments7_behavior1_1')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            1.2 ทิ้งขยะได้ถูกที่
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments7_behavior1_2">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments7_behavior1_2')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            1.3 ปิดน้ำหลังการใช้ทันที
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments7_behavior1_3">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments7_behavior1_3')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="5">
                                            2.มีมารยาทตามวัฒนธรรมไทย และรักความเป็นไทย
                                        </td>
                                        <td>
                                            2.1 ปฎิบัติตามมารยาทไทยด้วยตนเอง
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments7_behavior2_1">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments7_behavior2_1')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            2.2 กล่าวคำจอบคุณและขอโทษด้วยตนเอง
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments7_behavior2_2">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments7_behavior2_2')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            2.3 ยืนตรงเมื่อได้ยินเสียงเพลงชาติไทยและเพลงสรรเสริญพระบารมี
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments7_behavior2_3">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments7_behavior2_3')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            2.4 มีสัมมาคารวะและมารยาทตามวัฒนธรรมไทย
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments7_behavior2_4">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments7_behavior2_4')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            2.5 รักความเป็นไทย
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments7_behavior2_5">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments7_behavior2_5')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" rowspan="13">
                                            <u>พัฒนาการด้านสังคม</u> <br>
                                            <label for="">มาตรฐานที่ 8</label><br>
                                            <label for="">อยู่ร่วมกับผู้อื่นได้อย่างมีความสุข
                                                และปฎิบัติตนเป็นสมาชิกที่ดีของสังคมในระบอกประชาธิปไตยอันมีพระมหากษัตริย์ทรงเป็นประมุข</label>
                                        </th>
                                        <td rowspan="3">
                                            1.ยอมรับความเหมือนความแตกต่างระหว่างบุคคล
                                        </td>
                                        <td>
                                            1.1 เล่นและทำกิจกรรมร่วมกกับเด็กที่แตกต่างไปจากตน
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments8_behavior1_1">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments8_behavior1_1')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            1.2 บอกกความเหมืนหรือความแตกต่างระหว่างตัวเองและผู้อื่นได้
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments8_behavior1_2">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments8_behavior1_2')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            1.3 เล่นและทำกิจกรรมร่วมกับเด็กที่แตกต่างไปจากตนได้ เช่นต่างภาษา เชื้อชาติ
                                            พื้นเพทางสังคมหรือมีความบกพร่องทางร่างกาย
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments8_behavior1_3">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments8_behavior1_3')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="5">
                                            2.มีปฎิสัมพันธ์ทีดีกับผู้อื่น
                                        </td>
                                        <td>
                                            2.1 เล่นหรือทำงานร่วมกับเพื่อนเป็นลุ่ม
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments8_behavior2_1">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments8_behavior2_1')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            2.2 ยิ้ม ทักทาย หรือพูดคุยกับผู้ใหญ่และบุคคลที่คุ้นเคยได้ด้วนตนเอง
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments8_behavior2_2">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments8_behavior2_2')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            2.3 เข้าร่วมกิจกรรมกลุ่มได้นานขึ้น
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments8_behavior2_3">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments8_behavior2_3')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            2.4 แบ่นปันกันเพื่อนและผลัดกันเล่นโดยมีผู้ใหญ่แนะนำ
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments8_behavior2_4">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments8_behavior2_4')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            2.5 ประนีประนอมแก้ไขปัญหาร่วมกับผู้นอื่นได้
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments8_behavior2_5">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments8_behavior2_5')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="5">
                                            3.ปฎิบัติตนเบื้องต้นในการเป็นสมาชิกที่ดีของสังคม
                                        </td>
                                        <td>
                                            3.1 มีส่วนร่วมในการสร้างข้อตกลงและปฎิบัติตามข้อตกลงเมื่อมีผู้ชี้แนะ
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments8_behavior3_1">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments8_behavior3_1')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            3.2 ปฎิบัติตนเป็นผู้นำและผู้ตามได้ด้วนตนเอง
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments8_behavior3_2">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments8_behavior3_2')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            3.3 ประนีประนอมแก้ไข้ปัญหาโดยปราศจากความรุนแรงเมื่อมีผู้ชี้แนะ
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments8_behavior3_3">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments8_behavior3_3')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            3.4 ยืนตรงเคารพพธงชาติร้องเพลงชาติ
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments8_behavior3_4">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments8_behavior3_4')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            3.5
                                            เข้าร่วมกกิจกรรมที่เกี่ยวกับสถาบันพระมหากกษัตริย์ตามที่โรงเรียนและชุมชนจัดขึ้น
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments8_behavior3_5">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments8_behavior3_5')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" rowspan="8">
                                            <u>พัฒนาการด้านสติปัญญา</u> <br>
                                            <label for="">มาตรฐานที่ 9</label><br>
                                            <label for="">ใช้ภาษาสื่อสารได้เหมาะสม</label>
                                        </th>
                                        <td rowspan="5">
                                            1.สนทนาโต้ตอบและเล่าเรื่องให้ผู้อื่นเข้าใจ
                                        </td>
                                        <td>
                                            1.1 ฟังผู้อื่นพูดจนจบและสนทนาโต้ดอบสอดคล้องกับเรื่องที่ฟัง
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments9_behavior1_1">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments9_behavior1_1')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            1.2 เล่าเป็นเรื่องราวต่อเนื่องได้
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments9_behavior1_2">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments9_behavior1_2')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            1.3 ฟังคำสัง 2 ขั้นตอนและสามารถปฎิบัติได้
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments9_behavior1_3">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments9_behavior1_3')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            1.4 พูดโต้ตอบและเล่าเรื่องเป็นประโยคอย่างต่อเนื่อง
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments9_behavior1_4">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments9_behavior1_4')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            1.5 ฟัง พูด โต้ตอบและแสดงความรู้สึกเกี่ยวกับเรื่องที่ฟังได้
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments9_behavior1_5">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments9_behavior1_5')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="3">
                                            2.อ่านเขียนภาพและสัญลักญณ์ได้
                                        </td>
                                        <td>
                                            2.1 อ่านภาพ สัญลักษณ์ คำ พร้อมทั้งชี้ หรือ กวาดตามองข้อความตามบรรทัด
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments9_behavior2_1">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments9_behavior2_1')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            2.2 เขียนคล้ายตัวอักษร
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments9_behavior2_2">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments9_behavior2_2')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            2.3 เปิดและอ่านหนังสือด้วนตนเอง
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments9_behavior2_3">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments9_behavior2_3')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" rowspan="10">
                                            <u>พัฒนาการด้านสติปัญญา</u> <br>
                                            <label for="">มาตรฐานที่ 10</label><br>
                                            <label for="">มีความสามารถในการคิดเป็นพื้นฐานในการเรียนรู้</label>
                                        </th>
                                        <td rowspan="5">
                                            1.สนทนาโต้ตอบและเล่าเรื่องให้ผู้อื่นเข้าใจ
                                        </td>
                                        <td>
                                            1.1 บอกลักษณะส่วนประกอบของสิ่งของต่างๆจากกการสังเกตโดยใช้ประสาทสัมผัส
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments10_behavior1_1">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments10_behavior1_1')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            1.2 จับคู่และเปรียบเทียบความแตกต่างหรือความเหมือนของสิ่งต่างๆ
                                            โดยใช้ลักษณะที่สังเกตพบเพียงลักกษณะเดียว
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments10_behavior1_2">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments10_behavior1_2')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            1.3 จำแนกและจัดกลุ่มสิ่งต่างๆ โดยใช้อย่างน้อย 1 ลักกษณะเป็นเกณฑ์
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments10_behavior1_3">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments10_behavior1_3')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            1.4 เรียงลำดับสิ่งของหรือเหตุกการณ์อย่างน้อย 4 ลำดับ
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments10_behavior1_4">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments10_behavior1_4')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            1.5 แก้ปัญหาด้วยวิธีการต่างๆ โดยกการลองผิดลองถูกด้วยตนเอง
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments10_behavior1_5">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments10_behavior1_5')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2">
                                            2.มีความสามารถในการคิดเชิงเหตุผล
                                        </td>
                                        <td>
                                            2.1 ระบุสาเหตุหรือผผลที่เกิดขึ้นในเหตุการณ์หรือการกระทำเมื่อมีผู้ชี้แนะ
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments10_behavior2_1">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments10_behavior2_1')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            2.2 คาดเดาหรือคาดคะเนสิ่งที่อาดเกินขึ้นหรือมีส่วนร่วมในการลงความเห็นจากข้อมูล
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments10_behavior2_2">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments10_behavior2_2')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="3">
                                            3.มีความสามารถในการคิดแก้ปัญหาและตัดสินใจ
                                        </td>
                                        <td>
                                            3.1 ตัดสินใจในเรื่องง่ายๆ และเริ่มเรียนรู้ผลที่เกิดขึ้น
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments10_behavior3_1">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments10_behavior3_1')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            3.2 ระบุปัญหาโดยลองผิดลองถูก
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments10_behavior3_2">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments10_behavior3_2')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            3.3
                                            ให้เตุผผลในการคาดคะแนการลงความเห็นหรือการลงข้อสรุปเพื่ออธิบายเกี่ยวกับสิ่งที่สังเกตหรือเรียนรู้
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments10_behavior3_3">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments10_behavior3_3')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" rowspan="4">
                                            <u>พัฒนาการด้านสติปัญญา</u> <br>
                                            <label for="">มาตรฐานที่ 11</label><br>
                                            <label for="">มีจินตนาการและความคิดสร้างสรรค์</label>
                                        </th>
                                        <td rowspan="2">
                                            1.ทำงานศิลปะตามจินตนาการและความคิดสร้างสรรค์
                                        </td>
                                        <td>
                                            1.1
                                            สร้างผลงานศิลปะเพื่อสื่อสานตวามรู้สึกของตนเองโดยมีการดัดแปลงและแปลกใหม่จากเดิมหรือมีรายละเอียดเพิ่มขึ้น
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments11_behavior1_1">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments11_behavior1_1')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            1.2 เล่น/ทำงานศิลปะตามจินตนาการของตนเอง
                                            โดนมีลักษณะคิดริเริ่มคิดคล่องแคล่วคิดยึดหยุ่นและคิดละเอียดลออ
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments11_behavior1_2">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments11_behavior1_2')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="2">
                                            2.แสดงท่าทาง/เคลื่อนไหวตามจินตนาการอย่างสร้างสรรค์
                                        </td>
                                        <td>
                                            2.1
                                            เคลื่อนไหวท่าทางเพพื่อสื่อสารความคิดความรู้สึกของตนเองอย่างหลากหลายหรือแปลกใหม่
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments11_behavior2_1">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments11_behavior2_1')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            2.2
                                            แสดงท่าทาง/เลื่อนไหว/เล่นบทบาทสมมุติตามจินตนาการของตนเองและท่าทาง/การเลื่อนไหวมีลักษณะคิดริเริ่ม
                                            คิดคล่องแคล่ว คิดยึดหยุ่นและคิดละอียดลออ
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments11_behavior2_2">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments11_behavior2_2')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="row" rowspan="6">
                                            <u>พัฒนาการด้านสติปัญญา</u> <br>
                                            <label for="">มาตรฐานที่ 12</label><br>
                                            <label
                                                for="">มีเจคติที่ดีต่อการเรียนรู้และมีความสามารถในการแสวงหาความรู้ได้เหมาะสมกับวัย</label>
                                        </th>
                                        <td rowspan="3">
                                            1.มีเจคติที่ดีต่อการเรียนรู้
                                        </td>
                                        <td>
                                            1.1 สนใจซักถามเกี่ยวกับสัญลักษณ์หรือตัวหนังสือที่พบเห็น
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments12_behavior1_1">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments12_behavior1_1')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            1.2 กระตือรือร้นในการเข้าร่วมกิจกรรม
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments12_behavior1_2">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments12_behavior1_2')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            1.3 ถามคำถามและแสดงความคิดเห็นเกี่ยวกับเรื่องที่สนใจ
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments12_behavior1_3">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments12_behavior1_3')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td rowspan="3">
                                            2.มีความสามารถในการแสวงหาความรู้
                                        </td>
                                        <td>
                                            2.1 ค้นหาคำตอบของข้อสงสัยต่างๆ ตามวิธีการของตนเอง
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments12_behavior2_1">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments12_behavior2_1')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            2.2 ใช้ประโยคคำถามว่า "ที่ไหน" "ทำไม" ในการค้นหาคำตอบ
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments12_behavior2_2">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments12_behavior2_2')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            2.3 เชื่อมโยงความรู้และทักษะต่างๆใช้ในชีวิตประจำวัน
                                        </td>
                                        <td class="text-center">
                                            <select class="form-select" aria-label="Default select example"
                                                name="developments12_behavior2_3">
                                                <option selected>พัฒนาการ</option>
                                                <option value="1">ควรเสริม</option>
                                                <option value="2">ปานกลาง</option>
                                                <option value="3">ดี</option>
                                            </select>
                                            @error('developments12_behavior2_3')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </td>
                                    </tr>
                                </tbody>
                            </table>


                            <div class="row justify-content-center align-items-center g-2 mb-3">
                                <div class="col">
                                    <label for="exampleFormControlTextarea1"
                                        class="form-label">ความคิดเห็นของครูประจำชั้น</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="commenteacher" rows="3">{{ old('habitations') }}</textarea> {{-- ,$data->habitations --}}
                                </div>

                            </div>
                            <div class="mb-3 row">
                                <div class="offset-sm-4 col-sm-8 text-end">
                                    <button type="submit" class="btn btn-primary">บันทึก</button>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
