@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center g-2">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('ลงเวลามาเรียน-กลับบ้าน') }} {{ $datenow }}</div>

                    <div class="card-body">
                        @if ($message = Session::get('error'))
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
                                    {{-- @dd($student->max('$datenow'),$datenow) --}}
                                    @if ($student->max('c_date') == $datenow)
                                        <div class="mb-3">
                                            <label for="" class="form-label">เวลามาโรงเรียนแล้วนะ</label>
                                            <input class="form-control" type="text" value="{{ __('ลงเวลาแล้ว') }}"
                                                aria-label="readonly input example" disabled>
                                        </div>
                                    @else
                                        <div class="mb-3">
                                            <label for="" class="form-label">เวลามาโรงเรียน</label>
                                            <input class="form-control" name="checkin" type="text"
                                                value="{{ $timenow }}" aria-label="readonly input example" readonly>
                                        </div>
                                    @endif
                                </div>
                                {{-- เวลากลับบ้าน --}}
                                <div class="col">
                                    {{-- @dd(empty($check_student[0]->c_out))  --}}
                                    @if ($timenow > '16:30:00')
                                        @if (empty($check_student[0]->c_out))
                                            <div class="mb-3">
                                            <label for="" class="form-label">เวลากลับบ้าน</label>
                                            <input class="form-control" name="checkout" type="text"
                                                value="{{ $timenow }}" aria-label="readonly input example" readonly>
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
                                        <input class="form-control"  type="text"
                                            value="{{ __('หลัง 13.00 น.') }}" aria-label="readonly input example" readonly>
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
                                    <table class="table table-primary">
                                        <thead>
                                            <tr>
                                                <th scope="col">date</th>
                                                <th scope="col">work-in</th>
                                                <th scope="col">work-out</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($student as $students)
                                                <tr class="">
                                                    <td scope="row">{{ $students->c_date }}</td>
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
