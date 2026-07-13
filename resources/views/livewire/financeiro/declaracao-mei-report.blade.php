<div class="card" x-data="{ loadingPdf: false }">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h3 class="card-title mb-0">Declaração MEI</h3>

        <a
            href="{{ route('relatorio.financeiro.declaracao_mei.pdf', ['type' => $type, 'year' => $year]) }}"
            target="_blank"
            class="btn btn-sm bg-maroon"
            x-on:click="loadingPdf = true"
            x-bind:class="loadingPdf ? 'opacity-75 pointer-events-none' : ''"
        >
            <i class="fa-solid fa-print"></i>
            Imprimir PDF
        </a>
    </div>

    <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-6">
                <label for="mei_type" class="mb-2 d-block">Tipo de Agrupamento</label>
                <select id="mei_type" wire:model.live="type" class="form-control">
                    <option value="monthly">Mensal</option>
                    <option value="yearly">Anual</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="mei_year" class="mb-2 d-block">Ano de Referência</label>
                <select id="mei_year" wire:model.live="year" class="form-control">
                    @foreach ($availableYears as $yearOption)
                        <option value="{{ $yearOption }}">{{ $yearOption }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div wire:loading.class="opacity-60" class="table-responsive border rounded">
            <table class="table table-sm mb-0 align-middle">
                <thead class="bg-light">
                    <tr>
                        <th>Período</th>
                        <th class="text-right">Receita Bruta - Comércio/Indústria</th>
                        <th class="text-right">Receita Bruta - Prestação de Serviços</th>
                        <th class="text-right">Receita Bruta Total</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($records as $record)
                        <tr>
                            <td><strong>{{ $record['period'] }}</strong></td>
                            <td class="text-right">R$ {{ number_format($record['commerce'], 2, ',', '.') }}</td>
                            <td class="text-right">R$ {{ number_format($record['service'], 2, ',', '.') }}</td>
                            <td class="text-right"><strong>R$ {{ number_format($record['total'], 2, ',', '.') }}</strong></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-4">Nenhum lançamento encontrado para o filtro selecionado.</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    <tr class="bg-light">
                        <td>Total Geral</td>
                        <td class="text-right"><strong>R$ {{ number_format($totals['commerce'], 2, ',', '.') }}</strong></td>
                        <td class="text-right"><strong>R$ {{ number_format($totals['service'], 2, ',', '.') }}</strong></td>
                        <td class="text-right"><strong>R$ {{ number_format($totals['total'], 2, ',', '.') }}</strong></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
