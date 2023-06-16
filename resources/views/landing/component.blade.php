@extends('layouts.admin_landing')

@section('title')
    
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-body">
            <div class="row mb-3">
                <div class="col-12 text-right">
                    <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalCreate" id="createButton"><i class="fas fa-plus-circle"></i> Create</a>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th width="50px" class="text-center">No</th>
                            @if ($componentType == 3)
                                <th class="text-center" width="200px">Image</th>
                            @elseif ($componentType == 1 || $componentType == 4)
                                <th width="200px">Title</th>
                                <th width="200px">Description</th>
                            @elseif ($componentType == 5)
                                <th width="200px">Title</th>
                                <th class="text-center" width="200px">Image</th>
                            @elseif($componentType == 7)
                            <th width="200px">Description</th>
                            <th width="200px">Embed Link</th>
                            @endif
                                <th width="50px" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contents as $key => $content)
                            <tr>
                                <td class="text-center">{{ ++$key }}</td>
                                @if ($componentType == 3)
                                    <td class="text-center"><img src="{{ asset('images/galery/' . $content->image) }}" width="500px"></td>
                                @elseif ($componentType == 1 || $componentType == 4)
                                    <td>{{ $content->title }}</td>
                                    <td>{{ $content->description }}</td>
                                @elseif ($componentType == 5)
                                    <td>{{ $content->title }}</td>
                                    <td class="text-center"><img src="{{ asset('images/image-hero/' . $content->image) }}" width="300px"></td>
                                @elseif ($componentType == 7)
                                    <td>{{ $content->description }}</td>
                                    <td width="50px">{{ $content->embed_link }}</td>
                                @endif
                                <td class="text-center">
                                    <a class="btn btn-sm btn-primary" href="#"><i class="fas fa-search"></i></a>
                                    <button class="btn btn-sm btn-success" id="editButton" data-bs-toggle="modal" data-bs-target=".modalEdit" data-id="{{ $content->id }}"><i class="fas fa-pencil-alt"></i></button>
                                    <a class="btn btn-sm btn-danger" href="#"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
    <div class="modal fade modalCreate" tabindex="-1" role="dialog" aria-hidden="true" id="modalCreate">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Create Content</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" id="form_createContent" method="POST" class="custom-validation">
                        @csrf
                            <input type="hidden" name="id" value="{{ $component_id }}">
                            <div class="form-group row mb-4 {{ ($componentType == 1 || $componentType ==  4 || $componentType ==  5 || $componentType ==  6 ? '' : 'd-none') }}">
                                <label for="title" class="col-sm-3 col-form-label">Title<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Input content title...">
                                @error('title')
                                    <div class="text-danger small">{!! $message !!}</div>
                                @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4 {{ ($componentType == 1 || $componentType ==  3 || $componentType ==  4 || $componentType ==  5 ? '' : 'd-none') }}">
                                <label for="image" class="col-sm-3 col-form-label">Image<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <img src="" alt="" class="img-thumbnail mt-3 mb-3 w-50" id="preview">
                                    <input type="file" class="form-control @error('image') is-invalid text-danger @enderror" name="image" id="image">
                                    @error('image')
                                        <div class="text-danger small">{!! $message !!}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4 {{ ($componentType ==  6 ? '' : 'd-none') }}">
                                <label for="embed_link" class="col-sm-3 col-form-label">Embed Link<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control @error('embed_link') is-invalid @enderror" name="embed_link" placeholder="Input content embed link...">
                                @error('embed_link')
                                    <div class="text-danger small">{!! $message !!}</div>
                                @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4 {{ ($componentType == 1 || $componentType ==  4 || $componentType ==  6 ? '' : 'd-none') }}">
                                <label for="description" class="col-sm-3 col-form-label">Description<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                <textarea name="description" id="sample" class="form-control" cols="30" rows="10"></textarea>
                                @error('description')
                                    <div class="text-danger small">{!! $message !!}</div>
                                @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4 {{ ($componentType ==  6 ? '' : 'd-none') }}">
                                <label for="button_text" class="col-sm-3 col-form-label">Button Text<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control @error('button_text') is-invalid @enderror" name="button_text" placeholder="Input content button text...">
                                @error('button_text')
                                    <div class="text-danger small">{!! $message !!}</div>
                                @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4 {{ ($componentType ==  6 ? '' : 'd-none') }}">
                                <label for="button_link" class="col-sm-3 col-form-label">Button Link<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control @error('button_link') is-invalid @enderror" name="button_link" placeholder="Input content button link...">
                                @error('button_link')
                                    <div class="text-danger small">{!! $message !!}</div>
                                @enderror
                                </div>
                            </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-9">
                                <div>
                                    <button type="submit" class="btn btn-primary w-md">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modalEdit" tabindex="-1" role="dialog" aria-hidden="true" id="modalEdit">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Edit Menu</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" id="form_editContent" method="POST" class="custom-validation">
                        @csrf
                        <input type="hidden" name="id">
                            <div class="form-group row mb-4 {{ ($componentType == 1 || $componentType ==  4 || $componentType ==  5 || $componentType ==  6 ? '' : 'd-none') }}">
                                <label for="title" class="col-sm-3 col-form-label">Title<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Input content title...">
                                @error('title')
                                    <div class="text-danger small">{!! $message !!}</div>
                                @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4 {{ ($componentType == 1 || $componentType ==  3 || $componentType ==  4 || $componentType ==  5 ? '' : 'd-none') }}">
                                <label for="image" class="col-sm-3 col-form-label">Image<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                    <img src="" alt="" class="img-thumbnail mt-3 mb-3 w-50" id="preview">
                                    <input type="file" class="form-control @error('image') is-invalid text-danger @enderror" name="image" id="image">
                                    @error('image')
                                        <div class="text-danger small">{!! $message !!}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4 {{ ($componentType ==  6 ? '' : 'd-none') }}">
                                <label for="embed_link" class="col-sm-3 col-form-label">Embed Link<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control @error('embed_link') is-invalid @enderror" name="embed_link" placeholder="Input content embed link...">
                                @error('embed_link')
                                    <div class="text-danger small">{!! $message !!}</div>
                                @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4 {{ ($componentType == 1 || $componentType ==  4 || $componentType ==  6 ? '' : 'd-none') }}">
                                <label for="description" class="col-sm-3 col-form-label">Description<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                <textarea name="description" id="sample" class="form-control" cols="30" rows="10"></textarea>
                                @error('description')
                                    <div class="text-danger small">{!! $message !!}</div>
                                @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4 {{ ($componentType ==  6 ? '' : 'd-none') }}">
                                <label for="button_text" class="col-sm-3 col-form-label">Button Text<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control @error('button_text') is-invalid @enderror" name="button_text" placeholder="Input content button text...">
                                @error('button_text')
                                    <div class="text-danger small">{!! $message !!}</div>
                                @enderror
                                </div>
                            </div>
                            <div class="form-group row mb-4 {{ ($componentType ==  6 ? '' : 'd-none') }}">
                                <label for="button_link" class="col-sm-3 col-form-label">Button Link<span class="text-danger">*</span></label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control @error('button_link') is-invalid @enderror" name="button_link" placeholder="Input content button link...">
                                @error('button_link')
                                    <div class="text-danger small">{!! $message !!}</div>
                                @enderror
                                </div>
                            </div>
                        <div class="form-group row justify-content-end">
                            <div class="col-sm-9">
                                <div>
                                    <button type="submit" class="btn btn-primary w-md">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            $("table tbody").on('click', '#editButton', function(e){
                e.preventDefault();
                get_data(this);
            });

            $("input[name=image]").change(function() {
                imagePreview(this);
            });

            $('#form_editContent').on('submit', function(e) {
                e.preventDefault();
                edit_content(this);
            });

            $('#form_createContent').on('submit', function(e) {
                e.preventDefault();
                create_content(this);
            });

            const editor = SUNEDITOR.create((document.getElementById('sample') || 'sample'),{
                buttonList: [
                ['undo', 'redo'],
                ['font', 'fontSize', 'formatBlock'],
                ['paragraphStyle', 'blockquote'],
                ['bold', 'underline', 'italic', 'strike', 'subscript', 'superscript'],
                ['fontColor', 'hiliteColor', 'textStyle'],
                ['removeFormat'],
                '/', // Line break
                ['outdent', 'indent'],
                ['align', 'horizontalRule', 'list', 'lineHeight'],
                ['table', 'link', 'image', 'video', 'audio' /** ,'math' */], // You must add the 'katex' library at options to use the 'math' plugin.
                /** ['imageGallery'] */ // You must add the "imageGalleryUrl".
                ['fullScreen', 'showBlocks', 'codeView'],
                ['preview', 'print'],
                ['save', 'template'],
                /** ['dir', 'dir_ltr', 'dir_rtl'] */ // "dir": Toggle text direction, "dir_ltr": Right to Left, "dir_rtl": Left to Right
                ]
            });

            function edit_content(form) {
                var data = new FormData(form);
                data.append("description", editor.getContents())

                $.ajax({
                    url: '{{ route("component.edit_content") }}',
                    type: "POST",
                    data: data,
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if(data.status == "success") {
                            $('#modalEdit').modal('hide');
                            setInterval(() => {
                                window.location.reload();
                            }, 1000);
                        }
                    },
                });
            }

            function create_content(form) {
                var data = new FormData(form);
                data.append("description", editor.getContents())

                $.ajax({
                    url: '{{ route("component.create_content") }}',
                    type: "POST",
                    data: data,
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if(data.status == "success") {
                            $('#modalCreate').modal('hide');
                            setInterval(() => {
                                window.location.reload();
                            }, 1000);
                        }
                    },
                });
            }

            function imagePreview(input) {
                if(input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('#preview').removeClass('d-none');
                        $('#preview').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }

            function get_data(form) {
                var id = $(form).attr('data-id');

                $.ajax({
                    url: '{{ route('component.get_content') }}',
                    type: "POST",
                    dataType: 'JSON',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id,
                    },
                    success: function(data) {
                        $('#modalEdit input[name=id]').val(data.content.id);
                        $('#modalEdit input[name=title]').val(data.content.title);
                        $('#modalEdit input[name=embed_link]').val(data.content.embed_link);
                        $('#modalEdit input[name=button_text]').val(data.content.button_text);
                        $('#modalEdit input[name=button_link]').val(data.content.button_link);
                        // $('#modalEdit img[id=preview]').attr('src', `{{ asset('images/image-hero/') }}/${data.content.image}`);
                        editor.setContents(data.content.description)
                    },
                });
            }
        });
    </script>
@endsection

@section('css')
    
@endsection