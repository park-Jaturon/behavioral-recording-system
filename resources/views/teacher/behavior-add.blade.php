@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('เพิ่มรายงานพฤติกรรม') }}</div>

                    <div class="card-body">
                        <div class="container">
                            <form action="{{route('store.behavior')}}" method="post">
                                @csrf
                                <div class="mb-3 row">
                                    <label for="inputName" class="col-4 col-form-label">ชื่อ</label>
                                    <div class="col-8">
                                        <select class="form-select" aria-label="Default select example" name="fname">
                                            <option selected disabled>ชื่อ - นามสกุล</option>
                                            @foreach ($studentname as $name)
                                                <option value="{{ $name->student_id}}">
                                                    {{ $name->prefix_name . $name->first_name . ' ' . $name->last_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="inputName" class="col-4 col-form-label">รายงาน</label>
                                    <div class="col-8">
                                        <select class="form-select" name="type" aria-label="Default select example">
                                            <option selected disabled>ประเภท</option>
                                            <option value="ด้านร่างกาย">ด้านร่างกาย</option>
                                            <option value="ด้านอารมณ์และจิตใจ">ด้านอารมณ์และจิตใจ</option>
                                            <option value="ด้านสังคม">ด้านสังคม</option>
                                            <option value="ด้านสติปัญญา">ด้านสติปัญญา</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row justify-content-md-center">
                                    <div class="col-11">
                                        <textarea name="description" id="editor" rows="3"></textarea> {{-- {{ old('description',$data->p_description) }} --}}
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="offset-sm-4 col-sm-8">
                                        <button type="submit" class="btn btn-primary float-end"> {{ __('บันทึก') }}</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        
        ClassicEditor
            .create(document.querySelector('#editor'), {
                
                ckfinder: {
                     uploadUrl: '{{ route('behavior.upload') . '?_token=' . csrf_token() }}',
                }
            })
            .then(editor => {
                console.log(editor);
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
