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
                    <input type="text" class="form-control" id="title">
                    <span id="titleError" class="text-danger"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="saveSub" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    {{--  --}}
    <div class="container">
        <h1>ตารางเรียน</h1>
        <div id='calendar'></div>
    </div>

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
                    $('#bookingModal').modal('toggle');

                    $('#saveSub').click(function() {
                        var title = $('#title').val();
                        var teachers_id = {!! json_encode(Auth::User()->rank_id) !!};
                        var start_date = moment(start).format('YYYY-MM-DD');
                        var end_date = moment(end).format('YYYY-MM-DD');
                        //console.log(title,start_date,end_date);
                        $.ajax({
                            url: "{{ route('calendar.store') }}",
                            type: "POST",
                            dataType: 'json',
                            data: {
                                title,
                                teachers_id,
                                start_date,
                                end_date
                            },
                            success: function(response) {
                                $('#bookingModal').modal('hide')
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Your work has been saved',
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
                                title: 'Event Updated!',
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
                    Swal.fire({
                        title: 're you sure delete?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: "{{ route('calendar.destroy', '') }}" + '/' + id,
                                type: "DELETE",
                                dataType: 'json',
                                success: function(response) {
                                    $('#calendar').fullCalendar('removeEvents',
                                        response);
                                    Swal.fire({
                                        position: 'top-end',
                                        icon: 'success',
                                        title: 'Your file has been deleted',
                                        showConfirmButton: false,
                                        timer: 1500
                                    })
                                    setTimeout(() => {
                                        window.location.href = $url +
                                            '/teacher/event/inddex';
                                    }, 2000);
                                },
                                error: function(error) {
                                    console.log(error)
                                },
                            });
                        }
                    })
                },

            })
        })
    </script>
    {{-- @vite(['resources\js\event-fullcalender.js']) --}}
@endsection
