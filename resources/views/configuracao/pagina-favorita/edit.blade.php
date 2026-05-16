@extends('adminlte::page')

@section('title', 'Editar Página Favorita')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Editar Página Favorita</h1>
        </div>
        <div class="col-sm-6 text-right">
            {!! html()->a(route('configuracao.pagina-favorita.index'), 'Voltar')
                ->class('btn btn-sm btn-secondary') !!}
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Informações da Página Favorita</h3>
                </div>

                {!! html()->form('put', route('configuracao.pagina-favorita.update', ['pagina_favorita' => $favorita->id]))->open() !!}
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="text">Rótulo do Botão</label>
                            {!! html()->text('text', old('text', $favorita->text))
                                ->class('form-control' . ($errors->has('text') ? ' is-invalid' : ''))
                                ->id('text')
                                ->required() !!}
                            @error('text')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="color">Cor do Botão</label>
                            {!! html()->select('color', $colors, old('color', $favorita->color))
                                ->class('form-control' . ($errors->has('color') ? ' is-invalid' : ''))
                                ->id('color')
                                ->required() !!}
                            @error('color')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Visualização do Botão</label>
                            <div class="mt-2">
                                {!! html()->button($favorita->text)
                                    ->type('button')
                                    ->id('preview-button')
                                    ->class('btn ' . $favorita->color) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Informações da Rota</label>
                            <div class="alert alert-info">
                                <strong>Rota:</strong> {{ $favorita->route }}<br>
                                <strong>Ícone:</strong> <i class="{{ $favorita->icon }}"></i> {{ $favorita->icon }}
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        {!! html()->button('Salvar Alterações', 0)
                            ->type('submit')
                            ->class('btn btn-primary') !!}
                    </div>
                {!! html()->form()->close() !!}
            </div>
        </div>

        <div class="col-md-6">
            <div class="card card-info">
                <div class="card-header">
                    <h3 class="card-title">Cores Disponíveis</h3>
                </div>
                <div class="card-body">
                    @foreach ($colors as $colorClass => $colorLabel)
                        <div class="mb-2">
                            {!! html()->button($colorLabel)
                                ->type('button')
                                ->class('btn btn-sm ' . $colorClass) !!}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script>
        $(function () {
            function updatePreview() {
                var text = $('#text').val() || 'Rótulo do Botão';
                var color = $('#color').val();
                var classes = color || 'btn-primary';

                $('#preview-button').attr('class', 'btn ' + classes).text(text);
            }

            $('#text').on('keyup', updatePreview);
            $('#color').on('change', updatePreview);

            updatePreview();
        });
    </script>
@stop
