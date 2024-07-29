@section('title', 'OSLab_'.$os->id.'_'.$os->cliente->titleName())
@include('os.screen.print-content')


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
    {{-- <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">


    @yield('css')
    <link rel="shortcut icon" href="{{ asset('favicons/favicon-color.png') }}" media="(prefers-color-scheme: light)" />
    <link rel="shortcut icon" href="{{ asset('favicons/favicon-white.png') }}" media="(prefers-color-scheme: dark)" />
    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57.png') }}" media="(prefers-color-scheme: dark)" >
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60.png') }}" media="(prefers-color-scheme: dark)" >
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72.png') }}" media="(prefers-color-scheme: dark)" >
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76.png') }}" media="(prefers-color-scheme: dark)" >
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114.png') }}" media="(prefers-color-scheme: dark)" >
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-icon-120x120.png') }}" media="(prefers-color-scheme: dark)" >
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-icon-144x144.png') }}" media="(prefers-color-scheme: dark)" >
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-icon-152x152.png') }}" media="(prefers-color-scheme: dark)" >
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180.png') }}" media="(prefers-color-scheme: dark)" >
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16.png') }}" media="(prefers-color-scheme: dark)" >
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32.png') }}" media="(prefers-color-scheme: dark)" >
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96.png') }}" media="(prefers-color-scheme: dark)" >
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('favicons/android-icon-192x192.png') }}" media="(prefers-color-scheme: dark)" >

    <link rel="apple-touch-icon" sizes="57x57" href="{{ asset('favicons/apple-icon-57x57-color.png') }}" media="(prefers-color-scheme: light)" >
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('favicons/apple-icon-60x60-color.png') }}" media="(prefers-color-scheme: light)" >
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('favicons/apple-icon-72x72-color.png') }}" media="(prefers-color-scheme: light)" >
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('favicons/apple-icon-76x76-color.png') }}" media="(prefers-color-scheme: light)" >
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('favicons/apple-icon-114x114-color.png') }}" media="(prefers-color-scheme: light)" >
    <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('favicons/apple-icon-120x120-color.png') }}" media="(prefers-color-scheme: light)" >
    <link rel="apple-touch-icon" sizes="144x144" href="{{ asset('favicons/apple-icon-144x144-color.png') }}" media="(prefers-color-scheme: light)" >
    <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('favicons/apple-icon-152x152-color.png') }}" media="(prefers-color-scheme: light)" >
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicons/apple-icon-180x180-color.png') }}" media="(prefers-color-scheme: light)" >
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicons/favicon-16x16-color.png') }}" media="(prefers-color-scheme: light)" >
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicons/favicon-32x32-color.png') }}" media="(prefers-color-scheme: light)" >
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('favicons/favicon-96x96-color.png') }}" media="(prefers-color-scheme: light)" >
    <link rel="icon" type="image/png" sizes="192x192"  href="{{ asset('favicons/android-icon-192x192-color.png') }}" media="(prefers-color-scheme: light)" >
    {{-- <link rel="manifest" crossorigin="use-credentials" href="{{ asset('favicons/manifest.json') }}"> --}}
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset('favicon/ms-icon-144x144.png') }}">
</head>
<body style="margin: 15px" >
{{-- <body style="margin: 15px" onload="window.print()"> --}}
    @yield('os-print-content')
</body>
    {{-- <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script> --}}

    @yield('js')

</html>

