@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-between">
                            <div class="col-4">
                                {{ __('รูปกิจกรรม') }}
                            </div>

                            <div class="col-3 text-end">
                                <select class="form-select" aria-label="Default select example" onchange="selectLevel(value)">
                                    {{--  id="selectLevel" --}}
                                    <option class="text-center" selected disabled>---ระดับชั้น---</option>
                                    <option class="text-center" value="1">อบ2</option>
                                    <option class="text-center" value="2">อบ3</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            {{-- <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">วันที่</th>
                                        <th scope="col">เรื่อง</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($event2 as $events)
                                        <tr class="">
                                            <td scope="row">
                                                {{ date('d-m-Y ', strtotime($events->start)) }}
                                            </td>
                                            <td>
                                                <a
                                                    href="{{ url('parent/descendant/activity/show/image/' . $events->events_id) }}">{{ $events->title }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <li id="result"></li>
                                </tbody>
                            </table> --}}
                            <table table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">วันที่</th>
                                        <th scope="col">เรื่อง</th>
                                    </tr>
                                </thead>
                                <tbody id="result">
                                    <!-- ตารางผลลัพธ์จะถูกแสดงที่นี่ -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('script')
    <script>
        let text = ""; // ประกาศตัวแปร text ในขอบเขตที่กว้างขึ้น
        let levels1 = {!! $event !!};
        let levels2 = {!! $event2 !!};

        function selectLevel(value) {
            console.log(value);

            if (value == 1) {
                text = "";
                levels2.forEach(myFunction);
                document.getElementById("result").innerHTML = text;
            } else if (value == 2) {
                text = "";
                levels1.forEach(myFunction);
                document.getElementById("result").innerHTML = text;
            }
        }

        function formatDate(inputDate) {
            const [datePart, timePart] = inputDate.split(' ');
            const [year, month, day] = datePart.split('-');
            return `${day}-${month}-${year}`;
        }

        function myFunction(item, index) {
            text += `<tr>
                <td>
                    ${formatDate(item.start)}
                </td>
                <td>
                    <a href="${$url}/parent/descendant/activity/show/image/${item.events_id}">${item.title}</a>
                </td>
                </tr>`;

        }
    </script>
@endsection
