@extends('layouts.app')

@section('title')
    Description | Edit
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
            $('input[name="name"]').on('keyup', function() {
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
                <div class="card-header">{{ __('Categories | Edit') }}</div>
                <div class="card-body">
                    <form id="contactForm" action="{{ route('backend.categories.process.edit') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-12  col-md-12 mb-3">
                                
                                <div class="mb-3">
                                    <div class="mb-2 @error('name') text-danger fw-bold @enderror">Categories Name :</div>
                                    <input type="text" name="name" value="{{$categories->name}}" placeholder="name" class="form-control @error('name') is-invalid @enderror">
                                    @error('name')
                                        <small class="text-danger">{!! $message !!}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <input type="hidden" name="id_lembaga" value="{{ $landingPage->id_lembaga }}">
                                </div>

                                <div class="mb-3">
                                    <div class="mb-2 @error('slug') text-danger fw-bold @enderror">Slug :</div>
                                    <input type="text" name="slug" value="{{ $categories->slug }}" placeholder="slug" class="form-control @error('slug') is-invalid @enderror">
                                    @error('slug')
                                        <small class="text-danger">{!! $message !!}</small>
                                    @enderror
                                </div>
                               
                               

                                <button class="btn btn-primary btn-xl" id="submitButton" type="submit">Edit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
