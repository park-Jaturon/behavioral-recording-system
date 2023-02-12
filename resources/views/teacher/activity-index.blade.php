@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">วันที่</th>
                            <th scope="col">เรื่อง</th>
                            <th scope="col">เพื่มรูป</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($event as $events)
                            <tr class="">
                                <td scope="row">{{ date('d-m-Y ', strtotime($events->start)) }}</td>
                                <td><a href="{{ url('teacher/activity/' . $events->events_id) }}">{{ $events->title }}</a>
                                </td>
                                <td>
                                    <a href="javascript:void(0)" id="show-event"
                                        data-url="{{ route('show.activity', $events->events_id) }}"
                                        class="btn btn-info">เพิ่ม</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="userShowModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><span id="user-name"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('store.activity')}}" method="post">
                    @csrf
                <div class="modal-body">                                           
                        <div class="mb-3 row">
                            <label for="staticEmail" class="col-sm-2 col-form-label">iD</label>
                            <div class="col-sm-10">
                                <input type="text" readonly class="form-control-plaintext" id="event-id" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="formFileMultiple" class="form-label">Multiple files input example</label>
                            <div class="col-sm-10">
                                <input class="form-control" type="file" id="formFileMultiple" multiple>
                            </div>
                        </div>

                        {{-- <p><strong>ID:</strong> <span id="user-id"></span></p>
                        <p><strong>Name:</strong> <span id="user-name"></span></p> --}}                   
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-secondary" data-bs-dismiss="modal">บันทึก</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    @vite(['resources\js\show-data-event.js'])
@endsection
