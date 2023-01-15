@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <a href="{{route('add.room')}}" class=" btn btn-primary float-end">เพิ่ม</a>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                   

                    {{ __('roomindex') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
