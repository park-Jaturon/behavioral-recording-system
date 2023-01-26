@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ route('add.parents') }}" class=" btn btn-primary float-end">เพิ่ม</a>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                   

                    {{ __('Manage Parents Index') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection