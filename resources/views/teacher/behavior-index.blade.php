@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('รายงานพฤติกรรม') }}
                    <a href="{{ route('add.behavior') }}" class=" btn btn-primary float-end">เพิ่ม</a>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('behavior!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
