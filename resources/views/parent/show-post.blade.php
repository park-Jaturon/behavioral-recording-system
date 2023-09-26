@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-start align-items-center g-2">
                            <div class="col-md-4">
                                <a class="btn btn-info" href="{{ route('home.parent') }}" role="button"><i
                                        class="bi bi-chevron-left"></i>กลับ</a>
                            </div>
                            <div class="col-md-4 text-center">
                                {{ __('ประกาศ') }}
                            </div>
                            <div class="col-md-4 text-end">
                                {{ 'ห้อง ' . $rooms->room_name }}
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @foreach ($showpost as $row)
                            @if ($row->status == 'show')
                                <div class="card mb-3">
                                    <div class="card-header img">
                                        {{ $row->p_topic }}
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">

                                            {!! $row->p_description !!}
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        // ดึงรูปภาพที่อยู่ภายใน div.card-body ทั้งหมด
        const cardBodyImages = document.querySelectorAll('.card-body img');

        // วนลูปผ่านรูปภาพและปรับขนาดให้พอดีกับ div.card-body
        cardBodyImages.forEach(image => {
            image.style.maxWidth = '100%';
            image.style.height = 'auto';
        });
    </script>
@endsection
