@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center g-2">
            <div class="col-6">
                <h3>Admin</h3>
            </div>
            <div class="col-6 text-end">
                <a name="add" id="add" class="btn btn-primary" href="{{route('registeradmin')}}" role="button">เพิ่ม</a>
            </div>
        </div>
        <div class="row justify-content-center align-items-center g-2">
            @if ($message = Session::get('success'))
            <div class="alert alert-success">
                {{ $message }}
            </div>
        @endif
            <div class="col-8">
                <div class="table-responsive">
                    <table id="tbAdmin" class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col" class=" text-center">ID</th>
                                {{-- <th scope="col">แก้ไข</th> --}}
                                <th scope="col">ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($IDAdmin as $ID)
                            <tr class="">
                                <td scope="row" class=" text-center">{{ $ID->users_name }}</td>
                                {{-- <td><a name="" id="" class="btn btn-primary" href="#" role="button">แก้ไข</a></td> --}}
                                <td>
                                    <button type="button" class="btn btn-danger delete-item"
                                            data-admin_id="{{ $ID->users_id}}">ลบ</button>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
<script src="\js\confirm-delete-admin.js"></script>
@endsection