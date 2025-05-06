<div>
    <div class="card custom-border">
        <div class="card-header pb-0 border-0 pr-3 pl-3">
            <div class="d-flex justify-content-between">
              <h3 class="card-title">Estatísticas do Sistema</h3>
            </div>
        </div>
        <div class="card-body p-3">
            <div class="row">
                <div class="col-md-6">
                    <div class="small-box btn-oslab">
                        <div class="inner pt-0 pb-0">
                          <h3 class="mb-0">{{ $osCount }}</h3>
                          <span>Ordens de Serviços</span>
                        </div>
                        <div class="icon">
                          <i class="fa-regular fa-rectangle-list" style="font-size: 50px;"></i>
                        </div>
                        @can('os_create')
                        <a href="{{ route('os.create') }}" class="small-box-footer">
                            Adicionar OS <i class="fas fa-arrow-circle-right"></i>
                        </a>
                        @endcan
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="small-box btn-oslab">
                        <div class="inner pt-0 pb-0">
                          <h3 class="mb-0">{{ $clienteCount }}</h3>
                          <span>Clientes</span>
                        </div>
                        <div class="icon">
                          <i class="fa-regular fa-rectangle-list" style="font-size: 50px;"></i>
                        </div>
                        @can('cliente_create')
                        <a href="{{ route('cliente.create') }}" class="small-box-footer">
                            Adicionar Cliente <i class="fas fa-arrow-circle-right"></i>
                        </a>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="small-box btn-oslab">
                        <div class="inner pt-0 pb-0">
                          <h3 class="mb-0">{{ $produtoCount }}</h3>
                          <span>Produtos</span>
                        </div>
                        <div class="icon">
                          <i class="fa-regular fa-rectangle-list" style="font-size: 50px;"></i>
                        </div>
                        @can('produto_create')
                        <a href="{{ route('produto.create') }}" class="small-box-footer">
                            Adicionar Produto <i class="fas fa-arrow-circle-right"></i>
                        </a>
                        @endcan
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="small-box btn-oslab">
                        <div class="inner pt-0 pb-0">
                          <h3 class="mb-0">{{ $servicoCount }}</h3>
                          <span>Serviços</span>
                        </div>
                        <div class="icon">
                          <i class="fa-regular fa-rectangle-list" style="font-size: 50px;"></i>
                        </div>
                        @can('servico_create')
                        <a href="{{ route('servico.create') }}" class="small-box-footer">
                            Adicionar Serviço <i class="fas fa-arrow-circle-right"></i>
                        </a>
                        @endcan
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="small-box btn-oslab mb-md-0">
                        <div class="inner pt-0 pb-0">
                          <h3 class="mb-0">{{ $wikiCount }}</h3>
                          <span>Wiki</span>
                        </div>
                        <div class="icon">
                          <i class="fa-regular fa-rectangle-list" style="font-size: 50px;"></i>
                        </div>
                        @can('wiki_create')
                        <a href="{{ route('wiki.create') }}" class="small-box-footer">
                            Adicionar Wiki <i class="fas fa-arrow-circle-right"></i>
                        </a>
                        @endcan
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="small-box btn-oslab mb-md-0">
                        <div class="inner pt-0 pb-0">
                          <h3 class="mb-0">{{ $checklistCount }}</h3>
                          <span>Checklists</span>
                        </div>
                        <div class="icon">
                          <i class="fa-regular fa-rectangle-list" style="font-size: 50px;"></i>
                        </div>
                        @can('checklist_create')
                        <a href="{{ route('checklist.create') }}" class="small-box-footer">
                            Adicionar Checklist <i class="fas fa-arrow-circle-right"></i>
                        </a>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
