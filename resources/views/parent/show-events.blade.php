@extends('layouts.app')

@section('content')
    {{-- show --}}
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
                }
            })
        })
    </script>
@endsection
