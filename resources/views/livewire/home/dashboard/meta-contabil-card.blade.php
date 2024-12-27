<div>
    <div class="card custom-border">
        <div class="card-header pb-0 border-0 pr-3 pl-3">
            <div class="d-flex justify-content-between">
              <h3 class="card-title">Metas Contábeis</h3>
              @can('financeiro_meta_contabil')
              <a href="{{ route('financeiro.meta_contabil.index') }}">
                  <button type="button" class="btn btn-sm btn-oslab">
                      Ver Todas
                  </button>
              </a>
              @endcan
            </div>
        </div>
        <div class="card-body p-3">
            @forelse ($metaContabil as $item)
            <table class="table table-sm" style="table-layout: fixed;" >
                <tr>
                    <td title="{{ $item->name }}" class="text-truncate border-0 pb-0">
                        {{ $item->name }}
                    </td>
                    <td class="text-truncate border-0 pb-0" style="width:50%;">
                        <span class="float-right" title="R$ {{ number_format($item->executado, 2, ',', '.') }} / R$ {{ number_format($item->valor_meta, 2, ',', '.') }}" ><b>R$ {{ number_format($item->executado, 2, ',', '.') }}</b> / R$ {{ number_format($item->valor_meta, 2, ',', '.') }}</span>
                    </td>
                </tr>
                <tr>
                    <td class="border-0 pb-1" style="padding-top: 0px" colspan="2">
                        <div class="progress progress-sm">
                            <div class="progress-bar btn-oslab" title="{{ $item->porcentagem_executada }}%" style="width: {{ $item->porcentagem_executada }}%">{{ $item->porcentagem_executada }}%</div>
                        </div>
                    </td>
                </tr>
            </table>
            @empty
                <h3>Sem Metas cadastradas</h3>
            @endforelse
        </div>
    </div>
</div>
