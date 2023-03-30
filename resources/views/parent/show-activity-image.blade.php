@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row">
            <div class="col-lg-8 m-auto">

                <!-- การสร้าง Carousel -->
                <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">

                        @forelse ($eventImage as $images)
                            <div class="carousel-item active" data-bs-interval="10000">
                                <img src="\uploads\activity\{{ $images->activity_images }}" class="d-block w-100"
                                    alt="...">
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
                                <h5>ยังไม่มีรูป</h5>
                            </div>
                        @endforelse
                    </div>

                </div>

            </div>
        </div>
    </div>
@endsection
