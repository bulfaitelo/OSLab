@extends('adminlte::page')

@section('title', 'Detalhes da Auditoria')

@section('content_header')
    <h1><i class="fas fa-history"></i> Detalhes da Auditoria</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <a href="{{ route('relatorio.sistema.auditoria.index') }}">
            <button type="button" class="btn btn-sm btn-default d-print-none">
                <i class="fa-solid fa-chevron-left"></i>
                Voltar
            </button>
        </a>
        <a onclick="window.print();return false;" class="d-print-none">
            <button type="button" title="Imprimir" class="btn btn-sm bg-navy d-print-none">
                <i class="fa-solid fa-print"></i>
                <span class="d-none d-sm-inline">Imprimir</span>
            </button>
        </a>
    </div>

    <div class="card-body">
        <div class="d-none d-print-block">
            {{ App\Models\Configuracao\Sistema\Emitente::getHtmlEmitente(1) }}
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label><strong>Data/Hora:</strong></label>
                    <p>{{ $auditoria->created_at->format('d/m/Y H:i:s') }}</p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Usuário:</strong></label>
                    <p>
                        @if($auditoria->user)
                            <span class="badge badge-info">{{ $auditoria->user->name }}</span>
                        @else
                            <span class="badge badge-secondary">Sistema</span>
                        @endif
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Tipo de Evento:</strong></label>
                    <p>
                        @if($auditoria->event === 'created')
                            <span class="badge badge-success badge-lg">{{ ucfirst($auditoria->event) }}</span>
                        @elseif($auditoria->event === 'updated')
                            <span class="badge badge-warning badge-lg">{{ ucfirst($auditoria->event) }}</span>
                        @elseif($auditoria->event === 'deleted')
                            <span class="badge badge-danger badge-lg">{{ ucfirst($auditoria->event) }}</span>
                        @else
                            <span class="badge badge-secondary badge-lg">{{ ucfirst($auditoria->event) }}</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>Modelo:</strong></label>
                    <p>
                        <span class="badge badge-primary">
                            {{ class_basename($auditoria->auditable_type) }}
                        </span>
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label><strong>ID do Registro:</strong></label>
                    <p>{{ $auditoria->auditable_id }}</p>
                </div>
            </div>
        </div>

        <hr>

        <div class="row">
            <div class="col-md-12">
                <h4><i class="fas fa-arrow-right"></i> Valores Alterados</h4>
            </div>
        </div>

        @if($auditoria->event === 'created')
            <div class="alert alert-success" role="alert">
                <strong>Novo Registro Criado</strong>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead class="table-success">
                        <tr>
                            <th width="30%">Campo</th>
                            <th width="70%">Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($auditoria->new_values as $field => $value)
                            <tr>
                                <td><strong>{{ $field }}</strong></td>
                                <td>
                                    @if(is_array($value))
                                        <pre>{{ json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                    @else
                                        {{ $value }}
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center"><em>Sem alterações registradas</em></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @elseif($auditoria->event === 'deleted')
            <div class="alert alert-danger" role="alert">
                <strong>Registro Deletado</strong>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered table-sm">
                    <thead class="table-danger">
                        <tr>
                            <th width="30%">Campo</th>
                            <th width="70%">Valor Deletado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($auditoria->old_values as $field => $value)
                            <tr>
                                <td><strong>{{ $field }}</strong></td>
                                <td>
                                    @if(is_array($value))
                                        <pre>{{ json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                    @else
                                        {{ $value }}
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center"><em>Sem dados deletados</em></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @else
            <div class="alert alert-warning" role="alert">
                <strong>Registro Atualizado</strong>
            </div>

            @if(count($auditoria->old_values) > 0 || count($auditoria->new_values) > 0)
                <div class="row">
                    <div class="col-md-6">
                        <h5 class="text-danger"><i class="fas fa-arrow-left"></i> Valores Anteriores</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead class="table-danger">
                                    <tr>
                                        <th>Campo</th>
                                        <th>Valor Anterior</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($auditoria->old_values as $field => $value)
                                        <tr>
                                            <td><strong>{{ $field }}</strong></td>
                                            <td>
                                                @if(is_array($value))
                                                    <pre>{{ json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                                @else
                                                    {{ $value }}
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center"><em>Nenhum</em></td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <h5 class="text-success"><i class="fas fa-arrow-right"></i> Novos Valores</h5>
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead class="table-success">
                                    <tr>
                                        <th>Campo</th>
                                        <th>Novo Valor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($auditoria->new_values as $field => $value)
                                        <tr>
                                            <td><strong>{{ $field }}</strong></td>
                                            <td>
                                                @if(is_array($value))
                                                    <pre>{{ json_encode($value, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</pre>
                                                @else
                                                    {{ $value }}
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="2" class="text-center"><em>Nenhum</em></td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-info" role="alert">
                    <em>Nenhuma alteração registrada neste evento.</em>
                </div>
            @endif
        @endif

        <hr>

        <div class="row">
            <div class="col-md-12">
                <p class="text-muted text-sm">
                    <strong>IP:</strong> {{ $auditoria->ip_address }}<br>
                    <strong>User Agent:</strong> <small>{{ $auditoria->user_agent }}</small>
                </p>
            </div>
        </div>
    </div>
</div>
@stop
