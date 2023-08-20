<div>
    @include('adminlte::partials.form-alert')
    {!! html()->form('put', route('os.update', $os))->acceptsFiles()->open() !!}
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="cliente_id">Cliente</label>
                    {!! html()->select('cliente_id', $os->getClienteForSelect(), $os->cliente_id)->class('form-control cliente')->placeholder('Selecione')->required() !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="tecnico_id">Tecnico Responsavel </label>
                    {!! html()->select('tecnico_id', $os->getTecnicoForSelect(), $os->tecnico_id)->class('form-control user')->placeholder('Selecione')->required() !!}

                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="categoria_id">Categoria</label>
                    {!! html()->select('categoria_id', \App\Models\Configuracao\Os\CategoriaOs::orderBy('name')->pluck('name', 'id'), $os->categoria_id )->class('form-control')->placeholder('Selecione') !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="modelo_id">Modelo</label>
                    {!! html()->select('modelo_id', $os->getModeloForSelect(), $os->modelo_id)->class('form-control modelo')->placeholder('Selecione') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="status_id">Status</label>
                    {!! html()->select('status_id', \App\Models\Configuracao\Os\StatusOs::orderBy('name')->pluck('name', 'id'), $os->status_id)->class('form-control')->placeholder('Selecione') !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="data_entrada">Data Entrada</label>
                    {!! html()->date('data_entrada', $os->data_entrada)->class('form-control') !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="data_saida">Data Saída</label>
                    {!! html()->date('data_saida', $os->data_saida)->class('form-control') !!}
                </div>
            </div>
            <div class="col-md-5 d-flex align-items-end">
                <div class="form-group text-right">
                    @if ($os->modelo_id)
                        <a target="_blank" href="{{route('wiki.show', $os->modelo->wiki->id)}}">
                            <button type="button"  class="btn bg-primary">
                                <i class="fa-solid fa-list-check"></i>
                                Wiki
                            </button>
                        </a>
                    @endif
                    <a href="#">
                        <button type="button"  class="btn bg-primary">
                            <i class="fa-solid fa-book"></i>
                            Checklist
                        </button>
                    </a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    {!! html()->textarea('descricao', $os->descricao)->class('texto')->placeholder('Status') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="defeito">Defeito</label>
                    {!! html()->textarea('defeito', $os->defeito)->class('texto')->placeholder('Status') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="observacoes">Observações</label>
                    {!! html()->textarea('observacoes', $os->observacoes)->class('texto')->placeholder('Status') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="laudo">Laudo</label>
                    {!! html()->textarea('laudo', $os->laudo)->class('texto')->placeholder('Status') !!}
                </div>
            </div>
        </div>


        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i>
            Salvar
        </button>
    {!! html()->form()->close() !!}
</div>
