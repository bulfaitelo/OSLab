<div>
    <div wire:init="loadBackups">
        <div class="row justify-content-md-center">
            <div class="col-md-11 ">
                <!-- general form elements -->
                <div class="card">
                    <div class="card-header">
                        <a href="{{ url()->previous() }}">
                            <button type="button"  class="btn btn-sm btn-default">
                                <i class="fa-solid fa-chevron-left"></i>
                                Voltar
                            </button>
                        </a>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->

                    <div class="card-body ">
                        @include('adminlte::partials.form-alert')
                        @forelse ($backupInfo as $disco)
                        <div class="card card-primary table-responsive card-outline card-outline-tabs">
                            <table class="table table-bordered table-sm text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Disco</th>
                                        <th>Acessível</th>
                                        <th>Saudável</th>
                                        <th>Ultimo Backup</th>
                                        <th>Quantidade de Backups</th>
                                        <th>Espaço em Disco</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $disco['name'] }}</td>
                                    <td>{{ $disco['disk'] }}</td>
                                    @if ($disco['reachable'])
                                    <td>
                                        <i style="color:green" class=" fa-regular fa-circle-check"></i>
                                    </td>
                                    @else
                                    <td>
                                        <i style="color:red"  class="fa-regular fa-circle-xmark"></i>
                                    </td>
                                    @endif
                                    @if ($disco['healthy'])
                                    <td> <i style="color:green" class="fa-regular fa-circle-check"></i> </td>
                                    @else
                                    <td>
                                        <i style="color:red"  class="fa-regular fa-circle-xmark"></i>
                                    </td>
                                    @endif
                                    <td>{{ $disco['newest'] }}</td>
                                    <td>{{ $disco['count'] }}</td>
                                    <td>{{ $disco['storageSpace'] }}</td>
                                </tr>
                            </table>
                            @if (count($disco['backups']))
                            <table class="table table-sm text-nowrap">
                                <thead>
                                    <tr>
                                        <th>Arquivo</th>
                                        <th>Data</th>
                                        <th>Tamanho</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                        @foreach ($disco['backups'] as $backup)
                                        <tr>
                                            <td>{{ $backup['name'] }}</td>
                                            <td>{{ $backup['date']->format('d/m/Y H:i:s') }}</td>
                                            <td>{{ $backup['size'] }}</td>
                                            <td>
                                                <div class="btn-group btn-group-sm ">
                                                @can('config_backup_download')
                                                    @if ($backup['path'])
                                                    <a onclick="document.getElementById('{{ $backup['name'] }}').submit();"  title="Download" class="btn btn-left btn-primary"><i class="fa-solid fa-download"></i></a>
                                                    {!! html()->form('post', route('configuracao.backup.download'))->attribute('id', $backup['name'])->open() !!}
                                                        {!! html()->hidden('path', $backup['path']) !!}
                                                    {!! html()->form()->close() !!}
                                                    @else
                                                        <a href="" title="Download" class="btn btn-left btn-primary disabled"><i class="fa-solid fa-download"></i></a>
                                                    @endif
                                                @endcan
                                                @can('config_backup_destroy')
                                                    @if ($backup['path'])
                                                        <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-name="{{$backup['name']}}" data-path="{{$backup['path']}}" data-url="{{route('configuracao.backup.delete')}}" data-target="#modal-excluir-download"><i class="fas fa-trash"></i></button>
                                                    @else
                                                        <button type="button" class="btn btn-block btn-danger disabled"><i class="fas fa-trash"></i></button>
                                                    @endif
                                                @endcan
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                            </table>
                            @endif
                        </div>
                        @empty
                            <h5>Carregando Backups <i class="fa-solid fa-spinner fa-spin"></i></h5>
                        @endforelse

                    </div>
                    {{-- Minimal with icon only --}}

                </div>
                <!-- /.card -->

            </div>
        </div>
    </div>
    <script>
        document.addEventListener('livewire:init', function () {
            $('#modal-excluir-download').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var name = button.data('name') // Extract info from data-* attributes
                var path = button.data('path') // Extract info from data-* attributes
                var url = button.data('url') // Extract info from data-* attributes
                var modal = $(this)
                modal.find('.modal-body span').text(name)
                modal.find('#path').val(path)
                modal.find('form').attr('action', url)
            })
        });
    </script>
    <div class="modal fade"  id="modal-excluir-download" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                <h4 class="modal-title">Realmente deseja Excluir?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                <p><b>Nome:</b> <span></span></p>
                </div>
                <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    <i class="fa-solid fa-ban"></i>
                    Fechar
                </button>
                {!! html()->form('post')->open() !!}
                    {!! html()->hidden('path') !!}
                    <button type="submit" class="btn btn-danger delete-permission">
                        <i class="fa-solid fa-trash"></i>
                        Excluir
                    </button>
                {!! html()->form()->close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
