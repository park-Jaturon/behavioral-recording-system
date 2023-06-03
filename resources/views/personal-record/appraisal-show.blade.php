@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row  my-2">
            {{-- @dd(isset($dataphysicallysemester1)) --}}
            <div class="col-3 text-end">
                @if (isset($datasemester1) && isset($datasemester2))
                    <a name="" id="" class="btn btn-primary" href="{{ url('teacher/pdf/' . $student_id) }}"
                        role="button"><i class="bi bi-file-earmark-pdf"></i>ดู</a>
                    <a name="" id="" class="btn btn-primary"
                        href="{{ url('teacher/pdf/download/' . $student_id) }}" role="button"><i
                            class="bi bi-file-earmark-pdf"></i> ดาวน์โหลด</a>
                @else
                    <a href="#" class="btn btn-primary disabled" tabindex="-1" role="button" aria-disabled="true"><i
                            class="bi bi-file-earmark-pdf"></i>ดู</a>
                    <a href="#" class="btn btn-primary disabled" tabindex="-1" role="button" aria-disabled="true"><i
                            class="bi bi-file-earmark-pdf"></i> ดาวน์โหลด</a>
                @endif
            </div>
        </div>

        <div class="row justify-content-between">
            <div class="col-md-8">
                <div class="card text-start">
                    <div class="card-header">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <!-- พัฒนาการด้านร่างกาย -->
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#home">พัฒนาการด้านร่างกาย</a>
                            </li>
                            <!-- พัฒนาการด้านอารมณ์และจิตใจ -->
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#menu1">พัฒนาการด้านอารมณ์และจิตใจ</a>
                            </li>
                            <!-- พัฒนาการด้านสังคม -->
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#menu2">พัฒนาการด้านสังคม</a>
                            </li>
                            <!-- พัฒนาการด้านสติปัญญา -->
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#menu3">พัฒนาการด้านสติปัญญา</a>
                            </li>
                            <!-- ความเห็นของครู -->
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#menu4">ความเห็นของครู</a>
                            </li>
                            <!-- สรุปผลการประเมิน -->
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#menu5">สรุปผลการประเมิน</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <!-- พัฒนาการด้านร่างกาย -->
                            <div id="home" class="container tab-pane active"><br>
                                <table class="table table-bordered border-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col" class=" text-center" valign="middle">พัฒนาการ</th>
                                            <th scope="col" class=" text-center" valign="middle" width="150px">ตัวบ่งชี้
                                            </th>
                                            <th scope="col" class=" text-center" valign="middle">พฤติกรรม</th>
                                            <th scope="col" class=" text-center" valign="middle" width="170px">
                                                ภาคเรียน1
                                            </th>
                                            <th scope="col" class=" text-center" valign="middle" width="170px">
                                                ภาคเรียน2
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
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester1[0]->score_rate_physically))
                                                @elseif ($dataphysicallysemester1[0]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text" value="ควรเสริม"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @elseif ($dataphysicallysemester1[0]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text" value="ปานกลาง"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @elseif ($dataphysicallysemester1[0]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester1[0]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester2[0]->score_rate_physically))
                                                @elseif ($dataphysicallysemester2[0]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[0]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[0]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester2[0]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                1.2 ส่วนสูงตามเกณฑ์อายุของกรมอนามัย
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester1[1]->score_rate_physically))
                                                @elseif ($dataphysicallysemester1[1]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester1[1]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester1[1]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester1[1]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester2[1]->score_rate_physically))
                                                @elseif ($dataphysicallysemester2[1]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[1]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[1]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester2[1]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                1.3 เส้นรอบศีรษะตามเกณฑ์อายุ
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester1[2]->score_rate_physically))
                                                @elseif ($dataphysicallysemester1[2]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester1[2]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester1[2]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester1[2]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester2[2]->score_rate_physically))
                                                @elseif ($dataphysicallysemester2[2]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[2]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[2]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester2[2]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="6">
                                                2.มีสุขภาพอนามัยสุขนิสัยที่ดี
                                            </td>
                                            <td>
                                                2.1 รับประทานอาหารที่มีประโยชน์และดื่มน้ำสะอาดได้ด้วยตนเอง
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester1[3]->score_rate_physically))
                                                @elseif ($dataphysicallysemester1[3]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester1[3]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester1[3]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester1[3]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester2[3]->score_rate_physically))
                                                @elseif ($dataphysicallysemester2[3]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[3]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[3]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester2[3]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                2.2 ล้างมือก่อนรับประทานอาหารและหลังใช้ห้องส้วมได้ด้วยตนเอง
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester1[4]->score_rate_physically))
                                                @elseif ($dataphysicallysemester1[4]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester1[4]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester1[4]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester1[4]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester2[4]->score_rate_physically))
                                                @elseif ($dataphysicallysemester2[4]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[4]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[4]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester2[4]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                2.3 นอนพักผ่อนเป็นเวลา
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester1[5]->score_rate_physically))
                                                @elseif ($dataphysicallysemester1[5]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester1[5]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester1[5]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester1[5]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester2[5]->score_rate_physically))
                                                @elseif ($dataphysicallysemester2[5]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[5]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[5]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester2[5]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                2.4 ออกกำลังกายเป็นเวลา
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester1[6]->score_rate_physically))
                                                @elseif ($dataphysicallysemester1[6]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester1[6]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester1[6]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester1[6]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester2[6]->score_rate_physically))
                                                @elseif ($dataphysicallysemester2[6]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[6]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[6]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester2[6]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                2.5 อาบน้ำแต่ตัวได้แต่ไม่คล่อง
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester1[7]->score_rate_physically))
                                                @elseif ($dataphysicallysemester1[7]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester1[7]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester1[7]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester1[7]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester2[7]->score_rate_physically))
                                                @elseif ($dataphysicallysemester2[7]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[7]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[7]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester2[7]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                2.6 ขับถ่ายเป็นเวลา
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester1[8]->score_rate_physically))
                                                @elseif ($dataphysicallysemester1[8]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester1[8]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester1[8]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester1[8]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester2[8]->score_rate_physically))
                                                @elseif ($dataphysicallysemester2[8]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[8]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[8]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester2[8]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2">
                                                3.รักษาความปลอดภัยของตนเองและผู้อื่น
                                            </td>
                                            <td>
                                                3.1 เล่นและทำกิจกรรมอย่างปลอดภัยได้ด้วยตนเอง
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester1[9]->score_rate_physically))
                                                @elseif ($dataphysicallysemester1[9]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester1[9]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester1[9]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester1[9]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester2[9]->score_rate_physically))
                                                @elseif ($dataphysicallysemester2[9]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[9]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[9]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester2[9]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                3.2 ระมัดระวังตนเองให้ปลอดภัยขณะเล่นได้บางครั้ง
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester1[10]->score_rate_physically))
                                                @elseif ($dataphysicallysemester1[10]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester1[10]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester1[10]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester1[10]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester2[10]->score_rate_physically))
                                                @elseif ($dataphysicallysemester2[10]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[10]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[10]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester2[10]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
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
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester1[11]->score_rate_physically))
                                                @elseif ($dataphysicallysemester1[11]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester1[11]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester1[11]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester1[11]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester2[11]->score_rate_physically))
                                                @elseif ($dataphysicallysemester2[11]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[11]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[11]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester2[11]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                1.2 กระโดดขาเดียวไปอยู่กับที่ได้โดยไม่เสียการทรงตัว
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester1[12]->score_rate_physically))
                                                @elseif ($dataphysicallysemester1[12]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester1[12]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester1[12]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester1[12]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester2[12]->score_rate_physically))
                                                @elseif ($dataphysicallysemester2[12]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[12]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[12]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester2[12]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                1.3 วิ่งหลบหลีกสิ่งกีดขวางได้
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester1[13]->score_rate_physically))
                                                @elseif ($dataphysicallysemester1[13]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester1[13]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester1[13]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester1[13]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester2[13]->score_rate_physically))
                                                @elseif ($dataphysicallysemester2[13]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[13]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[13]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester2[13]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                1.4 รับลูกบอลโดยใช้มือทั้ง 2 ข้าง
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester1[14]->score_rate_physically))
                                                @elseif ($dataphysicallysemester1[14]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester1[14]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester1[14]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester1[14]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester2[14]->score_rate_physically))
                                                @elseif ($dataphysicallysemester2[14]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[14]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[14]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester2[14]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                1.5 เดินลงบันไดสลับเท้าได้
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester1[15]->score_rate_physically))
                                                @elseif ($dataphysicallysemester1[15]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester1[15]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester1[15]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester1[15]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester2[15]->score_rate_physically))
                                                @elseif ($dataphysicallysemester2[15]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[15]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[15]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester2[15]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="4">
                                                2.ใช้มือ-ตาประสาทสัมพันธ์กัน
                                            </td>
                                            <td>
                                                2.1 ใช้กรรไกกรตัดระดาษตามแนวเส้นตรงได้
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester1[16]->score_rate_physically))
                                                @elseif ($dataphysicallysemester1[16]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester1[16]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester1[16]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester1[16]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester2[16]->score_rate_physically))
                                                @elseif ($dataphysicallysemester2[16]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[16]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[16]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester2[16]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                2.2 เขียนรูปสี่เหลียมตามได้อย่างมีมุมชัดเจน
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester1[17]->score_rate_physically))
                                                @elseif ($dataphysicallysemester1[17]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester1[17]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester1[17]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester1[17]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester2[17]->score_rate_physically))
                                                @elseif ($dataphysicallysemester2[17]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[17]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[17]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester2[17]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                2.3 ร้อยวัสดุที่มีรูขนาดเส้นผ่าศูนย์กลาง 0.5 เซนติเมตรได้
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester1[18]->score_rate_physically))
                                                @elseif ($dataphysicallysemester1[18]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester1[18]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester1[18]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester1[18]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester2[18]->score_rate_physically))
                                                @elseif ($dataphysicallysemester2[18]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[18]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[18]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester2[18]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                2.4 โยนลูกบอลไปข้างหน้าได้ไม่คล่องแคล่ว
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester1[19]->score_rate_physically))
                                                @elseif ($dataphysicallysemester1[19]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester1[19]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester1[19]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester1[19]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataphysicallysemester2[19]->score_rate_physically))
                                                @elseif ($dataphysicallysemester2[19]->score_rate_physically == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[19]->score_rate_physically == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataphysicallysemester2[19]->score_rate_physically == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($dataphysicallysemester2[19]->score_rate_physically))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- พัฒนาการด้านอารมณ์และจิตใจ -->
                            <div id="menu1" class="container tab-pane fade"><br>
                                <table class="table table-bordered border-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col" class=" text-center" valign="middle">พัฒนาการ</th>
                                            <th scope="col" class=" text-center" valign="middle">ตัวบ่งชี้</th>
                                            <th scope="col" class=" text-center" valign="middle">พฤติกรรม</th>
                                            <th scope="col" class=" text-center" valign="middle" width="170px">
                                                ภาคเรียน1
                                            </th>
                                            <th scope="col" class=" text-center" valign="middle" width="170px">
                                                ภาคเรียน2
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
                                            <td valign="middle">
                                                @if (!isset($datamood_mindsemester1[0]->score_rate_mood_mind))
                                                @elseif ($datamood_mindsemester1[0]->score_rate_mood_mind == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester1[0]->score_rate_mood_mind == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester1[0]->score_rate_mood_mind == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($datamood_mindsemester1[0]->score_rate_mood_mind))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datamood_mindsemester2[0]->score_rate_mood_mind))
                                                @elseif ($datamood_mindsemester2[0]->score_rate_mood_mind == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester2[0]->score_rate_mood_mind == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester2[0]->score_rate_mood_mind == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($datamood_mindsemester2[0]->score_rate_mood_mind))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                1.2 ร่าเริง สดชื่น แจ่มใส และอารมณ์ดี
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datamood_mindsemester1[1]->score_rate_mood_mind))
                                                @elseif ($datamood_mindsemester1[1]->score_rate_mood_mind == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester1[1]->score_rate_mood_mind == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester1[1]->score_rate_mood_mind == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($datamood_mindsemester1[1]->score_rate_mood_mind))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datamood_mindsemester2[1]->score_rate_mood_mind))
                                                @elseif ($datamood_mindsemester2[1]->score_rate_mood_mind == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester2[1]->score_rate_mood_mind == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester2[1]->score_rate_mood_mind == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($datamood_mindsemester2[1]->score_rate_mood_mind))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="4">
                                                2.มีความรู้สึกดีต่อตนเองและผู้อื่น
                                            </td>
                                            <td>
                                                2.1 กล้าพูด กล้าแสดงออกอย่างเหมาะสมบางสถานการณ์
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datamood_mindsemester1[2]->score_rate_mood_mind))
                                                @elseif ($datamood_mindsemester1[2]->score_rate_mood_mind == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester1[2]->score_rate_mood_mind == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester1[2]->score_rate_mood_mind == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($datamood_mindsemester1[2]->score_rate_mood_mind))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datamood_mindsemester2[2]->score_rate_mood_mind))
                                                @elseif ($datamood_mindsemester2[2]->score_rate_mood_mind == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester2[2]->score_rate_mood_mind == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester2[2]->score_rate_mood_mind == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($datamood_mindsemester2[2]->score_rate_mood_mind))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                2.2 แสดงความพอใจในผลงานและความสามารถจองตนเอง
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datamood_mindsemester1[3]->score_rate_mood_mind))
                                                @elseif ($datamood_mindsemester1[3]->score_rate_mood_mind == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester1[3]->score_rate_mood_mind == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester1[3]->score_rate_mood_mind == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($datamood_mindsemester1[3]->score_rate_mood_mind))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datamood_mindsemester2[3]->score_rate_mood_mind))
                                                @elseif ($datamood_mindsemester2[3]->score_rate_mood_mind == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester2[3]->score_rate_mood_mind == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester2[3]->score_rate_mood_mind == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($datamood_mindsemester2[3]->score_rate_mood_mind))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                2.3 มีความมั่นใจในตนเอง
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datamood_mindsemester1[4]->score_rate_mood_mind))
                                                @elseif ($datamood_mindsemester1[4]->score_rate_mood_mind == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester1[4]->score_rate_mood_mind == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester1[4]->score_rate_mood_mind == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($datamood_mindsemester1[4]->score_rate_mood_mind))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datamood_mindsemester2[4]->score_rate_mood_mind))
                                                @elseif ($datamood_mindsemester2[4]->score_rate_mood_mind == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester2[4]->score_rate_mood_mind == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester2[4]->score_rate_mood_mind == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($datamood_mindsemester2[4]->score_rate_mood_mind))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                2.4 รับรู้ความรู้สึกผู้อื่นและปลอบโยนเมื่อผู้อื่นเสียใจ
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datamood_mindsemester1[5]->score_rate_mood_mind))
                                                @elseif ($datamood_mindsemester1[5]->score_rate_mood_mind == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester1[5]->score_rate_mood_mind == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester1[5]->score_rate_mood_mind == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($datamood_mindsemester1[5]->score_rate_mood_mind))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน" aria-label="Disabled input example"
                                                        disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datamood_mindsemester2[5]->score_rate_mood_mind))
                                                @elseif ($datamood_mindsemester2[5]->score_rate_mood_mind == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester2[5]->score_rate_mood_mind == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester2[5]->score_rate_mood_mind == 3)
                                                    <input class="form-control text-center" type="text" value="ดี"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                                @if (empty($datamood_mindsemester2[5]->score_rate_mood_mind))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
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
                                            <td valign="middle">
                                                @if (!isset($datamood_mindsemester1[6]->score_rate_mood_mind))
                                                @elseif ($datamood_mindsemester1[6]->score_rate_mood_mind == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester1[6]->score_rate_mood_mind == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester1[6]->score_rate_mood_mind == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datamood_mindsemester1[6]->score_rate_mood_mind))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datamood_mindsemester2[6]->score_rate_mood_mind))
                                                @elseif ($datamood_mindsemester2[6]->score_rate_mood_mind == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester2[6]->score_rate_mood_mind == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester2[6]->score_rate_mood_mind == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datamood_mindsemester2[6]->score_rate_mood_mind))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                1.2 สนใจ มีความสุขและแสดงออกผ่านเสียงเลงดนตรี
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datamood_mindsemester1[7]->score_rate_mood_mind))
                                                @elseif ($datamood_mindsemester1[7]->score_rate_mood_mind == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester1[7]->score_rate_mood_mind == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester1[7]->score_rate_mood_mind == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datamood_mindsemester1[7]->score_rate_mood_mind))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datamood_mindsemester2[7]->score_rate_mood_mind))
                                                @elseif ($datamood_mindsemester2[7]->score_rate_mood_mind == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester2[7]->score_rate_mood_mind == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester2[7]->score_rate_mood_mind == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datamood_mindsemester2[7]->score_rate_mood_mind))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                1.3 สนใจ มีความสุขและแสดงท่าทาง/เคลื่อนไหวประกอบเลงจังหวะและดนตรี
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datamood_mindsemester1[8]->score_rate_mood_mind))
                                                @elseif ($datamood_mindsemester1[8]->score_rate_mood_mind == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester1[8]->score_rate_mood_mind == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester1[8]->score_rate_mood_mind == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datamood_mindsemester1[8]->score_rate_mood_mind))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datamood_mindsemester2[8]->score_rate_mood_mind))
                                                @elseif ($datamood_mindsemester2[8]->score_rate_mood_mind == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester2[8]->score_rate_mood_mind == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester2[8]->score_rate_mood_mind == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datamood_mindsemester2[8]->score_rate_mood_mind))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                1.4สนใจแล้วมีความสุขขณะทำงานศิลปะ
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datamood_mindsemester1[9]->score_rate_mood_mind))
                                                @elseif ($datamood_mindsemester1[9]->score_rate_mood_mind == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester1[9]->score_rate_mood_mind == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester1[9]->score_rate_mood_mind == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datamood_mindsemester1[9]->score_rate_mood_mind))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datamood_mindsemester2[9]->score_rate_mood_mind))
                                                @elseif ($datamood_mindsemester2[9]->score_rate_mood_mind == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester2[9]->score_rate_mood_mind == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester2[9]->score_rate_mood_mind == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datamood_mindsemester2[9]->score_rate_mood_mind))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
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
                                            <td valign="middle">
                                                @if (!isset($datamood_mindsemester1[10]->score_rate_mood_mind))
                                                @elseif ($datamood_mindsemester1[10]->score_rate_mood_mind == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester1[10]->score_rate_mood_mind == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester1[10]->score_rate_mood_mind == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datamood_mindsemester1[10]->score_rate_mood_mind))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datamood_mindsemester2[10]->score_rate_mood_mind))
                                                @elseif ($datamood_mindsemester2[10]->score_rate_mood_mind == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester2[10]->score_rate_mood_mind == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester2[10]->score_rate_mood_mind == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datamood_mindsemester2[10]->score_rate_mood_mind))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                1.2 รู้จักขอโทษเมื่อมีผู้ชี้เนะ
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datamood_mindsemester1[11]->score_rate_mood_mind))
                                                @elseif ($datamood_mindsemester1[11]->score_rate_mood_mind == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester1[11]->score_rate_mood_mind == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester1[11]->score_rate_mood_mind == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datamood_mindsemester1[11]->score_rate_mood_mind))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datamood_mindsemester2[11]->score_rate_mood_mind))
                                                @elseif ($datamood_mindsemester2[11]->score_rate_mood_mind == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester2[11]->score_rate_mood_mind == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester2[11]->score_rate_mood_mind == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datamood_mindsemester2[11]->score_rate_mood_mind))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="3">
                                                2.มีความเมตากรุณา มีน้ำำใจ และช่วยเหลือแบ่งปัน
                                            </td>
                                            <td>
                                                2.1 แสดงความรักต่อเพื่อนและมีเมตตาต่อสัตว์เลี้ยง
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datamood_mindsemester1[12]->score_rate_mood_mind))
                                                @elseif ($datamood_mindsemester1[12]->score_rate_mood_mind == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester1[12]->score_rate_mood_mind == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester1[12]->score_rate_mood_mind == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datamood_mindsemester1[12]->score_rate_mood_mind))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datamood_mindsemester2[12]->score_rate_mood_mind))
                                                @elseif ($datamood_mindsemester2[12]->score_rate_mood_mind == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester2[12]->score_rate_mood_mind == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester2[12]->score_rate_mood_mind == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datamood_mindsemester2[12]->score_rate_mood_mind))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                2.2 ช่วยเหลือผู้อื่นได้เมื่อมีผู้ชี้เนะ
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datamood_mindsemester1[13]->score_rate_mood_mind))
                                                @elseif ($datamood_mindsemester1[13]->score_rate_mood_mind == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester1[13]->score_rate_mood_mind == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester1[13]->score_rate_mood_mind == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datamood_mindsemester1[13]->score_rate_mood_mind))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datamood_mindsemester2[13]->score_rate_mood_mind))
                                                @elseif ($datamood_mindsemester2[13]->score_rate_mood_mind == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester2[13]->score_rate_mood_mind == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester2[13]->score_rate_mood_mind == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datamood_mindsemester2[13]->score_rate_mood_mind))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                2.3 มีจิตสาธารณะ
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datamood_mindsemester1[14]->score_rate_mood_mind))
                                                @elseif ($datamood_mindsemester1[14]->score_rate_mood_mind == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester1[14]->score_rate_mood_mind == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester1[14]->score_rate_mood_mind == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datamood_mindsemester1[14]->score_rate_mood_mind))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datamood_mindsemester2[14]->score_rate_mood_mind))
                                                @elseif ($datamood_mindsemester2[14]->score_rate_mood_mind == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester2[14]->score_rate_mood_mind == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester2[14]->score_rate_mood_mind == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datamood_mindsemester2[14]->score_rate_mood_mind))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2">
                                                3.มีความเห็นอกเห็นใจผู้อื่น
                                            </td>
                                            <td>
                                                3.1 แสดงสีหน้าท่าทางรับรู้ความรู้สิกของผู้อื่น
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datamood_mindsemester1[15]->score_rate_mood_mind))
                                                @elseif ($datamood_mindsemester1[15]->score_rate_mood_mind == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester1[15]->score_rate_mood_mind == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester1[15]->score_rate_mood_mind == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datamood_mindsemester1[15]->score_rate_mood_mind))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datamood_mindsemester2[15]->score_rate_mood_mind))
                                                @elseif ($datamood_mindsemester2[15]->score_rate_mood_mind == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester2[15]->score_rate_mood_mind == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester2[15]->score_rate_mood_mind == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datamood_mindsemester2[15]->score_rate_mood_mind))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                3.2 รับรู้ความรู้ศึกผู้อื่นและปลอบโยนเมื่อผู้อื่นเสียใจ
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datamood_mindsemester1[16]->score_rate_mood_mind))
                                                @elseif ($datamood_mindsemester1[16]->score_rate_mood_mind == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester1[16]->score_rate_mood_mind == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester1[16]->score_rate_mood_mind == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datamood_mindsemester1[16]->score_rate_mood_mind))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datamood_mindsemester2[16]->score_rate_mood_mind))
                                                @elseif ($datamood_mindsemester2[16]->score_rate_mood_mind == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester2[16]->score_rate_mood_mind == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester2[16]->score_rate_mood_mind == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datamood_mindsemester2[16]->score_rate_mood_mind))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2">
                                                4.มีความรับผิดชอบ
                                            </td>
                                            <td>
                                                4.1 ทำงานที่ได้รับมอบหมายจนสำเร็จเมื่อมีผู้ชี้เนะ
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datamood_mindsemester1[17]->score_rate_mood_mind))
                                                @elseif ($datamood_mindsemester1[17]->score_rate_mood_mind == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester1[17]->score_rate_mood_mind == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester1[17]->score_rate_mood_mind == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datamood_mindsemester1[17]->score_rate_mood_mind))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datamood_mindsemester2[17]->score_rate_mood_mind))
                                                @elseif ($datamood_mindsemester2[17]->score_rate_mood_mind == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester2[17]->score_rate_mood_mind == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester2[17]->score_rate_mood_mind == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datamood_mindsemester2[17]->score_rate_mood_mind))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                4.2 รักษาสิงของที่ใช้ร่วมกัน
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datamood_mindsemester1[18]->score_rate_mood_mind))
                                                @elseif ($datamood_mindsemester1[18]->score_rate_mood_mind == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester1[18]->score_rate_mood_mind == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester1[18]->score_rate_mood_mind == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datamood_mindsemester1[18]->score_rate_mood_mind))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datamood_mindsemester2[18]->score_rate_mood_mind))
                                                @elseif ($datamood_mindsemester2[18]->score_rate_mood_mind == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester2[18]->score_rate_mood_mind == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datamood_mindsemester2[18]->score_rate_mood_mind == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datamood_mindsemester2[18]->score_rate_mood_mind))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- พัฒนาการด้านสังคม -->
                            <div id="menu2" class="container tab-pane fade"><br>
                                <table class="table table-bordered border-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col" class=" text-center" valign="middle">พัฒนาการ</th>
                                            <th scope="col" class=" text-center" valign="middle">ตัวบ่งชี้</th>
                                            <th scope="col" class=" text-center" valign="middle">พฤติกรรม</th>
                                            <th scope="col" class=" text-center" valign="middle" width="170px">
                                                ภาคเรียน1
                                            </th>
                                            <th scope="col" class=" text-center" valign="middle" width="170px">
                                                ภาคเรียน2
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
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester1[0]->score_rate_social))
                                                @elseif ($datasocialsemester1[0]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[0]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[0]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester1[0]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester2[0]->score_rate_social))
                                                @elseif ($datasocialsemester2[0]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[0]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[0]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester2[0]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                1.2 รับประทานอาหารด้วนตนเอง
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester1[1]->score_rate_social))
                                                @elseif ($datasocialsemester1[1]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[1]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[1]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester1[1]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester2[1]->score_rate_social))
                                                @elseif ($datasocialsemester2[1]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[1]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[1]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester2[1]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                1.3 ใช้ห้องน้ำ ห้องส้วมด้วยตนเอง
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester1[2]->score_rate_social))
                                                @elseif ($datasocialsemester1[2]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[2]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[2]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester1[2]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester2[2]->score_rate_social))
                                                @elseif ($datasocialsemester2[2]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[2]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[2]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester2[2]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                1.4 ระมัดระวังดูแลตนเองและผู้อื่นให้ปลอดภัยโดยมีผู้อื่นคอยตักเตือนบ้าง
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester1[3]->score_rate_social))
                                                @elseif ($datasocialsemester1[3]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[3]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[3]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester1[3]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester2[3]->score_rate_social))
                                                @elseif ($datasocialsemester2[3]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[3]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[3]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester2[3]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="3">
                                                2.มีวินัยในตนเอง
                                            </td>
                                            <td>
                                                2.1 เก็บของเล่น ของใช้เข้าที่ด้วยตนเอง
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester1[4]->score_rate_social))
                                                @elseif ($datasocialsemester1[4]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[4]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[4]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester1[4]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester2[4]->score_rate_social))
                                                @elseif ($datasocialsemester2[4]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[4]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[4]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester2[4]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                2.2 เข้าแถวตามลำดับกก่อน-หลัง ได้ด้วยตนเอง
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester1[5]->score_rate_social))
                                                @elseif ($datasocialsemester1[5]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[5]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[5]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester1[5]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester2[5]->score_rate_social))
                                                @elseif ($datasocialsemester2[5]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[5]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[5]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester2[5]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                2.3 ทึ้งขยะเป็นที่ได้แต่ไม่เรียบร้อย
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester1[6]->score_rate_social))
                                                @elseif ($datasocialsemester1[6]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[6]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[6]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester1[6]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester2[6]->score_rate_social))
                                                @elseif ($datasocialsemester2[6]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[6]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[6]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester2[6]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2">
                                                3.ประหยัดพอเพียง
                                            </td>
                                            <td>
                                                3.1 ใช้สิงของเครื่องใช้อย่างประหยัดและพพอเพียงเมื่อมีผู้ชี้เนะ
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester1[7]->score_rate_social))
                                                @elseif ($datasocialsemester1[7]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[7]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[7]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester1[7]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester2[7]->score_rate_social))
                                                @elseif ($datasocialsemester2[7]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[7]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[7]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester2[7]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                3.2 รักกษาสิ่งของที่ใช้ร่วมกัน
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester1[8]->score_rate_social))
                                                @elseif ($datasocialsemester1[8]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[8]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[8]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester1[8]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester2[8]->score_rate_social))
                                                @elseif ($datasocialsemester2[8]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[8]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[8]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester2[8]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
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
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester1[9]->score_rate_social))
                                                @elseif ($datasocialsemester1[9]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[9]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[9]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester1[9]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester2[9]->score_rate_social))
                                                @elseif ($datasocialsemester2[9]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[9]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[9]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester2[9]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                1.2 ทิ้งขยะได้ถูกที่
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester1[10]->score_rate_social))
                                                @elseif ($datasocialsemester1[10]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[10]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[10]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester1[10]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester2[10]->score_rate_social))
                                                @elseif ($datasocialsemester2[10]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[10]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[10]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester2[10]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                1.3 ปิดน้ำหลังการใช้ทันที
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester1[11]->score_rate_social))
                                                @elseif ($datasocialsemester1[11]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[11]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[11]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester1[11]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester2[11]->score_rate_social))
                                                @elseif ($datasocialsemester2[11]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[11]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[11]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester2[11]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="5">
                                                2.มีมารยาทตามวัฒนธรรมไทย และรักความเป็นไทย
                                            </td>
                                            <td>
                                                2.1 ปฎิบัติตามมารยาทไทยด้วยตนเอง
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester1[12]->score_rate_social))
                                                @elseif ($datasocialsemester1[12]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[12]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[12]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester1[12]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester2[12]->score_rate_social))
                                                @elseif ($datasocialsemester2[12]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[12]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[12]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester2[12]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                2.2 กล่าวคำขอบคุณและขอโทษด้วยตนเอง
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester1[13]->score_rate_social))
                                                @elseif ($datasocialsemester1[13]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[13]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[13]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester1[13]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester2[13]->score_rate_social))
                                                @elseif ($datasocialsemester2[13]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[13]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[13]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester2[13]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                2.3 ยืนตรงเมื่อได้ยินเสียงเพลงชาติไทยและเพลงสรรเสริญพระบารมี
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester1[14]->score_rate_social))
                                                @elseif ($datasocialsemester1[14]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[14]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[14]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester1[14]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester2[14]->score_rate_social))
                                                @elseif ($datasocialsemester2[14]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[14]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[14]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester2[14]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                2.4 มีสัมมาคารวะและมารยาทตามวัฒนธรรมไทย
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester1[15]->score_rate_social))
                                                @elseif ($datasocialsemester1[15]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[15]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[15]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester1[15]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester2[15]->score_rate_social))
                                                @elseif ($datasocialsemester2[15]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[15]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[15]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester2[15]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                2.5 รักความเป็นไทย
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester1[16]->score_rate_social))
                                                @elseif ($datasocialsemester1[16]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[16]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[16]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester1[16]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester2[16]->score_rate_social))
                                                @elseif ($datasocialsemester2[16]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[16]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[16]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester2[16]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
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
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester1[17]->score_rate_social))
                                                @elseif ($datasocialsemester1[17]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[17]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[17]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester1[17]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester2[17]->score_rate_social))
                                                @elseif ($datasocialsemester2[17]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[17]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[17]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester2[17]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                1.2 บอกความเหมืนหรือความแตกต่างระหว่างตัวเองและผู้อื่นได้
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester1[18]->score_rate_social))
                                                @elseif ($datasocialsemester1[18]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[18]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[18]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester1[18]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester2[18]->score_rate_social))
                                                @elseif ($datasocialsemester2[18]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[18]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[18]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester2[18]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                1.3 เล่นและทำกิจกรรมร่วมกับเด็กที่แตกต่างไปจากตนได้ เช่นต่างภาษา เชื้อชาติ
                                                พื้นเพทางสังคมหรือมีความบกพร่องทางร่างกาย
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester1[19]->score_rate_social))
                                                @elseif ($datasocialsemester1[19]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[19]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[19]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester1[19]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester2[19]->score_rate_social))
                                                @elseif ($datasocialsemester2[19]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[19]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[19]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester2[19]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="5">
                                                2.มีปฎิสัมพันธ์ทีดีกับผู้อื่น
                                            </td>
                                            <td>
                                                2.1 เล่นหรือทำงานร่วมกับเพื่อนเป็นกลุ่ม
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester1[20]->score_rate_social))
                                                @elseif ($datasocialsemester1[20]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[20]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[20]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester1[20]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester2[20]->score_rate_social))
                                                @elseif ($datasocialsemester2[20]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[20]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[20]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester2[20]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                2.2 ยิ้ม ทักทาย หรือพูดคุยกับผู้ใหญ่และบุคคลที่คุ้นเคยได้ด้วนตนเอง
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester1[21]->score_rate_social))
                                                @elseif ($datasocialsemester1[21]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[21]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[21]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester1[21]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester2[21]->score_rate_social))
                                                @elseif ($datasocialsemester2[21]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[21]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[21]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester2[21]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                2.3 เข้าร่วมกิจกรรมกลุ่มได้นานขึ้น
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester1[22]->score_rate_social))
                                                @elseif ($datasocialsemester1[22]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[22]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[22]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester1[22]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester2[22]->score_rate_social))
                                                @elseif ($datasocialsemester2[22]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[22]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[22]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester2[22]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                2.4 แบ่นปันกันเพื่อนและผลัดกันเล่นโดยมีผู้ใหญ่แนะนำ
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester1[23]->score_rate_social))
                                                @elseif ($datasocialsemester1[23]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[23]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[23]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester1[23]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester2[23]->score_rate_social))
                                                @elseif ($datasocialsemester2[23]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[23]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[23]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester2[23]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                2.5 ประนีประนอมแก้ไขปัญหาร่วมกับผู้อื่นได้
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester1[24]->score_rate_social))
                                                @elseif ($datasocialsemester1[24]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[24]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[24]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester1[24]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester2[24]->score_rate_social))
                                                @elseif ($datasocialsemester2[24]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[24]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[24]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester2[24]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="5">
                                                3.ปฎิบัติตนเบื้องต้นในการเป็นสมาชิกที่ดีของสังคม
                                            </td>
                                            <td>
                                                3.1 มีส่วนร่วมในการสร้างข้อตกลงและปฎิบัติตามข้อตกลงเมื่อมีผู้ชี้แนะ
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester1[25]->score_rate_social))
                                                @elseif ($datasocialsemester1[25]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[25]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[25]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester1[25]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester2[25]->score_rate_social))
                                                @elseif ($datasocialsemester2[25]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[25]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[25]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester2[25]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                3.2 ปฎิบัติตนเป็นผู้นำและผู้ตามได้ด้วนตนเอง
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester1[26]->score_rate_social))
                                                @elseif ($datasocialsemester1[26]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[26]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[26]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester1[26]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester2[26]->score_rate_social))
                                                @elseif ($datasocialsemester2[26]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[26]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[26]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester2[26]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                3.3 ประนีประนอมแก้ไข้ปัญหาโดยปราศจากความรุนแรงเมื่อมีผู้ชี้แนะ
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester1[27]->score_rate_social))
                                                @elseif ($datasocialsemester1[27]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[27]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[27]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester1[27]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester2[27]->score_rate_social))
                                                @elseif ($datasocialsemester2[27]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[27]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[27]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester2[27]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                3.4 ยืนตรงเคารพพธงชาติร้องเพลงชาติ
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester1[28]->score_rate_social))
                                                @elseif ($datasocialsemester1[28]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[28]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[28]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester1[28]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester2[28]->score_rate_social))
                                                @elseif ($datasocialsemester2[28]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[28]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[28]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester2[28]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                3.5
                                                เข้าร่วมกกิจกรรมที่เกี่ยวกับสถาบันพระมหากกษัตริย์ตามที่โรงเรียนและชุมชนจัดขึ้น
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester1[29]->score_rate_social))
                                                @elseif ($datasocialsemester1[29]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[29]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester1[29]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester1[29]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($datasocialsemester2[29]->score_rate_social))
                                                @elseif ($datasocialsemester2[29]->score_rate_social == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[29]->score_rate_social == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($datasocialsemester2[29]->score_rate_social == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($datasocialsemester2[29]->score_rate_social))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- พัฒนาการด้านสติปัญญา -->
                            <div id="menu3" class="container tab-pane fade"><br>
                                <table class="table table-bordered border-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col" class=" text-center" valign="middle">พัฒนาการ</th>
                                            <th scope="col" class=" text-center" valign="middle">ตัวบ่งชี้</th>
                                            <th scope="col" class=" text-center" valign="middle">พฤติกรรม</th>
                                            <th scope="col" class=" text-center" valign="middle" width="170px">
                                                ภาคเรียน1
                                            </th>
                                            <th scope="col" class=" text-center" valign="middle" width="170px">
                                                ภาคเรียน2
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
                                                1.1 ฟังผู้อื่นพูดจนจบและสนทนาโต้ดอบสอดคล้องกับเรื่องที่ฟัง
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester1[0]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester1[0]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[0]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[0]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester1[0]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester2[0]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester2[0]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[0]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[0]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester2[0]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                1.2 เล่าเป็นเรื่องราวต่อเนื่องได้
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester1[1]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester1[1]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[1]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[1]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester1[1]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester2[1]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester2[1]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[1]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[1]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester2[1]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                1.3 ฟังคำสัง 2 ขั้นตอนและสามารถปฎิบัติได้
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester1[2]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester1[2]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[2]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[2]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester1[2]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester2[2]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester2[2]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[2]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[2]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester2[2]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                1.4 พูดโต้ตอบและเล่าเรื่องเป็นประโยคอย่างต่อเนื่อง
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester1[3]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester1[3]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[3]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[3]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester1[3]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester2[3]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester2[3]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[3]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[3]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester2[3]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                1.5 ฟัง พูด โต้ตอบและแสดงความรู้สึกเกี่ยวกับเรื่องที่ฟังได้
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester1[4]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester1[4]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[4]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[4]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester1[4]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester2[4]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester2[4]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[4]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[4]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester2[4]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="3">
                                                2.อ่านเขียนภาพและสัญลักญณ์ได้
                                            </td>
                                            <td>
                                                2.1 อ่านภาพ สัญลักษณ์ คำ พร้อมทั้งชี้ หรือ กวาดตามองข้อความตามบรรทัด
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester1[5]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester1[5]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[5]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[5]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester1[5]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester2[5]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester2[5]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[5]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[5]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester2[5]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                2.2 เขียนคล้ายตัวอักษร
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester1[6]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester1[6]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[6]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[6]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester1[6]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester2[6]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester2[6]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[6]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[6]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester2[6]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                2.3 เปิดและอ่านหนังสือด้วนตนเอง
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester1[7]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester1[7]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[7]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[7]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester1[7]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester2[7]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester2[7]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[7]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[7]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester2[7]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
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
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester1[8]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester1[8]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[8]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[8]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester1[8]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester2[8]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester2[8]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[8]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[8]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester2[8]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                1.2 จับคู่และเปรียบเทียบความแตกต่างหรือความเหมือนของสิ่งต่างๆ
                                                โดยใช้ลักษณะที่สังเกตพบเพียงลักกษณะเดียว
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester1[9]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester1[9]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[9]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[9]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester1[9]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester2[9]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester2[9]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[9]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[9]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester2[9]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                1.3 จำแนกและจัดกลุ่มสิ่งต่างๆ โดยใช้อย่างน้อย 1 ลักกษณะเป็นเกณฑ์
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester1[10]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester1[10]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[10]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[10]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester1[10]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester2[10]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester2[10]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[10]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[10]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester2[10]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                1.4 เรียงลำดับสิ่งของหรือเหตุกการณ์อย่างน้อย 4 ลำดับ
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester1[11]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester1[11]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[11]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[11]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester1[11]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester2[11]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester2[11]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[11]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[11]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester2[11]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                1.5 แก้ปัญหาด้วยวิธีการต่างๆ โดยกการลองผิดลองถูกด้วยตนเอง
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester1[12]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester1[12]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[12]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[12]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester1[12]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester2[12]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester2[12]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[12]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[12]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester2[12]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2">
                                                2.มีความสามารถในการคิดเชิงเหตุผล
                                            </td>
                                            <td>
                                                2.1 ระบุสาเหตุหรือผลที่เกิดขึ้นในเหตุการณ์หรือการกระทำเมื่อมีผู้ชี้แนะ
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester1[13]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester1[13]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[13]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[13]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester1[13]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester2[13]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester2[13]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[13]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[13]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester2[13]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                2.2
                                                คาดเดาหรือคาดคะเนสิ่งที่อาดเกินขึ้นหรือมีส่วนร่วมในการลงความเห็นจากข้อมูล
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester1[14]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester1[14]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[14]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[14]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester1[14]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester2[14]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester2[14]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[14]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[14]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester2[14]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="3">
                                                3.มีความสามารถในการคิดแก้ปัญหาและตัดสินใจ
                                            </td>
                                            <td>
                                                3.1 ตัดสินใจในเรื่องง่ายๆ และเริ่มเรียนรู้ผลที่เกิดขึ้น
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester1[15]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester1[15]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[15]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[15]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester1[15]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester2[15]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester2[15]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[15]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[15]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester2[15]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                3.2 ระบุปัญหาโดยลองผิดลองถูก
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester1[16]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester1[16]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[16]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[16]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester1[16]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester2[16]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester2[16]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[16]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[16]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester2[16]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                3.3
                                                ให้เตุผผลในการคาดคะแนการลงความเห็นหรือการลงข้อสรุปเพื่ออธิบายเกี่ยวกับสิ่งที่สังเกตหรือเรียนรู้
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester1[17]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester1[17]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[17]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[17]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester1[17]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester2[17]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester2[17]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[17]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[17]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester2[17]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
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
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester1[18]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester1[18]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[18]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[18]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester1[18]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester2[18]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester2[18]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[18]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[18]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester2[18]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                1.2 เล่น/ทำงานศิลปะตามจินตนาการของตนเอง
                                                โดนมีลักษณะคิดริเริ่มคิดคล่องแคล่วคิดยึดหยุ่นและคิดละเอียดลออ
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester1[19]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester1[19]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[19]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[19]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester1[19]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester2[19]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester2[19]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[19]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[19]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester2[19]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="2">
                                                2.แสดงท่าทาง/เคลื่อนไหวตามจินตนาการอย่างสร้างสรรค์
                                            </td>
                                            <td>
                                                2.1
                                                เคลื่อนไหวท่าทางเพื่อสื่อสารความคิดความรู้สึกของตนเองอย่างหลากหลายหรือแปลกใหม่
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester1[20]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester1[20]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[20]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[20]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester1[20]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester2[20]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester2[20]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[20]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[20]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester2[20]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                2.2
                                                แสดงท่าทาง/เลื่อนไหว/เล่นบทบาทสมมุติตามจินตนาการของตนเองและท่าทาง/การเลื่อนไหวมีลักษณะคิดริเริ่ม
                                                คิดคล่องแคล่ว คิดยึดหยุ่นและคิดละเอียดลออ 
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester1[21]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester1[21]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[21]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[21]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester1[21]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester2[21]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester2[21]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[21]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[21]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester2[21]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
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
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester1[22]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester1[22]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[22]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[22]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester1[22]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester2[22]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester2[22]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[22]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[22]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester2[22]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                1.2 กระตือรือร้นในการเข้าร่วมกิจกรรม
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester1[23]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester1[23]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[23]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[23]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester1[23]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester2[23]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester2[23]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[23]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[23]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester2[23]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                1.3 ถามคำถามและแสดงความคิดเห็นเกี่ยวกับเรื่องที่สนใจ
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester1[24]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester1[24]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[24]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[24]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester1[24]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester2[24]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester2[24]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[24]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[24]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester2[24]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td rowspan="3">
                                                2.มีความสามารถในการแสวงหาความรู้
                                            </td>
                                            <td>
                                                2.1 ค้นหาคำตอบของข้อสงสัยต่างๆ ตามวิธีการของตนเอง
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester1[25]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester1[25]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[25]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[25]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester1[25]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester2[25]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester2[25]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[25]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[25]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester2[25]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                2.2 ใช้ประโยคคำถามว่า "ที่ไหน" "ทำไม" ในการค้นหาคำตอบ
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester1[26]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester1[26]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[26]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[26]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester1[26]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester2[26]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester2[26]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[26]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[26]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester2[26]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                2.3 เชื่อมโยงความรู้และทักษะต่างๆใช้ในชีวิตประจำวัน
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester1[27]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester1[27]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[27]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester1[27]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester1[27]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                            <td valign="middle">
                                                @if (!isset($dataintellectualsemester2[27]->score_rate_intellectual))
                                                @elseif ($dataintellectualsemester2[27]->score_rate_intellectual == 1)
                                                    <input class="form-control text-center" type="text"
                                                        value="ควรเสริม" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[27]->score_rate_intellectual == 2)
                                                    <input class="form-control text-center" type="text"
                                                        value="ปานกลาง" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @elseif ($dataintellectualsemester2[27]->score_rate_intellectual == 3)
                                                    <input class="form-control text-center" type="text"
                                                        value="ดี" aria-label="Disabled input example" disabled
                                                        readonly>
                                                @endif
                                                @if (empty($dataintellectualsemester2[27]->score_rate_intellectual))
                                                    <input class="form-control text-center" type="text"
                                                        value="ยังไม่ได้รับการประเมิน"
                                                        aria-label="Disabled input example" disabled readonly>
                                                @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- ความเห็นของครู -->
                            <div id="menu4" class="container tab-pane fade"><br>
                                <div class="card">
                                    <div class="card-header">
                                        ความคิดเห็นของครูประจำชั้น
                                    </div>
                                    <div class="card-body">
                                        @forelse ($commenTeacher as $commenT)
                                            <div class="card mb-2">
                                                <div class="card-header">
                                                    {{ $commenT->semester }}
                                                </div>
                                                <div class="card-body">
                                                    <blockquote class="blockquote mb-0">
                                                        {!! $commenT->comment_teacher !!}
                                                    </blockquote>
                                                </div>
                                                @if (auth()->User()->rank == 'teacher')
                                                <div class="card-footer text-end">
                                                    <a name="" id="" class="btn btn-warning" href="{{ url('teacher/commen/edit/'.$commenT->id) }}" role="button">แก้ไข</a>
                                                </div>
                                                @endif
                                            </div>
                                        @empty
                                            <div class="alert alert-danger text-center" role="alert">
                                                ยังไม่ได้รับการประเมิน
                                            </div>
                                        @endforelse
                                    </div>

                                </div>
                            </div>
                            @php
                                $score_physically1 = ($appraisalsemester1Physically->score_physically / 60) * 100;
                                $score_physically2 = ($appraisalsemester2Physically->score_physically / 60) * 100;
                                $score_mood_mind1 = ($appraisalsemester1mood_mind->score_mood_mind / 57) * 100;
                                $score_mood_mind2 = ($appraisalsemester2mood_mind->score_mood_mind / 57) * 100;
                                $score_social1 = ($appraisalsemester1social->score_social / 90) * 100;
                                $score_social2 = ($appraisalsemester2social->score_social / 90) * 100;
                                $score_intellectual1 = ($appraisalsemester1intellectual->score_intellectual / 84) * 100;
                                $score_intellectual2 = ($appraisalsemester2intellectual->score_intellectual / 84) * 100;
                                // Debugbar::notice($score_physically1,$score_physically2);
                                // Debugbar::notice($score_mood_mind1,$score_mood_mind2);
                                // Debugbar::notice($score_social1,$score_social2);
                                // Debugbar::notice($score_intellectual1,$score_intellectual2);
                            @endphp
                            <!-- สรุปผลการประเมิน -->
                            <div id="menu5" class="container tab-pane fade"><br>
                                <table class="table table-bordered border-dark">
                                    <thead>
                                        <tr>
                                            <th scope="col" class=" text-center" valign="middle" rowspan="2">
                                                พัฒนาการ
                                            </th>
                                            <th scope="col" class=" text-center" valign="middle" colspan="3">
                                                ระดับคุณภาพ
                                            </th>
                                            <th scope="col" class=" text-center" valign="middle" rowspan="2">
                                                หมายเหตุ
                                            </th>
                                        </tr>
                                        <tr>
                                            <th scope="col" class=" text-center">
                                                3 <br>
                                                ดี
                                            </th>
                                            <th scope="col" class=" text-center">
                                                2 <br>
                                                ปานกลาง
                                            </th>
                                            <th scope="col" class=" text-center">
                                                1 <br>
                                                ควรเสริม
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row">
                                                ด้านร่างกาย
                                            </th>
                                            <td>
                                                <div class="row justify-content-md-center">
                                                    <div class="col-md-auto">
                                                        @if (isset($datasemester1) && isset($datasemester2))
                                                            @if ($score_physically2 > 66.66 && $score_physically2 <= 100)
                                                                <i class="bi bi-check-lg"></i>
                                                            @endif
                                                        @else
                                                            @if ($score_physically1 > 66.66 && $score_physically1 <= 100)
                                                                <i class="bi bi-check-lg"></i>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row justify-content-md-center">
                                                    <div class="col-md-auto">
                                                        @if (isset($datasemester1) && isset($datasemester2))
                                                            @if ($score_physically2 > 33.33 && $score_physically2 <= 66.66)
                                                                <i class="bi bi-check-lg"></i>
                                                            @endif
                                                        @else
                                                            @if ($score_physically1 > 33.33 && $score_physically1 <= 66.66)
                                                                <i class="bi bi-check-lg"></i>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row justify-content-md-center">
                                                    <div class="col-md-auto">
                                                        @if (isset($datasemester1) && isset($datasemester2))
                                                            @if ($score_physically2 <= 33.33)
                                                                <i class="bi bi-check-lg"></i>
                                                            @endif
                                                        @else
                                                            @if ($score_physically1 <= 33.33)
                                                                <i class="bi bi-check-lg"></i>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if (isset($datasemester1) && isset($datasemester2))
                                                    @if ($score_physically2 > 66.66 && $score_physically2 <= 100)
                                                        ควรส่งเสริม
                                                    @elseif ($score_physically2 > 33.33 && $score_physically2 <= 66.66)
                                                        ควรปรับปรุง
                                                    @else
                                                        ควรแก้ไขด่วน
                                                    @endif
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                ด้านอารมณ์ - จิตใจ
                                            </th>
                                            <td>
                                                <div class="row justify-content-md-center">
                                                    <div class="col-md-auto">
                                                        @if (isset($datasemester1) && isset($datasemester2))
                                                            @if ($score_mood_mind2 > 66.66 && $score_mood_mind2 <= 100)
                                                                <i class="bi bi-check-lg"></i>
                                                            @endif
                                                        @else
                                                            @if ($score_mood_mind1 > 66.66 && $score_mood_mind1 <= 100)
                                                                <i class="bi bi-check-lg"></i>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row justify-content-md-center">
                                                    <div class="col-md-auto">
                                                        @if (isset($datasemester1) && isset($datasemester2))
                                                            @if ($score_mood_mind2 > 33.33 && $score_mood_mind2 <= 66.66)
                                                                <i class="bi bi-check-lg"></i>
                                                            @endif
                                                        @else
                                                            @if ($score_mood_mind1 > 33.33 && $score_mood_mind1 <= 66.66)
                                                                <i class="bi bi-check-lg"></i>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row justify-content-md-center">
                                                    <div class="col-md-auto">
                                                        @if (isset($datasemester1) && isset($datasemester2))
                                                            @if ($score_mood_mind2 <= 33.33)
                                                                <i class="bi bi-check-lg"></i>
                                                            @endif
                                                        @else
                                                            @if ($score_mood_mind1 <= 33.33)
                                                                <i class="bi bi-check-lg"></i>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if (isset($datasemester1) && isset($datasemester2))
                                                @if ($score_physically2 > 66.66 && $score_physically2 <= 100)
                                                    ควรส่งเสริม
                                                @elseif ($score_physically2 > 33.33 && $score_physically2 <= 66.66)
                                                    ควรปรับปรุง
                                                @else
                                                    ควรแก้ไขด่วน
                                                @endif
                                            @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                ด้านสังคม
                                            </th>
                                            <td>
                                                <div class="row justify-content-md-center">
                                                    <div class="col-md-auto">
                                                        @if (isset($datasemester1) && isset($datasemester2))
                                                            @if ($score_social2 > 66.66 && $score_social2 <= 100)
                                                                <i class="bi bi-check-lg"></i>
                                                            @endif
                                                        @else
                                                            @if ($score_social1 > 66.66 && $score_social1 <= 100)
                                                                <i class="bi bi-check-lg"></i>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row justify-content-md-center">
                                                    <div class="col-md-auto">
                                                        @if (isset($datasemester1) && isset($datasemester2))
                                                            @if ($score_social2 > 33.33 && $score_social2 <= 66.66)
                                                                <i class="bi bi-check-lg"></i>
                                                            @endif
                                                        @else
                                                            @if ($score_social1 > 33.33 && $score_social1 <= 66.66)
                                                                <i class="bi bi-check-lg"></i>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row justify-content-md-center">
                                                    <div class="col-md-auto">
                                                        @if (isset($datasemester1) && isset($datasemester2))
                                                            @if ($score_social2 <= 33.33)
                                                                <i class="bi bi-check-lg"></i>
                                                            @endif
                                                        @else
                                                            @if ($score_social1 <= 33.33)
                                                                <i class="bi bi-check-lg"></i>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if (isset($datasemester1) && isset($datasemester2))
                                                @if ($score_physically2 > 66.66 && $score_physically2 <= 100)
                                                    ควรส่งเสริม
                                                @elseif ($score_physically2 > 33.33 && $score_physically2 <= 66.66)
                                                    ควรปรับปรุง
                                                @else
                                                    ควรแก้ไขด่วน
                                                @endif
                                            @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th scope="row">
                                                ด้านสติปัญญา
                                            </th>
                                            <td>
                                                <div class="row justify-content-md-center">
                                                    <div class="col-md-auto">
                                                        @if (isset($datasemester1) && isset($datasemester2))
                                                            @if ($score_intellectual2 > 66.66 && $score_intellectual2 <= 100)
                                                                <i class="bi bi-check-lg"></i>
                                                            @endif
                                                        @else
                                                            @if ($score_intellectual1 > 66.66 && $score_intellectual1 <= 100)
                                                                <i class="bi bi-check-lg"></i>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row justify-content-md-center">
                                                    <div class="col-md-auto">
                                                        @if (isset($datasemester1) && isset($datasemester2))
                                                            @if ($score_intellectual2 > 33.33 && $score_intellectual2 <= 66.66)
                                                                <i class="bi bi-check-lg"></i>
                                                            @endif
                                                        @else
                                                            @if ($score_intellectual1 > 33.33 && $score_intellectual1 <= 66.66)
                                                                <i class="bi bi-check-lg"></i>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="row justify-content-md-center">
                                                    <div class="col-md-auto">
                                                        @if (isset($datasemester1) && isset($datasemester2))
                                                            @if ($score_intellectual2 <= 33.33)
                                                                <i class="bi bi-check-lg"></i>
                                                            @endif
                                                        @else
                                                            @if ($score_intellectual1 <= 33.33)
                                                                <i class="bi bi-check-lg"></i>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                @if (isset($datasemester1) && isset($datasemester2))
                                                @if ($score_physically2 > 66.66 && $score_physically2 <= 100)
                                                    ควรส่งเสริม
                                                @elseif ($score_physically2 > 33.33 && $score_physically2 <= 66.66)
                                                    ควรปรับปรุง
                                                @else
                                                    ควรแก้ไขด่วน
                                                @endif
                                            @endif
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                {{-- <div>
                                    <span>
                                        >66.66&&<=100=ดี </span>
                                            <br>
                                            <span>
                                                >33.33&&<=66.66=ปานกลาง </span>
                                                    <br>
                                                    <span>
                                                        <=33.33=ควรเสริม </span>

                                                          
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-2">
                    <div class="card-header">
                        {{ __('ภาคเรียน1') }}
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div id="myChart1" style="height: 400px;"></div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        {{ __('ภาคเรียน2') }}
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div id="myChart2" style="height: 400px;"></div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('script')
    <script>
        var myChart1 = echarts.init(document.getElementById('myChart1'));
        var PhysicallyData = {!! json_encode($appraisalsemester1Physically->score_physically) !!};
        var mood_mindData = {!! json_encode($appraisalsemester1mood_mind->score_mood_mind) !!};
        var socialData = {!! json_encode($appraisalsemester1social->score_social) !!};
        var intellectualData = {!! json_encode($appraisalsemester1intellectual->score_intellectual) !!};
        // console.log((PhysicallyData / 60) );

        var option = {
            title: {
                text: '',
                subtext: '',
                left: 'right',
                top: 'bottom'
            },
            tooltip: {
                trigger: 'item'
            },
            legend: {
                orient: 'vertical',
                left: 'left'
            },
            series: [{
                name: 'Access From',
                type: 'pie',
                radius: '50%',
                data: [{
                        value: (PhysicallyData / 60) * 100,
                        name: 'พัฒนาการด้านร่างกาย'
                    },
                    {
                        value: (mood_mindData / 57) * 100,
                        name: 'พัฒนาการด้านอารมณ์และจิตใจ'
                    },
                    {
                        value: (socialData / 90) * 100,
                        name: 'พัฒนาการด้านสังคม'
                    },
                    {
                        value: (intellectualData / 84) * 100,
                        name: 'พัฒนาการด้านสติปัญญา'
                    }
                ],
                emphasis: {
                    itemStyle: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }]
        };

        myChart1.setOption(option);

        var myChart2 = echarts.init(document.getElementById('myChart2'));
        var PhysicallyData2 = {!! json_encode($appraisalsemester2Physically->score_physically) !!};
        var mood_mindData2 = {!! json_encode($appraisalsemester2mood_mind->score_mood_mind) !!};
        var socialData2 = {!! json_encode($appraisalsemester2social->score_social) !!};
        var intellectualData2 = {!! json_encode($appraisalsemester2intellectual->score_intellectual) !!};
        console.log();
        var option = {
            title: {
                text: ' ',
                subtext: ' ',
                left: 'center'
            },
            tooltip: {
                trigger: 'item'
            },
            legend: {
                orient: 'vertical',
                left: 'left'
            },
            series: [{
                name: 'Access From',
                type: 'pie',
                radius: '50%',
                data: [{
                        value: (PhysicallyData2 / 60) * 100,
                        name: 'พัฒนาการด้านร่างกาย'
                    },
                    {
                        value: (mood_mindData2 / 57) * 100,
                        name: 'พัฒนาการด้านอารมณ์และจิตใจ'
                    },
                    {
                        value: (socialData2 / 90) * 100,
                        name: 'พัฒนาการด้านสังคม'
                    },
                    {
                        value: (intellectualData2 / 84) * 100,
                        name: 'พัฒนาการด้านสติปัญญา'
                    }
                ],
                emphasis: {
                    itemStyle: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }]
        };

        myChart2.setOption(option);
    </script>
@endsection
