@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @endif
                        <form action="{{route('store.room')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row justify-content-center align-items-center g-2">
                                <div class="col-8      ">
                                    <div class="mb-3">
                                        <label for="" class="form-label">ห้อง</label>
                                        <input type="text" name="roomname" id="" class="form-control"
                                            placeholder="" aria-describedby="helpId">
                                        <small id="helpId" class="text-muted">Help text</small>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row mb-0 ">
                                <div class="col-md-8 offset-md-4 ">
                                    <button type="submit" class="btn btn-primary float-end">
                                        {{ __('บันทึก') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
