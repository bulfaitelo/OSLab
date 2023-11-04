<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>OS Lab</title>
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">

</head>
<body>
    <div class="content">
        {!! $emitente !!}
        <div class="container-fluid">
            <div class="row justify-content-md-center">
                <div class="col-md-6 mt-3">
                    <div class="card ">
                        <div class="card-header text-center">
                            Informação atualizada com sucesso!
                        </div>
                        <div class="card-body text-center">
                            <h4>Você já pode fechar essa janela!</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
</html>


