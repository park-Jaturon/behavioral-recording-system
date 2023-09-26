@extends('layouts.app')

@section('style')
    <style>
        /* สร้างคลาสสำหรับกำหนดสี box-shadow */
        .box-shadow {
            transition: box-shadow 0.3s ease-in-out;
        }
    </style>
@endsection

@section('content')
    <div class="container">
        @foreach ($students as $student)
        @php
        $hasMultipleStudents = count($students) > 1;
        $boxShadowColor = $hasMultipleStudents ? sprintf('#%06X', mt_rand(0, 0xFFFFFF)) : '#FFFFFF';
    @endphp
            <div class="row justify-content-center mb-3 ">
                <div class="col-md-8">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            {{ $message }}
                        </div>
                    @endif
                    <div class="card" style="box-shadow: 0 0 5pt 0.5pt {{ $boxShadowColor }};">
                        <div class="card-header">
                            <div class="row justify-content-start align-items-center g-2">
                                <div class="col-md-auto">
                                    {{ $student->prefix_name . $student->first_name . ' ' . $student->last_name }}
                                </div>
                                <div class="col-md-4">
                                    {{ 'ห้อง ' . $student->room_name }}
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-xl-3 col-md-6  mb-4">
                                    <div class="card bg-warning text-white mb-4">
                                        <div class="card-body">
                                            เวลาเรียน
                                        </div>
                                        <div class="card-footer d-flex align-items-center justify-content-between">
                                            <a class="small text-white stretched-link"
                                                href="{{ url('parent/descendant/time/show/' . $student->student_id) }}"></a>
                                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <div class="card bg-success text-white mb-4">
                                        <div class="card-body">ประกาศ</div>
                                        <div class="card-footer d-flex align-items-center justify-content-between">
                                            <a class="small text-white stretched-link"
                                                href="{{ url('parent/descendant/post/show/' . $student->rooms_id) }}"></a>
                                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <div class="card text-white mb-4" style="background-color: #fd7e14;">
                                        <div class="card-body">ตารางเรียน</div>
                                        <div class="card-footer d-flex align-items-center justify-content-between">
                                            <a class="small text-white stretched-link"
                                                href="{{ url('parent/descendant/events/show/' . $student->rooms_id) }}"></a>
                                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <div class="card  text-white mb-4" style="background-color: #e214fd;">
                                        <div class="card-body">รูปกิจกรรม</div>
                                        <div class="card-footer d-flex align-items-center justify-content-between">
                                            <a class="small text-white stretched-link"
                                                href="{{ route('show_activity', ['rooms_id' => $student->rooms_id, $student->school_year, $student->level]) }}"></a>
                                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-md-6">
                                    <div class="card  text-white mb-4" style="background-color: #2fd2d8;">
                                        <div class="card-body">รายงานพฤติกรรม</div>
                                        <div class="card-footer d-flex align-items-center justify-content-between">
                                            <a class="small text-white stretched-link"
                                                href="{{ url('parent/descendant/behavior/show/' . $student->student_id) }}"></a>
                                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const cards = document.querySelectorAll('.card');
            cards.forEach(card => {
                card.classList.add('random-box-shadow');
            });
        });
    </script>
@endsection
