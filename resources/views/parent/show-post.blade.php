@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ประกาศ') }}</div>

                <div class="card-body">
                    @foreach ($showpost as $row)
                    @if ($row->status == 'shown')
                    <div class="card mb-3">
                        <div class="card-header">
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