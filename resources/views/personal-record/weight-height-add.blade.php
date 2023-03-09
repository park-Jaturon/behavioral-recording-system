@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form action="" method="post">
                            @csrf

                            <table class="table table-bordered border-dark">
                                <thead>
                                    <tr align="center" valign="middle">
                                        <th rowspan="2">ครั้งที่</th>
                                        <th rowspan="2">ปีการศึกษา</th>
                                        <th rowspan="2">ภาคเรียนที่</th>
                                        <th rowspan="2" style="width: 55px">ว/ด/ป</th>
                                        <th rowspan="2">อายุ(ป/ต)</th>
                                        <th rowspan="2">น้ำหนัก(ก.ก)</th>
                                        <th rowspan="2">ส่วนสูง(ซ.ม)</th>
                                        <th colspan="4">ภาววะโชนาการ</th>
                                    </tr>
                                    <tr align="center" valign="middle">
                                        <th>น้ำหนักต่ำกว่าเกณฑ์</th>
                                        <th>ส่วนสูงต่ำกว่าเกณฑ์</th>
                                        <th>น้ำหนักและส่วนสูงต่ำกว่าเกณฑ์</th>
                                        <th>น้ำหนักและส่วนสูงตามเกณฑ์มาตรฐาน</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <tr>
                                        <td><input class="form-control" type="text" placeholder="ครั้งที่"
                                                aria-label="default input example"></td>
                                        <td>
                                            2
                                        </td>
                                        <td>3</td>
                                        <td>4</td>
                                        <td>5</td>
                                        <td>6</td>
                                        <td>7</td>
                                        <td>8</td>
                                        <td>9</td>
                                        <td>10</td>
                                        <td>11</td>
                                    </tr>

                                </tbody>
                            </table>

                            <button type="submit" class="btn btn-primary float-end">
                                {{ __('บันทึก') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
