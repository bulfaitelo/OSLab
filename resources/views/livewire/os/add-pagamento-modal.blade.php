<div class="modal-dialog modal-lg">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Adicionar um Novo Pagamento</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('financeiro.receita.pagamento.store', $os->fatura_id) }}" id="form-pagamento" method="post">
                @csrf
            <div class="row" >
                <div  class="col-md-4">
                    <div class="form-group">
                        <label for="pagamento_valor"> Valor </label>
                        {!! html()->text('pagamento_valor')->class('form-control decimal')->placeholder('Valor') !!}
                    </div>
                </div>
                <div  class="col-md-4 ">
                    <div class="form-group">
                        <label for="data_pagamento"> Data pagamento </label>
                        {!! html()->date('data_pagamento')->class('form-control')->placeholder('Valor Pago') !!}
                    </div>
                </div>
                <div  class="col-md-4">
                    <div class="form-group">
                        <label for="forma_pagamento_id">Forma de pagamento</label>
                        {!! html()->select('forma_pagamento_id', \App\Models\Configuracao\Financeiro\FormaPagamento::orderBy('name')->pluck('name', 'id'))->class('form-control')->placeholder('Selecione') !!}
                    </div>
                </div>
            </div>
            <div class="row">
                <h4>Pagamentos realizados</h4>
                <table class="table table-sm">
                    <thead>
                        <tr>
                        <th>Data</th>
                        <th>Forma de Pagamento</th>
                        <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>21/11/2023</td>
                            <td>PIX</td>
                            <td>R$ 200,00</td>
                        </tr>
                    </tbody>
                    <tfoot style=" border-top: 2px solid rgb(225, 225, 225)">
                        <tr>
                            <td colspan="1"></td>
                            <td class="text-right">
                                <b>
                                    Total Recebido:
                                </b>
                            </td>
                            <td>R$ 250,00</td>
                        </tr>
                        <tr style="border-bottom: 2px solid rgb(156, 156, 156)">
                            <td colspan="1"></td>
                            <td class="text-right">
                                <b>
                                    Pendente:
                                </b>
                            </td>
                            <td>R$ 250,00</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
        <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">
                <i class="fas fa-times"></i>
                Fechar
            </button>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i>
                Salvar
            </button>
        </div>
        {!! html()->form()->close() !!}
    </div>
    <script>
        document.addEventListener('livewire:load', function () {
            window.livewire.on('toggleAddPagamentoModal', () => $('#addPagamentoModal').modal('toggle'));
        });
    </script>
</div>
