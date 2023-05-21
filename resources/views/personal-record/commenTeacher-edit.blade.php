@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center g-2">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $student->prefix_name.$student->first_name.' '.$student->last_name}}</div>

                    <div class="card-body">
                       <form action="{{ url('teacher/commen/update/'.$tcomment->id) }}" method="post"> 
                            @csrf
                            <div class="col">
                                <label for="exampleFormControlTextarea1"
                                    class="form-label">{{__('ความคิดเห็นของครูประจำชั้น').' '.$tcomment->semester}}</label>

                                <textarea name="commenteacher" id="editor" rows="3">{{$tcomment->comment_teacher}} </textarea> {{-- {{ old('description',$data->p_description) }} --}}

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
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ),{
            ckfinder: {
                uploadUrl: '{{route('ckedditor.upload').'?_token='.csrf_token()}}',
    }
        })
        .then( editor =>{
            console.log(editor);
        } )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection



