@extends('layouts.app')

@section('title')
    Artikel | Edit 
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
            $('textarea[name=content]').summernote({height: 200});
        });
    </script>

    <script>
        $(function(){

            $('input[name="title"]').on('keyup', function() {
                let Text = $(this).val();
                Text = Text.toLowerCase();
                Text = Text.replace(/[^a-zA-Z0-9]+/g, '-');
                $('input[name="slug"]').val(Text);
            });

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

    <script>
        // In your Javascript (external .js resource or <script> tag)
        $(document).ready(function() {
            $('.js-example-basic-single').select2();

            $(".js-select-tag").select2({
                tags: true
            });
        });
    </script>

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Artikel | Edit ') }} #{{$artikel->id}}</div>
                <div class="card-body">
                    <form id="contactForm" action="{{ route('backend.edit.process.artikel') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        
                        
                        <div class="row">
                            <div class="col-xs-12 col-sm-12  col-md-12 mb-3">
                                
                                <div class="mb-3">
                                    <input type="hidden" name="id_lembaga" value="{{ $landingPage->id_lembaga }}">
                                    <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">


                                    <label for="title" class="form-label  @error('status') text-danger fw-bold @enderror">
                                        Status
                                    </label>
                                    <input type="text" name="status" value="{{ old('status', $artikel->status) }}" placeholder="Status" class="form-control @error('status') is-invalid @enderror">
                                    @error('status')
                                        <small class="text-danger">{!! $message !!}</small>
                                    @enderror
                                </div>

                                

                                <div style="display: flex; flex-direction: column" class="mb-3">
                                    <label  class="form-label">
                                        Categories
                                    </label>
                                    
                                    <select class="form-control js-select-tag" multiple="multiple">
                                        @foreach ($categories as $item )
                                        <option  value="{{$item->id}}">{{$item->name}}</option>
                                        @endforeach

                                    </select>

                                    
                                </div>

                                {{-- Lembaga --}}
                                <div class="mb-3">

                                    <label  class="form-label">
                                        Lembaga
                                    </label>

                                    <select class="form-control js-select-tag mb-3" name="id_lembaga" multiple="multiple">    
                                        @foreach ($lembaga as $item )
                                            <option value="{{$item->id}}">{{$item->nama_lembaga}}</option>
                                        @endforeach
                                    </select>

                                    @error('lembaga')
                                        <div class="text-danger small" >{!! $message !!}</div>
                                    @enderror

                                </div>
                                
                                <div class="mb-3">
                                    <label for="image" class="form-label @error('title') text-danger fw-bold @enderror">
                                        Image
                                    </label>
                                    <input type="file" name="image" id="image" class="form-control">
                                    <img src="" class="img-thumbnail mt-3 mb-3 d-none w-50" id="preview">
                                    @error('image')
                                    <div class="text-danger small" >{!! $message !!}</div>
                                    @enderror
                                </div>


                                <div class="mb-3">
                                    
                                    <label for="title" class="form-label  @error('title') text-danger fw-bold @enderror">
                                        Title
                                    </label>
                                    <input type="text" name="title" value="{{ old('title') }}" placeholder="Title" class="form-control @error('title') is-invalid @enderror">
                                    @error('title')
                                        <small class="text-danger">{!! $message !!}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="mb-2 @error('slug') text-danger fw-bold @enderror">Slug :</div>
                                    <input type="text" name="slug" value="{{ old('slug') }}" placeholder="slug" class="form-control @error('slug') is-invalid @enderror">
                                    @error('slug')
                                        <small class="text-danger">{!! $message !!}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="mb-2 @error('description') text-danger fw-bold @enderror">Description :</div>
                                    <textarea class="form-control @error('description') text-danger fw-bold @enderror" name="description" placeholder="description Here" > {{ old('description') }} </textarea>
                                    @error('description')
                                        <small class="text-danger">{!! $message !!}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="mb-2 @error('content') text-danger fw-bold @enderror">Content :</div>
                                    <textarea class="form-control @error('content') text-danger fw-bold @enderror" name="content" placeholder="content">{{ old('content') }}</textarea>
                                    @error('content')
                                        <small class="text-danger">{!! $message !!}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <div class="mb-2 @error('views') text-danger fw-bold @enderror">Views :</div>
                                    <input type="text" name="views" value="{{ old('views') }}" placeholder="views" class="form-control @error('views') is-invalid @enderror">
                                    @error('views')
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
