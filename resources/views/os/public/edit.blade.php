<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ url('') }}/vendor/patternlock/patternlock.css">
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

</head>
<body>
    <div class="content">
        <div class="container-fluid">
            <div class="row justify-content-md-center">
                <div class="col-md-6 mt-3">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">{{ $informacao->getTipo() }}</h3>
                        </div>
                        <form>
                            <div class="card-body">
                                @if ($informacao->tipo == 1)
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="anotacao">Anotação</label>
                                            <textarea type="text" disabled id="anotacao" class="form-control" placeholder="Escreva aqui a anotação">{{$informacao->informacao}}</textarea>
                                        </div>
                                    </div>
                                @endif
                                @if ($informacao->tipo == 2)
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="descricao_senha">Descricao</label>
                                            <input type="text" value="{{$informacao->descricao}}" disabled id="descricao_senha" class="form-control" placeholder="Descrição ">
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
                                            <label for="senha_texto">Senha</label>
                                            @livewire('os.informacoes.senha-input', ['senha' => $informacao->informacao, 'senha_id' => $informacao->id], key($informacao->id))
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
                                            <button type="button" class="btn btn-sm btn-primary" wire:click="getFile({{$informacao->id}})">
                                                <i class="fa-solid fa-download"></i>
                                                Download
                                            </button>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-sm btn-primary">
                                    <i class="fas fa-save"></i>
                                    Salvar
                                </button>
                            </div>
                        </form>
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

    <script>
    $(document).ready(function() {

        let senha_padrao ;

            function sleep(ms) {
                return new Promise(resolve => setTimeout(resolve, ms));
            }
            var e = document.getElementById('lock');

            var p =  new PatternLock(e, {
                onPattern: async function(pattern) {
                    senha = pattern.toString()
                    if (senha.length > 3 ) {
                        this.success();
                        senha_padrao = pattern;
                    } else {
                        this.error();
                        senha_padrao = '';
                        await sleep(1000);
                        this.clear();
                    }
                }
            });
            // function setPadrao(id, tipo, senha) {
            //     if (tipo == 'padrao') {
            //         var e = document.getElementById('lock_view_'+id);
            //         var p =  new PatternLock(e, {
            //         });
            //         p.setPattern(senha);
            //     }
            // }


    })
    </script>
</html>


