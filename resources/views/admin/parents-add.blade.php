@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mb-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        @if (empty($dataParent->parents_id))
                            {{ __('เพิ่มข้อมูลผู้ปกครอง') }}
                        @else
                            {{ __('แก้ไขข้อมูลผู้ปกครอง') }}
                        @endif

                    </div>

                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                {{ $message }}
                            </div>
                        @endif
                        <form
                            action="{{ empty($dataParent->parents_id) ? route('store.parents') : url('admin/parent/update/' . $dataParent->parents_id) }}"
                            method="post">
                            @if (!empty($dataParent->parents_id))
                                @method('put')
                            @endif
                            @csrf

                            {{-- form-ชื่อ-นามสกุล  --}}
                            <div class="row justify-content-center align-items-center g-3 mb-3">
                                <div class="col">
                                    <label for="prefix" class="form-label">คำนำหน้าชื่อ</label>
                                    <select class="form-select" name="prefix" aria-label="Default select example">
                                        <option selected>{{ old('--คำนำหน้าชื่อ--', $dataParent->prefix_name) }}</option>
                                        {{-- ,$dataParent->prefix_name --}}
                                        <option value="นาย">นาย</option>
                                        <option value="นาง">นาง</option>
                                        <option value="นางสาว">นางสาว</option>
                                    </select>
                                    @error('prefix')
                                        <span role="alert" class="text-danger">
                                            <strong> {{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="firstname" class="form-label">ชื่อ</label>
                                    <input type="text" name="firstname" id="firstname"
                                        value="{{ old('firstname', $dataParent->first_name) }}" class="form-control">
                                    <small id="helpId" class="text-muted">
                                        @error('firstname')
                                            <span role="alert" class="text-danger">
                                                <strong> {{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </small>
                                </div>
                                <div class="col">
                                    <label for="lastname" class="form-label">นามสกุล</label>
                                    <input type="text" name="lastname" id="lastname" class="form-control"
                                        value="{{ old('lastname', $dataParent->last_name) }}">
                                    @error('lastname')
                                        <small id="helpId" class="text-muted">
                                            <span role="alert" class="text-danger">
                                                <strong> {{ $message }}</strong>
                                            </span>
                                        </small>
                                    @enderror
                                </div>
                            </div>

                            {{-- form-ความสัมพันธ์กับเด็ก-อาชีพ --}}
                            <div class="row justify-content-center align-items-center g-3 mb-3">
                                <div class="col">
                                    <label for="relationship" class="form-label">ความสัมพันธ์กับเด็ก</label>
                                    <input type="text" name="relationship" id="relationship" class="form-control"
                                        value="{{ old('relationship', $dataParent->relationship) }}">
                                    <small id="helpId" class="text-muted"> @error('relationship')
                                            <span role="alert" class="text-danger">
                                                <strong> {{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </small>
                                </div>
                                <div class="col">
                                    <label for="job" class="form-label">อาชีพ</label>
                                    <input type="text" name="job" id="job" class="form-control"
                                        value="{{ old('job', $dataParent->job) }}">
                                    <small id="helpId" class="text-muted"> @error('job')
                                            <span role="alert" class="text-danger">
                                                <strong> {{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </small>
                                </div>
                            </div>

                            <div class="row justify-content-end align-items-center g-2">
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('บันทึก') }}
                                    </button>
                                </div>
                                <div class="col-auto">
                                    <a name="" id="" class="btn btn-danger"
                                        href="{{ route('index.manageparents') }}" role="button"> ยกเลิก</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @isset($dataParent->parents_id)
            <div class="row justify-content-around align-items-center g-2">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            แก้ไขนักเรียนในปกครอง
                        </div>
                        <div class="card-body">
                            @foreach ($dataParent->students as $Dstuden)
                                <div class="row justify-content-start align-items-center g-2 mb-1">
                                    <div class="col-md-auto">
                                        <label for="parents" class="form-label">นักเรียนในปกครอง</label>
                                    </div>
                                    <div class="col-md-auto">
                                        <input class="form-control" type="text"
                                            placeholder="{{ $Dstuden->prefix_name . $Dstuden->first_name . ' ' . $Dstuden->last_name }}"
                                            aria-label="Disabled input example" disabled readonly>
                                        <input type="hidden" id="studentAll" data-id="{{ $Dstuden->student_id }}"
                                            name="student_section[]" value="{{ $Dstuden->student_id }}" />
                                    </div>
                                    <div class="col-md-auto">
                                        <label for="parents" class="form-label">ชื่อ – นามสกุล (ผู้ปกครอง)</label>
                                    </div>
                                    <div class="col-md-auto">
                                        <select class="form-select" id="parentAll" name="parents[]"
                                            aria-label="Default select example">
                                            <option value="{{ $dataParent->parents_id }}" selected>
                                                {{ old('--ผู้ปกกครอง--', $dataParent->prefix_name . $dataParent->first_name . ' ' . $dataParent->last_name) }}
                                            </option>
                                            @foreach ($parent as $parents)
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
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="card-footer text-muted">
                            <div class="row justify-content-end align-items-center g-2">
                                <div class="col-auto">
                                    <button type="button" class="btn btn-primary" onclick="btnSave()">
                                        {{ __('บันทึก') }}
                                    </button>
                                </div>
                                <div class="col-auto">
                                    <a name="" id="" class="btn btn-danger"
                                        href="{{ route('index.manageparents') }}" role="button"> ยกเลิก</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endisset
    </div>
@endsection
@section('script')
    <script>
        function btnSave() {
            let studentAll = document.querySelectorAll('#studentAll');
            let parentAll = document.querySelectorAll('#parentAll');

            let param = [];

            studentAll.forEach((studentElement, index) => {
                let student_id = studentElement.getAttribute('data-id');
                let parentElement = parentAll[index];
                let parent_id = parentElement.value;

                // สร้างออบเจ็กต์ที่มี student_id และ parent_id แล้วเพิ่มเข้าในอาเรย์ param
                param.push({
                    student_id: student_id,
                    parent_id: parent_id
                });
            });

            // param ตอนนี้จะเก็บข้อมูล student_id กับ parent_id แต่ละคู่
            console.log(param);
            axios.post('/api/parentedit', param).then((response) => {
                console.log(response);
                if (response.data.status == 'success') {
                    location.href = "/admin/manage/parents";
                }
            })
        }
    </script>
@endsection
