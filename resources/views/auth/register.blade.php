@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('IDName') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" required autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col text-center">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                        id="inlineRadio1" value="teacher">
                                    <label class="form-check-label" for="inlineRadio1">ครู</label>

                                </div>
                                <div class="col">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                        id="inlineRadio2" value="parent">
                                    <label class="form-check-label" for="inlineRadio2">ผู้ปกครอง</label>
                                </div>
                            </div>

                            <div class="row justify-content-md-center mb-3">
                                {{-- teachers --}}
                                <div class="col-md-6 mt-2 teachers" style="display: none">
                                    <select class="form-select  " name="rankidteachers" aria-label="Default select example">
                                        <option selected value="0">ชื่อ - นามสกุล</option>
                                        @foreach ($datateachers as $datateacher)
                                            <option value="{{ $datateacher->teachers_id }}">
                                                {{ $datateacher->prefix_name . $datateacher->first_name . ' ' . $datateacher->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- parents --}}
                                <div class="col-md-6 mt-2 parents" style="display: none">
                                    <select class="form-select  " name="rankidparents" aria-label="Default select example">
                                        <option selected value="0">ชื่อ - นามสกุล</option>
                                        @foreach ($dataparents as $dataparent)
                                            <option value="{{ $dataparent->parents_id }}">
                                                {{ $dataparent->prefix_name . $dataparent->first_name . ' ' . $dataparent->last_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $("#inlineRadio1").click(function() {
                document.querySelector('.teachers').style.display = 'block'
                document.querySelector('.parents').style.display = 'none'
            });

            $("#inlineRadio2").click(function() {
                document.querySelector('.parents').style.display = 'block'
                document.querySelector('.teachers').style.display = 'none'
            });
        });
    </script>
@endsection
