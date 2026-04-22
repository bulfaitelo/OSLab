@php
    $formatarResumido = function($valor) {
        $valor = $valor ?? 0;
        if (abs($valor) >= 1000000) return number_format($valor / 1000000, 1, ',', '.') . 'M';
        if (abs($valor) >= 1000) return number_format($valor / 1000, 1, ',', '.') . 'k';
        return number_format($valor, 2, ',', '.');
    };

    $formatarCompleto = function($valor) {
        return number_format($valor ?? 0, 2, ',', '.');
    };
@endphp

{{-- Elemento RAIZ único exigido pelo Livewire --}}
<div class="balancete-container">
    @once
    <style>
        .balancete-container {
            container-type: inline-size;
        }
        .texto-curto { display: none !important; }
        .texto-longo { display: inline-block !important; }

        @container (max-width: 240px) {
            .texto-longo { display: none !important; }
            .texto-curto { display: inline-block !important; }
        }
    </style>
    @endonce
    <div class="card custom-border">
        <div class="card-body p-3">
            {!! html()->select('mes', $meses, $mes_busca)->class('form-control mb-3')->attribute('wire:model.live', 'mes_busca') !!}

            <div class="d-flex justify-content-between align-items-center mb-1">
                <span class="h5 mb-0 balancete-credito" title="Receita">
                    <span class="texto-longo">Receita</span>
                    <span class="texto-curto">R</span>
                </span>
                <span class="h5 mb-0 balancete-credito text-nowrap">
                    <span class="texto-longo">R$ {{ $formatarCompleto($balancete?->receita) }}</span>
                    <span class="texto-curto">R$ {{ $formatarResumido($balancete?->receita) }}</span>
                </span>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-2">
                <span class="h5 mb-0 balancete-debito" title="Despesa">
                    <span class="texto-longo">Despesa</span>
                    <span class="texto-curto">D</span>
                </span>
                <span class="h5 mb-0 balancete-debito text-nowrap">
                    <span class="texto-longo">R$ {{ $formatarCompleto($balancete?->despesa) }}</span>
                    <span class="texto-curto">R$ {{ $formatarResumido($balancete?->despesa) }}</span>
                </span>
            </div>

            <hr class="m-0 mb-2">

            <div class="d-flex justify-content-between align-items-center">
                <span @class([
                    'h5 mb-0',
                    'balancete-debito' => ($balancete?->saldo ?? 0) < 0,
                    'balancete-credito' => ($balancete?->saldo ?? 0) >= 0,
                ]) title="Saldo">
                    <span class="texto-longo">Saldo</span>
                    <span class="texto-curto">S</span>
                </span>

                <span @class([
                    'h5 mb-0 text-nowrap',
                    'balancete-debito' => ($balancete?->saldo ?? 0) < 0,
                    'balancete-credito' => ($balancete?->saldo ?? 0) >= 0,
                ])>
                    <span class="texto-longo">R$ {{ $formatarCompleto($balancete?->saldo) }}</span>
                    <span class="texto-curto">R$ {{ $formatarResumido($balancete?->saldo) }}</span>
                </span>
            </div>
        </div>
    </div>
</div>

