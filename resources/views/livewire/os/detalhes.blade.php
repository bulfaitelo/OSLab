<div>
    @include('adminlte::partials.form-alert')
    {!! html()->form('post', route('os.store'))->acceptsFiles()->open() !!}
        <div class="row">
            <div class="col-md-4">
                <div class="form-group">
                    <label for="cliente_id">Cliente</label>
                    {!! html()->select('cliente_id')->class('form-control cliente')->placeholder('Selecione')->required() !!}
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="tecnico_id">Tecnico Responsavel </label>
                    {!! html()->select('tecnico_id', [Auth()->id() => Auth()->user()->name], Auth()->id())->class('form-control user')->placeholder('Selecione')->required() !!}

                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="categoria_id">Categoria</label>
                    {!! html()->select('categoria_id', \App\Models\Configuracao\Os\CategoriaOs::orderBy('name')->pluck('name', 'id'), )->class('form-control')->placeholder('Selecione') !!}
                </div>
            </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="modelos_id">Modelo</label>
                    {!! html()->select('modelos_id', [], )->class('form-control modelo')->placeholder('Selecione') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="form-group">
                    <label for="status_id">Status</label>
                    {!! html()->select('status_id', \App\Models\Configuracao\Os\StatusOs::orderBy('name')->pluck('name', 'id'), )->class('form-control')->placeholder('Selecione') !!}
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
                    <a href="#">
                        <button type="button"  class="btn bg-primary">
                            <i class="fa-solid fa-list-check"></i>
                            Wiki
                        </button>
                    </a>
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
                    {!! html()->textarea('descricao')->class('texto')->placeholder('Status') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="defeito">Defeito</label>
                    {!! html()->textarea('defeito')->class('texto')->placeholder('Status') !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="observacoes">Observações</label>
                    {!! html()->textarea('observacoes')->class('texto')->placeholder('Status') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="laudo">Laudo</label>
                    {!! html()->textarea('laudo')->class('texto')->placeholder('Status') !!}
                </div>
            </div>
        </div>


        <button type="submit" class="btn btn-primary">
            <i class="fas fa-save"></i>
            Salvar
        </button>


    {!! html()->form()->close() !!}
</div>
