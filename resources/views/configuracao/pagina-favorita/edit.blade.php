@extends('adminlte::page')

@section('title', 'Editar Página Favorita')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Editar Página Favorita</h1>
        </div>
        <div class="col-sm-6 text-right">
            <a href="{{ route('configuracao.pagina-favorita.index') }}" class="btn btn-sm btn-secondary">
                <i class="fas fa-arrow-left"></i> Voltar
            </a>
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
                <form action="{{ route('configuracao.pagina-favorita.update', $favorita->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="text">Rótulo do Botão</label>
                            <input type="text" class="form-control @error('text') is-invalid @enderror" id="text" name="text" value="{{ old('text', $favorita->text) }}" required>
                            @error('text')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="color">Cor do Botão</label>
                            <select class="form-control @error('color') is-invalid @enderror" id="color" name="color" required>
                                @foreach ($colors as $colorClass => $colorLabel)
                                    <option value="{{ $colorClass }}" {{ old('color', $favorita->color) === $colorClass ? 'selected' : '' }}>
                                        {{ $colorLabel }}
                                    </option>
                                @endforeach
                            </select>
                            @error('color')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Visualização do Botão</label>
                            <div class="mt-2">
                                <button type="button" id="preview-button" class="btn {{ $favorita->color }}">
                                    {{ $favorita->text }}
                                </button>
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
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Salvar Alterações
                        </button>
                    </div>
                </form>
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
                            <button type="button" class="btn btn-sm {{ $colorClass }}">
                                {{ $colorLabel }}
                            </button>
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
