@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <iframe src="https://docs.google.com/forms/d/e/1FAIpQLSctuWmwYR8xtGIHwPgG_OmfOI6w1wXDg_vjdwmkmaJupOpoIg/viewform?embedded=true" width="640" height="1116" frameborder="0" marginheight="0" marginwidth="0">Loading…</iframe>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
