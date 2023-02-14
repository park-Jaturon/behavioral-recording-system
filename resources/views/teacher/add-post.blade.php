@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center g-2">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <form action="{{empty($data->posts_id) ? route('store.post') : url('teacher/post/update/' . $data->posts_id) }}" method="post">
                            @if (!empty($data->posts_id))
                                @method('put')
                            @endif
                            @csrf
                            <div class="mb-3">
                                <label for="" class="form-label">หัวเรื่อง</label>
                                <input type="text" name="topic" id="" class="form-control" placeholder=""
                                    aria-describedby="helpId" value="{{ old('topic',$data->p_topic) }}"> {{-- p_name --}}
                                <small id="helpId" class="text-muted">Help text</small>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">เนื้อความ</label>
                                <textarea name="description" id="editor" rows="3">{{ old('description',$data->p_description) }}</textarea>{{-- ,$data->description --}}
                            </div>
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

@section('script')
<script src="\js\ckeditor-description.js"></script>
@endsection


