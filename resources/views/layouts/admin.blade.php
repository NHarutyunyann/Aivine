<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="/images/aivine/adminLogo.webp">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin &lsaquo; @yield('title')</title>
    <link rel="shortcut icon" href="{{ URL::asset('images/aivine/adminLogo.webp') }}" type="image/x-icon" />
    {{-- <link rel="stylesheet" href="{{ asset('fonts/googleapis/fonts.googleapis.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('fontawesome-free/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
    <script>
        window._configs = {
            locale: '{{ app()->getLocale() }}',
            csrf: "{{ csrf_token() }}",
            awsUrl: "{{ config('filesystems.disks.s3.url') }}"
        }
    </script>
    <link href="{{ asset('dist/admin/css/main.css?v=' . config('app.release')) }}" rel="stylesheet">
    @yield('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper" id="admin">
        @include('admin.partials.header')
        <!-- Main Sidebar Container -->
        @include('admin.partials.sidebar')
        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- /.content-wrapper -->
        @include('admin.partials.footer')
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap-switch.min.js') }}"></script>
    <script src="{{ asset('js/adminlte.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('js/select2.full.min.js') }}"></script>
    <script src="{{ asset('dist/admin/js/admin.js?v=' . time()) }}"></script>
    <script src="{{ asset('/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('/js/moment.min.js') }}"></script>
    <script src="{{ asset('js/table.js') }}"></script>
    <script>
        $(document).ready(function() {
            @if (session('error'))
                @if (is_array(session('error')))
                    @foreach (session('error') as $error)
                        toastr.error('{!! $error !!}', 'Something went wrong', {
                            timeOut: 20000
                        })
                    @endforeach
                @else
                    toastr.error('{!! session('error') !!}', 'Something went wrong', {
                        timeOut: 20000
                    })
                @endif
            @endif


            @if (session('success'))
                toastr.success('{!! session('success') !!}', {
                    timeOut: 20000
                })
            @endif

            @if (session('errors'))
                @foreach (session('errors')->getMessages() as $key => $value)
                    toastr.error('{!! $value[0] !!}', 'Validation Error', {
                        timeOut: 20000
                    })
                @endforeach
            @endif
        })
    </script>
    <script src="{{ asset('js/tinymce/tinymce.min.js') }}"></script>
    <script src="{{ asset('js/textarea.js') }}"></script>
    <script src="{{ asset('js/admin.js?v=' . config('app.release')) }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>

    @yield('scripts')
</body>

</html>
