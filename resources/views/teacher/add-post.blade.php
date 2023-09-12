@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center g-2">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row justify-content-start align-items-center g-2">
                            
                            <div class="col">
                                @if (empty($data->posts_id))
                                {{ __('เพิ่มประกาศ') }}
                            @else
                                {{ __('แก้ไขประกาศ') }}
                            @endif
                            </div>
                        </div>
                       
                    </div>
                    <form
                        action="{{ empty($data->posts_id) ? url('teacher/post/store/' . $room->rooms_id) : url('teacher/post/update/' . $data->posts_id) }}"
                        method="post">
                        <div class="card-body">

                            @if (!empty($data->posts_id))
                                @method('put')
                            @endif
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">หัวเรื่อง</label>
                                <input type="text" name="topic" id="" class="form-control" placeholder=""
                                    aria-describedby="helpId" value="{{ old('topic', $data->p_topic) }}">
                                {{-- p_name --}}
                                <small id="helpId" class="text-muted">
                                    @error('topic')
                                        <span role="alert" class="text-danger">
                                            <strong> {{ $message }}</strong>
                                        </span>
                                    @enderror
                                </small>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">เนื้อความ</label>
                                <textarea name="description" id="editor" rows="3">{{ old('description', $data->p_description) }}</textarea>{{-- ,$data->description --}}
                                <small id="helpId" class="text-muted">
                                    @error('description')
                                        <span role="alert" class="text-danger">
                                            <strong> {{ $message }}</strong>
                                        </span>
                                    @enderror
                                </small>
                            </div>

                            @if (!empty($data->posts_id))
                                <div class="mb-3">
                                    <div class="row">
                                        <label for="" class="form-label">การแสดงประกาศ</label>
                                    </div>

                                    <div class="row">
                                        @if ($data->status == 'shown')
                                        <div class="col-1 ml-5">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" value="shown"
                                                    id="flexRadioDefault1" checked>
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    แสดง
                                                </label>
                                            </div>
                                            
                                        </div>
                                        <div class="col">
                                            <div class="form-check">
                                                 <input class="form-check-input" type="radio" name="flexRadioDefault" value="hidden" id="flexRadioDefault2" >{{-- checked --}}
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                  ไม่แสดง
                                                </label>
                                              </div>
                                        </div>
                                        @else
                                        <div class="col">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="flexRadioDefault" value="shown"
                                                    id="flexRadioDefault1" checked>
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    แสดง
                                                </label>
                                            </div>
                                            
                                        </div>
                                        <div class="col">
                                            <div class="form-check">
                                                 <input class="form-check-input" type="radio" name="flexRadioDefault" value="hidden" id="flexRadioDefault2" checked>{{-- checked --}}
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                  ไม่แสดง
                                                </label>
                                              </div>
                                        </div>
                                        @endif
                                       
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary ">{{ __('บันทึก') }}</button>
                            <a name="" id="" class="btn btn-danger" href="{{ route('index.post') }}"
                                role="button"> ยกเลิก </a>
                        </div>
                    </form>
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
                    uploadUrl: '{{ route('ckedditor.upload') . '?_token=' . csrf_token() }}',
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
