@extends('layouts.admin_landing')

@section('title')
    Description | Backend
@endsection

@section('javascript')
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('table').DataTable({
                "pageLength" : 50
            });
        });
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header">
                    {{ __('Description') }}
                    <a href="{{ route('backend.description.create') }}" class=" btn btn-sm btn-success">Create</a>
                </div>

                <div class="card-body">
                    @if (Session::has('error'))
                        <div class="alert alert-danger">
                            {!! Session::get('error') !!}
                        </div>
                    @endif

                    @if (Session::has('success'))
                        <div class="alert alert-success">
                            {!! Session::get('success') !!}
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <th>No</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Button</th>
                                <th>Video</th>
                                <th>Image</th>
                                <th>Image Position</th>
                                <th width="205">Action</th>
                            </thead>
                            @foreach ($description as $item)
                            <tbody>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $item->title }}</td>
                                <td>{!! $item->description !!}</td>
                                <td>{{ $item->link }}</td>
                                @if ($item->video != null)
                                <td>{{ $item->video }}</td>
                                @else
                                <td> - </td>
                                @endif
                                @if ($item->image != null)
                                <td class="w-25"><img src="{{ asset('images/description') . '/' . $item->image }}" alt="" class="img-thumbnail"></td>
                                @else
                                <td> - </td>
                                @endif
                                <td>{{ $item->position }}</td>
                                <td>
                                    <a href="{{ route('backend.description.edit' , $item->id) }}" class="btn btn-sm btn-success"><i class="fas fa-pencil-alt pe-1"></i> Edit</a>
                                    <form action="{{ route('backend.description.delete', $item->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-trash-alt pe-1"> Delete</i>
                                        </button>
                                    </form>
                                </td>
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
