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

        .nav-pills .nav-link.active,
        .nav-pills .show>.nav-link {
            background-color: #b3f3fd;
            color: white;
            border-radius: 0px;
        }

        .nav-pills .nav-link {
            border: 1px solid #17a2b8;
            border-radius: 0px;
        }

        .have-data {
            background-color: #17a2b8 !important;
            color: white !important;
            border-radius: 0px !important;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center g-2">
            @if (count($table1_semester1) > 0 &&
                    count($table1_semester2) > 0 && count($table2_semester1) > 0 &&
                    count($table2_semester2) > 0 && count($table3_semester1) > 0 &&
                    count($table3_semester2) > 0 && count($table4_semester1) > 0 &&
                    count($table4_semester2) > 0 && count($table5_semester1) > 0 &&
                    count($table5_semester2) > 0 && count($table6_semester1) > 0 &&
                    count($table6_semester2) > 0 && count($table7_semester1) > 0 &&
                    count($table7_semester2) > 0 && count($table8_semester1) > 0 &&
                    count($table8_semester2) > 0 && count($table9_semester1) > 0 &&
                    count($table9_semester2) > 0 && count($table10_semester1) > 0 && count($table10_semester2) > 0)
                <div class="alert alert-info text-center" role="alert">
                    <h5>
                        ประเมินพัฒนาการครบทั้ง2ภาคเรียนแล้ว
                        <a href="{{route('appraisal.show3',['student_id'=>$student->student_id])}}">{{--{{ url('teacher/record/appraisal/show/' . $student->student_id) }}--}}
                            ดูบันทึก
                        </a>
                    </h5>
                </div>
            @else
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <div class="row justify-content-start align-items-center g-2">
                                <div class="col-md-4 text-start">
                                    <a class="btn btn-info" href="{{ route('record.appraisal') }}" role="button"><i
                                        class="bi bi-chevron-left"></i>กลับ</a>
                                </div>
                                <div class="col-md-4 text-center">
                                    {{ $student->prefix_name . $student->first_name . ' ' . $student->last_name }}
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <ul class="nav nav-pills nav-fill mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-1-tab" data-toggle="pill" href="#pills-1"
                                        role="tab" aria-controls="pills-1" aria-selected="true">1</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-2-tab" data-toggle="pill" href="#pills-2" role="tab"
                                        aria-controls="pills-2" aria-selected="false">2</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-3-tab" data-toggle="pill" href="#pills-3" role="tab"
                                        aria-controls="pills-3" aria-selected="false">3</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-4-tab" data-toggle="pill" href="#pills-4" role="tab"
                                        aria-controls="pills-4" aria-selected="false">4</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-5-tab" data-toggle="pill" href="#pills-5" role="tab"
                                        aria-controls="pills-5" aria-selected="false">5</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-6-tab" data-toggle="pill" href="#pills-6" role="tab"
                                        aria-controls="pills-6" aria-selected="false">6</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-7-tab" data-toggle="pill" href="#pills-7" role="tab"
                                        aria-controls="pills-7" aria-selected="false">7</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-8-tab" data-toggle="pill" href="#pills-8" role="tab"
                                        aria-controls="pills-8" aria-selected="false">8</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-9-tab" data-toggle="pill" href="#pills-9" role="tab"
                                        aria-controls="pills-9" aria-selected="false">9</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-10-tab" data-toggle="pill" href="#pills-10" role="tab"
                                        aria-controls="pills-10" aria-selected="false">10</a>
                                </li>
                            </ul>

                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="pills-1" role="tabpanel"
                                    aria-labelledby="pills-1-tab">
                                    <form action="{{ url('teacher/record/appraisal/store/' . $student->student_id) }}"
                                        method="post" class="employee-form">
                                        @csrf
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class=" text-center" valign="middle">
                                                        พัฒนาการ
                                                    </th>
                                                    <th scope="col" class=" text-center" valign="middle">
                                                        ตัวบ่งชี้
                                                    </th>
                                                    <th scope="col" class=" text-center" valign="middle">
                                                        พฤติกรรม
                                                    </th>
                                                    <th scope="col" class=" text-center" valign="middle"
                                                        width="170px">
                                                        <select class="form-select" aria-label="Default select example"
                                                            name="semester" required
                                                            data-parsley-required-message="กรุณาเลือกภาคเรียน"
                                                            onChange="selectSemester('table1', event)">{{--  --}}
                                                            <option selected disabled>-- ภาคเรียนที่ --</option>
                                                            @if ($check_table_semester1 == false && $check_table_semester2 == false)
                                                                <option value="ภาคเรียน1">ภาคเรียน 1</option>
                                                            @endif
                                                            @if ($check_table_semester1 == true && $check_table_semester2 == false)
                                                                <option value="ภาคเรียน2">ภาคเรียน 2</option>
                                                            @endif
                                                        </select>
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody class="semester1">
                                                <tr>
                                                    <th scope="row" rowspan="11">
                                                        <u>พัฒนาการด้านร่างกาย</u> <br>
                                                        <label for="">มาตรฐานที่ 1</label><br>
                                                        <label
                                                            for="">ร่ายกายเจริญเติบโตตามวัยและมีสุขนิสัยที่ดี</label>
                                                    </th>
                                                    <td rowspan="3">
                                                        1.มีน้ำหนักส่วนสูงตามเกณ์
                                                    </td>
                                                    <td>
                                                        1.1 น้ำหนักตามเณฑ์อายุของกรมอนามัย
                                                        <input type="hidden" name="table_section[]" value="1_1_1" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id1" onchange="jsfuncSetState('id1')"
                                                            name="developments_behavior1_1_1" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">{{--  --}}

                                                            <option selected disabled value="">-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        1.2 ส่วนสูงตามเกณฑ์อายุของกรมอนามัย
                                                        <input type="hidden" name="table_section[]" value="1_1_2" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id2" onchange="jsfuncSetState('id2')"
                                                            name="developments_behavior1_1_2" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">{{--  --}}
                                                            <option selected disabled value="">-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        1.3 เส้นรอบศีรษะตามเกณฑ์อายุ
                                                        <input type="hidden" name="table_section[]" value="1_1_3" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id3" onchange="jsfuncSetState('id3')"
                                                            name="developments_behavior1_1_3" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">{{--  --}}
                                                            <option selected disabled value="">-- พัฒนาการ --
                                                            </option>
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
                                                        2.1 รับประทานอาหารที่มีประโยชน์ได้หลายชนิดดื่มน้ำสะอาดได้ด้วยตนเอง
                                                        <input type="hidden" name="table_section[]" value="1_2_1" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id4" onchange="jsfuncSetState('id4')"
                                                            name="developments_behavior1_2_1" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">{{--  --}}
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        2.2 ล้างมือก่อนรับประทานอาหารและหลังใช้ห้องน้ำ ห้องส้วมได้ด้วยตนเอง
                                                        <input type="hidden" name="table_section[]" value="1_2_2" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id5" onchange="jsfuncSetState('id5')"
                                                            name="developments_behavior1_2_2" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">{{--  --}}
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        2.3 นอนพักผ่อนเป็นเวลา
                                                        <input type="hidden" name="table_section[]" value="1_2_3" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id6" onchange="jsfuncSetState('id6')"
                                                            name="developments_behavior1_2_3" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">{{--  --}}
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        2.4 ออกกำลังกายเป็นเวลา
                                                        <input type="hidden" name="table_section[]" value="1_2_4" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id7" onchange="jsfuncSetState('id7')"
                                                            name="developments_behavior1_2_4" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">{{--  --}}
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        2.5 อาบน้ำแต่ตัวได้แต่ไม่คล่อง
                                                        <input type="hidden" name="table_section[]" value="1_2_5" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id8" onchange="jsfuncSetState('id8')"
                                                            name="developments_behavior1_2_5" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">{{--  --}}
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        2.6 ขับถ่ายเป็นเวลา
                                                        <input type="hidden" name="table_section[]" value="1_2_6" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id9" onchange="jsfuncSetState('id9')"
                                                            name="developments_behavior1_2_6" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">{{--  --}}
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
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
                                                        3.1 เล่นและทำกิจกรรมและปฏิบัตต่อผู่อื่นอย่างปลอดภัยได้ด้วยตนเอง
                                                        <input type="hidden" name="table_section[]" value="1_3_1" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id10" onchange="jsfuncSetState('id10')"
                                                            name="developments_behavior1_3_1" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">{{--  --}}
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        3.2 ระมัดระวังตนเองให้ปลอดภัยขณะเล่น
                                                        <input type="hidden" name="table_section[]" value="1_3_2" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id11" onchange="jsfuncSetState('id11')"
                                                            name="developments_behavior1_3_2" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">{{--  --}}
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <input type="hidden" name="table_no" value="1" />
                                        <button type="submit" class="btn btn-success float-end">บันทึก</button>
                                    </form>
                                </div> {{-- ปิด-pills-1 --}}

                                <div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2-tab">
                                    <form action="{{ url('teacher/record/appraisal/store/' . $student->student_id) }}"
                                        method="post" class="employee-form">
                                        @csrf
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class=" text-center" valign="middle">
                                                        พัฒนาการ
                                                    </th>
                                                    <th scope="col" class=" text-center" valign="middle">
                                                        ตัวบ่งชี้
                                                    </th>
                                                    <th scope="col" class=" text-center" valign="middle">
                                                        พฤติกรรม
                                                    </th>
                                                    <th scope="col" class=" text-center" valign="middle"
                                                        width="170px">
                                                        <select class="form-select" aria-label="Default select example"
                                                            name="semester" required
                                                            data-parsley-required-message="กรุณาเลือกภาคเรียน"
                                                            onChange="selectSemester('table2', event)">
                                                            <option selected disabled>-- ภาคเรียนที่ --</option>
                                                            @if ($check_table_semester1 == false && $check_table_semester2 == false)
                                                                <option value="ภาคเรียน1">ภาคเรียน 1</option>
                                                            @endif
                                                            @if ($check_table_semester1 == true && $check_table_semester2 == false)
                                                                <option value="ภาคเรียน2">ภาคเรียน 2</option>
                                                            @endif
                                                        </select>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="semester2">
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
                                                        1.1 เดินต่อเท้าถอยหลังเป็นเส้นตรงได้โดยไม่ต้องกางแขน
                                                        <input type="hidden" name="table_section[]" value="2_1_1" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id12" onchange="jsfuncSetState('id12')"
                                                            name="developments_behavior2_1_1" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        1.2 กระโดดขาเดียวไปข้างหน้าได้อย่างต่อเนื่องโดยไม่เสียการทรงตัว
                                                        <input type="hidden" name="table_section[]" value="2_1_2" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id13" onchange="jsfuncSetState('id13')"
                                                            name="developments_behavior2_1_2" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        1.3 วิ่งหลบหลีกสิ่งกีดขวางได้อย่างคล่องแคล่ว
                                                        <input type="hidden" name="table_section[]" value="2_1_3" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id14" onchange="jsfuncSetState('id14')"
                                                            name="developments_behavior2_1_3" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        1.4 รับลูกบอลที่กระดอนจากพื้อนได้
                                                        <input type="hidden" name="table_section[]" value="2_1_4" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id15" onchange="jsfuncSetState('id15')"
                                                            name="developments_behavior2_1_4" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        1.5 เดินลงบันไดสลับเท้าได้อย่างคล่องแคล่ว
                                                        <input type="hidden" name="table_section[]" value="2_1_5" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id16" onchange="jsfuncSetState('id16')"
                                                            name="developments_behavior2_1_5" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
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
                                                        2.1 ใช้กรรไกกรตัดระดาษตามแนวเส้นโค้งได้
                                                        <input type="hidden" name="table_section[]" value="2_2_1" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id17" onchange="jsfuncSetState('id17')"
                                                            name="developments_behavior2_2_1" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        2.2 เขียนรูปสามเหลียมตามแบบได้อย่างมีมุมชัดเจน
                                                        <input type="hidden" name="table_section[]" value="2_2_2" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id18" onchange="jsfuncSetState('id18')"
                                                            name="developments_behavior2_2_2" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        2.3 ร้อยวัสดุที่มีรูขนาดเส้นผ่าศูนย์กลาง 0.25 เซนติเมตรได้
                                                        <input type="hidden" name="table_section[]" value="2_2_3" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id19" onchange="jsfuncSetState('id19')"
                                                            name="developments_behavior2_2_3" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        2.4 โยนลูกบอลไปข้างหน้าได้
                                                        <input type="hidden" name="table_section[]" value="2_2_4" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id20" onchange="jsfuncSetState('id20')"
                                                            name="developments_behavior2_2_4" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <input type="hidden" name="table_no" value="2" />
                                        <button type="submit" class="btn btn-success float-end">บันทึก</button>
                                    </form>
                                </div>{{-- ปิด-pills-2 --}}

                                <div class="tab-pane fade" id="pills-3" role="tabpanel" aria-labelledby="pills-3-tab">
                                    <form action="{{ url('teacher/record/appraisal/store/' . $student->student_id) }}"
                                        method="post" class="employee-form">
                                        @csrf
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class=" text-center" valign="middle">
                                                        พัฒนาการ
                                                    </th>
                                                    <th scope="col" class=" text-center" valign="middle">
                                                        ตัวบ่งชี้
                                                    </th>
                                                    <th scope="col" class=" text-center" valign="middle">
                                                        พฤติกรรม
                                                    </th>
                                                    <th scope="col" class=" text-center" valign="middle"
                                                        width="170px">
                                                        <select class="form-select" aria-label="Default select example"
                                                            name="semester" required
                                                            data-parsley-required-message="กรุณาเลือกภาคเรียน"
                                                            onChange="selectSemester('table3', event)">
                                                            <option selected disabled>-- ภาคเรียนที่ --</option>
                                                            @if ($check_table_semester1 == false && $check_table_semester2 == false)
                                                                <option value="ภาคเรียน1">ภาคเรียน 1</option>
                                                            @endif
                                                            @if ($check_table_semester1 == true && $check_table_semester2 == false)
                                                                <option value="ภาคเรียน2">ภาคเรียน 2</option>
                                                            @endif
                                                        </select>
                                                    </th>
                                                </tr>
                                            </thead>

                                            <tbody class="semester3">
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
                                                        1.1 แสดงอารมณ์ได้อย่างสอดคล่องกับสถานการณ์อย่างเหมาะสม
                                                        <input type="hidden" name="table_section[]" value="3_1_1" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id21" onchange="jsfuncSetState('id21')"
                                                            name="developments_behavior3_1_1" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        1.2 ร่าเริง สดชื่น แจ่มใส และอารมณ์ดี
                                                        <input type="hidden" name="table_section[]" value="3_1_2" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id22" onchange="jsfuncSetState('id22')"
                                                            name="developments_behavior3_1_2" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
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
                                                        <input type="hidden" name="table_section[]" value="3_2_1" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id23" onchange="jsfuncSetState('id23')"
                                                            name="developments_behavior3_2_1" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        2.2 แสดงความพอใจในผลงานและความสามารถจองตนเองและผู้อื่น
                                                        <input type="hidden" name="table_section[]" value="3_2_2" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id24" onchange="jsfuncSetState('id24')"
                                                            name="developments_behavior3_2_2" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        2.3 มีความมั่นใจในตนเอง
                                                        <input type="hidden" name="table_section[]" value="3_2_3" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id25" onchange="jsfuncSetState('id25')"
                                                            name="developments_behavior3_2_3" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        2.4 รับรู้ความรู้สึกผู้อื่นและปลอบโยนเมื่อผู้อื่นเสียใจ
                                                        <input type="hidden" name="table_section[]" value="3_2_4" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id26" onchange="jsfuncSetState('id26')"
                                                            name="developments_behavior3_2_4" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
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
                                                        <label for="">ชื่นชมและแสดงออกทางศิลปะ
                                                            คนตรีและการเคลื่อนไหว</label>
                                                    </th>
                                                    <td rowspan="4">
                                                        1.สนใจมีความสุขและแสดงออกผ่านงานศิลปะ คนตรีและการเคลื่อนไหว
                                                    </td>
                                                    <td>
                                                        1.1 สนใจ มีความสุขและแสดงออผ่านงานศิลปะ
                                                        <input type="hidden" name="table_section[]" value="4_1_1" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id27" onchange="jsfuncSetState('id27')"
                                                            name="developments_behavior4_1_1" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        1.2 สนใจ มีความสุขและแสดงออกผ่านเสียงเลงดนตรี
                                                        <input type="hidden" name="table_section[]" value="4_1_2" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id28" onchange="jsfuncSetState('id28')"
                                                            name="developments_behavior4_1_2" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        1.3 สนใจ มีความสุขและแสดงท่าทาง/เคลื่อนไหวประกอบเพลงจังหวะและดนตรี
                                                        <input type="hidden" name="table_section[]" value="4_1_3" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id29" onchange="jsfuncSetState('id29')"
                                                            name="developments_behavior4_1_3" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        1.4 สนใจแล้วมีความสุขขณะทำงานศิลปะ
                                                        <input type="hidden" name="table_section[]" value="4_1_4" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id30" onchange="jsfuncSetState('id30')"
                                                            name="developments_behavior4_1_4" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <input type="hidden" name="table_no" value="3" />
                                        <button type="submit" class="btn btn-success float-end">บันทึก</button>
                                    </form>
                                </div>{{-- ปิด-pills-3 --}}

                                <div class="tab-pane fade" id="pills-4" role="tabpanel" aria-labelledby="pills-4-tab">
                                    <form action="{{ url('teacher/record/appraisal/store/' . $student->student_id) }}"
                                        method="post" class="employee-form">
                                        @csrf
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class=" text-center" valign="middle">
                                                        พัฒนาการ
                                                    </th>
                                                    <th scope="col" class=" text-center" valign="middle">
                                                        ตัวบ่งชี้
                                                    </th>
                                                    <th scope="col" class=" text-center" valign="middle">
                                                        พฤติกรรม
                                                    </th>
                                                    <th scope="col" class=" text-center" valign="middle"
                                                        width="170px">
                                                        <select class="form-select" aria-label="Default select example"
                                                            name="semester" onChange="selectSemester('table4', event)"
                                                            required data-parsley-required-message="กรุณาเลือกภาคเรียน">
                                                            <option selected disabled>-- ภาคเรียนที่ --</option>
                                                            @if ($check_table_semester1 == false && $check_table_semester2 == false)
                                                                <option value="ภาคเรียน1">ภาคเรียน 1</option>
                                                            @endif
                                                            @if ($check_table_semester1 == true && $check_table_semester2 == false)
                                                                <option value="ภาคเรียน2">ภาคเรียน 2</option>
                                                            @endif
                                                        </select>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="semester4">
                                                <tr>
                                                    <th rowspan="9">
                                                        <u>พัฒนาการด้านอารมณ์และจิตใจ</u> <br>
                                                        <label for="">มาตรฐานที่ 5</label><br>
                                                        <label for="">มีคุณธรรม จริยธรรม และ จิตใจที่ดีงาม</label>
                                                    </th>
                                                    <td rowspan="2">
                                                        1.ซื่อสัตย์สุจริต
                                                    </td>
                                                    <td>
                                                        1.1 ขออนุญาตหรือรอคอยเมื่อต้องการสิ่งของของผู้อื่นด้วยตัวเอง
                                                        <input type="hidden" name="table_section[]" value="5_1_1" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id31" onchange="jsfuncSetState('id31')"
                                                            name="developments_behavior5_1_1">{{-- required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน" --}}
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        1.2 รู้จักขอโทษด้วยตนเอง
                                                        <input type="hidden" name="table_section[]" value="5_1_2" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id32" onchange="jsfuncSetState('id32')"
                                                            name="developments_behavior5_1_2" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td rowspan="3">
                                                        2.มีความเมตตากรุณา มีน้ำใจ และช่วยเหลือแบ่งปัน
                                                    </td>
                                                    <td>
                                                        2.1 แสดงความรักเพื่อนและมีเมตตาต่อสัตว์เลี้ยง
                                                        <input type="hidden" name="table_section[]" value="5_2_1" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id33" onchange="jsfuncSetState('id33')"
                                                            name="developments_behavior5_2_1" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        2.2 ช่วยเหลือผู้อื่นได้ด้วนตนเอง
                                                        <input type="hidden" name="table_section[]" value="5_2_2" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id34" onchange="jsfuncSetState('id34')"
                                                            name="developments_behavior5_2_2" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        2.3 มีจิตสาธารณะ
                                                        <input type="hidden" name="table_section[]" value="5_2_3" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id35" onchange="jsfuncSetState('id35')"
                                                            name="developments_behavior5_2_3" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
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
                                                        3.1
                                                        แสดงสีหน้าท่าทางรับรู้ความรู้สึกของผู้อื่นอย่างสอดคล้องกับสถานการณ์
                                                        <input type="hidden" name="table_section[]" value="5_3_1" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id36" onchange="jsfuncSetState('id36')"
                                                            name="developments_behavior5_3_1" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        3.2 รับรู้ความรู้ศึกผู้อื่นและปลอบโยนเมื่อผู้อื่นเสียใจ
                                                        <input type="hidden" name="table_section[]" value="5_3_2" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id37" onchange="jsfuncSetState('id37')"
                                                            name="developments_behavior5_3_2" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
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
                                                        4.1 ทำงานที่ได้รับมอบหมายจนสำเร็จด้วยตนเอง
                                                        <input type="hidden" name="table_section[]" value="5_4_1" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id38" onchange="jsfuncSetState('id38')"
                                                            name="developments_behavior5_4_1" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        4.2 รักษาสิงของที่ใช้ร่วมกันได้
                                                        <input type="hidden" name="table_section[]" value="5_4_2" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id39" onchange="jsfuncSetState('id39')"
                                                            name="developments_behavior5_4_2" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <input type="hidden" name="table_no" value="4" />
                                        <button type="submit" class="btn btn-success float-end">บันทึก</button>
                                    </form>
                                </div>{{-- ปิด-pills-4 --}}

                                <div class="tab-pane fade" id="pills-5" role="tabpanel" aria-labelledby="pills-5-tab">
                                    <form action="{{ url('teacher/record/appraisal/store/' . $student->student_id) }}"
                                        method="post" class="employee-form">
                                        @csrf
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class=" text-center" valign="middle">
                                                        พัฒนาการ
                                                    </th>
                                                    <th scope="col" class=" text-center" valign="middle">
                                                        ตัวบ่งชี้
                                                    </th>
                                                    <th scope="col" class=" text-center" valign="middle">
                                                        พฤติกรรม
                                                    </th>
                                                    <th scope="col" class=" text-center" valign="middle"
                                                        width="170px">
                                                        <select class="form-select" aria-label="Default select example"
                                                            name="semester" required
                                                            data-parsley-required-message="กรุณาเลือกภาคเรียน"
                                                            onChange="selectSemester('table5', event)">
                                                            <option selected disabled>-- ภาคเรียนที่ --</option>
                                                            @if ($check_table_semester1 == false && $check_table_semester2 == false)
                                                                <option value="ภาคเรียน1">ภาคเรียน 1</option>
                                                            @endif
                                                            @if ($check_table_semester1 == true && $check_table_semester2 == false)
                                                                <option value="ภาคเรียน2">ภาคเรียน 2</option>
                                                            @endif
                                                        </select>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="semester5">
                                                <tr>
                                                    <th scope="row" rowspan="9">
                                                        <u>พัฒนาการด้านสังคม</u> <br>
                                                        <label for="">มาตรฐานที่ 6</label><br>
                                                        <label
                                                            for="">มีทักษะชีวิตและปฎิบัติตามหลักปรัชญาของเศรษฐกิจพอเพียง</label>
                                                    </th>
                                                    <td rowspan="4">
                                                        1.ช่วยเหลือตนเองในการปฎิบัติกิจวัตรประจำวัน
                                                    </td>
                                                    <td>
                                                        1.1 แต่ตัวด้วยตนเองได้อย่างคล่องแคล่ว
                                                        <input type="hidden" name="table_section[]" value="6_1_1" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id40" onchange="jsfuncSetState('id40')"
                                                            name="developments_behavior6_1_1" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        1.2 รับประทานอาหารด้วนตนเองอย่างถูกวิธี
                                                        <input type="hidden" name="table_section[]" value="6_1_2" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id41" onchange="jsfuncSetState('id41')"
                                                            name="developments_behavior6_1_2" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        1.3 ใช้และทำความสอาดหลังใช้ห้องน้ำ ห้องส้วมด้วยตนเอง
                                                        <input type="hidden" name="table_section[]" value="6_1_3" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id42" onchange="jsfuncSetState('id42')"
                                                            name="developments_behavior6_1_3" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        1.4 ระมัดระวังดูแลตนเองและผู้อื่นให้ปลอดภัย
                                                        <input type="hidden" name="table_section[]" value="6_1_4" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id43" onchange="jsfuncSetState('id43')"
                                                            name="developments_behavior6_1_4" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
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
                                                        2.1 เก็บของเล่น ของใช้เข้าที่อย่างเรียบร้อยด้วยตนเอง
                                                        <input type="hidden" name="table_section[]" value="6_2_1" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id44" onchange="jsfuncSetState('id44')"
                                                            name="developments_behavior6_2_1" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        2.2 เข้าแถวตามลำดับก่อน-หลัง ได้ด้วยตนเอง
                                                        <input type="hidden" name="table_section[]" value="6_2_2" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id45" onchange="jsfuncSetState('id45')"
                                                            name="developments_behavior6_2_2" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        2.3 ทึ้งขยะเป็นที่ได้
                                                        <input type="hidden" name="table_section[]" value="6_2_3" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id46" onchange="jsfuncSetState('id46')"
                                                            name="developments_behavior6_2_3" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td rowspan="2">
                                                        3.ประหยัดและพอเพียง
                                                    </td>
                                                    <td>
                                                        3.1 ใช้สิ่งของเครื่องใช้อย่างประหยัดและพอเพียงด้วยตนเอง
                                                        <input type="hidden" name="table_section[]" value="6_3_1" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id47" onchange="jsfuncSetState('id47')"
                                                            name="developments_behavior6_3_1" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        3.2 รู้จักใช้สิ่งของ/เครื่องใช้/น้ำ/ไฟอย่างประหยัด
                                                        <input type="hidden" name="table_section[]" value="6_3_2" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id48" onchange="jsfuncSetState('id48')"
                                                            name="developments_behavior6_3_2" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <input type="hidden" name="table_no" value="5" />
                                        <button type="submit" class="btn btn-success float-end">บันทึก</button>
                                    </form>
                                </div>{{-- ปิด-pills-5 --}}

                                <div class="tab-pane fade" id="pills-6" role="tabpanel" aria-labelledby="pills-6-tab">
                                    <form action="{{ url('teacher/record/appraisal/store/' . $student->student_id) }}"
                                        method="post" class="employee-form">
                                        @csrf
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class=" text-center" valign="middle">
                                                        พัฒนาการ
                                                    </th>
                                                    <th scope="col" class=" text-center" valign="middle">
                                                        ตัวบ่งชี้
                                                    </th>
                                                    <th scope="col" class=" text-center" valign="middle">
                                                        พฤติกรรม
                                                    </th>
                                                    <th scope="col" class=" text-center" valign="middle"
                                                        width="200px">
                                                        <select class="form-select" aria-label="Default select example"
                                                            name="semester" required
                                                            data-parsley-required-message="กรุณาเลือกภาคเรียน"
                                                            onChange="selectSemester('table6', event)">
                                                            <option selected disabled>-- ภาคเรียนที่ --</option>
                                                            @if ($check_table_semester1 == false && $check_table_semester2 == false)
                                                                <option value="ภาคเรียน1">ภาคเรียน 1</option>
                                                            @endif
                                                            @if ($check_table_semester1 == true && $check_table_semester2 == false)
                                                                <option value="ภาคเรียน2">ภาคเรียน 2</option>
                                                            @endif
                                                        </select>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="semester6">
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
                                                        1.1 มีส่วนร่วมดูแลรักษาธรรมชาติและสิ่งแวดล้อมด้วยตนเอง
                                                        <input type="hidden" name="table_section[]" value="7_1_1" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id49" onchange="jsfuncSetState('id49')"
                                                            name="developments_behavior7_1_1" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        1.2 ทิ้งขยะได้ถูกที่
                                                        <input type="hidden" name="table_section[]" value="7_1_2" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id50" onchange="jsfuncSetState('id50')"
                                                            name="developments_behavior7_1_2">{{-- required data-parsley-required-message="ยังไม่ได้ประเมิน" --}}
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        1.3 ปิดน้ำหลังการใช้ทันที
                                                        <input type="hidden" name="table_section[]" value="7_1_3" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id51" onchange="jsfuncSetState('id51')"
                                                            name="developments_behavior7_1_3" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
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
                                                        2.1 ปฎิบัติตามมารยาทไทยได้ตามกาลเทศะ
                                                        <input type="hidden" name="table_section[]" value="7_2_1" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id52" onchange="jsfuncSetState('id52')"
                                                            name="developments_behavior7_2_1" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        2.2 กล่าวคำจอบคุณและขอโทษด้วยตนเอง
                                                        <input type="hidden" name="table_section[]" value="7_2_2" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id53" onchange="jsfuncSetState('id53')"
                                                            name="developments_behavior7_2_2" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        2.3 ยืนตรงและร่วมร้องเพลงชาติไทยและเพลงสรรเสริญพระบารมี
                                                        <input type="hidden" name="table_section[]" value="7_2_3" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id54" onchange="jsfuncSetState('id54')"
                                                            name="developments_behavior7_2_3" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        2.4 มีสัมมาคารวะและมารยาทตามวัฒนธรรมไทยได้คล่อง
                                                        <input type="hidden" name="table_section[]" value="7_2_4" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id55" onchange="jsfuncSetState('id55')"
                                                            name="developments_behavior7_2_4" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        2.5 รักความเป็นไทย
                                                        <input type="hidden" name="table_section[]" value="7_2_5" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id56" onchange="jsfuncSetState('id56')"
                                                            name="developments_behavior7_2_5" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <input type="hidden" name="table_no" value="6" />
                                        <button type="submit" class="btn btn-success float-end">บันทึก</button>
                                    </form>
                                </div>{{-- ปิด-pills-6 --}}

                                <div class="tab-pane fade" id="pills-7" role="tabpanel"
                                    aria-labelledby="pills-7-tab">
                                    <form action="{{ url('teacher/record/appraisal/store/' . $student->student_id) }}"
                                        method="post" class="employee-form">
                                        @csrf
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class=" text-center" valign="middle">
                                                        พัฒนาการ
                                                    </th>
                                                    <th scope="col" class=" text-center" valign="middle">
                                                        ตัวบ่งชี้
                                                    </th>
                                                    <th scope="col" class=" text-center" valign="middle">
                                                        พฤติกรรม
                                                    </th>
                                                    <th scope="col" class=" text-center" valign="middle"
                                                        width="170px">
                                                        <select class="form-select" aria-label="Default select example"
                                                            name="semester" required
                                                            data-parsley-required-message="กรุณาเลือกภาคเรียน"
                                                            onChange="selectSemester('table7', event)">
                                                            <option selected disabled>-- ภาคเรียนที่ --</option>
                                                            @if ($check_table_semester1 == false && $check_table_semester2 == false)
                                                                <option value="ภาคเรียน1">ภาคเรียน 1</option>
                                                            @endif
                                                            @if ($check_table_semester1 == true && $check_table_semester2 == false)
                                                                <option value="ภาคเรียน2">ภาคเรียน 2</option>
                                                            @endif
                                                        </select>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="semester7">
                                                <tr>
                                                    <th scope="row" rowspan="15 ">
                                                        <u>พัฒนาการด้านสังคม</u> <br>
                                                        <label for="">มาตรฐานที่ 8</label><br>
                                                        <label for="">อยู่ร่วมกับผู้อื่นได้อย่างมีความสุข
                                                            และปฎิบัติตนเป็นสมาชิกที่ดีของสังคม
                                                            ในระบอกประชาธิปไตยอันมีพระมหากษัตริย์ทรงเป็นประมุข</label>
                                                    </th>
                                                    <td rowspan="5">
                                                        1.ยอมรับความเหมือนความแตกต่างระหว่างบุคคล
                                                    </td>
                                                    <td>
                                                        1.1 เล่นและทำกิจกรรมร่วมกกับเด็กที่แตกต่างไปจากตน
                                                        <input type="hidden" name="table_section[]" value="8_1_1" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id57" onchange="jsfuncSetState('id57')"
                                                            name="developments_behavior8_1_1" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        1.2 บอกความเหมืนหรือความแตกต่างระหว่างตัวเองและผู้อื่นได้
                                                        <input type="hidden" name="table_section[]" value="8_1_2" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id58" onchange="jsfuncSetState('id58')"
                                                            name="developments_behavior8_1_2" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        1.3 เล่นและทำกิจกรรมร่วมกับกลุ่มเด็กที่แตกต่างไปจากตนได้ เช่น
                                                        ต่างภาษา
                                                        เชื้อชาติ
                                                        พื้นเพทางสังคมหรือมีความบกพร่องทางร่างกาย
                                                        <input type="hidden" name="table_section[]" value="8_1_3" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id59" onchange="jsfuncSetState('id59')"
                                                            name="developments_behavior8_1_3" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        1.4 แลกเปลี่ยนความคิดเห็นและยอมรับความแตกต่างระหว่างบุคคล เชื้อชาติ
                                                        ศาสนา สังคมและวัฒนธรรมอื่น
                                                        <input type="hidden" name="table_section[]" value="8_1_4" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id60" onchange="jsfuncSetState('id60')"
                                                            name="developments_behavior8_1_4" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        1.5
                                                        พูดเกี่ยวกับประเพณีครอบครัวต่างๆและเข้าร่วมเล่นแสดงความสนใจในวัฒนธรรมอื่น
                                                        <input type="hidden" name="table_section[]" value="8_1_5" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id61" onchange="jsfuncSetState('id61')"
                                                            name="developments_behavior8_1_5" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
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
                                                        <input type="hidden" name="table_section[]" value="8_2_1" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id62" onchange="jsfuncSetState('id62')"
                                                            name="developments_behavior8_2_1" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        2.2 ยิ้ม ทักทาย หรือพูดคุยกับผู้ใหญ่และบุคคลที่คุ้นเคยได้ด้วนตนเอง
                                                        <input type="hidden" name="table_section[]" value="8_2_2" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id63" onchange="jsfuncSetState('id63')"
                                                            name="developments_behavior8_2_2" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        2.3 เข้าร่วมกิจกรรมกลุ่มได้นานขึ้นด้วยตนเอง
                                                        <input type="hidden" name="table_section[]" value="8_2_3" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id64" onchange="jsfuncSetState('id64')"
                                                            name="developments_behavior8_2_3" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        2.4 แบ่นปันกันเพื่อนและผลัดกันเล่นด้วยตนเอง
                                                        <input type="hidden" name="table_section[]" value="8_2_4" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id65" onchange="jsfuncSetState('id65')"
                                                            name="developments_behavior8_2_4" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        2.5 ประนีประนอมแก้ไขปัญหาร่วมกับผู้นอื่นได้
                                                        <input type="hidden" name="table_section[]" value="8_2_5" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id66" onchange="jsfuncSetState('id66')"
                                                            name="developments_behavior8_2_5" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
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
                                                        3.1 มีส่วนร่วมในการสร้างข้อตกลงและปฎิบัติตามข้อตกลงด้วยตนเอง
                                                        <input type="hidden" name="table_section[]" value="8_3_1" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id67" onchange="jsfuncSetState('id67')"
                                                            name="developments_behavior8_3_1" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        3.2 ปฎิบัติตนเป็นผู้นำและผู้ตามได้เหมาะสมกับสถานการณ์
                                                        <input type="hidden" name="table_section[]" value="8_3_2" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id68" onchange="jsfuncSetState('id68')"
                                                            name="developments_behavior8_3_2" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        3.3 ประนีประนอมแก้ไข้ปัญหาโดยปราศจากความรุนแรงด้วยตนเอง
                                                        <input type="hidden" name="table_section[]" value="8_3_3" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id69" onchange="jsfuncSetState('id69')"
                                                            name="developments_behavior8_3_3" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        3.4 ยืนตรงเคารพธงชาติร้องเพลงชาติ
                                                        <input type="hidden" name="table_section[]" value="8_3_4" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id70" onchange="jsfuncSetState('id70')"
                                                            name="developments_behavior8_3_4" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
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
                                                        <input type="hidden" name="table_section[]" value="8_3_5" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id71" onchange="jsfuncSetState('id71')"
                                                            name="developments_behavior8_3_5" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <input type="hidden" name="table_no" value="7" />
                                        <button type="submit" class="btn btn-success float-end">บันทึก</button>
                                    </form>
                                </div>{{-- ปิด-pills-7 --}}

                                <div class="tab-pane fade" id="pills-8" role="tabpanel"
                                    aria-labelledby="pills-8-tab">
                                    <form action="{{ url('teacher/record/appraisal/store/' . $student->student_id) }}"
                                        method="post" class="employee-form">
                                        @csrf
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class=" text-center" valign="middle">
                                                        พัฒนาการ
                                                    </th>
                                                    <th scope="col" class=" text-center" valign="middle">
                                                        ตัวบ่งชี้
                                                    </th>
                                                    <th scope="col" class=" text-center" valign="middle">
                                                        พฤติกรรม
                                                    </th>
                                                    <th scope="col" class=" text-center" valign="middle"
                                                        width="170px">
                                                        <select class="form-select" aria-label="Default select example"
                                                            name="semester" required
                                                            data-parsley-required-message="กรุณาเลือกภาคเรียน"
                                                            onChange="selectSemester('table8', event)">
                                                            <option selected disabled>-- ภาคเรียนที่ --</option>
                                                            @if ($check_table_semester1 == false && $check_table_semester2 == false)
                                                                <option value="ภาคเรียน1">ภาคเรียน 1</option>
                                                            @endif
                                                            @if ($check_table_semester1 == true && $check_table_semester2 == false)
                                                                <option value="ภาคเรียน2">ภาคเรียน 2</option>
                                                            @endif
                                                        </select>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="semester8">
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
                                                        1.1 ฟังผู้อื่นพูดจนจบและสนทนาโต้ตอบอย่างต่อเนื่อง
                                                        <input type="hidden" name="table_section[]" value="9_1_1" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id72" onchange="jsfuncSetState('id72')"
                                                            name="developments_behavior9_1_1" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        1.2 เล่าเป็นเรื่องราวต่อเนื่องได้
                                                        <input type="hidden" name="table_section[]" value="9_1_2" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id73" onchange="jsfuncSetState('id73')"
                                                            name="developments_behavior9_1_2" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        1.3 ฟังคำสัง 3 ขั้นตอนและสามารถปฎิบัติได้
                                                        <input type="hidden" name="table_section[]" value="9_1_3" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id74" onchange="jsfuncSetState('id74')"
                                                            name="developments_behavior9_1_3" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        1.4 พูดโต้ตอบและเล่าเรื่องราวต่อเนื่องได้
                                                        <input type="hidden" name="table_section[]" value="9_1_4" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id75" onchange="jsfuncSetState('id75')"
                                                            name="developments_behavior9_1_4" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        1.5 ฟัง พูด โต้ตอบและนำมาถ่ายทอดด้วยคำูกจองตนเองได้
                                                        <input type="hidden" name="table_section[]" value="9_1_5" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id76" onchange="jsfuncSetState('id76')"
                                                            name="developments_behavior9_1_5" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
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
                                                        2.1 อ่านภาพ สัญลักษณ์ คำ
                                                        ด้วยการชี้หรือกวาดตามองจุดเริ่มต้นและจุดจบของข้อความ
                                                        <input type="hidden" name="table_section[]" value="9_2_1" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id77" onchange="jsfuncSetState('id77')"
                                                            name="developments_behavior9_2_1" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        2.2 เขียนชื่อตนเองตามแบบเขียนข้อความด้วยวิธีที่คิดขึ้นเอง
                                                        <input type="hidden" name="table_section[]" value="9_2_2" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id78" onchange="jsfuncSetState('id78')"
                                                            name="developments_behavior9_2_2" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        2.3 อ่านหนังสือและเล่าเรื่องซ้ำด้วยตนเอง
                                                        <input type="hidden" name="table_section[]" value="9_2_3" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id79" onchange="jsfuncSetState('id79')"
                                                            name="developments_behavior9_2_3" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
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
                                                        1.1
                                                        บอกลักษณะการประกอบเปลี่ยนแปลงหรือความสัมพันธ์ของสิ่งของต่างๆจากการสังเกตโดยใช้ประสาทสัมผัส
                                                        <input type="hidden" name="table_section[]" value="10_1_1" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id80" onchange="jsfuncSetState('id80')"
                                                            name="developments_behavior10_1_1" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        1.2 จับคู่และเปรียบเทียบความแตกต่างและความเหมือนของสิ่งต่างๆ
                                                        โดยใช้ลักษณะที่สังเกตพบ 2 ลักกษณะขึ้นไป
                                                        <input type="hidden" name="table_section[]" value="10_1_2" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id81" onchange="jsfuncSetState('id81')"
                                                            name="developments_behavior10_1_2" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        1.3 จำแนกและจัดกลุ่มสิ่งต่างๆ โดยใช้ตั้งแต่ 2 ลักกษณะขึ้นไปเป็นเกณฑ์
                                                        <input type="hidden" name="table_section[]" value="10_1_3" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id82" onchange="jsfuncSetState('id82')"
                                                            name="developments_behavior10_1_3" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        1.4 เรียงลำดับสิ่งของหรือเหตุกการณ์อย่างน้อย 5 ลำดับ
                                                        <input type="hidden" name="table_section[]" value="10_1_4" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id83" onchange="jsfuncSetState('id83')"
                                                            name="developments_behavior10_1_4" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        1.5 วางแผนและลงมือแก้ปัญหาหรือความต้องการด้วยวิธีการต่างๆ
                                                        ที่คิดด้วยตนเอง
                                                        <input type="hidden" name="table_section[]" value="10_1_5" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id84" onchange="jsfuncSetState('id84')"
                                                            name="developments_behavior10_1_5" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
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
                                                        2.1
                                                        อธิบายหรือเชื่อมโยงสาเหตุและผลที่เกิดขึ้นในเหตุการณ์หรือการกระทำด้วยตนเอง
                                                        <input type="hidden" name="table_section[]" value="10_2_1" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id85" onchange="jsfuncSetState('id85')"
                                                            name="developments_behavior10_2_1" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        2.2
                                                        คาดคะเนสิ่งที่อาดเกินขึ้นและมีส่วนร่วมในการลงความเห็นจากข้อมูลอย่างมีเหตุผล
                                                        <input type="hidden" name="table_section[]" value="10_2_2" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id86" onchange="jsfuncSetState('id86')"
                                                            name="developments_behavior10_2_2" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
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
                                                        3.1 ตัดสินใจในเรื่องง่ายๆ และยอมรับผลที่เกิดขึ้น
                                                        <input type="hidden" name="table_section[]" value="10_3_1" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id87" onchange="jsfuncSetState('id87')"
                                                            name="developments_behavior10_3_1" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        3.2 ระบุปัญหาสร้างทางเลือกและวิธีแก้ปัญหา
                                                        <input type="hidden" name="table_section[]" value="10_3_2" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id88" onchange="jsfuncSetState('id88')"
                                                            name="developments_behavior10_3_2" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        3.3
                                                        ให้เหตุผลในการคาดคะแนการลงความเห็นหรือการลงข้อสรุปเพื่ออธิบายเกี่ยวกับสิ่งที่สังเกตหรือเรียนรู้
                                                        <input type="hidden" name="table_section[]" value="10_3_3" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id89" onchange="jsfuncSetState('id89')"
                                                            name="developments_behavior10_3_3" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <input type="hidden" name="table_no" value="8" />
                                        <button type="submit" class="btn btn-success float-end">บันทึก</button>
                                    </form>
                                </div>{{-- ปิด-pills-8 --}}

                                <div class="tab-pane fade" id="pills-9" role="tabpanel"
                                    aria-labelledby="pills-9-tab">
                                    <form action="{{ url('teacher/record/appraisal/store/' . $student->student_id) }}"
                                        method="post" class="employee-form">
                                        @csrf
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class=" text-center" valign="middle">
                                                        พัฒนาการ
                                                    </th>
                                                    <th scope="col" class=" text-center" valign="middle">
                                                        ตัวบ่งชี้
                                                    </th>
                                                    <th scope="col" class=" text-center" valign="middle">
                                                        พฤติกรรม
                                                    </th>
                                                    <th scope="col" class=" text-center" valign="middle"
                                                        width="170px">
                                                        <select class="form-select" aria-label="Default select example"
                                                            name="semester" onChange="selectSemester('table9', event)"
                                                            required data-parsley-required-message="กรุณาเลือกภาคเรียน">
                                                            <option selected disabled>-- ภาคเรียนที่ --</option>
                                                            @if ($check_table_semester1 == false && $check_table_semester2 == false)
                                                                <option value="ภาคเรียน1">ภาคเรียน 1</option>
                                                            @endif
                                                            @if ($check_table_semester1 == true && $check_table_semester2 == false)
                                                                <option value="ภาคเรียน2">ภาคเรียน 2</option>
                                                            @endif
                                                        </select>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody class="semester9">
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
                                                        <input type="hidden" name="table_section[]" value="11_1_1" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id90" onchange="jsfuncSetState('id90')"
                                                            name="developments_behavior11_1_1" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        1.2 เล่น/ทำงานศิลปะตามจินตนาการของตนเอง
                                                        โดนมีลักษณะคิดริเริ่ม คิดคล่องแคล่ว คิดยึดหยุ่นและคิดละเอียดลออ
                                                        <input type="hidden" name="table_section[]" value="11_1_2" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id91" onchange="jsfuncSetState('id91')"
                                                            name="developments_behavior11_1_2" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
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
                                                        เคลื่อนไหวท่าทางเพื่อสื่อสารความคิดความรู้สึกของตนเองอย่างหลากหลายและแปลกใหม่
                                                        <input type="hidden" name="table_section[]" value="11_2_1" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id92" onchange="jsfuncSetState('id92')"
                                                            name="developments_behavior11_2_1" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        2.2
                                                        แสดงท่าทาง/เลื่อนไหว/เล่นบทบาทสมมุติตามจินตนาการของตนเองและท่าทาง/
                                                        การเลื่อนไหวมีลักษณะคิดริเริ่ม
                                                        คิดคล่องแคล่ว คิดยึดหยุ่นและคิดละอียดลออ
                                                        <input type="hidden" name="table_section[]" value="11_2_2" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id93" onchange="jsfuncSetState('id93')"
                                                            name="developments_behavior11_2_2" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
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
                                                        1.1
                                                        สนใจหยิบหนังสือมาอ่านและเขียนสื่อความคิดด้วยตนเองเป็นประจำอย่างต่อเนื่อง
                                                        <input type="hidden" name="table_section[]" value="12_1_1" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id94" onchange="jsfuncSetState('id94')"
                                                            name="developments_behavior12_1_1" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        1.2 กระตือรือร้นในการเข้าร่วมกิจกรรม ตั้งแต่ต้นจนจบ
                                                        <input type="hidden" name="table_section[]" value="12_1_2" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id95" onchange="jsfuncSetState('id95')"
                                                            name="developments_behavior12_1_2" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        1.3
                                                        ถามคำถามเกี่ยวกับเรื่องต่างๆและกระตือรือร้นที่จะหาคำตอบด้วยวิธีการหลากหลาย
                                                        <input type="hidden" name="table_section[]" value="12_1_3" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id96" onchange="jsfuncSetState('id96')"
                                                            name="developments_behavior12_1_3" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
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
                                                        2.1 ค้นหาคำตอบของข้อสงสัยต่างๆ โดยใช่วิธีการที่หลากหลายด้วยตนเอง
                                                        <input type="hidden" name="table_section[]" value="12_2_1" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id97" onchange="jsfuncSetState('id97')"
                                                            name="developments_behavior12_2_1" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        2.2 ใช้ประโยคคำถามว่า "เมื่อไหร่" "อย่างไร" ในการค้นหาคำตอบ
                                                        <input type="hidden" name="table_section[]" value="12_2_2" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id98" onchange="jsfuncSetState('id98')"
                                                            name="developments_behavior12_2_2" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        2.3 เชื่อมโยงความรู้และทักษะต่างๆใช้ในชีวิตประจำวัน
                                                        <input type="hidden" name="table_section[]" value="12_2_3" />
                                                    </td>
                                                    <td>
                                                        <select class="form-select" aria-label="Default select example"
                                                            id="id99" onchange="jsfuncSetState('id99')"
                                                            name="developments_behavior12_2_3" required
                                                            data-parsley-required-message="ยังไม่ได้ประเมิน">
                                                            <option value="" selected disabled>-- พัฒนาการ --
                                                            </option>
                                                            <option value="1">ควรเสริม</option>
                                                            <option value="2">ปานกลาง</option>
                                                            <option value="3">ดี</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <input type="hidden" name="table_no" value="9" />
                                        <button type="submit" class="btn btn-success float-end">บันทึก</button>
                                    </form>
                                </div>{{-- ปิด-pills-9 --}}

                                <div class="tab-pane fade" id="pills-10" role="tabpanel"
                                    aria-labelledby="pills-10-tab">
                                    <form action="{{ url('teacher/record/appraisal/store/' . $student->student_id) }}"
                                        method="post" class="employee-form">
                                        @csrf
                                        <div class="row justify-content-center align-items-center g-2 mb-3">
                                            <div class="col">
                                                <label for="exampleFormControlTextarea1"
                                                    class="form-label">ความคิดเห็นของครูประจำชั้น</label>
                                            </div>
                                            <div class="col">
                                                <select class="form-select float-end"
                                                    aria-label="Default select example" name="semester" required
                                                    required data-parsley-required-message="กรุณาเลือกภาคเรียน"
                                                    onChange="selectSemester('table10', event)" style="width: 200px;">
                                                    <option selected disabled>-- ภาคเรียนที่ --</option>
                                                    @if ($check_table_semester1 == false && $check_table_semester2 == false)
                                                        <option value="ภาคเรียน1">ภาคเรียน 1</option>
                                                    @endif
                                                    @if ($check_table_semester1 == true && $check_table_semester2 == false)
                                                        <option value="ภาคเรียน2">ภาคเรียน 2</option>
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row justify-content-center align-items-center g-2 mb-3">
                                            <div class="row justify-content-center align-items-center g-2 mb-3">
                                                <div class="col">

                                                    <textarea name="commenteacher" id="editor" rows="3"></textarea> {{-- {{ old('description',$data->p_description) }} --}}

                                                </div>
                                            </div>
                                        </div>
                                        <input type="hidden" name="table_no" value="10" />
                                        <button type="submit" class="btn btn-success float-end">บันทึก</button>
                                    </form>
                                </div>{{-- ปิด-pills-10 --}}
                            </div>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection

@section('script')
    <script>
        let data1_1 = {!! $table1_semester1 !!};
        let data1_2 = {!! $table1_semester2 !!};
        let data2_1 = {!! $table2_semester1 !!};
        let data2_2 = {!! $table2_semester2 !!};
        let data3_1 = {!! $table3_semester1 !!};
        let data3_2 = {!! $table3_semester2 !!};
        let data4_1 = {!! $table4_semester1 !!};
        let data4_2 = {!! $table4_semester2 !!};
        let data5_1 = {!! $table5_semester1 !!};
        let data5_2 = {!! $table5_semester2 !!};
        let data6_1 = {!! $table6_semester1 !!};
        let data6_2 = {!! $table6_semester2 !!};
        let data7_1 = {!! $table7_semester1 !!};
        let data7_2 = {!! $table7_semester2 !!};
        let data8_1 = {!! $table8_semester1 !!};
        let data8_2 = {!! $table8_semester2 !!};
        let data9_1 = {!! $table9_semester1 !!};
        let data9_2 = {!! $table9_semester2 !!};
        let data10_1 = {!! $table10_semester1 !!};
        let data10_2 = {!! $table10_semester2 !!};

        let dataList = [
            [data1_1,
                data2_1,
                data3_1,
                data4_1,
                data5_1,
                data6_1,
                data7_1,
                data8_1,
                data9_1,
                data10_1
            ],
            [
                data1_2,
                data2_2,
                data3_2,
                data4_2,
                data5_2,
                data6_2,
                data7_2,
                data8_2,
                data9_2,
                data10_2
            ]
        ]

        $(document).ready(function() {
            if ("{{ $check_table_semester1 }}" == false && "{{ $check_table_semester2 }}" == false) {

                if (data1_1.length == 11) {

                    $('#pills-1-tab').addClass('have-data');
                } else {
                    console.log(data1_1.length);
                    $('#pills-1-tab').removeClass('have-data');
                }

                if (data2_1.length == 9) {
                    $('#pills-2-tab').addClass('have-data');
                } else {
                    $('#pills-2-tab').removeClass('have-data');
                }

                if (data3_1.length == 10) {
                    $('#pills-3-tab').addClass('have-data');
                } else {
                    $('#pills-3-tab').removeClass('have-data');
                }

                if (data4_1.length == 9) {
                    $('#pills-4-tab').addClass('have-data');
                } else {
                    $('#pills-4-tab').removeClass('have-data');
                }

                if (data5_1.length == 9) {
                    $('#pills-5-tab').addClass('have-data');
                } else {
                    $('#pills-5-tab').removeClass('have-data');
                }

                if (data6_1.length == 8) {
                    $('#pills-6-tab').addClass('have-data');
                } else {
                    $('#pills-6-tab').removeClass('have-data');
                }

                if (data7_1.length == 15) {
                    $('#pills-7-tab').addClass('have-data');
                } else {
                    $('#pills-7-tab').removeClass('have-data');
                }

                if (data8_1.length == 18) {
                    $('#pills-8-tab').addClass('have-data');
                } else {
                    $('#pills-8-tab').removeClass('have-data');
                }

                if (data9_1.length == 10) {
                    $('#pills-9-tab').addClass('have-data');
                } else {
                    $('#pills-9-tab').removeClass('have-data');
                }

                if (data10_1.length > 0) {
                    $('#pills-10-tab').addClass('have-data');
                } else {
                    $('#pills-10-tab').removeClass('have-data');
                }
            }

            if ("{{ $check_table_semester1 }}" == true && "{{ $check_table_semester2 }}" == false) {
                console.log(data1_2.length);
                if (data1_2.length == 11) {
                    $('#pills-1-tab').addClass('have-data');
                } else {
                    $('#pills-1-tab').removeClass('have-data');
                }

                if (data2_2.length == 9) {
                    $('#pills-2-tab').addClass('have-data');
                } else {
                    $('#pills-2-tab').removeClass('have-data');
                }

                if (data3_2.length == 10) {
                    $('#pills-3-tab').addClass('have-data');
                } else {
                    $('#pills-3-tab').removeClass('have-data');
                }

                if (data4_2.length == 9) {
                    $('#pills-4-tab').addClass('have-data');
                } else {
                    $('#pills-4-tab').removeClass('have-data');
                }

                if (data5_2.length == 9) {
                    $('#pills-5-tab').addClass('have-data');
                } else {
                    $('#pills-5-tab').removeClass('have-data');
                }

                if (data6_2.length == 8) {
                    $('#pills-6-tab').addClass('have-data');
                } else {
                    $('#pills-6-tab').removeClass('have-data');
                }

                if (data7_2.length == 15) {
                    $('#pills-7-tab').addClass('have-data');
                } else {
                    $('#pills-7-tab').removeClass('have-data');
                }

                if (data8_2.length == 18) {
                    $('#pills-8-tab').addClass('have-data');
                } else {
                    $('#pills-8-tab').removeClass('have-data');
                }

                if (data9_2.length == 10) {
                    $('#pills-9-tab').addClass('have-data');
                } else {
                    $('#pills-9-tab').removeClass('have-data');
                }

                if (data10_2.length > 0) {
                    $('#pills-10-tab').addClass('have-data');
                } else {
                    $('#pills-10-tab').removeClass('have-data');
                }
            }
        });

        function jsfuncSetState(value) {
            document.getElementById(value).setAttribute("style", "color:MediumSeaGreen ")
        }

        let theEditor;
        ClassicEditor
            .create(document.querySelector('#editor'), {

                ckfinder: {
                    uploadUrl: '{{ route('behavior.upload') . '?_token=' . csrf_token() }}',
                }
            })
            .then(editor => {
                console.log(editor);
                theEditor = editor;
            })
            .catch(error => {
                console.error(error);
            });


        function selectSemester(table, event) {
            let semester = event && event.target && event.target.value ? event.target.value : '';
            console.log('semester: ', semester);

            if (semester === 'ภาคเรียน2') {
                dataList[0].forEach((v, index) => (index += 1, $(`#pills-${index}-tab`).removeClass('have-data')));
                dataList[1].forEach((v, index) => (index += 1, v.length > 0 && $(`#pills-${index}-tab`).addClass(
                    'have-data')));
            }

            if (table === 'table1') {
                setScore(semester, data1_1, data1_2, 'semester1', 'score_rate_physically');
            } else if (table === 'table2') {
                setScore(semester, data2_1, data2_2, 'semester2', 'score_rate_physically');

            } else if (table === 'table3') {
                setScore(semester, data3_1, data3_2, 'semester3', 'score_rate_mood_mind');
            } else if (table === 'table4') {
                setScore(semester, data4_1, data4_2, 'semester4', 'score_rate_mood_mind');
            } else if (table === 'table5') {
                setScore(semester, data5_1, data5_2, 'semester5', 'score_rate_social');
            } else if (table === 'table6') {
                setScore(semester, data6_1, data6_2, 'semester6', 'score_rate_social');
            } else if (table === 'table7') {
                setScore(semester, data7_1, data7_2, 'semester7', 'score_rate_social');
            } else if (table === 'table8') {
                setScore(semester, data8_1, data8_2, 'semester8', 'score_rate_intellectual');
            } else if (table === 'table9') {
                setScore(semester, data9_1, data9_2, 'semester9', 'score_rate_intellectual');
            } else if (table === 'table10') {
                if (semester && semester === 'ภาคเรียน1') {
                    if (data10_1.length > 0) {
                        data10_1.forEach(element => {
                            theEditor.setData(element['comment_teacher']);
                        });
                    } else {

                        theEditor.setData('');
                    }

                } else if (semester && semester === 'ภาคเรียน2') {
                    console.log('element', data10_2);
                    if (data10_2.length > 0) {
                        data10_2.forEach(element => {
                            theEditor.setData(element['comment_teacher']);
                        });

                    } else {
                        theEditor.setData('');
                    }

                }
            }
        }

        function setScore(semester, data1, data2, semesterText, scoreText) {
            
            if (semester && semester === 'ภาคเรียน1') {
                if (data1.length > 0) {
                    data1.forEach(element => {
                        document.getElementsByName('developments_behavior' + element.table_section)[0].value =
                            element[`${scoreText}`]
                    });
                } else {
                    $(`tbody.${semesterText}`).find("select").val('');
                }

            } else if (semester && semester === 'ภาคเรียน2') {
                if (data2.length > 0) {

                    $(`tbody.${semesterText}`).find("select").val('');
                    data2.forEach(element => {
                        document.getElementsByName('developments_behavior' + element.table_section)[0].value =
                            element[`${scoreText}`]
                    });
                } else {
                    $(`tbody.${semesterText}`).find("select").val('');
                }

            }
        }
        $('.employee-form').parsley();
    </script>
@endsection
