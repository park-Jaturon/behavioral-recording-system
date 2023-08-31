@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8      ">
                <div class="card">
                    <div class="card-header">
                        @if (Auth::user()->rank == 'teacher' || Auth::user()->rank == 'parent')
                            {{ $username->prefix_name . $username->first_name . ' ' . $username->last_name }}
                        @else
                            {{ __('เปลี่ยนรหัสผ่าน' . ' ' . $iduser->rank) }}
                        @endif
                    </div>
                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success">
                                {{ $message }}
                            </div>
                        @endif
                        <form method="POST" action="{{ url('/profile/update/' . $iduser->users_id) }}">
                            @csrf
                            <div class="mb-3 row">
                                <label for="inputName" class="col-4 col-form-label">{{ __('IDName') }}</label>
                                <div class="col-8">
                                    <input type="text" class="form-control" name="name" id="inputName"
                                        value="{{ old('name', $iduser->users_name) }}" placeholder="Name">
                                </div>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <label for="inputName" class="col-4 col-form-label">{{ __('Password') }}</label>
                                <div class="col-8">
                                    <input type="password" class="form-control" @error('password') is-invalid @enderror"
                                        name="password" id="password" placeholder="Password">
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 row">
                                <div class="offset-sm-4 col-sm-8 text-end">
                                    <button type="submit" class="btn btn-primary ">{{ __('บันทึก') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
