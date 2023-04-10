@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('เพิ่มห้องเรียน') }}</div>

                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                {{ $message }}
                            </div>
                        @endif
                        <form
                            action="{{ empty($dataRoom->rooms_id) ? route('store.room') : url('admin/room/update/' . $dataRoom->rooms_id) }}"
                            method="post">{{-- route('store.room') --}}
                            @if (!empty($dataRoom->rooms_id))
                                @method('put')
                            @endif
                            @csrf
                            <div class="row justify-content-center align-items-center g-2">
                                <div class="col-8      ">
                                    <div class="mb-3">
                                        <label for="" class="form-label">ห้อง</label>
                                        <input type="text" name="roomname"
                                            value="{{ old('roomname', $dataRoom->room_name) }}" class="form-control"
                                            placeholder="" aria-describedby="helpId">
                                        <small id="helpId" class="text-muted"> @error('roomname')
                                            <span role="alert" class="text-danger">
                                                <strong> {{ $message }}</strong>
                                            </span>
                                        @enderror</small>
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
