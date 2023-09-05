@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-around mb-3 g-2">
            <div class="col-auto">
                <a class="btn btn-light" href="{{ route('index.event') }}" role="button"><i class="bi bi-chevron-left"></i></a>
                 <label for="topic"><h5>{{$topic->title}}</h5></label>
            </div>
            
            <div class="col-auto">
                <a href="{{ url('teacher/activity/add/' . $events_id) }}" class="btn btn-primary">เพิ่ม</a>
                <a href="{{route('edit.activity',['events_id'=>$events_id])}}" class="btn btn-warning">แก้ไข</a>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 m-auto">

                <!-- การสร้าง Carousel -->
                <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">

                        @forelse ($activities as $images)
                            <div class="carousel-item active" data-bs-interval="10000" >   {{-- style="height: 550px" --}}
                                <img src="\uploads\activity\{{ $images->activity_images }}" class="d-block w-100 " 
                                    alt="...">              {{-- style="height: 100% ; width:100%" --}}
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
