@section('title', 'OSLab_'.$os->id.'_'.$os->cliente->titleName())
@include('os.pdf.print-content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- Title --}}
    <title>
        @yield('title_prefix', config('adminlte.title_prefix', ''))
        @yield('title', config('adminlte.title', 'AdminLTE 3'))
        @yield('title_postfix', config('adminlte.title_postfix', ''))
    </title>
    <!-- Latest compiled and minified CSS -->

<!-- Latest compiled and minified JavaScript -->
{{-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script> --}}
    {{-- <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}"> --}}
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> --}}
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/oslab/globalCss.css') }}">

    <style>
        @page { margin: 5; }
        body {
            font-size: 12px;
        }
        h1 {
            font-family: 'metropolis-regular', 'sans-serif'
        }
        b, .bold {
            font-family: 'metropolis-bold', 'sans-serif' !important;
            font-weight: bold;
        }
    </style>

    @yield('css')
</head>
<body style="font-family: 'metropolis-regular', 'sans-serif';">
    @yield('os-print-content')
</body>
</html>

