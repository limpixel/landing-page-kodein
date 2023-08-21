@extends('layouts.app')

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
                <div class="card-header ">
                    {{ __('Artikel | Dashboard') }}
                    <a href="{{ route('backend.categories.create') }}" class=" btn btn-sm btn-success">Create</a>
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
                                <th>status</th>
                                <th>user_id</th>
                                <th>category_id</th>
                                <th>title</th>
                                <th>Slug</th>
                                <th>image</th>
                                <th>description</th>
                                <th>content</th>
                                <th>views</th>
                                
                                <th width="205">Action</th>
                            </thead>
                            @foreach ($artikel as $item)
                            <tbody>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $item->status }}</td>
                                <td>{{ $item->user_id  }}</td>
                                <td>{{ $item->category_id }}</td>
                                <td>{{ $item->title  }}</td>
                                <td>{{ $item->slug  }}</td>
                                <td>{{ $item->image  }}</td>
                                <td>{{ $item->description  }}</td>
                                <td>{{ $item->content  }}</td>
                                <td>{{ $item->views  }}</td>
                                <td>
                                    <a href="{{route('backend.categories.edit', $item->id )}}" class="btn btn-sm btn-success"><i class="fas fa-pencil-alt pe-1"></i> Edit</a>
                                    <form action="{{route('backend.categories.delete', $item->id)}}" method="post" class="d-inline">
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
