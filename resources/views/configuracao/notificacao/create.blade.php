@extends('adminlte::page')

@section('title', 'Criar Notificação')

@section('content_header')
<h1> <i class="fa-solid fa-bell "></i> Criar Notificação</h1>
@stop

@section('content')

<div class="row justify-content-md-center">
    <div class="col-md-10 ">
        <!-- general form elements -->
        <div class="card">
            <div class="card-header">
                <a href="{{ url()->previous() }}">
                    <button type="button" class="btn btn-sm btn-default">
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
                        <div class="col-md-2">
                            <label for="chek_ativo">
                                Notificação Ativa
                                <help-popover content="Ativa ou desativa a notificação. Se desativada não será enviada">
                                </help-popover>
                            </label>
                            <div class="custom-control custom-switch custom-switch-md">
                                {!! html()->checkbox('ativo', true)->class('custom-control-input') !!}
                                <label class="custom-control-label" for="ativo"></label>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="canal" class="form-label">
                                Canal de Saída
                                <help-popover content="Canal através do qual a notificação será enviada">
                                </help-popover>
                            </label>
                            {!! html()->select('canal', ['notificacao' => 'Notificação interna', 'whatsapp' => 'WhatsApp', 'email' => 'E-Mail'])->class('form-control')->placeholder('Selecione por onde a mensagem será enviada')->required() !!}
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="categoria_id" class="form-label">
                                Categoria
                                <help-popover content="Categoria que a notificação será enviada">
                                </help-popover>
                            </label>
                            {!! html()->select('categoria_id', \App\Models\Configuracao\Parametro\Categoria::orderBy('name')->pluck('name', 'id'))->class('form-control')->placeholder('Todas as Categorias') !!}
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="status_id" class="form-label">
                                Status
                                <help-popover content="Status que a notificação será enviada">
                                </help-popover>
                            </label>
                            {!! html()->select('status_id', \App\Models\Configuracao\Parametro\Status::orderBy('name')->pluck('name', 'id'))->class('form-control')->placeholder('Todos os Status') !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="name" class="form-label">
                                Nome da Notificação
                                <help-popover content="Nome identificador para esta notificação">
                                </help-popover>
                            </label>
                            {!! html()->text('name')->class('form-control')->placeholder('Ex: Relatório Diário de Vendas')->required() !!}
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="descricao" class="form-label">
                                Descrição
                                <help-popover content="Descreva o propósito e conteúdo desta notificação">
                                </help-popover>
                            </label>
                            {!! html()->text('descricao')->class('form-control')->placeholder('Descreva o propósito e conteúdo desta notificação') !!}
                        </div>

                    </div>
                </div>

                <!-- Configuração de Envio -->
                <div class="mb-3">
                    <h3 class="section-header">
                        <i class="fas fa-cogs"></i> Configuração de Envio
                    </h3>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">
                                Tipo de Notificação
                                <help-popover content="Escolha entre envio imediato ou agendado">
                                </help-popover>
                                <span class="required-span" title="Este campo é obrigatório">*</span>
                            </label>
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
                        </div>
                    </div>
                    <div id="schedulingFields" style="display: none;">
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="horario" class="form-label">
                                    Horário de Envio
                                    <help-popover content="Horário específico para envio da notificação">
                                    </help-popover>
                                </label>
                                {!! html()->time('horario')->class('form-control')->placeholder('HH:MM') !!}
                            </div>
                            <div class="col-md-4">
                                <label for="intervalo_dia" class="form-label">
                                    Intervalo de Dias
                                    <help-popover
                                        content="Intervalo em dias para envio da notificação, Exemplo: 7 dias, será enviado após 7 dias das configurações definidas">
                                    </help-popover>
                                </label>
                                <div class="input-group">
                                    {!! html()->number('intervalo_dia')->class('form-control')->placeholder('Número de dias para o envio') !!}
                                    <div class="input-group-append">
                                        <span class="input-group-text"><b>Dias</b></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="schedulingAlert" class="alert alert-success">
                        ⚡ Esta notificação será enviada imediatamente quando acionada
                    </div>
                </div>

                <!-- envio de mensagens -->
                <div class="mb-3">
                    <h3 class="section-header">
                        <i class="fa-solid fa-paper-plane"></i></i> Mensagem
                    </h3>
                    <div id="bloco-summernote" class="row">
                        <div class="col-md-7">
                            <div class="form-group">
                                {!! html()->textarea('conteudo')->class('texto form-control')->placeholder('Mensagem')->id('inputSummernote') !!}
                            </div>
                        </div>
                    </div>
                    <div id="bloco-whatsapp" class="row">
                        <div class="col-md-7 ">
                            <div class="mb-3">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-whatsapp data_info" onclick="addFormatting('*')"
                                        data-container="body"
                                        data-toggle="popover"
                                        data-placement="top"
                                        data-content="Negrito">
                                        <i class="fas fa-bold"></i>
                                    </button>
                                    <button type="button" class="btn btn-whatsapp data_info" onclick="addFormatting('_')"
                                        data-container="body"
                                        data-toggle="popover"
                                        data-placement="top"
                                        data-content="Itálico">
                                        <i class="fas fa-italic"></i>
                                    </button>
                                    <button type="button" class="btn btn-whatsapp data_info" onclick="addFormatting('~')"
                                        data-container="body"
                                        data-toggle="popover"
                                        data-placement="top"
                                        data-content="Riscado">
                                        <i class="fas fa-strikethrough"></i>

                                    </button>
                                    <button type="button" class="btn btn-whatsapp data_info" onclick="addFormatting('```')"
                                        data-container="body"
                                        data-toggle="popover"
                                        data-placement="top"
                                        data-content="Monoespaçado">
                                        <i class="fa-solid fa-text-width"></i>

                                    </button>
                                    <button type="button" class="btn btn-whatsapp data_info" onclick="clearFormatting()"
                                        data-container="body"
                                        data-toggle="popover"
                                        data-placement="top"
                                        data-content=" Limpar formatação">
                                        <i class="fas fa-eraser"></i>

                                    </button>
                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-whatsapp data_info" onclick="addList('ul')"
                                        data-container="body"
                                        data-toggle="popover"
                                        data-placement="top"
                                        data-content="Lista não ordenada">
                                        <i class="fas fa-list-ul"></i>

                                    </button>
                                    <button type="button" class="btn btn-whatsapp data_info" onclick="addList('ol')"
                                        data-container="body"
                                        data-toggle="popover"
                                        data-placement="top"
                                        data-content="Lista ordenada">
                                        <i class="fas fa-list-ol"></i>

                                    </button>
                                </div>
                            </div>
                            <div class="mb-4">
                                <textarea
                                    id="inputWhatsApp"
                                    name="conteudo"
                                    placeholder="Digite seu texto aqui"
                                    id="inputText"
                                    cols="30"
                                    rows="10"
                                    class="form-control"
                                    oninput="updatePreview(); "></textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card mt-3">
                                <div class="card-body" id="chat">
                                    <div class="message sent preview-card">
                                        <div class="message-text" id="previewText">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
<link rel="stylesheet" href="{{ url('vendor/oslab/notificacoes/whatsapp-style.css') }}">
@stop

@section('js')
<script src="{{ url('') }}/vendor/summernote/summernote-bs4.min.js"></script>
<script src="{{ url('') }}/vendor/summernote/lang/summernote-pt-BR.js"></script>
<script src="{{ url('vendor/oslab/notificacoes/whatsapp-script.js') }}"></script>
<script>
    $('.data_info').popover({
        trigger: 'hover'
    });
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
