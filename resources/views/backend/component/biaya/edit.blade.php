@extends('layouts.app')
@section('title')
    biaya | Edit #ID {{ $biaya->id }}
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
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">biaya | Edit #ID {{ $biaya->id }}</div>
                    <div class="card-body">
                        <form action="{{ route('backend.biaya.edit.process', $biaya->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                    <div class="mb-3">
                                        <input type="hidden" name="id_lembaga" value="{{ $landingPage->id_lembaga }}">
                                        <div class="mb-2 @error('image') text-danger fw-bold @enderror">Image:</div>
                                        <input class="form-control" type="file" name="image1" id="image1">
                                        <div class="mb-3">
                                            <img src="{{ asset('images/biaya/'.$biaya->image1) }}" class="w-25" id="preview1">
                                        </div>
                                        @error('image')
                                            <small class="text-danger">{!! $message !!}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <div class="mb-2 @error('image2') text-danger fw-bold @enderror">Image:</div>
                                        <input class="form-control" type="file" name="image2" id="image2" >
                                        <div class="mb-3">
                                            <img src="{{ asset('images/biaya/'.$biaya->image2) }}" class="w-25" id="preview2">
                                        </div>
                                        @error('image2')
                                            <small class="text-danger">{!! $message !!}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <div class="mb-2 @error('image3') text-danger fw-bold @enderror">Image:</div>
                                        <input class="form-control" type="file" name="image3" id="image3" >
                                        <div class="mb-3">
                                            <img src="{{ asset('images/biaya/'.$biaya->image3) }}" class="w-25" id="preview3">
                                        </div>
                                        @error('image3')
                                            <small class="text-danger">{!! $message !!}</small>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <div class="mb-2 @error('image4') text-danger fw-bold @enderror">Image:</div>
                                        <input class="form-control" type="file" name="image4" id="image4" >
                                        <div class="mb-3">
                                            <img src="{{ asset('images/biaya/'.$biaya->image4) }}" class="w-25" id="preview4">
                                        </div>
                                        @error('image4')
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
