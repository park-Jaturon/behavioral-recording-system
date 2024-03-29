@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center g-2">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-start align-items-center g-2">
                            <div class="col-4 text-start">
                                <a class="btn btn-info" href="{{ route('index.check') }}" role="button"><i
                                    class="bi bi-chevron-left"></i>กลับ</a>
                            </div>
                            <div class="col-4 text-center">
                                {{ __('ลงเวลามาเรียน-กลับบ้าน' . ' ' . date('d/m/Y', strtotime($datenow))) }}
                            </div>
                        </div>


                    </div>
                    <div class="card-body">
                        @if ($message = Session::get('Error'))
                        <div class="alert alert-danger" role="alert">
                            {{ $message }}
                          </div>
                            
                        @endif
                        @if ($message = Session::get('Messages'))
                            <div class="alert alert-success">
                                {{ $message }}
                            </div>
                        @endif
                        <form action="{{ url('teacher/store/check/' . $data->student_id) }}" method="post">
                            @csrf
                            <div class="row justify-content-center align-items-center g-2">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="" class="form-label">เลขที่</label>
                                        <input type="text" class="form-control" value="{{ $data->number }}"
                                            aria-describedby="helpId" placeholder="" readonly>
                                        {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="" class="form-label">ชื่อ-นามสกุล</label>
                                        <input type="text" class="form-control"
                                            value="{{ $data->prefix_name . $data->first_name . ' ' . $data->last_name }}"
                                            aria-describedby="helpId" placeholder="" readonly>
                                        {{-- <small id="helpId" class="form-text text-muted">Help text</small> --}}
                                    </div>
                                </div>
                                {{-- เวลามาโรงเรียน --}}
                                <div class="col">
                                    {{-- @dd($latest_date,$datenow) --}}
                                    @if ($timenow >= $setTime->time_in_start && $timenow <= $setTime->time_in_end)
                                        @if ($latest_date == $datenow)
                                            <div class="mb-3">
                                                <label for="" class="form-label">เวลามาโรงเรียน</label>
                                                <input class="form-control text-center" type="text"
                                                    value="{{ __('ลงเวลาแล้ว') }}" aria-label="readonly input example"
                                                    disabled>
                                            </div>
                                        @else
                                            <div class="mb-3">
                                                <label for="" class="form-label">เวลามาโรงเรียน</label>
                                                <input class="form-control" name="checkin" type="text"
                                                    value="{{ $timenow }}" aria-label="readonly input example"
                                                    readonly>
                                            </div>
                                        @endif
                                    @else
                                        <div class="mb-3">
                                            <label for="" class="form-label">เวลามาโรงเรียน</label>
                                            <input class="form-control bg-secondary text-light text-center" type="text"
                                                value="{{ __('07.00-08.00') }}" aria-label="readonly input example"
                                                disabled>
                                        </div>
                                    @endif

                                </div>
                                {{-- เวลากลับบ้าน --}}
                                <div class="col">
                                    {{-- @dd(empty($check_student[0]->c_out))  --}}
                                    @if ($timenow >= $setTime->time_out_start && $timenow <= $setTime->time_out_end)
                                        @if (empty($check_student[0]->c_out))
                                            <div class="mb-3">
                                                <label for="" class="form-label">เวลากลับบ้าน</label>
                                                <input class="form-control" name="checkout" type="text"
                                                    value="{{ $timenow }}" aria-label="readonly input example"
                                                    readonly>
                                            </div>
                                        @endif
                                        @if (!empty($check_student[0]->c_out))
                                            <div class="mb-3">
                                                <label for="" class="form-label">เวลากลับบ้าน</label>
                                                <input class="form-control" type="text" value="{{ __('กลับบ้านแล้ว') }}"
                                                    aria-label="readonly input example" disabled>
                                            </div>
                                        @endif
                                    @else
                                        <div class="mb-3">
                                            <label for="" class="form-label">เวลากลับบ้าน</label>
                                            <input class="form-control bg-secondary text-light text-center" type="text"
                                                value="{{ __('15.00-18.00') }}" aria-label="readonly input example"
                                                readonly>
                                        </div>
                                    @endif
                                </div>

                                <div class="row mb-0 ">
                                    <div class="col-md-8 offset-md-4 ">
                                        <button type="submit" class="btn btn-primary float-end">
                                            {{ __('บันทึก') }}
                                        </button>
                                    </div>
                                </div>

                            </div>
                        </form>
                        {{-- List --}}
                        <div class="row justify-content-center align-items-center g-2">
                            <div class="col my-3">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th scope="col">วันที่</th>
                                                <th scope="col">เวลามาโรงเรียน</th>
                                                <th scope="col">เวลากลับบ้าน</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($student as $students)
                                                <tr class="">
                                                    <td scope="row">
                                                        {{ date('d/m/Y', strtotime($students->c_date)) }}
                                                    </td>
                                                    <td>{{ $students->c_in }}</td>
                                                    <td>{{ $students->c_out }}</td>
                                                </tr>
                                            @endforeach


                                        </tbody>
                                    </table>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
