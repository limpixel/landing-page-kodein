@extends('layouts.admin_landing')

@section('title')
    Galery | Create
@endsection

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.9.0/css/all.min.css">
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
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(function() {
            $('.select2').select2();
        });
    </script>

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
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Galery | Create') }}</div>
                <div class="card-body">
                    <form id="contactForm" action="{{ route('backend.galery.create') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-12  col-md-12 mb-3">
                                <div class="mb-3">
                                    <label for="image" class="form-label">
                                        Image
                                    </label>
                                    <input type="file" name="image" id="image" class="form-control">
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
