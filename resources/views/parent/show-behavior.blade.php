@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                            <!-- ความเห็นของครู -->
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#home">ความเห็นของครู</a>
                            </li>
                            <!-- สรุปผลการประเมิน -->
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#menu1">สรุปผลการประเมิน</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">
                        <!-- Tab panes -->
                        <div class="tab-content">
                            <!-- ความเห็นของครู -->
                            <div id="home" class="container tab-pane active"><br>
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
                            <div id="menu1" class="container tab-pane fade"><br>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
