@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center g-2">
            <div class="col-md-8">
                @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    {{ $message }}
                </div>
            @endif
                <form action="{{route('admin.updateSetTime')}}" method="post">
                    @csrf
                    <div class="card text-center">
                        <div class="card-header">
                            <div class="row justify-content-start align-items-center g-2">
                                <div class="col-md-4 text-start">
                                    <a class="btn btn-info" href="{{ route('admindashboard') }}" role="button"><i
                                            class="bi bi-chevron-left"></i>กลับ</a>
                                </div>
                                <div class="col-md-4 text-center">
                                    <h4>ตั้งค่าเวลามาเรียน/กลับบ้าน</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center align-items-center g-2">
                                <div class="col">
                                    <label for="">เวลามาเรียน</label>
                                    <div class="input-group">
                                        <input type="text" id="time-in-start" name="timeinstart" class="form-control">
                                        <span class="input-group-text">ถึง</span>
                                        <input type="text" id="time-in-end" name="timeinend" class="form-control">
                                    </div>
                                </div>
                                <div class="col">
                                    <label for="">เวลากลับบ้าน</label>
                                    <div class="input-group">
                                        <input type="text" id="time-out-start" name="timeoutstart" class="form-control">
                                        <span class="input-group-text">ถึง</span>
                                        <input type="text" id="time-out-end" name="timeoutend" class="form-control">
                                    </div>
                                </div>
                                <input type="hidden" name="timeid" value="{{$setTime->statictime_id}}" />
                            </div>
                        </div>
                        <div class="card-footer text-muted">
                            <div class="row justify-content-end align-items-center g-2">
                                <div class="col">
                                    <button type="submit" class="btn btn-primary float-end">
                                        {{ __('บันทึก') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endsection

    @section('script')
        <script>
            var set_time = @json($setTime);
            $("#time-in-start").flatpickr({
                enableTime: true,
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true,
                defaultDate: set_time.time_in_start
            });
            $("#time-in-end").flatpickr({
                enableTime: true,
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true,
                defaultDate: set_time.time_in_end
            });
            $("#time-out-start").flatpickr({
                enableTime: true,
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true,
                defaultDate: set_time.time_out_start
            });
            $("#time-out-end").flatpickr({
                enableTime: true,
                enableTime: true,
                noCalendar: true,
                dateFormat: "H:i",
                time_24hr: true,
                defaultDate: set_time.time_out_end
            });
        </script>
    @endsection
