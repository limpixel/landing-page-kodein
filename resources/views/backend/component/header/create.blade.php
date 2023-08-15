@extends('layouts.app')

@section('title')
    Header | Create
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
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Header | Create') }}</div>
                <div class="card-body">
                    <form id="contactForm" action="{{ route('backend.header.create.process') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id_lembaga" value="{{ old('title') }}" placeholder="Title" class="form-control @error('title') is-invalid @enderror">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12  col-md-12 mb-3">
                                <div class="mb-3">
                                    <input type="hidden" name="id_lembaga" value="{{ $landingPage->id_lembaga }}">
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="mb-2 @error('buttonText') text-danger fw-bold @enderror">Button Text:</div>
                                            <input type="text" name="buttonText" value="{{ old('buttonText') }}" placeholder="Text" class="form-control @error('buttonText') is-invalid @enderror">
                                            @error('buttonText')
                                                <small class="text-danger">{!! $message !!}</small>
                                            @enderror
                                        </div>
                                        <div class="col-6">
                                            <div class="mb-2 @error('buttonLink') text-danger fw-bold @enderror">Button Link:</div>
                                            <input type="text" name="buttonLink" value="{{ old('buttonLink') }}" placeholder="Link" class="form-control @error('buttonLink') is-invalid @enderror">
                                            @error('buttonLink')
                                                <small class="text-danger">{!! $message !!}</small>
                                            @enderror
                                        </div>
                                    </div>
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
