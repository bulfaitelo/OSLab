<div>
    <div class="card">
        <div class="card-header">
            <a href="{{ url()->previous() }}" title="Voltar">
                <button type="button" class="btn btn-sm btn-default">
                    <i class="fa-solid fa-chevron-left"></i>
                    <span class="d-none d-sm-inline">Voltar</span>
                </button>
            </a>
            @can('relatorio_sistema_auditoria')
            <a href="{{ route('relatorio.sistema.auditoria.index', ['auditable_type' => get_class($cliente), 'auditable_id' => $cliente->id]) }}" class="btn btn-sm bg-lightblue">
                <i class="fas fa-history"></i>
                Auditoria
            </a>
            @endcan
            @can('os_create')
            <a href="{{ route('os.create', ['cliente_id' => $cliente->id]) }}">
                <button type="button" class="btn btn-sm btn-oslab">
                    <i class="fa-regular fa-rectangle-list"></i>
                    Criar OS
                </button>
            </a>
            @endcan
            <div class="btn-group btn-group-sm">
                <a  title="Detalhes" wire:click.prevent="tabChange('detalhes')"
                class="btn btn-left
                @if ($showTab == 'detalhes')
                    btn-info
                @else
                    btn-default
                @endif
                ">
                    <i class="fa-solid fa-users "></i>
                    Detalhes
                </a>
                <a title="Ordens de Serviço" wire:click.prevent="tabChange('os')"
                class="btn btn-left
                @if ($showTab == 'os')
                btn-info
                @else
                btn-default
                @endif
                ">
                    <i class="fa-regular fa-rectangle-list "></i>
                    Ordens de Serviço
                </a>
            </div>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <div class="card-body">
            @include('os.partials.os-table', [
                'osTable' => $os,
                'edit' => true,
                'show'=> true
            ])
        </div>
        {{-- Minimal with icon only --}}
        <!-- /.card-body -->
    </div>
</div>
