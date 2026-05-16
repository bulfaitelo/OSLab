@extends('adminlte::page')

@section('title', 'Gerenciar Páginas Favoritas')

@section('content_header')
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Páginas Favoritas</h1>
        </div>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Gerencie suas páginas favoritas</h3>
                </div>
                <div class="card-body">
                    @if ($favoritas->isEmpty())
                        <div class="alert alert-info">
                            Nenhuma página favorita cadastrada ainda.
                        </div>
                    @else
                        <div class="alert alert-info alert-dismissible fade show">
                            <strong>Dica:</strong> Você pode reorganizar as páginas favorites clicando e arrastando.
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        </div>

                        <div id="sortable-list" class="list-group">
                            @foreach ($favoritas as $favorita)
                                <div class="list-group-item d-flex justify-content-between align-items-center sortable-item" data-id="{{ $favorita->id }}" style="cursor: grab; padding: 15px;">
                                    <div class="flex-grow-1">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-grip-vertical mr-3 text-muted"></i>
                                            <div>
                                                <h6 class="mb-1">
                                                    <span class="badge {{ $favorita->color }}">{{ $favorita->text }}</span>
                                                </h6>
                                                <small class="text-muted">Rota: {{ $favorita->route }}</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('configuracao.pagina-favorita.edit', ['pagina_favorita' => $favorita->id]) }}" class="btn btn-info" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-excluir" data-name="{{ $favorita->text }}" data-url="{{ route('configuracao.pagina-favorita.destroy', ['pagina_favorita' => $favorita->id]) }}" title="Excluir">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="modal-excluir" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar Exclusão</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Tem certeza que deseja remover a página favorita <strong><span id="modal-name"></span></strong>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    {!! html()->form('delete', '')->id('delete-form')->open() !!}
                        @csrf
                        {!! html()->button('Remover', 0)->type('submit')->class('btn btn-danger') !!}
                    {!! html()->form()->close() !!}
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <style>
        .sortable-item {
            border: 1px solid #dee2e6;
            margin-bottom: 0.5rem;
            transition: all 0.2s ease;
        }

        .sortable-item:hover {
            background-color: #f8f9fa;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .sortable-item.ui-sortable-helper {
            opacity: 0.9;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            background-color: #e3f2fd;
        }

        .sortable-item.ui-sortable-placeholder {
            background-color: #bbdefb;
            opacity: 0.5;
            border: 2px dashed #2196f3;
        }
    </style>
@stop

@section('js')
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script>
        $(function () {
            $('#sortable-list').sortable({
                placeholder: 'ui-sortable-placeholder',
                items: '.sortable-item',
                cursor: 'grab',
                update: function (event, ui) {
                    var order = [];
                    $('.sortable-item').each(function () {
                        order.push($(this).data('id'));
                    });

                    $.ajax({
                        url: '{{ route("configuracao.pagina-favorita.update-order") }}',
                        type: 'POST',
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'order': order
                        },
                        success: function (response) {
                            if (response.success) {
                                // Opcional: mostrar uma notificação de sucesso
                            }
                        }
                    });
                }
            });

            $('#modal-excluir').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var name = button.data('name');
                var url = button.data('url');
                var modal = $(this);

                modal.find('#modal-name').text(name);
                modal.find('#delete-form').attr('action', url);
            });
        });
    </script>
@stop
