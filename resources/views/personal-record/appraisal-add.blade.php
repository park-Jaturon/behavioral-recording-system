@extends('layouts.app')

@section('style')
    <style>
        .form-section {
            display: none;
        }

        .form-section.current {
            display: inline;
        }

        .parsley-errors-list {
            color: red;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (isset($datasemester1) && isset($datasemester2))
                    <div class="alert alert-info text-center" role="alert">
                        <h5>ประเมินพัฒนาการครบทั้ง2ภาคเรียนแล้ว <a
                                href="{{ url('teacher/record/appraisal/show/' . $student->student_id) }}"> ดูบันทึก</a> </h5>
                    </div>
                @else
                    <div class="card">
                        <div class="card-header">
                            {{ $student->prefix_name . $student->first_name . ' ' . $student->last_name }}
                        </div>

                        <div class="card-body">
                            <div class="nav nav-fill my-3">
                                <label class="nav-link shadow-sm step0   border ml-2 ">1</label>
                                <label class="nav-link shadow-sm step1   border ml-2 ">2</label>
                                <label class="nav-link shadow-sm step2   border ml-2 ">3</label>
                                <label class="nav-link shadow-sm step3   border ml-2 ">4</label>
                                <label class="nav-link shadow-sm step4   border ml-2 ">5</label>
                                <label class="nav-link shadow-sm step5   border ml-2 ">6</label>
                                <label class="nav-link shadow-sm step6   border ml-2 ">7</label>
                                <label class="nav-link shadow-sm step7   border ml-2 ">8</label>
                                <label class="nav-link shadow-sm step8   border ml-2 ">9</label>
                                <label class="nav-link shadow-sm step9   border ml-2 ">10</label>
                            </div>
                            <form action="{{ url('teacher/record/appraisal/store/' . $student->student_id) }}"
                                method="post" class="employee-form">
                                @csrf
                                <!-- เพิ่มข้อมูลหน้า1 -->
                                <div class="form-section">
                                    <table class="table table-bordered border-dark">
                                        <thead>
                                            <tr>
                                                <th scope="col" class=" text-center" valign="middle"> พัฒนาการ </th>
                                                <th scope="col" class=" text-center" valign="middle">ตัวบ่งชี้</th>
                                                <th scope="col" class=" text-center" valign="middle">พฤติกรรม</th>
                                                <th scope="col" class=" text-center" valign="middle" width="200px">
                                                    <select class="form-select" aria-label="Default select example"
                                                        name="semester" required
                                                        data-parsley-required-message="กรุณาเลือกภาคเรียน">
                                                        <option selected disabled>-- ภาคเรียนที่ --</option>
                                                        @if (isset($datasemester1))
                                                            <option value="ภาคเรียน2">ภาคเรียน 2</option>
                                                        @else
                                                            <option value="ภาคเรียน1">ภาคเรียน 1</option>
                                                            <option value="ภาคเรียน2">ภาคเรียน 2</option>
                                                        @endif
                                                    </select>
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
                                                        id="id1" onchange="jsfuncSetState('id1')"
                                                        name="developments1_behavior1_1" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ -- </option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    1.2 ส่วนสูงตามเกณฑ์อายุของกรมอนามัย
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id2" onchange="jsfuncSetState('id2')"
                                                        name="developments1_behavior1_2" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    1.3 เส้นรอบศีรษะตามเกณฑ์อายุ
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id3" onchange="jsfuncSetState('id3')"
                                                        name="developments1_behavior1_3" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

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
                                                        id="id4" onchange="jsfuncSetState('id4')"
                                                        name="developments1_behavior2_1" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    2.2 ล้างมือก่อนรับประทานอาหารและหลังใช้ห้องส้วมได้ด้วยตนเอง
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id5" onchange="jsfuncSetState('id5')"
                                                        name="developments1_behavior2_2" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    2.3 นอนพักผ่อนเป็นเวลา
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id6" onchange="jsfuncSetState('id6')"
                                                        name="developments1_behavior2_3" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    2.4 ออกกำลังกายเป็นเวลา
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id7" onchange="jsfuncSetState('id7')"
                                                        name="developments1_behavior2_4" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    2.5 อาบน้ำแต่ตัวได้แต่ไม่คล่อง
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id8" onchange="jsfuncSetState('id8')"
                                                        name="developments1_behavior2_5" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    2.6 ขับถ่ายเป็นเวลา
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id9" onchange="jsfuncSetState('id9')"
                                                        name="developments1_behavior2_6" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

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
                                                        id="id10" onchange="jsfuncSetState('id10')"
                                                        name="developments1_behavior3_1" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    3.2 ระมัดระวังตนเองให้ปลอดภัยขณะเล่นได้บางครั้ง
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id11" onchange="jsfuncSetState('id11')"
                                                        name="developments1_behavior3_2" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- เพิ่มข้อมูลหน้า2 -->
                                <div class="form-section">
                                    <table class="table table-bordered border-dark">
                                        <thead>
                                            <tr>
                                                <th scope="col" class=" text-center" valign="middle">พัฒนาการ</th>
                                                <th scope="col" class=" text-center" valign="middle">ตัวบ่งชี้</th>
                                                <th scope="col" class=" text-center" valign="middle">พฤติกรรม</th>
                                                <th scope="col" class=" text-center" valign="middle" width="200px">
                                                    <select class="form-select" aria-label="Default select example"
                                                        name="semester" required
                                                        data-parsley-required-message="กรุณาเลือกภาคเรียน">
                                                        <option selected disabled>-- ภาคเรียนที่ --</option>
                                                        @if (isset($datasemester1))
                                                            <option value="ภาคเรียน2">ภาคเรียน 2</option>
                                                        @else
                                                            <option value="ภาคเรียน1">ภาคเรียน 1</option>
                                                            <option value="ภาคเรียน2">ภาคเรียน 2</option>
                                                        @endif
                                                    </select>

                                                </th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            <tr>
                                                <th scope="row" rowspan="9">
                                                    <u>พัฒนาการด้านร่างกาย</u> <br>
                                                    <label for="">มาตรฐานที่ 2</label><br>
                                                    <label for="">กล้ามเนื้อใหญ่และกล้ามเนื้อเล็กแข็งแรง
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
                                                        id="id12" onchange="jsfuncSetState('id12')"
                                                        name="developments2_behavior1_1" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    1.2 กระโดดขาเดียวไปอยู่กับที่ได้โดยไม่เสียการทรงตัว
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id13" onchange="jsfuncSetState('id13')"
                                                        name="developments2_behavior1_2" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    1.3 วิ่งหลบหลีกสิ่งกีดขวางได้
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id14" onchange="jsfuncSetState('id14')"
                                                        name="developments2_behavior1_3" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    1.4 รับลูกบอลโดยใช้มือทั้ง 2 ข้าง
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id15" onchange="jsfuncSetState('id15')"
                                                        name="developments2_behavior1_4" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    1.5 เดินลงบันไดสลับเท้าได้
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id16" onchange="jsfuncSetState('id16')"
                                                        name="developments2_behavior1_5" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

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
                                                        id="id17" onchange="jsfuncSetState('id17')"
                                                        name="developments2_behavior2_1" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    2.2 เขียนรูปสี่เหลียมตามได้อย่างมีมุมชัดเจน
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id18" onchange="jsfuncSetState('id18')"
                                                        name="developments2_behavior2_2" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    2.3 ร้อยวัสดุที่มีรูขนาดเส้นผ่าศูนย์กลาง 0.5 เซนติเมตรได้
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id19" onchange="jsfuncSetState('id19')"
                                                        name="developments2_behavior2_3" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    2.4 โยนลูกบอลไปข้างหน้าได้ไม่คล่องแคล่ว
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id20" onchange="jsfuncSetState('id20')"
                                                        name="developments2_behavior2_4" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- เพิ่มข้อมูลหน้า3 -->
                                <div class="form-section">
                                    <table class="table table-bordered border-dark">
                                        <thead>
                                            <tr>
                                                <th scope="col" class=" text-center" valign="middle">พัฒนาการ</th>
                                                <th scope="col" class=" text-center" valign="middle">ตัวบ่งชี้</th>
                                                <th scope="col" class=" text-center" valign="middle">พฤติกรรม</th>
                                                <th scope="col" class=" text-center" valign="middle" width="200px">
                                                    <select class="form-select" aria-label="Default select example"
                                                        name="semester" required
                                                        data-parsley-required-message="กรุณาเลือกภาคเรียน">
                                                        <option selected disabled>-- ภาคเรียนที่ --</option>
                                                        @if (isset($datasemester1))
                                                            <option value="ภาคเรียน2">ภาคเรียน 2</option>
                                                        @else
                                                            <option value="ภาคเรียน1">ภาคเรียน 1</option>
                                                            <option value="ภาคเรียน2">ภาคเรียน 2</option>
                                                        @endif
                                                    </select>

                                                </th>
                                            </tr>

                                        </thead>
                                        <tbody>
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
                                                        id="id21" onchange="jsfuncSetState('id21')"
                                                        name="developments3_behavior1_1" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    1.2 ร่าเริง สดชื่น แจ่มใส และอารมณ์ดี
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id22" onchange="jsfuncSetState('id22')"
                                                        name="developments3_behavior1_2" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

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
                                                        id="id23" onchange="jsfuncSetState('id23')"
                                                        name="developments3_behavior2_1" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    2.2 แสดงความพอใจในผลงานและความสามารถจองตนเอง
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id24" onchange="jsfuncSetState('id24')"
                                                        name="developments3_behavior2_2" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    2.3 มีความมั่นใจในตนเอง
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id25" onchange="jsfuncSetState('id25')"
                                                        name="developments3_behavior2_3" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    2.4 รับรู้ความรู้สึกผู้อื่นและปลอบโยนเมื่อผู้อื่นเสียใจ
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id26" onchange="jsfuncSetState('id26')"
                                                        name="developments3_behavior2_4" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" rowspan="4">
                                                    <u>พัฒนาการด้านอารมณ์และจิตใจ</u> <br>
                                                    <label for="">มาตรฐานที่ 4</label><br>
                                                    <label for="">ชื่นชมและแสดงออกทางศิลปะ ครตรี
                                                        และการเคลื่อนไหว</label>
                                                </th>
                                                <td rowspan="4">
                                                    1. สนใจมีความสุขและแสดงออกผ่านงานศิลปะคนตรีและการเคลื่อนไหว
                                                </td>
                                                <td>
                                                    1.1 สนใจ มีความสุขและแสดงออผ่านงานศิลปะ
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id27" onchange="jsfuncSetState('id27')"
                                                        name="developments4_behavior1_1" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    1.2 สนใจ มีความสุขและแสดงออกผ่านเสียงเลงดนตรี
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id28" onchange="jsfuncSetState('id28')"
                                                        name="developments4_behavior1_2" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    1.3 สนใจ มีความสุขและแสดงท่าทาง/เคลื่อนไหวประกอบเลงจังหวะและดนตรี
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id29" onchange="jsfuncSetState('id29')"
                                                        name="developments4_behavior1_3" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    1.4 สนใจแล้วมีความสุขขณะทำงานศิลปะ
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id30" onchange="jsfuncSetState('id30')"
                                                        name="developments4_behavior1_4" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- เพิ่มข้อมูลหน้า4 -->
                                <div class="form-section">
                                    <table class="table table-bordered border-dark">
                                        <thead>
                                            <tr>
                                                <th scope="col" class=" text-center" valign="middle">พัฒนาการ</th>
                                                <th scope="col" class=" text-center" valign="middle">ตัวบ่งชี้</th>
                                                <th scope="col" class=" text-center" valign="middle">พฤติกรรม</th>
                                                <th scope="col" class=" text-center" valign="middle" width="200px">
                                                    <select class="form-select" aria-label="Default select example"
                                                        name="semester" required
                                                        data-parsley-required-message="กรุณาเลือกภาคเรียน">
                                                        <option selected disabled>-- ภาคเรียนที่ --</option>
                                                        @if (isset($datasemester1))
                                                            <option value="ภาคเรียน2">ภาคเรียน 2</option>
                                                        @else
                                                            <option value="ภาคเรียน1">ภาคเรียน 1</option>
                                                            <option value="ภาคเรียน2">ภาคเรียน 2</option>
                                                        @endif
                                                    </select>

                                                </th>
                                            </tr>

                                        </thead>
                                        <tbody>
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
                                                        id="id31" onchange="jsfuncSetState('id31')"
                                                        name="developments5_behavior1_1" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    1.2 รู้จักขอโทษเมื่อมีผู้ชี้เนะ
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id32" onchange="jsfuncSetState('id32')"
                                                        name="developments5_behavior1_2" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="3">
                                                    2.มีความเมตากรุณา มีน้ำใจ และช่วยเหลือแบ่งปัน
                                                </td>
                                                <td>
                                                    2.1 แสดงความรักต่อเพื่อนและมีเมตตาต่อสัตว์เลี้ยง
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id33" onchange="jsfuncSetState('id33')"
                                                        name="developments5_behavior2_1" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    2.2 ช่วยเหลือผู้อื่นได้เมื่อมีผู้ชี้เนะ
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id34" onchange="jsfuncSetState('id34')"
                                                        name="developments5_behavior2_2" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    2.3 มีจิตสาธารณะ
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id35" onchange="jsfuncSetState('id35')"
                                                        name="developments5_behavior2_3" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

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
                                                        id="id36" onchange="jsfuncSetState('id36')"
                                                        name="developments5_behavior3_1" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    3.2 รับรู้ความรู้ศึกผู้อื่นและปลอบโยนเมื่อผู้อื่นเสียใจ
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id37" onchange="jsfuncSetState('id37')"
                                                        name="developments5_behavior3_2" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

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
                                                        id="id38" onchange="jsfuncSetState('id38')"
                                                        name="developments5_behavior4_1" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    4.2 รักษาสิงของที่ใช้ร่วมกัน
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id39" onchange="jsfuncSetState('id39')"
                                                        name="developments5_behavior4_2" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- เพิ่มข้อมูลหน้า5 -->
                                <div class="form-section">
                                    <table class="table table-bordered border-dark">
                                        <thead>
                                            <tr>
                                                <th scope="col" class=" text-center" valign="middle">พัฒนาการ</th>
                                                <th scope="col" class=" text-center" valign="middle">ตัวบ่งชี้</th>
                                                <th scope="col" class=" text-center" valign="middle">พฤติกรรม</th>
                                                <th scope="col" class=" text-center" valign="middle" width="200px">
                                                    <select class="form-select" aria-label="Default select example"
                                                        name="semester" required
                                                        data-parsley-required-message="กรุณาเลือกภาคเรียน">
                                                        <option selected disabled>-- ภาคเรียนที่ --</option>
                                                        @if (isset($datasemester1))
                                                            <option value="ภาคเรียน2">ภาคเรียน 2</option>
                                                        @else
                                                            <option value="ภาคเรียน1">ภาคเรียน 1</option>
                                                            <option value="ภาคเรียน2">ภาคเรียน 2</option>
                                                        @endif
                                                    </select>

                                                </th>
                                            </tr>

                                        </thead>
                                        <tbody>
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
                                                        id="id40" onchange="jsfuncSetState('id40')"
                                                        name="developments6_behavior1_1" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    1.2 รับประทานอาหารด้วนตนเอง
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id41" onchange="jsfuncSetState('id41')"
                                                        name="developments6_behavior1_2" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    1.3 ใช้ห้องน้ำ ห้องส้วมด้วยตนเอง
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id42" onchange="jsfuncSetState('id42')"
                                                        name="developments6_behavior1_3" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    1.4 ระมัดระวังดูแลตนเองและผู้อื่นให้ปลอดภัยโดยมีผู้อื่นคอยตักเตือนบ้าง
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id43" onchange="jsfuncSetState('id43')"
                                                        name="developments6_behavior1_4" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

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
                                                        id="id44" onchange="jsfuncSetState('id44')"
                                                        name="developments6_behavior2_1" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    2.2 เข้าแถวตามลำดับกก่อน-หลัง ได้ด้วยตนเอง
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id45" onchange="jsfuncSetState('id45')"
                                                        name="developments6_behavior2_2" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    2.3 ทึ้งขยะเป็นที่ได้แต่ไม่เรียบร้อย
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id46" onchange="jsfuncSetState('id46')"
                                                        name="developments6_behavior2_3" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td rowspan="2">
                                                    3.ประหยัดพอเพียง
                                                </td>
                                                <td>
                                                    3.1 ใช้สิงของเครื่องใช้อย่างประหยัดและพอเพียงเมื่อมีผู้ชี้เนะ
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id47" onchange="jsfuncSetState('id47')"
                                                        name="developments6_behavior3_1" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    3.2 รักกษาสิ่งของที่ใช้ร่วมกัน
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id48" onchange="jsfuncSetState('id48')"
                                                        name="developments6_behavior3_2" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- เพิ่มข้อมูลหน้า6 -->
                                <div class="form-section">
                                    <table class="table table-bordered border-dark">
                                        <thead>
                                            <tr>
                                                <th scope="col" class=" text-center" valign="middle">พัฒนาการ</th>
                                                <th scope="col" class=" text-center" valign="middle">ตัวบ่งชี้</th>
                                                <th scope="col" class=" text-center" valign="middle">พฤติกรรม</th>
                                                <th scope="col" class=" text-center" valign="middle" width="200px">
                                                    <select class="form-select" aria-label="Default select example"
                                                        name="semester" required
                                                        data-parsley-required-message="กรุณาเลือกภาคเรียน">
                                                        <option selected disabled>-- ภาคเรียนที่ --</option>
                                                        @if (isset($datasemester1))
                                                            <option value="ภาคเรียน2">ภาคเรียน 2</option>
                                                        @else
                                                            <option value="ภาคเรียน1">ภาคเรียน 1</option>
                                                            <option value="ภาคเรียน2">ภาคเรียน 2</option>
                                                        @endif
                                                    </select>

                                                </th>
                                            </tr>

                                        </thead>
                                        <tbody>
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
                                                        id="id49" onchange="jsfuncSetState('id49')"
                                                        name="developments7_behavior1_1" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    1.2 ทิ้งขยะได้ถูกที่
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id50" onchange="jsfuncSetState('id50')"
                                                        name="developments7_behavior1_2" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    1.3 ปิดน้ำหลังการใช้ทันที
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id51" onchange="jsfuncSetState('id51')"
                                                        name="developments7_behavior1_3" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

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
                                                        id="id52" onchange="jsfuncSetState('id52')"
                                                        name="developments7_behavior2_1" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    2.2 กล่าวคำจอบคุณและขอโทษด้วยตนเอง
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id53" onchange="jsfuncSetState('id53')"
                                                        name="developments7_behavior2_2" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    2.3 ยืนตรงเมื่อได้ยินเสียงเพลงชาติไทยและเพลงสรรเสริญพระบารมี
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id54" onchange="jsfuncSetState('id54')"
                                                        name="developments7_behavior2_3" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    2.4 มีสัมมาคารวะและมารยาทตามวัฒนธรรมไทย
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id55" onchange="jsfuncSetState('id55')"
                                                        name="developments7_behavior2_4" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    2.5 รักความเป็นไทย
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id56" onchange="jsfuncSetState('id56')"
                                                        name="developments7_behavior2_5" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- เพิ่มข้อมูลหน้า7 -->
                                <div class="form-section">
                                    <table class="table table-bordered border-dark">
                                        <thead>
                                            <tr>
                                                <th scope="col" class=" text-center" valign="middle">พัฒนาการ</th>
                                                <th scope="col" class=" text-center" valign="middle">ตัวบ่งชี้</th>
                                                <th scope="col" class=" text-center" valign="middle">พฤติกรรม</th>
                                                <th scope="col" class=" text-center" valign="middle" width="200px">
                                                    <select class="form-select" aria-label="Default select example"
                                                        name="semester" required
                                                        data-parsley-required-message="กรุณาเลือกภาคเรียน">
                                                        <option selected disabled>-- ภาคเรียนที่ --</option>
                                                        @if (isset($datasemester1))
                                                            <option value="ภาคเรียน2">ภาคเรียน 2</option>
                                                        @else
                                                            <option value="ภาคเรียน1">ภาคเรียน 1</option>
                                                            <option value="ภาคเรียน2">ภาคเรียน 2</option>
                                                        @endif
                                                    </select>
                                                </th>
                                            </tr>

                                        </thead>
                                        <tbody>
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
                                                        id="id57" onchange="jsfuncSetState('id57')"
                                                        name="developments8_behavior1_1" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    1.2 บอกกความเหมืนหรือความแตกต่างระหว่างตัวเองและผู้อื่นได้
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id58" onchange="jsfuncSetState('id58')"
                                                        name="developments8_behavior1_2" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    1.3 เล่นและทำกิจกรรมร่วมกับเด็กที่แตกต่างไปจากตนได้ เช่นต่างภาษา
                                                    เชื้อชาติ
                                                    พื้นเพทางสังคมหรือมีความบกพร่องทางร่างกาย
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id59" onchange="jsfuncSetState('id59')"
                                                        name="developments8_behavior1_3" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

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
                                                        id="id60" onchange="jsfuncSetState('id60')"
                                                        name="developments8_behavior2_1" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    2.2 ยิ้ม ทักทาย หรือพูดคุยกับผู้ใหญ่และบุคคลที่คุ้นเคยได้ด้วนตนเอง
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id61" onchange="jsfuncSetState('id61')"
                                                        name="developments8_behavior2_2" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    2.3 เข้าร่วมกิจกรรมกลุ่มได้นานขึ้น
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id62" onchange="jsfuncSetState('id62')"
                                                        name="developments8_behavior2_3" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    2.4 แบ่นปันกันเพื่อนและผลัดกันเล่นโดยมีผู้ใหญ่แนะนำ
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id63" onchange="jsfuncSetState('id63')"
                                                        name="developments8_behavior2_4" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    2.5 ประนีประนอมแก้ไขปัญหาร่วมกับผู้นอื่นได้
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id64" onchange="jsfuncSetState('id64')"
                                                        name="developments8_behavior2_5" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

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
                                                        id="id65" onchange="jsfuncSetState('id65')"
                                                        name="developments8_behavior3_1" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    3.2 ปฎิบัติตนเป็นผู้นำและผู้ตามได้ด้วนตนเอง
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id66" onchange="jsfuncSetState('id66')"
                                                        name="developments8_behavior3_2" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    3.3 ประนีประนอมแก้ไข้ปัญหาโดยปราศจากความรุนแรงเมื่อมีผู้ชี้แนะ
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id67" onchange="jsfuncSetState('id67')"
                                                        name="developments8_behavior3_3" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    3.4 ยืนตรงเคารพพธงชาติร้องเพลงชาติ
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id68" onchange="jsfuncSetState('id68')"
                                                        name="developments8_behavior3_4" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    3.5
                                                    เข้าร่วมกกิจกรรมที่เกี่ยวกับสถาบันพระมหากกษัตริย์ตามที่โรงเรียนและชุมชนจัดขึ้น
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id69" onchange="jsfuncSetState('id69')"
                                                        name="developments8_behavior3_5" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- เพิ่มข้อมูลหน้า8 -->
                                <div class="form-section">
                                    <table class="table table-bordered border-dark">
                                        <thead>
                                            <tr>
                                                <th scope="col" class=" text-center" valign="middle">พัฒนาการ</th>
                                                <th scope="col" class=" text-center" valign="middle">ตัวบ่งชี้</th>
                                                <th scope="col" class=" text-center" valign="middle">พฤติกรรม</th>
                                                <th scope="col" class=" text-center" valign="middle" width="200px">
                                                    <select class="form-select" aria-label="Default select example"
                                                        name="semester" required
                                                        data-parsley-required-message="กรุณาเลือกภาคเรียน">
                                                        <option selected disabled>-- ภาคเรียนที่ --</option>
                                                        @if (isset($datasemester1))
                                                            <option value="ภาคเรียน2">ภาคเรียน 2</option>
                                                        @else
                                                            <option value="ภาคเรียน1">ภาคเรียน 1</option>
                                                            <option value="ภาคเรียน2">ภาคเรียน 2</option>
                                                        @endif
                                                    </select>
                                                </th>
                                            </tr>

                                        </thead>
                                        <tbody>
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
                                                    1.1 ฟังผู้อื่นพูดจนจบและสนทนาโต้ตอบสอดคล้องกับเรื่องที่ฟัง
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id70" onchange="jsfuncSetState('id70')"
                                                        name="developments9_behavior1_1" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    1.2 เล่าเป็นเรื่องราวต่อเนื่องได้
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id71" onchange="jsfuncSetState('id71')"
                                                        name="developments9_behavior1_2" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    1.3 ฟังคำสัง 2 ขั้นตอนและสามารถปฎิบัติได้
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id72" onchange="jsfuncSetState('id72')"
                                                        name="developments9_behavior1_3" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    1.4 พูดโต้ตอบและเล่าเรื่องเป็นประโยคอย่างต่อเนื่อง
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id73" onchange="jsfuncSetState('id73')"
                                                        name="developments9_behavior1_4" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    1.5 ฟัง พูด โต้ตอบและแสดงความรู้สึกเกี่ยวกับเรื่องที่ฟังได้
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id74" onchange="jsfuncSetState('id74')"
                                                        name="developments9_behavior1_5" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

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
                                                        id="id75" onchange="jsfuncSetState('id75')"
                                                        name="developments9_behavior2_1" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    2.2 เขียนคล้ายตัวอักษร
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id76" onchange="jsfuncSetState('id76')"
                                                        name="developments9_behavior2_2" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    2.3 เปิดและอ่านหนังสือด้วนตนเอง
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id77" onchange="jsfuncSetState('id77')"
                                                        name="developments9_behavior2_3" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <th scope="row" rowspan="10">
                                                    <u>พัฒนาการด้านสติปัญญา</u> <br>
                                                    <label for="">มาตรฐานที่ 10</label><br>
                                                    <label
                                                        for="">มีความสามารถในการคิดเป็นพื้นฐานในการเรียนรู้</label>
                                                </th>
                                                <td rowspan="5">
                                                    1.มีความสามารถในการคิดรวบยอด
                                                </td>
                                                <td>
                                                    1.1 บอกลักษณะส่วนประกอบของสิ่งของต่างๆจากกการสังเกตโดยใช้ประสาทสัมผัส
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id78" onchange="jsfuncSetState('id78')"
                                                        name="developments10_behavior1_1" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    1.2 จับคู่และเปรียบเทียบความแตกต่างหรือความเหมือนของสิ่งต่างๆ
                                                    โดยใช้ลักษณะที่สังเกตพบเพียงลักกษณะเดียว
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id79" onchange="jsfuncSetState('id79')"
                                                        name="developments10_behavior1_2" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    1.3 จำแนกและจัดกลุ่มสิ่งต่างๆ โดยใช้อย่างน้อย 1 ลักกษณะเป็นเกณฑ์
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id80" onchange="jsfuncSetState('id80')"
                                                        name="developments10_behavior1_3" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    1.4 เรียงลำดับสิ่งของหรือเหตุกการณ์อย่างน้อย 4 ลำดับ
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id81" onchange="jsfuncSetState('id81')"
                                                        name="developments10_behavior1_4" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    1.5 แก้ปัญหาด้วยวิธีการต่างๆ โดยการลองผิดลองถูกด้วยตนเอง
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id82" onchange="jsfuncSetState('id82')"
                                                        name="developments10_behavior1_5" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

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
                                                        id="id83" onchange="jsfuncSetState('id83')"
                                                        name="developments10_behavior2_1" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    2.2
                                                    คาดเดาหรือคาดคะเนสิ่งที่อาดเกินขึ้นหรือมีส่วนร่วมในการลงความเห็นจากข้อมูล
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id84" onchange="jsfuncSetState('id84')"
                                                        name="developments10_behavior2_2" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

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
                                                        id="id85" onchange="jsfuncSetState('id85')"
                                                        name="developments10_behavior3_1" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    3.2 ระบุปัญหาโดยลองผิดลองถูก
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id86" onchange="jsfuncSetState('id86')"
                                                        name="developments10_behavior3_2" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    3.3
                                                    ให้เตุผผลในการคาดคะแนการลงความเห็นหรือการลงข้อสรุปเพื่ออธิบายเกี่ยวกับสิ่งที่สังเกตหรือเรียนรู้
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id87" onchange="jsfuncSetState('id87')"
                                                        name="developments10_behavior3_3" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- เพิ่มข้อมูลหน้า9 -->
                                <div class="form-section">
                                    <table class="table table-bordered border-dark">
                                        <thead>
                                            <tr>
                                                <th scope="col" class=" text-center" valign="middle">พัฒนาการ</th>
                                                <th scope="col" class=" text-center" valign="middle">ตัวบ่งชี้</th>
                                                <th scope="col" class=" text-center" valign="middle">พฤติกรรม</th>
                                                <th scope="col" class=" text-center" valign="middle"
                                                    width="200px">
                                                    <select class="form-select" aria-label="Default select example"
                                                        name="semester" required
                                                        data-parsley-required-message="กรุณาเลือกภาคเรียน">
                                                        <option selected disabled>-- ภาคเรียนที่ --</option>
                                                        @if (isset($datasemester1))
                                                            <option value="ภาคเรียน2">ภาคเรียน 2</option>
                                                        @else
                                                            <option value="ภาคเรียน1">ภาคเรียน 1</option>
                                                            <option value="ภาคเรียน2">ภาคเรียน 2</option>
                                                        @endif
                                                    </select>
                                                </th>
                                            </tr>

                                        </thead>
                                        <tbody>
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
                                                    สร้างผลงานศิลปะเพื่อสื่อสานความรู้สึกของตนเองโดยมีการดัดแปลงและแปลกใหม่จากเดิมหรือมีรายละเอียดเพิ่มขึ้น
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id88" onchange="jsfuncSetState('id88')"
                                                        name="developments11_behavior1_1" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    1.2 เล่น/ทำงานศิลปะตามจินตนาการของตนเอง
                                                    โดนมีลักษณะคิดริเริ่มคิดคล่องแคล่วคิดยึดหยุ่นและคิดละเอียดลออ
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id89" onchange="jsfuncSetState('id89')"
                                                        name="developments11_behavior1_2" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

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
                                                        id="id90" onchange="jsfuncSetState('id90')"
                                                        name="developments11_behavior2_1" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

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
                                                        id="id91" onchange="jsfuncSetState('id91')"
                                                        name="developments11_behavior2_2" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

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
                                                        id="id92" onchange="jsfuncSetState('id92')"
                                                        name="developments12_behavior1_1" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    1.2 กระตือรือร้นในการเข้าร่วมกิจกรรม
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id93" onchange="jsfuncSetState('id93')"
                                                        name="developments12_behavior1_2" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    1.3 ถามคำถามและแสดงความคิดเห็นเกี่ยวกับเรื่องที่สนใจ
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id94" onchange="jsfuncSetState('id94')"
                                                        name="developments12_behavior1_3" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

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
                                                        id="id95" onchange="jsfuncSetState('id95')"
                                                        name="developments12_behavior2_1" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    2.2 ใช้ประโยคคำถามว่า "ที่ไหน" "ทำไม" ในการค้นหาคำตอบ
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id96" onchange="jsfuncSetState('id96')"
                                                        name="developments12_behavior2_2" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    2.3 เชื่อมโยงความรู้และทักษะต่างๆใช้ในชีวิตประจำวัน
                                                </td>
                                                <td class="text-center">
                                                    <select class="form-select" aria-label="Default select example"
                                                        id="id97" onchange="jsfuncSetState('id97')"
                                                        name="developments12_behavior2_3" required
                                                        data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                        <option selected disabled>-- พัฒนาการ --</option>
                                                        <option value="1">ควรเสริม</option>
                                                        <option value="2">ปานกลาง</option>
                                                        <option value="3">ดี</option>
                                                    </select>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <!-- เพิ่มข้อมูลหน้า10 -->
                                <div class="form-section">
                                    <div class="row justify-content-center align-items-center g-2 mb-3">
                                        <div class="col">
                                            <label for="exampleFormControlTextarea1"
                                                class="form-label">ความคิดเห็นของครูประจำชั้น</label>

                                            <textarea name="commenteacher" id="editor" rows="3"></textarea> {{-- {{ old('description',$data->p_description) }} --}}

                                        </div>

                                    </div>
                                </div>
                        </div>
                        <div class="form-navigation my-3 mx-2">
                            <button type="button" class="previous btn btn-primary float-start ">&lt;ก่อนหน้า</button>
                            <button type="button" class="next btn btn-primary float-end">ถัดไป &gt;</button>
                            <button type="submit" class="btn btn-success float-end">บันทึก</button>
                        </div>
                        </form>
                    </div>
                @endif


            </div>
        </div>
    </div>
    </div>
@endsection

@section('script')
    <script>
        function jsfuncSetState(value) {
            document.getElementById(value).setAttribute("style", "color:MediumSeaGreen ")
        }

        ClassicEditor
            .create(document.querySelector('#editor'), {

                ckfinder: {
                    uploadUrl: '{{ route('behavior.upload') . '?_token=' . csrf_token() }}',
                }
            })
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });

        function jsfuncSetState(value) {
            document.getElementById(value).setAttribute("style", "color:MediumSeaGreen ")
        }

        $(function() {
            var $sections = $('.form-section');

            function navigateTo(index) {

                $sections.removeClass('current').eq(index).addClass('current');

                $('.form-navigation .previous').toggle(index > 0);
                var atTheEnd = index >= $sections.length - 1;
                $('.form-navigation .next').toggle(!atTheEnd);
                $('.form-navigation [Type=submit]').toggle(atTheEnd);


                const step = document.querySelector('.step' + index);
                step.style.backgroundColor = "#17a2b8";
                step.style.color = "white";



            }

            function curIndex() {

                return $sections.index($sections.filter('.current'));
            }

            $('.form-navigation .previous').click(function() {
                navigateTo(curIndex() - 1);
            });

            $('.form-navigation .next').click(function() {
                $('.employee-form').parsley().whenValidate({
                    group: 'block-' + curIndex()
                }).done(function() {
                    navigateTo(curIndex() + 1);
                });

            });

            $sections.each(function(index, section) {
                $(section).find(':input').attr('data-parsley-group', 'block-' + index);
            });


            navigateTo(0);



        });
    </script>
@endsection
