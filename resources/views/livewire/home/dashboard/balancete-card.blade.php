<div>
    <div class="card custom-border">
        <div class="card-body p-3">
            {!! html()->select('mes', $meses, $mes_busca)->class('form-control')->attribute('wire:model.live', 'mes_busca') !!}
            <div class="row  mt-3">
                <div class="col-6" >
                    <span class="h5 balancete-credito text-nowrap">Receita</span>
                </div>
                <div class="col-6">
                    <span style="float: right" class="h5 balancete-credito text-nowrap">R$ {{ (isset($balancete->receita)) ? number_format($balancete->receita, 2, ',', '.') : '0,00' }}</span>
                </div>
            </div>
            <div class="row">
                <div class="col-6" >
                    <span class="balancete-debito h5 text-nowrap">Despesa</span>
                </div>
                <div class="col-6">
                    <span style="float: right" class="h5 balancete-debito text-nowrap">R$ {{ (isset($balancete->despesa)) ? number_format($balancete->despesa, 2, ',', '.') : '0,00' }}</span>
                </div>
            </div>
            <hr class="m-0">
            <div class="row">
                <div class="col-6" >
                    <span
                    @class([
                        'h5 text-nowrap',
                        'balancete-debito' => (isset($balancete->saldo) && $balancete->saldo < 0) ? true : false,
                        'balancete-credito' => (isset($balancete->saldo) && $balancete->saldo > 0) ? true : false,
                    ])
                    >Saldo</span>
                </div>
                <div class="col-6">
                    <span style="float: right"
                    @class([
                        'h5 text-nowrap ',
                        'balancete-debito' => (isset($balancete->saldo) && $balancete->saldo < 0) ? true : false,
                        'balancete-credito' => (isset($balancete->saldo) && $balancete->saldo > 0) ? true : false,
                    ])
                    >R$ {{ (isset($balancete->saldo)) ? number_format($balancete->saldo, 2, ',', '.') : '0,00' }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
