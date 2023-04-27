@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <a href="{{ route('add.parents') }}" class=" btn btn-primary float-end">เพิ่ม</a>
            </div>
            <div class="col-md-8">
                <table id="tbParent" class="table table-striped">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">id</th>
                            <th class="text-center" scope="col">ชื่อ-นามสกุล</th>
                            <th class="text-center" scope="col">อาชีพ</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($parent as $parents)
                            <tr>
                                <td class="text-center" scope="row">{{ $parents->parents_id }}</td>
                                <td>{{ $parents->prefix_name . $parents->first_name . ' ' . $parents->last_name }}</td>
                                <td class="text-center">{{ $parents->job }}</td>
                                <td class="text-center">
                                    <a
                                        class="btn btn-warning "href="{{ url('admin/parent/edit/' . $parents->parents_id) }}"role="button">แก้ไข</a>
                                </td>
                                <td>
                                    <div class="d-grid gap-2">
                                        <button type="button" class="btn btn-danger delete-item"
                                            data-parents_id="{{ $parents->parents_id }}">ลบ</button>
                                        {{-- @vite(['resources\js\confirm-delete-parents.js']) --}}
                                    </div>
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