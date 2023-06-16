<?php 
    $components = DB::table('components')->orderBy('order')->get();
    $componentTypes = DB::table('component_types')->get();
?>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet">
    <style>
        /* Gaya khusus untuk sidebar */
        .sidebar {
            background-color: #f5f5f5;
            padding: 20px;
            height: 100vh;
            overflow-y: auto;
        }

        .main-content {
            padding-bottom: 60px; /* Menambahkan padding ke konten utama agar footer terlihat */
            height: 100vh;
            overflow-y: auto;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #f5f5f5;
            padding: 20px;
            text-align: center;
        }
    </style>
    @yield('css')

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 sidebar">
                    <!-- Isi sidebar -->
                    <h4 class="text-center">Landing Page Component</h4>
                    <ul class="nav flex-column">
                        <div class="row my-2">
                            <button class="col-6 btn mx-auto btn-secondary">Theme</button>
                            <button class="col-6 btn mx-auto btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Create new Component</button>
                        </div>
                        <div class="bg-white card card-body mb-2">Header</div>
                        <div class="sortable parent">
                            @foreach ($components as $component)
                                <div id="component-{{ $component->order }}" class="bg-white card card-body mb-2 drag-element">{{ $component->title }}</div>
                            @endforeach
                        </div>
                        <div class="bg-white card card-body mb-2">Footer</div>
                    </ul>
                </div>
                <div class="col-md-9 main-content">
                    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                        <div class="container">
                            <a class="navbar-brand" href="{{ url('/') }}">
                                {{ config('app.name', 'Laravel') }}
                            </a>
                            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                                <span class="navbar-toggler-icon"></span>
                            </button>
            
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <!-- Left Side Of Navbar -->
                                <ul class="navbar-nav me-auto">
            
                                </ul>
            
                                <!-- Right Side Of Navbar -->
                                <ul class="navbar-nav ms-auto">
                                    <!-- Authentication Links -->
                                    @guest
                                        @if (Route::has('login'))
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                            </li>
                                        @endif
            
                                        @if (Route::has('register'))
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                            </li>
                                        @endif
                                    @else
                                        <li class="nav-item dropdown">
                                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                {{ Auth::user()->name }}
                                            </a>
            
                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                                <a class="dropdown-item" href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                                                    {{ __('Logout') }}
                                                </a>
            
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            </div>
                                        </li>
                                    @endguest
                                </ul>
                            </div>
                        </div>
                    </nav>
                    <main class="py-4">
                        @yield('content')
                    </main>
                </div>
                <footer class="footer">
                    <div class="container">
                        <span>Hak Cipta &copy; 2023. Semua hak dilindungi.</span>
                    </div>
                </footer>
            </div>
        </div>

    </div>

    @yield('modal')
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create new Component</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="#" id="form_addComponent" method="POST" class="js-validation-edit">
                        @csrf
                        <input type="hidden" name="id">
                        <div class="form-group row mb-4">
                            <label for="name" class="col-sm-3 col-form-label">Type<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                                <select class="form-select" name="component_type">
                                    @foreach ($componentTypes as $type)
                                        <option value="{{ $type->id }}">{{ $type->type }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label for="name" class="col-sm-3 col-form-label">Name<span class="text-danger">*</span></label>
                            <div class="col-sm-9">
                              <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Input component name...">
                              @error('name')
                                  <div class="text-danger small">{!! $message !!}</div>
                              @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="form-group row justify-content-end">
                                <div class="col-sm-9">
                                    <div>
                                        <button type="submit" class="btn btn-primary w-md">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#form_addComponent').on('submit', function(e) {
                e.preventDefault();
                addComponent(this);
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function addComponent(form) {
                var data = new FormData(form);

                $.ajax({
                    url: '{{ route('component.add') }}',
                    type: "POST",
                    data: data,
                    dataType: 'JSON',
                    processData: false,
                    contentType: false,
                    success: function(data) {

                    },
                });
                window.location.reload();
            }

            $( ".parent" ).sortable({
                items: ".drag-element",
                revert: true,
                connectWith: ".parent",
                axis: "y",
                update: function(event, ui) {
                    var data = $(this).sortable('serialize');
                    console.log(data);

                    $.ajax({
                        data: data,
                        type: 'POST',
                        url: '{{ route('component.move') }}',
                    })

                    window.location.reload();
                }
            });
        });
    </script>
    @yield('script')
</body>
</html>
