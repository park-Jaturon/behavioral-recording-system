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
                        <form action="{{empty($dataTeacher->teachers_id) ? route('store.teacher') : url('admin/teacher/update/'.$dataTeacher->teachers_id)}}" method="post" enctype="multipart/form-data">{{-- route('store.teacher') --}}
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
                                </div>
                                <div class="col">
                                    <label for="firstname" class="form-label">ชื่อ</label>
                                    <input type="text" name="firstname" id="firstname"
                                        value="{{ old('firstname', $dataTeacher->first_name) }}" class="form-control">
                                    {{-- ,$teachers->first_name --}}
                                </div>
                                <div class="col">
                                    <label for="lastname" class="form-label">นามสกุล</label>
                                    <input type="text" name="lastname" id="lastname" class="form-control"
                                        value="{{ old('lastname', $dataTeacher->last_name) }}"> {{-- ,$teachers['last_name'] --}}
                                </div>
                            </div>
                            {{-- form-ตำแหน่ง-ห้อง-รูป --}}
                            <div class="row justify-content-center align-items-center g-3 mb-3">
                                <div class="col">
                                    <label for="prefix" class="form-label">ตำแหน่ง</label>
                                    <select class="form-select" name="rankteacher" aria-label="Default select example">
                                        <option selected>{{ old('--ตำแหน่ง--', $dataTeacher->rank_teacher) }}</option>
                                        <option value="ครูประจำห้อง">ครูประจำห้อง</option>
                                        <option value="ครูพี่เลี้ยง">ครูพี่เลี้ยง</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="formFile" class="form-label">รูป</label>
                                    <input class="form-control" type="file" name="imageteacher" id="formFile">
                                </div>
                                <div class="col">
                                    <label for="prefix" class="form-label">ห้อง</label>
                                    <select class="form-select" name="room" aria-label="Default select example">
                                        <option selected>{{ old('--ห้อง--', $dataTeacher->rooms_id) }}
                                        </option>
                                        @foreach ($room as $rooms)
                                            <option value="{{ $rooms->rooms_id }}"> {{ $rooms->room_name }}</option>
                                        @endforeach
                                    </select>
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
