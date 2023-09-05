@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($message = Session::get('successeditactivity'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif
        <form action="{{ route('update.activity', ['events_id' => $event->events_id]) }}" method="post" >
            @csrf
            <div class="row justify-content-start align-items-center g-2 mb-2">
                {{-- <div class="col">
                    <a class="btn btn-light" href="{{ route('image.activity', ['events_id' => $event->events_id]) }}"
                        role="button"><i class="bi bi-chevron-left"></i></a>
                </div> --}}
            </div>
            <div class="row g-2 align-items-center mb-3">
                <div class="col-auto">
                    <label for="inputPassword6" class="col-form-label">เรื่อง </label>
                </div>
                <div class="col-auto">
                    <input type="text" class="form-control" name="topic" id="inputName" value="{{ $event->title }}">
                </div>
    
                <div class="col-auto">
                    <label for="" class="col-form-label">ระยะเวลา</label>
                </div>
                <div class="col-auto">
                    <div class="input-group">
                        <span class="input-group-text"><i class="bi bi-calendar3"></i></span>
                        <input type="text" id="estart" aria-label="First name" class="form-control " name="starrt">
                        <span class="input-group-text">ถึง</span>
                        <span class="input-group-text"><i class="bi bi-calendar3"></i></span>
                        <input type="text" id="eend" aria-label="First name" class="form-control" name="end">
                    </div>
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                </div>
                <div class="col-md-auto  ">
                    <a name="" id="" class="btn btn-danger" href="{{route('image.activity',['events_id'=>$event->events_id])}}" role="button">ยกเลิก</a>
                 </div>
            </div>
        </form>

        <div id="cardImage" class="row justify-content-start align-items-center g-2">
            @foreach ($activities as $images)
                <div class="col ">
                    <div class="card" style="width: 18rem;">
                        {{-- <img src="..." class="card-img-top" alt="..."> --}}
                        <img src="\uploads\activity\{{ $images->activity_images }}" class="d-block w-100 " alt="...">
                        <div class="card-body">
                            {{-- <h5 class="card-title">Card title</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> --}}
                            <button type="button" class="btn btn-danger delete-item"
                                data-activity_id="{{ $images->activity_id }}">ลบ</button>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
@endsection

@section('script')
    <script>
        flatpickr("#estart", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            defaultDate: "{{ $event->start }}",
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

        flatpickr("#eend", {
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            defaultDate: "{{ $event->end }}",
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

        document.querySelector('#cardImage').addEventListener('click', (e) => {
            if (e.target.matches('.delete-item')) {
                console.log(e.target.dataset.activity_id);
                var activityId = e.target.dataset.activity_id;
                Swal.fire({
                    title: 'คุณแน่ใจน่ะว่าจะลบจริงๆ',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'ใช่ฉันต้องการลบ',
                    cancelButtonText: 'ยกเลิก'
                }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete($url + '/teacher/activity/delete/' + activityId).then((
                            response) => {
                            Swal.fire({
                                position: 'top-end',
                                icon: 'success',
                                title: 'ข้อมูลของคุณถูกลบไปแล้ว',
                                showConfirmButton: false,
                                timer: 1500
                            })
                            window.location.reload();
                        });
                    }
                });
            }
        });
    </script>
@endsection
