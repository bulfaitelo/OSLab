<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>OS Lab - {{$informacao->getTipo()}}</title>
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ url('') }}/vendor/patternlock/patternlock.css">
    <link rel="stylesheet" href="{{ url('') }}/vendor/oslab/globalCss.css">
    @livewireStyles
    <style>

        .icon{
            width: 3rem;
        }
        .item{
            width: 100%;
        }

        .ts-wrapper .option .title {
            display: block;
        }
        .ts-wrapper .option .url {
            font-size: 15px;
            display: block;
            color: #7c7c7c;
        }

        .ts-wrapper::after {
            display: none;
        }

    </style>
        {{-- Favicon --}}
    @if(config('adminlte.use_ico_only'))
        <link rel="shortcut icon" href="{{ asset('favicons/favicon-color.png') }}" media="(prefers-color-scheme: light)" />
        <link rel="shortcut icon" href="{{ asset('favicons/favicon-white.png') }}" media="(prefers-color-scheme: dark)" />
    @elseif(config('adminlte.use_full_favicon'))
        {{-- <link rel="shortcut icon" href="{{ asset('favicons/favicon.ico') }}" /> --}}
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
    @endif

</head>
<body>
    <div class="content">
        {!! $emitente !!}
        <div class="container-fluid">
            <div class="row justify-content-md-center">
                <div class="col-md-6 mt-3">
                    <div class="card ">
                        <div class="card-header">
                            <h3 class="card-title">{{ $informacao->getTipo() }}</h3>
                        </div>
                        @include('adminlte::partials.form-alert')
                        {!! html()->form('put', route('os.public.update', $informacao->uuid))->open() !!}
                        {!! html()->hidden('tipo', $informacao->tipo) !!}
                            <div class="card-body">
                                @if ($informacao->tipo == 1)
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="anotacao">Anotação</label>
                                            <textarea type="text" name="informacao" id="anotacao" class="form-control" placeholder="Escreva aqui a anotação">{{$informacao->informacao}}</textarea>
                                        </div>
                                    </div>
                                @endif
                                @if ($informacao->tipo == 2)

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="descricao_senha">Descricao</label>
                                            <input type="text" value="{{$informacao->descricao}}" name="descricao" id="descricao_senha" class="form-control" placeholder="Descrição ">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="tipo_senha">Tipo de senha</label>
                                            {!! html()->select('', ['text'=> 'Texto', 'padrao'=> 'Padrão'], $informacao->tipo_informacao)->class('form-control')->disabled() !!}
                                        </div>
                                    </div>
                                    <div class="col-md-12"  @if ($informacao->tipo_informacao == 'padrao') style="display: none" @endif >
                                        <div class="form-group">
                                            <label for="usuario_senha">Usuário</label>
                                            <input id="usuario" name="usuario" type="text" class="form-control" placeholder="Usuário">
                                        </div>
                                        <div class="form-group">
                                            <label for="senha_texto">Senha</label>
                                            <input id="informacao" name="informacao" type="text" class="form-control" placeholder="Senha">
                                        </div>
                                    </div>
                                    <div class="col-md-12" @if ($informacao->tipo_informacao == 'texto') style="display: none" @endif >
                                        <label for="">Padrão</label>
                                        <svg class="patternlock" id="lock" viewBox="0 0 100 100" >
                                            <g class="lock-actives"></g>
                                            <g class="lock-lines"></g>
                                            <g class="lock-dots">
                                                <circle cx="20" cy="20" r="2"/>
                                                <circle cx="50" cy="20" r="2"/>
                                                <circle cx="80" cy="20" r="2"/>
                                                <circle cx="20" cy="50" r="2"/>
                                                <circle cx="50" cy="50" r="2"/>
                                                <circle cx="80" cy="50" r="2"/>
                                                <circle cx="20" cy="80" r="2"/>
                                                <circle cx="50" cy="80" r="2"/>
                                                <circle cx="80" cy="80" r="2"/>
                                            </g>
                                        </svg>
                                    </div>
                                @endif
                                @if ($informacao->tipo == 3)
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="descricao_senha">Descricao</label>
                                            <input type="text" value="{{$informacao->descricao}}" disabled id="descricao_senha" class="form-control" placeholder="Descrição ">
                                            @error('descricao_senha') <span class="error">{{ $message }}</span> @enderror
                                        </div>
                                    </div>
                                    @if (in_array($informacao->tipo_informacao, ['jpg', 'bmp', 'png']))
                                        <div class="col-md-12">
                                            <img class="img-fluid" src="{{$informacao->url()}}" alt="{{$informacao->getDescricao()}}">
                                        </div>
                                    @endif
                                    <div class="col-md-12 mt-3">
                                        <div class="form-group">
                                                <a href="{{$informacao->url()}}" target="_blank" class="btn btn-sm btn-oslab">
                                                    <i class="fa-solid fa-download"></i>
                                                    Download
                                                </a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-sm btn-oslab">
                                    <i class="fas fa-save"></i>
                                    Salvar
                                </button>
                            </div>
                        {!! html()->form()->close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>


</body>
    <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('vendor/jquery-mask/jquery.mask.min.js') }}"></script>
    <script src="{{ url('') }}/vendor/patternlock/patternlock.js"></script>
    @livewireScripts
    <script>
    $(document).ready(function() {
        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }
        var e = document.getElementById('lock');

        var p =  new PatternLock(e, {
            onPattern: async function(pattern) {
                senha = pattern.toString()
                if (senha.length > 3 ) {
                    $('#informacao').val(pattern)
                    this.success();
                } else {
                    this.error();
                    $('#informacao').val('')
                    await sleep(1000);
                    this.clear();
                }
            }
        });
    })
    </script>
</html>


