@extends('layouts.admin_landing')
@section('title')
    Description | Edit #ID {{ $description->id }}
@endsection
@section('css')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    .select2-container .select2-selection--single { height: 37px; font-size: .875rem; }
    .select2-container--default .select2-selection--single .select2-selection__rendered { line-height: 37px; }
    .select2-container--default .select2-selection--single .select2-selection__arrow { height: 37px; }
    .select2-container--default .select2-selection--single { border-radius: 0.375rem; border: 1px solid #ced4da; }
    .select2-container--default .select2-results__option--selected { font-size: .875rem; }
    .select2-results__option--selectable { font-size: .875rem; }
</style>
@endsection

@section('js')

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(function () {
            $('textarea[name=description]').summernote({height: 200});
        });
    </script>

    <script>
        $(function(){
            $('input[name="image"]').change(function(){
                imagePreview(this);
            });
        })
        function imagePreview(input){
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e){
                    $("#preview").removeClass("d-none");
                    $("#preview").attr("src",e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>

@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Description | Edit #ID {{ $description->id }}</div>
                    <div class="card-body">
                        <form action="{{ route('backend.description.edit.process', $description->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">
                                            Title
                                        </label>
                                        <input type="text" name="title" value="{{ $description->title }}" placeholder="Title" class="form-control @error('title') is-invalid @enderror">
                                        @error('title')
                                            <small class="text-danger">{!! $message !!}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <div class="mb-2 @error('description') text-danger fw-bold @enderror">Description:</div>
                                        <textarea class="form-control @error('description') text-danger fw-bold @enderror" name="description" placeholder="Description">{!! $description->description !!}</textarea>
                                        @error('description')
                                            <small class="text-danger">{!! $message !!}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <div class="mb-2 @error('link') text-danger fw-bold @enderror">Button:</div>
                                        <input type="text" name="link" value="{{ $description->link}}" placeholder="link" class="form-control @error('link') is-invalid @enderror">
                                        @error('link')
                                            <small class="text-danger">{!! $message !!}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                              <button class="nav-link active" id="image-tab" data-bs-toggle="tab" data-bs-target="#image" type="button" role="tab" aria-controls="image" aria-selected="true">Image</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                              <button class="nav-link" id="video-tab" data-bs-toggle="tab" data-bs-target="#video" type="button" role="tab" aria-controls="video" aria-selected="false">Video</button>
                                            </li>
                                          </ul>
                                          <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="image" role="tabpanel" aria-labelledby="image-tab">
                                                <input type="file" name="image" id="image" class="form-control">
                                                <img src="{{ asset('images/description') . '/' . $description->image }}" class="img-thumbnail mt-3 mb-3 d-none w-50" id="preview">
                                                @error('image')
                                                <div class="text-danger small" >{!! $message !!}</div>
                                                @enderror
                                            </div>
                                            <div class="tab-pane fade" id="video" role="tabpanel" aria-labelledby="video-tab">
                                                <input type="text" name="video" value="{{ $description->video }}" placeholder="Link Video" class="form-control @error('video') is-invalid @enderror">
                                                @error('video')
                                                    <small class="text-danger">{!! $message !!}</small>
                                                @enderror
                                            </div>
                                          </div>
                                          
                                    </div>
                                    <div class="mb-3">
                                        <label for="position" class="form-label">
                                            Image Position <span class="text-danger">*</span>
                                        </label>
                                        <select class="select2 form-control" name="position" class="">
                                            <option value="{{ $description->position }}">{{ $description->position }}</option>
                                            <option>Right</option>
                                            <option>Left</option>
                                            {{-- <option>Top</option>
                                            <option>Bottom</option> --}}
                                        </select>
                                        @error('position')
                                            <small class="text-danger">{!! $message !!}</small>
                                        @enderror
                                    </div>
    
                                    <button type="submit" class="btn btn-dark">Edit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
