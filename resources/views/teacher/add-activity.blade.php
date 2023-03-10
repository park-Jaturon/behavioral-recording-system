@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">เพิ่มรูปกิจกรรม</div>

                    <div class="card-body">
                        <form action="{{url('teacher/activity/store/'.$event->events_id)}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3 row">
                                <label for="staticTitle" class="col-sm-2 col-form-label">เรื่อง</label>
                                <div class="col-sm-10">
                                  <input type="text" readonly class="form-control-plaintext" id="staticTitle" value="{{date('d-m-Y ', strtotime($event->start)).' '.$event->title}}">
                                </div>
                              </div>
                              <div class="mb-3 row">
                                <label for="inputImages" class="col-sm-2 col-form-label">รูป</label>
                                <div class="col-sm-10">
                                  <input type="file" class="form-control" id="inputPassword" name="images[]" multiple>
                                </div>
                              </div>
                            <div class="row mb-0 ">
                                <div class="col-md-8 offset-md-4 ">
                                    <button type="submit" class="btn btn-primary float-end">
                                        {{ __('บันทึก') }}
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
