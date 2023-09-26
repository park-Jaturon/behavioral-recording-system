@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-start align-items-center g-2">
            <div class="col-md-4">
                <a class="btn btn-info" href="{{ route('admindashboard') }}" role="button"><i
                        class="bi bi-chevron-left"></i>กลับ</a>
            </div>
            <div class="col-md-4 text-center">
                <h3>ผู้ปกครอง</h3>
            </div>
            <div class="col-md-4 text-end">
                <a href="{{ route('add.parents') }}" class=" btn btn-primary float-end">เพิ่ม</a>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <table id="tbParent" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">ชื่อ-นามสกุล</th>
                            <th class="text-center" scope="col">นักเรียนในปกครอง</th>
                            <th class="text-center" scope="col">อาชีพ</th>
                            <th class="text-center" scope="col"></th>
                            <th class="text-center" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($parent as $parents)
                            <tr>
                                <td>{{ $parents->prefix_name . $parents->first_name . ' ' . $parents->last_name }}</td>
                                <td>
                                    @foreach ($parents->students as $Dstuden)
                                       
                                            {{ $Dstuden->prefix_name . $Dstuden->first_name . ' ' . $Dstuden->last_name }}
                                      <br>
                                    @endforeach
                                </td>
                                <td class="text-center">{{ $parents->job }}</td>
                                <td class="text-center">
                                    <a
                                        class="btn btn-warning "href="{{ url('admin/parent/edit/' . $parents->parents_id) }}"role="button">แก้ไข</a>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger delete-item"
                                        data-parents_id="{{ $parents->parents_id }}">ลบ</button>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="\js\confirm-delete-parents.js"></script>
@endsection
