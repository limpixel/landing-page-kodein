@extends('layouts.app')
@section('title')
    Logo | Edit #ID {{ $landingPage->id }}
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
            $('textarea[name=title]').summernote({height: 50});
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
                    <div class="card-header">Logo | Edit #ID {{ $landingPage->id }}</div>
                    <div class="card-body">
                        @if (session()->has('error'))
                            <p class="text-danger">{{ session('error') }}</p>
                        @endif
                        <form action="{{ route('backend.landing.edit.process', $landingPage->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                    <div class="mb-3">
                                        <input type="hidden" name="id_lembaga" value="{{ $landingPage->id_lembaga }}">
                                        <label for="whatsapp" class="form-label">
                                            Domain
                                        </label>
                                        <input type="text" name="domain" value="{{ $domain }}" placeholder="domain" class="form-control @error('domain') is-invalid @enderror">
                                    </div>
                                    <div class="mb-3">
                                        <label for="logo" class="form-label">
                                            Logo
                                        </label>
                                        <input type="file" name="logo" id="logo" class="form-control">
                                        <img src="{{ asset('images/header/'.$landingPage->logo) }}" class="img-thumbnail mt-3 mb-3 d-none w-50" id="preview">
                                        @error('logo')
                                        <div class="text-danger small" >{!! $message !!}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="whatsapp" class="form-label">
                                            whatsapp
                                        </label>
                                        <input type="text" name="whatsapp" value="{{ $landingPage->whatsapp }}" placeholder="whatsapp" class="form-control @error('whatsapp') is-invalid @enderror">
                                        @error('whatsapp')
                                            <small class="text-danger">{!! $message !!}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="instagram" class="form-label">
                                            instagram
                                        </label>
                                        <input type="text" name="instagram" value="{{ $landingPage->instagram }}" placeholder="instagram" class="form-control @error('instagram') is-invalid @enderror">
                                        @error('instagram')
                                            <small class="text-danger">{!! $message !!}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="facebook" class="form-label">
                                            facebook
                                        </label>
                                        <input type="text" name="facebook" value="{{ $landingPage->facebook }}" placeholder="facebook" class="form-control @error('facebook') is-invalid @enderror">
                                        @error('facebook')
                                            <small class="text-danger">{!! $message !!}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="youtube" class="form-label">
                                            youtube
                                        </label>
                                        <input type="text" name="youtube" value="{{ $landingPage->youtube }}" placeholder="youtube" class="form-control @error('youtube') is-invalid @enderror">
                                        @error('youtube')
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
