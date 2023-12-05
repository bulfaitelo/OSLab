<div>
    <div class="timeline mt-2">
        @foreach ($os->getOsLogs() as $data => $items)
        <div class="time-label">
            <span class="bg-lightblue">{{ $data }}</span>
        </div>
        @foreach ($items as $item)
            @if ($item['log_type'] == 'status')
            <div>
                <i class="fas fa-user bg-green"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> {{ $item['created_at']->format('H:i:s d/m/Y') }} </span>
                    <h3 class="timeline-header no-border">
                        <b>Alteração no status:</b>
                       <span class="badge {{ $item['status_color'] }}"> {{ $item['status'] }} </span>
                        <a class="mt-0 float-right btn btn-warning btn-xs" data-toggle="collapse" href="#observacoes-log-div-{{ $item['id'] }}"   aria-expanded="true" aria-controls="observacoes" >
                            <i class="fa-regular fa-comment"></i>
                            <span class="d-none d-sm-inline">Adicionar Comentário</span>
                            <i id="obervacoes-log-icon" class="fa-solid fa-caret-right"></i>
                        </a>
                        <div id="observacoes-log-div-{{ $item['id'] }}" class="collapse timeline-body">
                            {!! html()->textarea('observacoes', $item['descricao'])->class('form-control mb-2')->placeholder('Observações (opcional)') !!}
                        </div>
                    </h3>
                </div>
            </div>
            @endif
            @if ($item['log_type'] == 'conta')
            <div>
                <i class="fas fa-money-bill  bg-danger"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> 11:20:55 01/11/2023 </span>
                    <h3 class="timeline-header no-border">
                        <b>Despesa </b> R$ 120,00
                        <a href="" class="mt-0 float-right btn btn-default btn-xs">
                            <i class="fas fa-eye"></i>
                            <span class="d-none d-sm-inline">visualizar</span>
                        </a>
                    </h3>
                </div>
            </div>
            <div>
                <i class="fas fa-money-bill  bg-green"></i>
                <div class="timeline-item">
                    <span class="time"><i class="fas fa-clock"></i> 11:20:55 01/11/2023 </span>
                    <h3 class="timeline-header no-border">
                        <b>Pagamento Recebido</b> R$ 120,00
                        <a href="" class="mt-0 float-right btn btn-default btn-xs">
                            <i class="fas fa-eye"></i>
                            <span class="d-none d-sm-inline">visualizar</span>
                        </a>
                    </h3>
                </div>
            </div>
            @endif
        @endforeach

        @endforeach




        <div class="time-label">
            <span class="bg-lightblue">{{ $os->created_at->format('d/m/Y') }}</span>
        </div>
        <div>
            <i class="fas fa-plus bg-lightblue"></i>
            <div class="timeline-item">
                <span class="time"><i class="fas fa-clock"></i> {{ $os->created_at->format('H:i:s d/m/Y') }} </span>
                <h3 class="timeline-header no-border">
                    <b>Abertura de OS</b>
                </h3>
            </div>
        </div>
    </div>
    @dump($os->getOsLogs())
    <script>
        //  document.addEventListener('livewire:load', function () {
        //      $('#observacoes-log-div').on('show.bs.collapse', function () {
        //          $('#obervacoes-log-icon').removeClass('fa-caret-right').addClass('fa-caret-down');
        //      })
        //      $('#observacoes-log-div').on('hidden.bs.collapse', function () {
        //          $('#obervacoes-log-icon').removeClass('fa-caret-down').addClass('fa-caret-right');
        //      })
        // });

        document.addEventListener('livewire:load', function () {
            $('.observacoes-log-div').on('show.bs.collapse', function () {
                $(this).find('.obervacoes-log-icon').removeClass('fa-caret-right').addClass('fa-caret-down');
            });

            $('.observacoes-log-div').on('hidden.bs.collapse', function () {
                $(this).find('.obervacoes-log-icon').removeClass('fa-caret-down').addClass('fa-caret-right');
            });
        });


    </script>
</div>
