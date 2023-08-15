@extends('layouts.app')

@section('title')
    Lembaga | Create
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
                <div class="card-header">{{ __('Lembaga | Create') }}</div>
                <div class="card-body">
                    <form id="contactForm" action="{{ route('backend.lembaga.create.process') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id_lembaga" value="{{ old('title') }}" placeholder="Title" class="form-control @error('title') is-invalid @enderror">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12  col-md-12 mb-3">
                                <div class="mb-3">
                                    <label for="title" class="form-label">
                                        Nama Lembaga
                                    </label>
                                    <input type="text" name="nama_lembaga" value="{{ old('nama_lembaga') }}" placeholder="Nama Lembaga" class="form-control @error('nama_lembaga') is-invalid @enderror">
                                    @error('nama_lembaga')
                                        <small class="text-danger">{!! $message !!}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="title" class="form-label">
                                        Alamat Lembaga
                                    </label>
                                    <input type="text" name="alamat_lembaga" value="{{ old('alamat_lembaga') }}" placeholder="Alamat Lembaga" class="form-control @error('alamat_lembaga') is-invalid @enderror">
                                    @error('alamat_lembaga')
                                        <small class="text-danger">{!! $message !!}</small>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="title" class="form-label">
                                        Kode Pos
                                    </label>
                                    <input type="text" name="kode_pos" value="{{ old('kode_pos') }}" placeholder="Kode Pos" class="form-control @error('kode_pos') is-invalid @enderror">
                                    @error('kode_pos')
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
