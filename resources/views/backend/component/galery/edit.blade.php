@extends('layouts.app')
@section('title')
    galery | Edit #ID {{ $galery->id }}
@endsection
@section('js')
    <script>
        $(function(){
            $('input[name="fullname"]').on('keyup', function(){
                let Text = $(this).val();

                Text = Text.toLowerCase();
                Text = Text.replace(/[^a-zA-Z0-9]+/g,'-');

                $('input[name="slug"]').val(Text);
                $('input[name=foto]').change(function(){
                imagePreview(this);
            });
            })
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
                    <div class="card-header">galery | Edit #ID {{ $galery->id }}</div>
                    <div class="card-body">
                        <form action="{{ route('backend.galery.edit.process', $galery->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 mb-3">
                                    <div class="mb-3">
                                        <div class="mb-2 @error('image') text-danger fw-bold @enderror">Image:</div>
                                        <input class="form-control" type="file" name="image" id="image">
                                        <div class="mb-3">
                                            <img src="{{ asset('images/galery/'.$galery->image) }}" class="w-25" id="preview">
                                        </div>
                                        @error('image')
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
