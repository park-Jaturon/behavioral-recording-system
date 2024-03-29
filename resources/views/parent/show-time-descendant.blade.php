@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row justify-content-start align-items-center g-2">
                        <div class="col-md-4">
                            <a class="btn btn-info" href="{{ route('home.parent') }}" role="button"><i
                                class="bi bi-chevron-left"></i>กลับ</a>
                        </div>
                        <div class="col-md-4 text-center">
                            {{ __('เวลามาเรียน - เวลากลับบ้าน') }}
                        </div>
                        <div class="col-md-4 text-end">
                            {{ $students->prefix_name . $students->first_name . ' ' . $students->last_name }}
                        </div>
                    </div>
                    
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">วันที่</th>
                                    <th scope="col">มาเรียน</th>
                                    <th scope="col">กลับบ้าน</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($check_student as $students)
                                    <tr >
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
@endsection