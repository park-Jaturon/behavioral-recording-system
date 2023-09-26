@extends('layouts.app')

@section('content')
    {{-- show --}}
    <div class="container">
        <div class="row justify-content-start align-items-center g-2">
            <div class="col-md-4">
                <a class="btn btn-info" href="{{ route('home.parent') }}" role="button"><i
                    class="bi bi-chevron-left"></i>กลับ</a>
            </div>
            <div class="col-md-4 text-center">
                <h1>ตารางเรียน</h1>
            </div>
            <div class="col-md-4 text-end">
                {{'ห้อง '.$rooms->room_name}}
            </div>
        </div>
        
        <div id='calendar'></div>
    </div>
    <div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">ตารางเรียน/กิจกรรม</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="" class="form-label">เรื่อง</label>
                        <input type="text" class="form-control" id="title" disabled readonly>
                        <small id="titleError" class="text-danger"></small>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">เนื้อความ</label>
                        <textarea class="form-control" id="textarea1" rows="3" disabled readonly></textarea>
                        <small id="textarea1Error" class="text-danger"></small>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">ระยะเวลา</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar3"></i></span>
                            <input type="text" id="estart" aria-label="First name" class="form-control" disabled
                                readonly>
                            <span class="input-group-text">ถึง</span>
                            <span class="input-group-text"><i class="bi bi-calendar3"></i></span>
                            <input type="text" id="eend" aria-label="First name" class="form-control" disabled
                                readonly>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
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

                eventClick: function(event) {
                    var id = event.eventsid;
                    // var title = document.getElementById('title');
                    console.log(id);
                    document.getElementById('title').value = event.title;
                    document.getElementById('textarea1').value = event.description;
                    document.getElementById('estart').value = formatDate(event.start);
                    document.getElementById('eend').value = formatDate(event.end);
                    $('#bookingModal').modal('show');


                },
            })
        })

        function formatDate(date) {
            const options = {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit',
                hour: '2-digit',
                minute: '2-digit',
            };
            const dateObj = new Date(date);
            return dateObj.toLocaleDateString('th-TH', options); // แสดงเป็นรูปแบบวันที่ "DD/MM/YYYY"
        }
        $('.modal fade').parsley();
    </script>
@endsection
