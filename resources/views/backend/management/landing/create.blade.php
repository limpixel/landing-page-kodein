@extends('layouts.app')

@section('title')
    Logo  | Create
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
    <script>
        $(function() {
            $('input[name="fullname"]').on('keyup', function() {
                let Text = $(this).val();
                Text = Text.toLowerCase();
                Text = Text.replace(/[^a-zA-Z0-9]+/g, '-');
                $('input[name="slug"]').val(Text);
            });

            // Move the image preview registration inside the document ready function
            $('input[name=image1]').change(function() {
                imagePreview(this, "#preview1");
            });
            $('input[name=image2]').change(function() {
                imagePreview(this, "#preview2");
            });
            $('input[name=image3]').change(function() {
                imagePreview(this, "#preview3");
            });
            $('input[name=image4]').change(function() {
                imagePreview(this, "#preview4");
            });
            $('input[name=image5]').change(function() {
                imagePreview(this, "#preview5");
            });
        });

        function imagePreview(input, previewId) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $(previewId).removeClass("d-none");
                    $(previewId).attr("src", e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Description | Create') }}</div>
                <div class="card-body">
                    <form id="contactForm" action="{{ route('backend.description.create.process') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-12  col-md-12 mb-3">
                                <div class="mb-3">
                                    <input type="hidden" name="id_lembaga" value="{{ $landingPage->id_lembaga }}">
                                    <label for="bgColor" class="form-label">
                                        Background Color
                                    </label>
                                    <input type="text" name="bgColor" value="{{ old('bgColor') }}" placeholder="#0000 or rgba(0,0,0,0)" class="form-control @error('bgColor') is-invalid @enderror">
                                    @error('bgColor')
                                        <small class="text-danger">{!! $message !!}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="mb-2 @error('title') text-danger fw-bold @enderror">Title:</div>
                                    <textarea class="form-control @error('title') text-danger fw-bold @enderror" name="title" placeholder="title"></textarea>
                                    @error('title')
                                        <small class="text-danger">{!! $message !!}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="mb-2 @error('description') text-danger fw-bold @enderror">Description:</div>
                                    <textarea class="form-control @error('description') text-danger fw-bold @enderror" name="description" placeholder="Description"></textarea>
                                    @error('description')
                                        <small class="text-danger">{!! $message !!}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <div class="mb-2 @error('link') text-danger fw-bold @enderror">Button:</div>
                                    <input type="text" name="link" value="{{ old('link') }}" placeholder="link" class="form-control @error('link') is-invalid @enderror">
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
                                            <img src="" class="img-thumbnail mt-3 mb-3 d-none w-50" id="preview">
                                            @error('image')
                                            <div class="text-danger small" >{!! $message !!}</div>
                                            @enderror
                                        </div>
                                        <div class="tab-pane fade" id="video" role="tabpanel" aria-labelledby="video-tab">
                                            <input type="text" name="video" value="{{ old('video') }}" placeholder="Link Video" class="form-control @error('video') is-invalid @enderror">
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
                                        <option>Right</option>
                                        <option>Left</option>
                                        <option>Top</option>
                                        <option>Bottom</option>
                                    </select>
                                    @error('position')
                                        <small class="text-danger">{!! $message !!}</small>
                                    @enderror
                                </div>

                                <button class="btn btn-primary btn-xl" id="submitButton" type="submit">Create</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection