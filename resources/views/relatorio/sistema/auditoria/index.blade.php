@extends('adminlte::page')

@section('title', 'Auditoria do Sistema')

@section('content_header')
    <h1><i class="fas fa-history"></i> Auditoria do Sistema</h1>
@stop

@section('content')
<div class="card">
    {!! html()->form('get', route('relatorio.sistema.auditoria.index'))->open() !!}
    <div class="card-header">
        <a href="{{ url()->previous() }}">
            <button type="button" class="btn btn-sm btn-default d-print-none">
                <i class="fa-solid fa-chevron-left"></i>
                Voltar
            </button>
        </a>
        @if (Request::all())
        <a onclick="window.print();return false;">
            <button type="button" title="Imprimir" class="btn btn-sm bg-navy d-print-none">
                <i class="fa-solid fa-print"></i>
                <span class="d-none d-sm-inline">Imprimir</span>
            </button>
        </a>
        @endif
        <button type="submit" class="float-right btn bg-lightblue btn-sm d-print-none">
            <i class="fa-solid fa-magnifying-glass"></i>
            Buscar
        </button>
    </div>

    <div class="card-body">
        <div class="d-none d-print-block">
            {{ App\Models\Configuracao\Sistema\Emitente::getHtmlEmitente(1) }}
        </div>

        @include('adminlte::partials.form-alert')

        <div class="row d-print-none">
            <div class="col-md-2">
                <div class="form-group">
                    <label for="data_inicio">Data Início</label>
                    {!! html()->date('data_inicio', ($request->data_inicio == true) ? $request->data_inicio : null)->class('form-control')->placeholder('Data Início') !!}
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label for="data_fim">Data Fim</label>
                    {!! html()->date('data_fim', ($request->data_fim == true) ? $request->data_fim : null)->class('form-control')->placeholder('Data Fim') !!}
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="auditable_type">Modelo</label>
                    {!! html()->select('auditable_type', ['' => '-- Selecione --'] + array_combine($modelos, $modelos), $request->auditable_type)->class('form-control')->placeholder('Modelo') !!}
                </div>
            </div>

            <div class="col-md-2">
                <div class="form-group">
                    <label for="event">Tipo de Evento</label>
                    {!! html()->select('event', ['' => '-- Selecione --', 'created' => 'Criado', 'updated' => 'Atualizado', 'deleted' => 'Deletado'], $request->event)->class('form-control') !!}
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="user_id">Usuário</label>
                    {!! html()->select('user_id', ['' => '-- Selecione --'] + $usuarios->toArray(), $request->user_id)->class('form-control') !!}
                </div>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-sm table-hover text-nowrap">
                <thead >
                    <tr>
                        <th>Data/Hora</th>
                        <th>Usuário</th>
                        <th>Modelo</th>
                        <th>ID do Registro</th>
                        <th>Evento</th>
                        <th>Detalhes</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($auditorias as $auditoria)
                        <tr>
                            <td>
                                <span title="{{ $auditoria->created_at }}">
                                    {{ $auditoria->created_at->format('d/m/Y H:i:s') }}
                                </span>
                            </td>
                            <td>
                                @if($auditoria->user)
                                    <span class="badge badge-info">{{ $auditoria->user->name }}</span>
                                @else
                                    <span class="badge badge-secondary">Sistema</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge badge-primary">
                                    {{ class_basename($auditoria->auditable_type) }}
                                </span>
                            </td>
                            <td>{{ $auditoria->auditable_id }}</td>
                            <td>
                                @if($auditoria->event === 'created')
                                    <span class="badge badge-success">{{ ucfirst($auditoria->event) }}</span>
                                @elseif($auditoria->event === 'updated')
                                    <span class="badge badge-warning">{{ ucfirst($auditoria->event) }}</span>
                                @elseif($auditoria->event === 'deleted')
                                    <span class="badge badge-danger">{{ ucfirst($auditoria->event) }}</span>
                                @else
                                    <span class="badge badge-secondary">{{ ucfirst($auditoria->event) }}</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('relatorio.sistema.auditoria.show', $auditoria->id) }}" class="btn btn-sm btn-default d-print-none" title="Ver Detalhes">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">
                                <em>Nenhum registro de auditoria encontrado.</em>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($auditorias->count() > 0)
        <div class="row d-print-none">
            <div class="col-md-12">
                {{ $auditorias->appends(request()->query())->links() }}
            </div>
        </div>
        @endif
    </div>
    {!! html()->form()->close() !!}
</div>
@stop
