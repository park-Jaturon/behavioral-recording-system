@extends('layouts.app')

@section('content')
    <!-- Modal -->
    <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">เพิ่มตารางเรียน/กิจกรรม</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="" class="form-label">เรื่อง</label>
                        <input type="text" class="form-control" id="title">
                        <small id="titleError" class="text-danger"></small>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">ระยะเวลา</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar3"></i></span>
                            <input type="text" id="estart" aria-label="First name" class="form-control">
                            <span class="input-group-text">ถึง</span>
                            <span class="input-group-text"><i class="bi bi-calendar3"></i></span>
                            <input type="text" id="eend" aria-label="First name" class="form-control">
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                    <button type="button" id="saveSub" class="btn btn-primary">บันทึก</button>
                </div>
            </div>
        </div>
    </div>
    {{--  --}}
    <div class="container">
        <h1>ตารางเรียน</h1>
        <div id='calendar'></div>
    </div>
@endsection


@section('script')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var booking = @json($events);
            $('#calendar').fullCalendar({
                header: {
                    left: 'prev, next, today',
                    center: 'title',
                    right: 'month, agendaWeek, agendaDay, listMonth',
                },
                events: booking,
                selectable: true,
                selectHelper: true,
                locale: 'th', // กำหนดให้แสดงภาษาไทย

                select: function(start, end, allDays) {
                    // $('#bookingModal').modal('toggle');

                    $('#bookingModal').modal('show');
                    $('#estart').flatpickr({
                        enableTime: true,
                        dateFormat: "Y-m-d H:i",
                        defaultDate: moment(start).format('YYYY-MM-DD h:mm'),
                        locale: {
                            firstDayOfWeek: 1,
                            rangeSeparator: " ถึง ",
                            scrollTitle: "เลื่อนเพื่อเพิ่มหรือลด",
                            toggleTitle: "คลิกเพื่อเปลี่ยน",
                            time_24hr: true,
                            weekdays: {
                                shorthand: ["อา", "จ", "อ", "พ", "พฤ", "ศ", "ส"],
                                longhand: [
                                    "อาทิตย์",
                                    "จันทร์",
                                    "อังคาร",
                                    "พุธ",
                                    "พฤหัสบดี",
                                    "ศุกร์",
                                    "เสาร์",
                                ],
                            },
                            months: {
                                shorthand: [
                                    "ม.ค.",
                                    "ก.พ.",
                                    "มี.ค.",
                                    "เม.ย.",
                                    "พ.ค.",
                                    "มิ.ย.",
                                    "ก.ค.",
                                    "ส.ค.",
                                    "ก.ย.",
                                    "ต.ค.",
                                    "พ.ย.",
                                    "ธ.ค.",
                                ],
                                longhand: [
                                    "มกราคม",
                                    "กุมภาพันธ์",
                                    "มีนาคม",
                                    "เมษายน",
                                    "พฤษภาคม",
                                    "มิถุนายน",
                                    "กรกฎาคม",
                                    "สิงหาคม",
                                    "กันยายน",
                                    "ตุลาคม",
                                    "พฤศจิกายน",
                                    "ธันวาคม",
                                ],
                            }
                        }
                    });

                    $('#eend').flatpickr({
                        enableTime: true,
                        dateFormat: "Y-m-d H:i",
                        defaultDate: moment(end).format('YYYY-MM-DD h:mm'),
                        locale: {
                            firstDayOfWeek: 1,
                            rangeSeparator: " ถึง ",
                            scrollTitle: "เลื่อนเพื่อเพิ่มหรือลด",
                            toggleTitle: "คลิกเพื่อเปลี่ยน",
                            time_24hr: true,
                            weekdays: {
                                shorthand: ["อา", "จ", "อ", "พ", "พฤ", "ศ", "ส"],
                                longhand: [
                                    "อาทิตย์",
                                    "จันทร์",
                                    "อังคาร",
                                    "พุธ",
                                    "พฤหัสบดี",
                                    "ศุกร์",
                                    "เสาร์",
                                ],
                            },
                            months: {
                                shorthand: [
                                    "ม.ค.",
                                    "ก.พ.",
                                    "มี.ค.",
                                    "เม.ย.",
                                    "พ.ค.",
                                    "มิ.ย.",
                                    "ก.ค.",
                                    "ส.ค.",
                                    "ก.ย.",
                                    "ต.ค.",
                                    "พ.ย.",
                                    "ธ.ค.",
                                ],
                                longhand: [
                                    "มกราคม",
                                    "กุมภาพันธ์",
                                    "มีนาคม",
                                    "เมษายน",
                                    "พฤษภาคม",
                                    "มิถุนายน",
                                    "กรกฎาคม",
                                    "สิงหาคม",
                                    "กันยายน",
                                    "ตุลาคม",
                                    "พฤศจิกายน",
                                    "ธันวาคม",
                                ],
                            }
                        }
                    });

                    $('#saveSub').click(function() {
                        var title = $('#title').val();
                        var rooms_id = {!! json_encode($room->rooms_id) !!};

                        var start_date = $('#estart').val();
                        var end_date = $('#eend').val();
                        console.log(title, start_date, end_date);

                        $.ajax({
                            url: "{{ route('calendar.store') }}",
                            type: "POST",
                            dataType: 'json',
                            data: {
                                title,
                                rooms_id,
                                start_date,
                                end_date
                            },
                            success: function(response) {
                                $('#bookingModal').modal('hide')
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'บันทึกตารางเรียน/กิจกรรมของคุณแล้ว',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                setTimeout(() => {
                                    window.location.href = $url +
                                        '/teacher/event/inddex';
                                }, 1600);

                            },
                            error: function(error) {
                                if (error.responseJSON.errors) {
                                    $('#titleError').html(error.responseJSON.errors
                                        .title);
                                }
                            },
                        });
                    });
                },
                editable: true,
                eventDrop: function(event) {
                    var id = event.eventsid;
                    var start_date = moment(event.start).format('YYYY-MM-DD');
                    var end_date = moment(event.end).format('YYYY-MM-DD');
                    $.ajax({
                        url: "{{ route('calendar.update', '') }}" + '/' + id,
                        type: "PATCH",
                        dataType: 'json',
                        data: {
                            start_date,
                            end_date
                        },
                        success: function(response) {
                            // swal("Good job!", "Event Updated!", "success");
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'ตารางเรียน/กิจกรรมของคุณแล้ว อัปเดตแล้ว',
                                showConfirmButton: false,
                                timer: 1500
                            })
                        },
                        error: function(error) {
                            console.log(error)
                        },
                    });
                },
                eventClick: function(event) {
                    var id = event.eventsid;
                    console.log(id);
                    window.location="{{route('image.activity','')}}"+ '/' + id;
                   
                },

            })
        })
    </script>
@endsection
