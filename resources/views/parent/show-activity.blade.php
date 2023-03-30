@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('รูปกิจกรรม') }}</div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">วันที่</th>
                                        <th scope="col">เรื่อง</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($event as $events)
                                        <tr class="">
                                            <td scope="row">
                                                {{ date('d-m-Y ', strtotime($events->start)) }}
                                            </td>
                                            <td>
                                                <a href="{{ url('parent/descendant/activity/show/image/' . $events->events_id) }}">{{ $events->title }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
