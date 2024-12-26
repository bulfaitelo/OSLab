<div>
    <div class="card custom-border">
        <div class="card-header pb-0 border-0 pr-3 pl-3">
            <div class="d-flex justify-content-between">
                <h3 class="card-title">Garantias Encerrando</h3>
                @can('os')
                <a href="{{ route('os.index') }}">
                    <button type="button" class="btn btn-sm btn-oslab">
                        Ver Todas
                    </button>
                </a>
                @endcan
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-sm " style="table-layout: fixed;">
                <thead>
                    <tr>
                        <th class=" pr-3 pl-3" style="width: 65px" >#</th>
                        <th>Cliente</th>
                        <th style="width: 70px">
                            <span title="Vencimento" >Venc.</span>
                        </th>
                        <th scope="pr-3" style="width: 65px"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($os as $item)
                        <tr>
                            <td class="pl-3" >{{ $item->id }}</td>
                            <td class="text-truncate">{{ $item->cliente->name }}</td>
                            <td><span
                                    @class([
                                        'badge',
                                        'bg-danger' => ($item->prazo_garantia->format('Y-m-d') == now()->format('Y-m-d')) ? true : false,
                                        'bg-success' => ($item->prazo_garantia > now()) ? true : false,
                                    ])
                                >{{ $item->prazo_garantia->format('d/m/Y') }}</span></td>
                            <td class="pr-3">
                            @can('os_show')
                                <a href="{{ route('os.show', $item->id) }}" title="Visualizar" class="btn btn-sm btn-default float-right"><i class="fas fa-eye"></i></a>
                            @endcan
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
