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
            <div class="">
                @forelse ($metaContabil as $item)
                    <div class="progress-group">
                        {{ $item->name }}
                        <span class="float-right"><b>R${{ number_format($item->getMetaExecutadaData()->executado, 2, ',', '.') }}</b> / R${{ $item->valor_meta }}</span>
                        <div class="progress progress-sm">
                            <div class="progress-bar btn-oslab" style="width: {{ $item->getMetaExecutadaData()->porcentagem_executada }}%"></div>
                        </div>
                    </div>
                @empty
                    <h3>Sem Metas cadastradas</h3>
                @endforelse               
            </div>
        </div>
    </div>
</div>
