@extends('adminlte::page')

@section('title', 'Criar Notificação')

@section('content_header')
    <h1> <i class="fa-solid fa-bell "></i> Criar Notificação</h1>
@stop

@section('content')

<div class="row justify-content-md-center">
    <div class="col-md-12 ">
        <!-- general form elements -->
        <div class="card">
            <div class="card-header">
                <a href="{{ url()->previous() }}">
                    <button type="button"  class="btn btn-sm btn-default">
                        <i class="fa-solid fa-chevron-left"></i>
                        Voltar
                    </button>
              </a>
            </div>
            <!-- /.card-header -->
            <!-- form start -->

            <div class="card-body">
                @include('adminlte::partials.form-alert')
                {!! html()->form('post', route('servico.store'))->acceptsFiles()->open() !!}
                <!-- Informações Básicas -->
                <div class="mb-3">
                    <h3 class="section-header">
                        <i class="fas fa-clipboard-list"></i> Informações Básicas
                    </h3>
                    <div class="row">
                        <div class="col-md-1">
                            <label for="chek_ativo">Ativo</label>
                            <div class="custom-control custom-switch custom-switch-md">
                                {!! html()->checkbox('ativo', true)->class('custom-control-input') !!}
                                <label class="custom-control-label" for="ativo"></label>
                            </div>
                        </div>
                        <div class="col-md-7 mb-3">
                            <label for="name" class="form-label">Nome da Notificação</label>
                            {!! html()->text('name')->class('form-control')->placeholder('Ex: Relatório Diário de Vendas')->required() !!}
                            <div class="form-text">Nome identificador único para esta notificação</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="categoria_id" class="form-label">Categoria</label>
                            {!! html()->select('categoria_id', \App\Models\Configuracao\Parametro\Categoria::orderBy('name')->pluck('name', 'id'))->class('form-control')->placeholder('Todas as Categorias') !!}
                            <div class="form-text">Categoria que a notificação será enviada</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 mb-3">
                            <label for="descricao" class="form-label">Descrição</label>
                            {!! html()->text('descricao')->class('form-control')->placeholder('Descreva o propósito e conteúdo desta notificação') !!}
                            <div class="form-text">Descrição detalhada da notificação</div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="status_id" class="form-label">Status</span></label>
                            {!! html()->select('status_id', \App\Models\Configuracao\Parametro\Status::orderBy('name')->pluck('name', 'id'))->class('form-control')->placeholder('Todos os Status') !!}
                            <div class="form-text">Status que a notificação será enviada</div>
                        </div>
                    </div>
                </div>

                <!-- envio de mensagens -->
                <div class="mb-3">
                    <h3 class="section-header">
                        <i class="fa-solid fa-paper-plane"></i></i> Mensagem
                    </h3>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="conteudo_html">Conteúdo da Mensagem com estilos e HTML</label>
                                {!! html()->textarea('conteudo_html')->class('texto')->placeholder('Status')->required() !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9 mb-3">
                            <label for="descricao" class="form-label">Conteúdo da Mensagem sem estilos e HTML</label>
                            <textarea class="form-control" id="descricao" name="descricao" rows="4" placeholder="Descreva o propósito e conteúdo desta notificação" required=""></textarea>
                            <div class="form-text">Descrição detalhada da notificação</div>
                        </div>
                    </div>



                </div>

                <!-- Configuração de Envio -->
                <div class="mb-5">
                    <h3 class="section-header">
                        <i class="fas fa-cogs"></i> Configuração de Envio
                    </h3>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Tipo de Notificação<span class="required-span" title="Este campo é obrigatório">*</span></label>
                            <br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tipo_notificacao" id="tempo_real"
                                    value="tempo_real" checked onchange="toggleSchedulingFields()">
                                <label class="form-check-label" for="tempo_real">
                                    ⚡ Tempo Real
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="tipo_notificacao" id="agendamento"
                                    value="agendamento" onchange="toggleSchedulingFields()">
                                <label class="form-check-label" for="agendamento">
                                    📅 Agendamento
                                </label>
                            </div>
                            <div class="form-text mt-3">Escolha se a notificação será enviada imediatamente ou agendada</div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="canal" class="form-label">Canal de Saída</label>
                            {!! html()->select('canal', \App\Models\Configuracao\Parametro\Categoria::orderBy('name')->pluck('name', 'id'))->class('form-control')->placeholder('Selecione por onde a mensagem será enviada')->required() !!}
                            <div class="form-text">Canal através do qual a notificação será enviada</div>
                        </div>
                    </div>
                    <div id="schedulingFields" style="display: none;">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="horario" class="form-label">Horário de Envio</label>
                                {!! html()->time('horario')->class('form-control')->placeholder('HH:MM') !!}
                                <div class="form-text">Horário específico para envio da notificação</div>
                            </div>
                            <div class="col-md-4">
                                <label for="intervalo_dia" class="form-label">Intervalo de Dias</label>
                                {!! html()->number('intervalo_dia')->class('form-control')->placeholder('Número de dias entre envios') !!}
                                <div class="form-text">Intervalo em dias para reenvio da notificação</div>
                            </div>
                        </div>
                    </div>
                    <div id="schedulingAlert" class="alert alert-success">
                        ⚡ Esta notificação será enviada imediatamente quando acionada
                    </div>
                </div>
            </div>
            {{-- Minimal with icon only --}}
            <!-- /.card-body -->
            <div class="card-footer">
                <button type="submit" class="btn btn-sm btn-oslab">
                    <i class="fas fa-save"></i>
                    Salvar
                </button>
            </div>
        </div>
      <!-- /.card -->
      {!! html()->form()->close() !!}
      </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ url('') }}/vendor/summernote/summernote-bs4.min.css">
@stop

@section('js')
<script src="{{ url('') }}/vendor/summernote/summernote-bs4.min.js"></script>
<script src="{{ url('') }}/vendor/summernote/lang/summernote-pt-BR.js"></script>
<script>
    $(document).ready(function() {
        $('.texto').summernote({
            lang: 'pt-BR',
            height: 300,
            toolbar: [
                // [ 'style', [ 'style' ] ],
                [ 'font', [ 'bold', 'italic', 'clear'] ],
                // [ 'fontname', [ 'fontname' ] ],
                // [ 'fontsize', [ 'fontsize' ] ],
                // [ 'color', [ 'color' ] ],
                [ 'para', [ 'ol', 'ul', 'paragraph', ] ],
                [ 'table', [ 'table' ] ],
                [ 'insert', ['link', 'picture',]],
                [ 'view', [ 'undo', 'redo', 'codeview', 'help' ] ]
            ]
        });
    });
</script>
<script>
    $('.decimal').mask('#.##0,00', { reverse: true });
</script>
<script>
    function toggleSchedulingFields() {
            const tempoReal = document.getElementById('tempo_real').checked;
            const schedulingFields = document.getElementById('schedulingFields');
            const schedulingAlert = document.getElementById('schedulingAlert');

            console.log(schedulingFields);

            if (schedulingFields) {
                if (tempoReal) {
                    schedulingFields.style.display = 'none';
                    schedulingAlert.style.display = 'block';
                    // Remove required attributes
                    document.getElementById('horario').removeAttribute('required');
                    document.getElementById('intervalo_dia').removeAttribute('required');
                } else {
                    schedulingFields.style.display = 'block';
                    schedulingAlert.style.display = 'none';
                    // Add required attributes
                    document.getElementById('horario').setAttribute('required', 'required');
                    document.getElementById('intervalo_dia').setAttribute('required', 'required');
                }
            }
        }
</script>
@stop
