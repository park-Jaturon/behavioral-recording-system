@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        {{ __('แบบประเมินพัฒนาการ ') }}
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class=" text-center">เลขที่</th>
                                    <th scope="col" class=" text-center">ชื่อ - นามสกุล</th>
                                    <th scope="col" class=" text-center">ห้อง</th>
                                    <th scope="col" class=" text-center">แบบประเมินพัฒนาการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $data)
                                    <tr>
                                        <th scope="row" class=" text-center">{{ $data->number }}</th>
                                        <td>
                                            <a href="{{ url('teacher/record/appraisal/add/' . $data->student_id) }}"
                                                style="text-decoration: none;">
                                                {{ $data->prefix_name . $data->first_name . ' ' . $data->last_name }}
                                            </a>
                                        </td>
                                        <td class=" text-center">{{ $data->room_name }}</td>
                                        <td class=" text-center">
                                            <a class="btn btn-primary"
                                                href="{{ url('teacher/record/appraisal/show/' . $data->student_id) }}"
                                                role="button">ดูบันทึก</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- c2 --}}

            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        {{ __('กราฟ ') }}
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div id="myChart" style="height: 400px;"></div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
       
        var myChart = echarts.init(document.getElementById('myChart'));

        var option = {
            title: {
                text: 'Referer of a Website',
                subtext: 'Fake Data',
                left: 'center'
            },
            tooltip: {
                trigger: 'item'
            },
            legend: {
                orient: 'vertical',
                left: 'left'
            },
            series: [{
                name: 'Access From',
                type: 'pie',
                radius: '50%',
                data: [{
                        value: 1048,
                        name: 'พัฒนาการด้านร่างกาย'
                    },
                    {
                        value: 735,
                        name: 'พัฒนาการด้านอารมณ์และจิตใจ'
                    },
                    {
                        value: 580,
                        name: 'พัฒนาการด้านสังคม'
                    },
                    {
                        value: 484,
                        name: 'พัฒนาการด้านสติปัญญา'
                    }
                ],
                emphasis: {
                    itemStyle: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)'
                    }
                }
            }]
        };

        myChart.setOption(option);
    </script>
@endsection
