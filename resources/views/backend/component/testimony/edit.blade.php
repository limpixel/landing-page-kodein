@extends('layouts.app')
@section('title')
    testimony | Edit #ID {{ $testimony->id }}
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
                    <div class="card-header">testimony | Edit #ID {{ $testimony->id }}</div>
                    <div class="card-body">
                        <form action="{{ route('backend.testimony.edit.process', $testimony->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                    <div class="mb-3">
                                        <input type="hidden" name="id_lembaga" value="{{ $landingPage->id_lembaga }}">
                                        <label for="name" class="form-label">
                                            Nama
                                        </label>
                                        <input type="text" name="name" value="{{ $testimony->name }}" placeholder="name" class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                            <small class="text-danger">{!! $message !!}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="image" class="form-label">
                                            Photo Profile
                                        </label>
                                        @error('image')
                                        <div class="text-danger small" >{!! $message !!}</div>
                                        @enderror
                                        <input type="file" name="image" id="image" class="form-control">
                                        <img src="{{ asset('images/testimoni') . '/' . $testimony->image }}" class="img-thumbnail mt-3 mb-3 w-20" id="preview">
                                    </div>
                                    <div class="mb-3">
                                        <div class="mb-2 @error('description') text-danger fw-bold @enderror">Description:</div>
                                        <textarea class="form-control @error('description') text-danger fw-bold @enderror" name="description" placeholder="Description">{!! $testimony->description !!}</textarea>
                                        @error('description')
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
