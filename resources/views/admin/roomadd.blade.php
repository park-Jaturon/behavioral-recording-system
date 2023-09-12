@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        @if (empty($dataRoom->rooms_id))
                            {{ __('เพิ่มห้องเรียน') }}
                        @else
                            {{ __('แก้ไขห้องเรียน') }}
                        @endif
                    </div>

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
                                <div class="col-8">
                                    <div class="mb-3">
                                        <label for="" class="form-label">ห้อง</label>
                                        <input type="text" name="room_name"
                                            value="{{ old('room_name', $dataRoom->room_name) }}" class="form-control"
                                            placeholder="" aria-describedby="helpId">
                                        <small id="helpId" class="text-muted"> 
                                            @error('room_name')
                                                <span role="alert" class="text-danger">
                                                    <strong> {{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </small>
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-end align-items-center g-2">
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary">
                                    {{ __('บันทึก') }}
                                </button>
                            </div>
                                <div class="col-auto">
                                    <a name="" id="" class="btn btn-danger" href="{{route('room.index')}}" role="button"> ยกเลิก</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
