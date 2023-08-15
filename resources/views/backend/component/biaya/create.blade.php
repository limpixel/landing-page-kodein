@extends('layouts.app')

@section('title')
    Biaya | Create
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
                <div class="card-header">{{ __('Biaya | Create') }}</div>
                <div class="card-body">
                    <form id="contactForm" action="{{ route('backend.biaya.create') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-12  col-md-12 mb-3">
                                <div class="mb-3">
                                    <input type="hidden" name="id_lembaga" value="{{ $landingPage->id_lembaga }}">
                                    <label for="image" class="form-label">
                                        Image1
                                    </label>
                                    <input type="file" name="image1" id="image" class="form-control">
                                    <img src="" class="img-thumbnail mt-3 mb-3 d-none w-50" id="preview">
                                    @error('image')
                                    <div class="text-danger small" >{!! $message !!}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="image2" class="form-label">
                                        Image2
                                    </label>
                                    <input type="file" name="image2" id="image2" class="form-control">
                                    <img src="" class="img-thumbnail mt-3 mb-3 d-none w-50" id="preview">
                                    @error('image')
                                    <div class="text-danger small" >{!! $message !!}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="image3" class="form-label">
                                        Image3
                                    </label>
                                    <input type="file" name="image3" id="image3" class="form-control">
                                    <img src="" class="img-thumbnail mt-3 mb-3 d-none w-50" id="preview">
                                    @error('image')
                                    <div class="text-danger small" >{!! $message !!}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="image4" class="form-label">
                                        Image4
                                    </label>
                                    <input type="file" name="image4" id="image4" class="form-control">
                                    <img src="" class="img-thumbnail mt-3 mb-3 d-none w-50" id="preview">
                                    @error('image')
                                    <div class="text-danger small" >{!! $message !!}</div>
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
