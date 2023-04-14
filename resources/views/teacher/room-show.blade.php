@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('ประวัตินักเรียน') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        
                        <div class="container ">
                            <div class="row">
                                <div class=" col">
                                    <label for="prefix" class="col-sm-4 col-form-label text-start">ชื่อ – นามสกุล
                                        (นักเรียน)</label>
                                </div>
                            </div>
                            <div class="row justify-content-md-center align-items-center g-2 mb-3">
                                <div class=" col">
                                    <input class="form-control" type="text"
                                        value="{{ $datastudents->prefix_name . $datastudents->first_name . ' ' . $datastudents->last_name }}"
                                        aria-label="readonly input example" readonly>
                                </div>
                            </div>

                            <div class="row justify-content-center align-items-center g-2 mb-3">
                                <div class="mb-3 col">
                                    <label for="birthdays" class=" col-form-label">วันเกิด</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text"
                                            value="{{ $datastudents->birthdays }}" aria-label="readonly input example"
                                            readonly>

                                    </div>
                                </div>

                                <div class="mb-3 col">
                                    <label for="symbol" class="col-form-label">สัญลักษณ์</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" value="{{ $datastudents->symbol }}"
                                            aria-label="readonly input example" readonly>

                                    </div>
                                </div>

                                <div class="mb-3 col">
                                    <label for="idtags" class=" col-form-label">รหัสประจำตัว</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" value="{{ $datastudents->id_tags }}"
                                            aria-label="readonly input example" readonly>

                                    </div>
                                </div>

                                <div class="mb-3 col">
                                    <label for="numberid" class=" col-form-label">เลขที่</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" value="{{ $datastudents->number }}"
                                            aria-label="readonly input example" readonly>

                                    </div>
                                </div>

                            </div>

                            <div class="row justify-content-center align-items-center g-2 mb-3">
                                <div class="mb-3 col">
                                    <label for="father" class=" col-form-label">ชื่อ – นามสกุล (บิดา)</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" value="{{ $datastudents->father }}"
                                            aria-label="readonly input example" readonly>

                                    </div>
                                </div>

                                <div class="mb-3 col">
                                    <label for="mother" class=" col-form-label">ชื่อ – นามสกุล (มารดา)</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" value="{{ $datastudents->mother }}"
                                            aria-label="readonly input example" readonly>

                                    </div>
                                </div>

                            </div>

                            <div class="row justify-content-center align-items-center g-3 mb-3">
                                <div class="mb-3 col">
                                    <label for="telephonenumberfather" class=" col-form-label">เบอร์โทรบิดา</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text"
                                            value="{{ $datastudents->telephone_number_fatherr }}"
                                            aria-label="readonly input example" readonly>

                                    </div>
                                </div>

                                <div class="mb-3 col">
                                    <label for="telephonenumbermother" class="col-form-label">เบอร์โทรมารดา</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text"
                                            value="{{ $datastudents->telephone_number_mother }}"
                                            aria-label="readonly input example" readonly>

                                    </div>
                                </div>

                                <div class="mb-3 col">
                                    <label for="telephonenumberbus" class=" col-form-label">เบอร์โทรถรับส่ง</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text"
                                            value="{{ $datastudents->telephone_number_bus }}"
                                            aria-label="readonly input example" readonly>

                                    </div>
                                </div>

                            </div>

                            <div class="row">
                                <div class=" col">
                                    <label for="prefix" class="col-sm-4 col-form-label text-start">ที่อยู่</label>
                                </div>
                            </div>
                            <div class="row justify-content-md-center align-items-center g-2 mb-3">
                                <div class=" col">
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" readonly>{{ $datastudents->habitations }}</textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
