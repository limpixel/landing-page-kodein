@extends('layouts.app')
@section('title')
    Location | Edit #ID {{ $location->id }}
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
                    <div class="card-header">Location | Edit #ID {{ $location->id }}</div>
                    <div class="card-body">
                        <form action="{{ route('backend.location.edit.process', $location->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                    <div class="mb-3">
                                        <label for="map" class="form-label">
                                            Map
                                        </label>
                                        <input type="text" name="map" value="{{ $location->map }}" placeholder="Link" class="form-control @error('map') is-invalid @enderror">
                                        @error('map')
                                            <small class="text-danger">{!! $message !!}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <div class="mb-2 @error('description') text-danger fw-bold @enderror">Description:</div>
                                        <textarea class="form-control @error('description') text-danger fw-bold @enderror" name="description" placeholder="Description">{{ $location->description }}</textarea>
                                        @error('description')
                                            <small class="text-danger">{!! $message !!}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="image1" class="form-label">
                                            Image
                                        </label>
                                        <input type="file" name="image1" id="image1" class="form-control">
                                        <img src="{{ asset('images/map/'.$location->image1) }}" class="w-25" id="preview">
                                        @error('image1')
                                        <div class="text-danger small" >{!! $message !!}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="image2" class="form-label">
                                            Image
                                        </label>
                                        <input type="file" name="image2" id="image2" class="form-control">
                                        <img src="{{ asset('images/map/'.$location->image2) }}" class="w-25" id="preview">
                                        @error('image2')
                                        <div class="text-danger small" >{!! $message !!}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="image3" class="form-label">
                                            Image
                                        </label>
                                        <input type="file" name="image3" id="image3" class="form-control">
                                        <img src="{{ asset('images/map/'.$location->image3) }}" class="w-25" id="preview">
                                        @error('image3')
                                        <div class="text-danger small" >{!! $message !!}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        Button 1<span class="text-danger">*optional</span>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="mb-2 @error('buttonText1') text-danger fw-bold @enderror">Text:</div>
                                                <input type="text" name="buttonText1" value="{{ $location->buttonText1 }}" placeholder="Text" class="form-control @error('buttonText1') is-invalid @enderror">
                                                @error('buttonText1')
                                                    <small class="text-danger">{!! $message !!}</small>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <div class="mb-2 @error('buttonLink1') text-danger fw-bold @enderror">Link:</div>
                                                <input type="text" name="buttonLink1" value="{{ $location->buttonLink1 }}" placeholder="Link" class="form-control @error('buttonLink1') is-invalid @enderror">
                                                @error('buttonLink1')
                                                    <small class="text-danger">{!! $message !!}</small>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        Button 2<span class="text-danger">*optional</span>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="mb-2 @error('buttonText2') text-danger fw-bold @enderror">Text:</div>
                                                <input type="text" name="buttonText2" value="{{ $location->buttonText2 }}" placeholder="Text" class="form-control @error('buttonText2') is-invalid @enderror">
                                                @error('buttonText2')
                                                    <small class="text-danger">{!! $message !!}</small>
                                                @enderror
                                            </div>
                                            <div class="col-6">
                                                <div class="mb-2 @error('buttonLink2') text-danger fw-bold @enderror">Link:</div>
                                                <input type="text" name="buttonLink2" value="{{ $location->buttonLink2 }}" placeholder="Link" class="form-control @error('buttonLink2') is-invalid @enderror">
                                                @error('buttonLink2')
                                                    <small class="text-danger">{!! $message !!}</small>
                                                @enderror
                                            </div>
                                        </div>
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
