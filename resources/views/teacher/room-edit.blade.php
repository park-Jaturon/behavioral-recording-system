@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('แก้ไขประวัตินักเรียน') }}</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ url('teacher/room/update/' . $datastudents->student_id) }}" method="post">

                            @csrf
                            {{-- form-ชื่อ-นามสกุล  --}}
                            <div class="row justify-content-center align-items-center g-3 mb-3">
                                <div class="col">
                                    <label for="prefix" class="form-label">คำนำหน้าชื่อ</label>
                                    <select class="form-select" name="prefix" aria-label="Default select example">
                                        <option selected>{{ old('prefix_name', $datastudents->prefix_name) }}</option>
                                        {{-- ,$datastudents->prefix_name --}}
                                        <option value="เด็กชาย">เด็กชาย</option>
                                        <option value="เด็กหญิง">เด็กหญิง</option>
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
                                        value="{{ old('firstname', $datastudents->first_name) }}" class="form-control">
                                    @error('firstname')
                                        <small id="helpId" class="text-muted">
                                            <span role="alert" class="text-danger">
                                                <strong> {{ $message }}</strong>
                                            </span>
                                        </small>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="lastname" class="form-label">นามสกุล</label>
                                    <input type="text" name="lastname" id="lastname" class="form-control"
                                        value="{{ old('lastname', $datastudents->last_name) }}">
                                    @error('lastname')
                                        <small id="helpId" class="text-muted">
                                            <span role="alert" class="text-danger">
                                                <strong> {{ $message }}</strong>
                                            </span>
                                        </small>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="status" class="form-label">สถานะ</label>
                                    <select class="form-select" name="status">
                                        <option selected>{{ old('status', $datastudents->status) }}</option>
                                        {{-- ,$datastudents->symbol --}}
                                        @if ($datastudents->status == 'เรียนอยู่')
                                            <option value="ออกแล้ว">ออกแล้ว</option>
                                        @else
                                            <option value="เรียนอยู่">เรียนอยู่</option>
                                        @endif
                                    </select>
                                    @error('status')
                                        <small id="helpId" class="text-muted">
                                            <span role="alert" class="text-danger">
                                                <strong> {{ $message }}</strong>
                                            </span>
                                        </small>
                                    @enderror
                                </div>
                                {{-- <div class="col">
                                <label for=" " class="form-label">ห้อง</label>
                                <select class="form-select" name="room" aria-label="Default select example">
                                    @foreach ($room as $rooms)
                                        @if ($datastudents->rooms_id == $rooms->rooms_id)
                                            <option selected>{{ old('--ห้อง--', $rooms->room_name) }}
                                        @endif
                                        </option>
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
                            </div> --}}
                            </div>
                            {{-- form-สัญลักษณ์-วันเกิด-รหัสประจำตัว --}}
                            <div class="row justify-content-center align-items-center g-2 mb-3">
                                <div class="col">
                                    <label for="birthdays" class="form-label">วันเกิด</label>
                                    <div class="input-group ">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="bi bi-calendar3"></i>
                                        </span>
                                        <input type="text" id="datepicker" name="birthdays" class="form-control "
                                            value="{{ old('birthdays', $datastudents->birthdays) }}"> {{-- ,$datastudents->birthdays --}}
                                    </div>
                                </div>

                                <div class="col">
                                    <label for="symbol" class="form-label">สัญลักษณ์</label>

                                    <select class="form-select" name="symbol">
                                        <option selected>{{ old('symbol', $datastudents->symbol) }}</option>
                                        {{-- ,$datastudents->symbol --}}
                                        <option value="ร่ม">ร่ม</option>
                                        <option value="บ้าน">บ้าน</option>
                                        <option value="ลูกบอล">ลูกบอล</option>
                                        <option value="โทรศัพท์">โทรศัพท์</option>
                                        <option value="ทับทิม">ทับทิม</option>
                                        <option value="ส้ม">ส้ม</option>
                                        <option value="ทุเรียน">ทุเรียน</option>
                                        <option value="กระต่าย">กระต่าย</option>
                                        <option value="รองเท้า">รองเท้า</option>
                                        <option value="หมู">หมู</option>
                                        <option value="เป็ด">เป็ด</option>
                                        <option value="แมลงปอ">แมลงปอ</option>
                                        <option value="ปลา">ปลา</option>
                                        <option value="ไอศครีม">ไอศครีม</option>
                                        <option value="ปู">ปู</option>
                                        <option value="แตงโม">แตงโม</option>
                                        <option value="พัด">พัด</option>
                                        <option value="ปลาหมึก">ปลาหมึก</option>
                                        <option value="กุหลาบ">กุหลาบ</option>
                                        <option value="มังคุด">มังคุด</option>
                                        <option value="พระอาทิตย์">พระอาทิตย์</option>
                                        <option value="ผีเสื้อ">ผีเสื้อ</option>
                                    </select>

                                    @error('symbol')
                                        <small id="helpId" class="text-muted">
                                            <span role="alert" class="text-danger">
                                                <strong> {{ $message }}</strong>
                                            </span>
                                        </small>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="id_tags" class="form-label">รหัสประจำตัว</label>

                                    <input type="text" name="id_tags" id="idtags" class="form-control"
                                        value="{{ old('id tags', $datastudents->id_tags) }}">

                                    @error('id_tags')
                                        <small id="helpId" class="text-muted">
                                            <span role="alert" class="text-danger">
                                                <strong> {{ $message }}</strong>
                                            </span>
                                        </small>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="numberid" class="form-label">เลขที่</label>

                                    <input type="text" name="numberid" id="numberid" class="form-control"
                                        value="{{ old('numberid', $datastudents->number) }}">

                                    @error('numberid')
                                        <small id="helpId" class="text-muted">
                                            <span role="alert" class="text-danger">
                                                <strong> {{ $message }}</strong>
                                            </span>
                                        </small>
                                    @enderror
                                </div>
                            </div>
                            {{-- form-ชื่อ-บิดา-มารดา-ผู้ปกครอง --}}
                            <div class="row justify-content-center align-items-center g-2 mb-3">
                                <div class="col">
                                    <label for="father" class="form-label">ชื่อ – นามสกุล (บิดา)</label>
                                    <input type="text" name="father" id="father" class="form-control"
                                        value="{{ old('father', $datastudents->father) }}">
                                    @error('father')
                                        <small id="helpId" class="text-muted">
                                            <span role="alert" class="text-danger">
                                                <strong> {{ $message }}</strong>
                                            </span>
                                        </small>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="mother" class="form-label">ชื่อ – นามสกุล (มารดา)</label>
                                    <input type="text" name="mother" id="mother" class="form-control"
                                        value="{{ old('mother', $datastudents->mother) }}">
                                    @error('mother')
                                        <small id="helpId" class="text-muted">
                                            <span role="alert" class="text-danger">
                                                <strong> {{ $message }}</strong>
                                            </span>
                                        </small>
                                    @enderror
                                </div>
                                {{-- <div class="col">
                                <label for="parents" class="form-label">ชื่อ – นามสกุล (ผู้ปกครอง)</label>
                                <select class="form-select" name="parents" aria-label="Default select example">
                                    @foreach ($parent as $parents)
                                        @if ($datastudents->parents_id == $parents->parents_id)
                                            <option selected>
                                                {{ old('--ผู้ปกกครอง--', $parents->prefix_name . $parents->first_name . ' ' . $parents->last_name) }}
                                            </option>
                                        @endif
                                        <option value="{{ $parents->parents_id }}">
                                            {{ $parents->prefix_name }}{{ $parents->first_name }}
                                            {{ $parents->last_name }}</option>
                                    @endforeach
                                </select>
                                @error('parents')
                                    <small id="helpId" class="text-muted">
                                        <span role="alert" class="text-danger">
                                            <strong> {{ $message }}</strong>
                                        </span>
                                    </small>
                                @enderror
                            </div> --}}
                            </div>
                            {{-- form-เบอร์ติดต่อ --}}
                            <div class="row justify-content-center align-items-center g-3 mb-3">
                                <div class="col">
                                    <label for="telephonenumberfather" class="form-label">เบอร์โทรบิดา</label>
                                    <input type="text" name="telephonenumberfather" id="telephonenumberfather"
                                        class="form-control"
                                        value="{{ old('telephonenumberfather', $datastudents->telephone_number_father) }}">
                                    @error('telephonenumberfather')
                                        <small id="helpId" class="text-muted">
                                            <span role="alert" class="text-danger">
                                                <strong> {{ $message }}</strong>
                                            </span>
                                        </small>
                                    @enderror

                                </div>
                                <div class="col">
                                    <label for="telephonenumbermother" class="form-label">เบอร์โทรมารดา</label>
                                    <input type="text" name="telephonenumbermother" id="telephonenumbermother"
                                        class="form-control"
                                        value="{{ old('telephonenumbermother', $datastudents->telephone_number_mother) }}">
                                    @error('telephonenumbermother')
                                        <small id="helpId" class="text-muted">
                                            <span role="alert" class="text-danger">
                                                <strong> {{ $message }}</strong>
                                            </span>
                                        </small>
                                    @enderror

                                </div>
                                <div class="col">
                                    <label for="telephonenumberbus" class="form-label">เบอร์โทรถรับส่ง</label>
                                    <input type="text" name="telephonenumberbus" id="telephonenumberbus"
                                        class="form-control"
                                        value="{{ old('telephonenumberbus', $datastudents->telephone_number_bus) }}">
                                    @error('telephonenumberbus')
                                        <small id="helpId" class="text-muted">
                                            <span role="alert" class="text-danger">
                                                <strong> {{ $message }}</strong>
                                            </span>
                                        </small>
                                    @enderror

                                </div>
                            </div>
                            {{-- form-ที่อยู่ --}}
                            <div class="row justify-content-center align-items-center g-2 mb-3">
                                <div class="col">
                                    <label for="exampleFormControlTextarea1" class="form-label">ที่อยู่</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" name="habitations" rows="3">{{ old('habitations', $datastudents->habitations) }}</textarea> {{-- ,$datastudents->habitations --}}
                                    @error('habitations')
                                        <small id="helpId" class="text-muted">
                                            <span role="alert" class="text-danger">
                                                <strong> {{ $message }}</strong>
                                            </span>
                                        </small>
                                    @enderror
                                </div>

                            </div>
                            <div class="row justify-content-center align-items-end">
                                <div class="col text-end">
                                    <button type="submit" class="btn btn-primary ">บันทึก</button>
                                    <a name="" id="" class="btn btn-danger"
                                    href="{{ route('teacher.room') }}" role="button">ยกเลิก</a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
