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
                        <form action="{{ route('store.parents') }}" method="post">
                            @csrf

                            {{-- form-ชื่อ-นามสกุล  --}}
                            <div class="row justify-content-center align-items-center g-3 mb-3">
                                <div class="col">
                                    <label for="prefix" class="form-label">คำนำหน้าชื่อ</label>
                                    <select class="form-select" name="prefix" aria-label="Default select example">
                                        <option selected>{{ old('--คำนำหน้าชื่อ--') }}</option> {{-- ,$teachers->prefix_name --}}
                                        <option value="นาย">นาย</option>
                                        <option value="นาง">นาง</option>
                                        <option value="นางสาว">นางสาว</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label for="firstname" class="form-label">ชื่อ</label>
                                    <input type="text" name="firstname" id="firstname" value="{{ old('firstname') }}"
                                        class="form-control"> {{-- ,$teachers->first_name --}}
                                </div>
                                <div class="col">
                                    <label for="lastname" class="form-label">นามสกุล</label>
                                    <input type="text" name="lastname" id="lastname" class="form-control"
                                        value="{{ old('lastname') }}"> {{-- ,$teachers['last_name'] --}}
                                </div>
                            </div>

                            {{-- form-ความสัมพันธ์กับเด็ก-อาชีพ --}}
                            <div class="row justify-content-center align-items-center g-3 mb-3">
                                <div class="col">
                                    <label for="relationship" class="form-label">ความสัมพันธ์กับเด็ก</label>
                                    <input type="text" name="relationship" id="relationship" class="form-control"
                                        value="{{ old('relationship') }}"> {{-- ,$teachers['last_name'] --}}
                                </div>
                                <div class="col">
                                    <label for="job" class="form-label">อาชีพ</label>
                                    <input type="text" name="job" id="job" class="form-control"
                                        value="{{ old('job') }}"> {{-- ,$teachers['last_name'] --}}
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
