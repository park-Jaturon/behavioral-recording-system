@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        @if (empty($dataTeacher->teachers_id))
                            {{ __('เพิ่มข้อมูลครู') }}
                        @else
                            {{ __('แก้ไขข้อมูลครู') }}
                        @endif

                    </div>

                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                {{ $message }}
                            </div>
                        @endif
                        <form
                            action="{{ empty($dataTeacher->teachers_id) ? route('store.teacher') : url('admin/teacher/update/' . $dataTeacher->teachers_id) }}"
                            method="post" enctype="multipart/form-data">{{-- route('store.teacher') --}}
                            @if (!empty($dataTeacher->teachers_id))
                                @method('put')
                            @endif
                            @csrf
                            {{-- form-ชื่อ-นามสกุล  --}}
                            <div class="row justify-content-center align-items-center g-3 mb-3">
                                <div class="col">
                                    <label for="prefix" class="form-label">คำนำหน้าชื่อ</label>
                                    <select class="form-select" name="prefix" aria-label="Default select example">
                                        <option selected>{{ old('--คำนำหน้าชื่อ--', $dataTeacher->prefix_name) }}</option>
                                        {{-- ,$teachers->prefix_name --}}
                                        <option value="นาย">นาย</option>
                                        <option value="นาง">นาง</option>
                                        <option value="นางสาว">นางสาว</option>
                                    </select>
                                    @error('prefix')
                                        <small id="helpId" class="text-muted">
                                            <span role="alert" class="text-danger">
                                                <strong> {{ $message }}</strong>
                                            </span>
                                        </small>
                                    @enderror
                                </div>
                                
                                <div class="col">
                                    <label for="firstname" class="form-label">ชื่อ</label>
                                    <input type="text" name="firstname" id="firstname"
                                        value="{{ old('firstname', $dataTeacher->first_name) }}" class="form-control">
                                    <small id="helpId" class="text-muted"> @error('firstname')
                                            <span role="alert" class="text-danger">
                                                <strong> {{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </small>
                                </div>
                                <div class="col">
                                    <label for="lastname" class="form-label">นามสกุล</label>
                                    <input type="text" name="lastname" id="lastname" class="form-control"
                                        value="{{ old('lastname', $dataTeacher->last_name) }}"> {{-- ,$teachers['last_name'] --}}
                                    <small id="helpId" class="text-muted"> @error('lastname')
                                            <span role="alert" class="text-danger">
                                                <strong> {{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </small>
                                </div>
                            </div>
                            {{-- form-ตำแหน่ง-ห้อง-รูป --}}
                            <div class="row justify-content-center align-items-center g-3 mb-3">
                                <div class="col">
                                    <label for="rankteacher" class="form-label">ตำแหน่ง</label>
                                    <select class="form-select" name="rankteacher" aria-label="Default select example">
                                        <option selected>{{ old('--ตำแหน่ง--', $dataTeacher->rank_teacher) }}</option>
                                        <option value="ครูประจำชั้น">ครูประจำชั้น</option>
                                        <option value="ครูพี่เลี้ยง">ครูพี่เลี้ยง</option>
                                    </select>
                                    @error('rankteacher')
                                    <small id="helpId" class="text-muted">
                                        <span role="alert" class="text-danger">
                                            <strong> {{ $message }}</strong>
                                        </span>
                                    </small>
                                @enderror
                                </div>
                                <div class="col">
                                    <label for="formFile" class="form-label">รูป</label>
                                    <input class="form-control" type="file" name="imageteacher" id="formFile">
                                    @error('imageteacher')
                                    <small id="helpId" class="text-muted">
                                        <span role="alert" class="text-danger">
                                            <strong> {{ $message }}</strong>
                                        </span>
                                    </small>
                                @enderror
                                </div>
                                <div class="col">
                                    <label for="prefix" class="form-label">ห้อง</label>
                                    <select class="form-select" name="room" aria-label="Default select example">
                                        <option @if (empty($dataTeacher->teachers_id))value="{{$dataTeacher->rooms_id}}" @endif selected>{{ old('--ห้อง--', $TeacherRoom->room_name) }}
                                        
                                       
                                        </option>
                                        @foreach ($room as $rooms)
                                            <option value="{{ $rooms->rooms_id }}"> {{ $rooms->room_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('room')
                                    <small id="helpId" class="text-muted">
                                        <span role="alert" class="text-danger">
                                            <strong> {{ $message }}</strong>
                                        </span>
                                    </small>
                                @enderror
                                </div>
                            </div>

                            <div class="row justify-content-end align-items-center g-2">
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary">
                                    {{ __('บันทึก') }}
                                </button>
                            </div>
                                <div class="col-auto">
                                    <a name="" id="" class="btn btn-danger" href="{{route('index.manageteacher')}}" role="button"> ยกเลิก</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
