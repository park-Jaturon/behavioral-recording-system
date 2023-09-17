@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row align-items-center mb-3 g-2" id="rActivity">
            <div class="col-md-4 text-start">
                <a class="btn btn-info" href="{{ route('index.event') }}" role="button"><i class="bi bi-chevron-left"></i>กลับ</a>
                
            </div>

            <div class="col-md-4 text-center">
                <label for="topic">
                    <h5>{{ $topic->title }}</h5>
                </label>
            </div>

            <div class="col-md-4 text-end">
                <a href="{{ url('teacher/activity/add/' . $events_id) }}" class="btn btn-success">เพิ่ม</a>
                <button type="button" class="btn btn-danger delete-item" data-events_id="{{$events_id}}">ลบ</button>
                <a href="{{ route('edit.activity', ['events_id' => $events_id]) }}" class="btn btn-warning">แก้ไข</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 m-auto">

                <!-- การสร้าง Carousel -->
                <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">

                        @forelse ($activities as $images)
                            <div class="carousel-item active" data-bs-interval="10000"> {{-- style="height: 550px" --}}
                                <img src="\uploads\activity\{{ $images->activity_images }}" class="d-block w-100 "
                                    alt="..."> {{-- style="height: 100% ; width:100%" --}}
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        @empty
                            <div class="alert alert-secondary text-center" role="alert">
                                <h5><a href="{{ url('teacher/activity/add/' . $events_id) }}">กรุณาเพิ่มรูป</a></h5>
                            </div>
                        @endforelse
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.querySelector('#rActivity').addEventListener('click', (e) => {
            if (e.target.matches('.delete-item')) {
                console.log(e.target.dataset.events_id);
                var eventId = e.target.dataset.events_id;
                axios.post($url + '/teacher/event/inspect/delete', {
                    event: eventId,
                    })
                    .then(function(response) {
                        console.log(response);
                        if (response.data == 0) {
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
                                    axios.delete($url + '/teacher/event/delete/' + e.target.dataset.events_id)
                                        .then((response) => {
                                            Swal.fire(
                                                'ลบแล้ว!',
                                                'ข้อมูลของคุณถูกลบไปแล้ว',
                                                'success'
                                            );
                                            window.location.href = "{{route('index.event')}}";
                                        });
                                }
                            });
                        } else {
                            Swal.fire({
                                icon: 'error',
                                title: 'ผิดพลาด',
                                text: 'ไม่สามารถลบได้ กรุณาลบรูปให้หมดก่อน',
                                // footer: '<a href="">Why do I have this issue?</a>'
                            })
                        }
                    })
                    .catch(function(error) {
                        console.log(error);
                    });
            }
        });
    </script>
@endsection
