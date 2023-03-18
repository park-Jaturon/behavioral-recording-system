@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('รายงาน') }}</div>

                    <div class="card-body">
                        @forelse ($report as $data)
                        <div class="card mb-3">
                            <div class="card-header">
                                {{ $data->type }}
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
    
                                    {!! $data->description !!}
                                </div>
                            </div>
                        </div>
                        @empty
                            <div class="alert alert-info text-center" role="alert">
                                ไม่มีรายงาน
                            </div>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
