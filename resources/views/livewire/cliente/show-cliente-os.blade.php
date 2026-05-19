<div>
    <div class="card">
        <div class="card-header">
            <a href="{{ url()->previous() }}" title="Voltar">
                <button type="button" class="btn btn-sm btn-default">
                    <i class="fa-solid fa-chevron-left"></i>
                    <span class="d-none d-sm-inline">Voltar</span>
                </button>
            </a>
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
