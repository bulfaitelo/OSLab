<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        {!! html()->form('put', route($tipo . '.faturar', $item->id))->open() !!}
            <div class="modal-header">
                @if ($tipo === 'os')
                <h5 class="modal-title" id="faturarModalLabel">Faturar OS: #{{ $item->id }}</h5>
                @endif
                @if ($tipo === 'venda')
                <h5 class="modal-title" id="faturarModalLabel">Faturar Venda: #{{ $item->id }}</h5>
                @endif
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="descricao">Descrição</label>
                            @if ($tipo === 'os')
                            {!! html()->text('descricao', 'Fatura OS Nº: #'. $item->id)->class('form-control')->placeholder('Descrição do faturamento')->required() !!}
                            @endif
                            @if ($tipo === 'venda')
                            {!! html()->text('descricao', 'Fatura Venda Nº: #'. $item->id)->class('form-control')->placeholder('Descrição do faturamento')->required() !!}
                            @endif
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="centro_custo_id">Centro de Custo</label>
                            {!! html()->select('centro_custo_id', \App\Models\Configuracao\Financeiro\CentroCusto::orderBy('name')->where('receita', '1')->pluck('name', 'id'), $item?->getCentroCustoPadrao())->class('form-control')->placeholder('Selecione o Centro de Custo')->required() !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="data_entrada">Entrada</label>
                            {!! html()->date('data_entrada', now())->class('form-control')->placeholder('Data de Entrada')->required() !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="valor">Valor Total</label>
                            {!! html()->text('valor', $itemValorTotal)->class('form-control decimal')->placeholder('Valor Total')->attributes(['inputmode' => 'numeric'])->required() !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="recebido">Recebido</label>
                            <div class="custom-control custom-switch custom-switch-md">
                                <input type="checkbox" name="recebido" id="recebido" class="custom-control-input" >
                                <label class="custom-control-label" for="recebido"></label>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="recebido-div" class="row" style="display: none">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="data_recebimento">Data Recebimento</label>
                            {!! html()->date('data_recebimento', now())->class('form-control')->placeholder('Data de recebimento') !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="valor_recebido">Valor Recebido</label>
                            {!! html()->text('valor_recebido')->class('form-control decimal')->placeholder('Valor Recebido')->attributes(['inputmode' => 'numeric']) !!}
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="forma_pagamento_id">Forma de pagamento</label>
                            {!! html()->select('forma_pagamento_id', \App\Models\Configuracao\Financeiro\FormaPagamento::orderBy('name')->pluck('name', 'id'))->class('form-control')->placeholder('Selecione') !!}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group mb-0">
                            <label data-toggle="collapse" href="#observacoes-div" role="button" for="observacoes" aria-expanded="true" aria-controls="observacoes" >
                                Observações
                                <i id="obervacoes-icon" class="fa-solid fa-caret-right"></i>
                            </label>
                            <div id="observacoes-div" class="collapse ">
                                {!! html()->textarea('observacoes')->class('form-control mb-2')->placeholder('Observações (opcional)') !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
                    <i class="fa-regular fa-rectangle-xmark"></i>
                    Fechar
                </button>
                <button type="submit" id="salvechecklist" class="btn btn-sm btn-oslab">
                    <i class="fas fa-save"></i>
                    Salvar
                </button>
            </div>
        {!! html()->form()->close() !!}
    </div>

    <script>
        document.addEventListener('livewire:init', function () {
            Livewire.on('toggleFaturarModal', () => $('#faturarModal').modal('toggle'));
        });
    </script>

</div>
