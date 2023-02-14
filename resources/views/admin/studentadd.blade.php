@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center g-2">

            <div class="card">
                <div class="card-header">
                    <h3>ปวะวัตินักเรียน</h3>
                </div>
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            {{ $message }}
                        </div>
                    @endif

                    <form action="{{empty($data->student_id) ? route('store.student') : url('admin/student/update/'.$data->student_id)}}" method="post">
                        @if (!empty($data->student_id))
                            @method('put')
                        @endif
                        @csrf
                        {{-- form-ชื่อ-นามสกุล  --}}
                        <div class="row justify-content-center align-items-center g-3 mb-3">
                            <div class="col">
                                <label for="prefix" class="form-label">คำนำหน้าชื่อ</label>
                                <select class="form-select" name="prefix" aria-label="Default select example">
                                    <option selected>{{ old('prefix_name', $data->prefix_name) }}</option>
                                    {{-- ,$data->prefix_name --}}
                                    <option value="เด็กชาย">เด็กชาย</option>
                                    <option value="เด็กหญิง">เด็กหญิง</option>
                                </select>
                            </div>
                            <div class="col">
                                <label for="firstname" class="form-label">ชื่อ</label>
                                <input type="text" name="firstname" id="firstname"
                                    value="{{ old('firstname', $data->first_name) }}" class="form-control">
                                {{-- ,$data->first_name --}}
                            </div>
                            <div class="col">
                                <label for="lastname" class="form-label">นามสกุล</label>
                                <input type="text" name="lastname" id="lastname" class="form-control"
                                    value="{{ old('lastname', $data->last_name) }}"> {{-- ,$data['last_name'] --}}
                            </div>
                            <div class="col">
                                <label for=" " class="form-label">ห้อง</label>
                                <select class="form-select" name="room" aria-label="Default select example">
                                    @foreach ($room as $rooms)
                                        @if ($data->rooms_id == $rooms->rooms_id)
                                            <option selected>{{ old('--ห้อง--', $rooms->room_name) }}
                                        @endif
                                        </option>
                                        <option value="{{ $rooms->rooms_id }}"> {{ $rooms->room_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- form-สัญลักษณ์-วันเกิด-รหัสประจำตัว --}}
                        <div class="row justify-content-center align-items-center g-2 mb-3">
                            <div class="col">
                                <label for="birthdays" class="form-label">วันเกิด</label>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="bi bi-calendar3"></i>
                                    </span>
                                    <input type="text" id="datepicker" name="birthdays" class="form-control "
                                        value="{{ old('birthdays', $data->birthdays) }}"> {{-- ,$data->birthdays --}}
                                </div>
                            </div>
                            {{-- @vite(['resources/js/datepicker-th.js']) --}}
                            <div class="col">
                                <label for="symbol" class="form-label">สัญลักษณ์</label>
                                <div class="input-group mb-3">
                                    <select class="form-select" name="symbol">
                                        <option selected>{{ old('symbol', $data->symbol) }}</option> {{-- ,$data->symbol --}}
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
                                </div>


                            </div>
                            <div class="col">
                                <label for="idtags" class="form-label">รหัสประจำตัว</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="idtags" id="idtags" class="form-control"
                                        value="{{ old('idtags', $data->id_tags) }}"> {{-- ,$data->id_tags- --}}
                                </div>
                            </div>
                            <div class="col">
                                <label for="numberid" class="form-label">เลขที่</label>
                                <div class="input-group mb-3">
                                    <input type="text" name="numberid" id="numberid" class="form-control"
                                        value="{{ old('numberid', $data->number) }}"> {{-- ,$data->id_tags- --}}
                                </div>
                            </div>
                        </div>
                        {{-- form-ชื่อ-บิดา-มารดา-ผู้ปกครอง --}}
                        <div class="row justify-content-center align-items-center g-2 mb-3">
                            <div class="col">
                                <label for="father" class="form-label">ชื่อ – นามสกุล (บิดา)</label>
                                <input type="text" name="father" id="father" class="form-control"
                                    value="{{ old('father', $data->father) }}"> {{-- ,$data->parents1 --}}
                            </div>
                            <div class="col">
                                <label for="mother" class="form-label">ชื่อ – นามสกุล (มารดา)</label>
                                <input type="text" name="mother" id="mother" class="form-control"
                                    value="{{ old('mother', $data->mother) }}"> {{-- ,$data->parents2 --}}
                            </div>
                            <div class="col">
                                <label for="parents" class="form-label">ชื่อ – นามสกุล (ผู้ปกครอง)</label>
                                <select class="form-select" name="parents" aria-label="Default select example">
                                    @foreach ($parent as $parents)
                                        @if ($data->parents_id == $parents->parents_id)
                                            <option selected>
                                                {{ old('--ผู้ปกกครอง--', $parents->prefix_name . $parents->first_name . ' ' . $parents->last_name) }}
                                            </option>
                                        @endif
                                        <option value="{{ $parents->parents_id }}">
                                            {{ $parents->prefix_name }}{{ $parents->first_name }}
                                            {{ $parents->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{-- form-เบอร์ติดต่อ --}}
                        <div class="row justify-content-center align-items-center g-3 mb-3">
                            <div class="col">
                                <label for="telephonenumberfather" class="form-label">เบอร์โทรบิดา</label>
                                <input type="text" name="telephonenumberfather" id="telephonenumberfather"
                                    class="form-control" value="{{ old('telephonenumberfather',$data->telephone_number_father) }}">
                                {{-- ,$data->telephone_number_parents1 --}}

                            </div>
                            <div class="col">
                                <label for="telephonenumbermother" class="form-label">เบอร์โทรมารดา</label>
                                <input type="text" name="telephonenumbermother" id="telephonenumbermother"
                                    class="form-control" value="{{ old('telephonenumbermother',$data->telephone_number_mother) }}">
                                {{-- ,$data->telephone_number_parents2 --}}

                            </div>
                            <div class="col">
                                <label for="telephonenumberbus" class="form-label">เบอร์โทรถรับส่ง</label>
                                <input type="text" name="telephonenumberbus" id="telephonenumberbus"
                                    class="form-control" value="{{ old('telephonenumberbus',$data->telephone_number_bus) }}">
                                {{-- ,$data->telephone_number_bus --}}

                            </div>
                        </div>
                        {{-- form-ที่อยู่ --}}
                        <div class="row justify-content-center align-items-center g-2 mb-3">
                            <div class="col">
                                <label for="exampleFormControlTextarea1" class="form-label">ที่อยู่</label>
                                <textarea class="form-control" id="exampleFormControlTextarea1" name="habitations" rows="3">{{ old('habitations',$data->habitations) }}</textarea> {{-- ,$data->habitations --}}
                            </div>

                        </div>
                        <button type="submit" class="btn btn-primary float-end">
                            บันทึก
                        </button>
                    </form>

                </div>
                <div class="card-footer text-muted">
                    Footer
                </div>
            </div>
        </div>
    </div>
    
@endsection

@section('script')
<script src="\js\datepicker-th.js"></script>
@endsection
