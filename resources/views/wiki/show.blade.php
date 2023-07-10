{{-- @extends('adminlte::page', ['iFrameEnabled' => true]) --}}
@extends('adminlte::page')


@section('title', 'Wiki - '. $wiki->name)

@section('content_header')
    <h1><b>[{{ $wiki->fabricante->name }}]</b> -  {{ $wiki->name}} </h1>
    <h6>{{ $wiki->modelosTitle() }}</h6>
@stop

@section('content')
<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Wiki</h3>
                    @can('wiki_edit')
                    {{-- <a href="{{ route('wiki.edit', $wiki->id) }}" title="Editar" >
                        <button type="button" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                            Editar
                        </button>
                    </a> --}}
                    <button id="edit" class="btn btn-primary" onclick="edit()" type="button">
                        <i class="fas fa-edit"></i>
                        Editar
                    </button>
                    <button style="display: none" id="save" class="btn btn-primary" onclick="save()" type="button">
                        <i class="fas fa-save"></i>
                        Salvar
                    </button>
                    @endcan
                </div>
            </div>
            <div class="card-body">
                <div id="texto_wiki" class="texto_wiki">{!! $wiki->texto !!}</div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Links</h3>
                            <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus-square"></i></button>

                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-sm">
                            <tbody>
                                <tr>
                                    <td>Manual de Uso</td>
                                    <td style="width: 40px" >
                                        <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#modal-excluir_"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="d-flex justify-content-between">
                            <h3 class="card-title">Arquivos</h3>
                            <button type="button" class="btn btn-primary btn-sm"><i class="fas fa-plus-square"></i></button>

                        </div>
                    </div>
                    <div class="card-body p-0">
                        <table class="table table-sm">
                            <tbody>
                                <tr>
                                    <td>Firmware... sd.asdssd lorem sdf</td>
                                    <td style="width: 40px" >
                                        <div class="btn-group btn-group-sm">
                                        <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#modal-excluir_"><i class="fas fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">OS</h3>
                    {{-- <button type="button" class="btn btn-primary btn-sm">Editar</button> --}}
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-sm">
                <thead>
                <tr>
                <th style="width: 10px">#</th>
                <th>Task</th>
                <th>Progress</th>
                <th style="width: 40px">Label</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                <td>1.</td>
                <td>Update software</td>
                <td>
                <div class="progress progress-xs">
                <div class="progress-bar progress-bar-danger" style="width: 55%"></div>
                </div>
                </td>
                <td><span class="badge bg-danger">55%</span></td>
                </tr>
                <tr>
                <td>2.</td>
                <td>Clean database</td>
                <td>
                <div class="progress progress-xs">
                <div class="progress-bar bg-warning" style="width: 70%"></div>
                </div>
                </td>
                <td><span class="badge bg-warning">70%</span></td>
                </tr>
                <tr>
                <td>3.</td>
                <td>Cron job running</td>
                <td>
                <div class="progress progress-xs progress-striped active">
                <div class="progress-bar bg-primary" style="width: 30%"></div>
                </div>
                </td>
                <td><span class="badge bg-primary">30%</span></td>
                </tr>
                <tr>
                <td>4.</td>
                <td>Fix and squish bugs</td>
                <td>
                <div class="progress progress-xs progress-striped active">
                <div class="progress-bar bg-success" style="width: 90%"></div>
                </div>
                </td>
                <td><span class="badge bg-success">90%</span></td>
                </tr>
                </tbody>
                </table>
                </div>
        </div>
    </div>
</div>

@stop

@section('css')
<link rel="stylesheet" href="{{ url('') }}/vendor/summernote/summernote-bs4.min.css">

@stop
@section('js')

<meta name="csrf-token" content="{{ csrf_token() }}" />
@routes
<script>
    function edit() {
        $('.texto_wiki').summernote({focus: true});
        $('#edit').css('display', 'none');
        $('#save').css('display', '');
    };
    function save() {
        var texto = $("#texto_wiki").summernote("code")
        var id = {{ $wiki->id }}
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: route('wiki.text.update', id),
            method: 'PUT',
            data: {
                texto: texto,
            },
            success: function(response) {
                console.log(response);
                flasher.success(response.text);
            },
            error: function(xhr, status, error) {
                flasher.error('Ouve um erro, recarregue a pagina e tente novamente');
            }
        });

        $('.texto_wiki').summernote('destroy');
        $('#edit').css('display', '');
        $('#save').css('display', 'none');
    };
</script>
<script src="{{ url('') }}/vendor/summernote/summernote-bs4.min.js"></script>
<script src="{{ url('') }}/vendor/summernote/lang/summernote-pt-BR.js"></script>
<script>
    $(document).ready(function() {
        $('#texto').summernote({
            lang: 'pt-BR',
            height: 300,
            // toolbar: [
            //     [ 'style', [ 'style' ] ],
            //     [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
            //     [ 'fontname', [ 'fontname' ] ],
            //     [ 'fontsize', [ 'fontsize' ] ],
            //     [ 'color', [ 'color' ] ],
            //     [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
            //     [ 'table', [ 'table' ] ],
            //     [ 'insert', [ 'link'] ],
            //     [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
            // ]
        });
    });



</script>
    <script defer src="https://cdn.jsdelivr.net/npm/@flasher/flasher@1.2.4/dist/flasher.min.js"></script>
@stop
@section('footer')

@stop

{{-- @include('section_footer') --}}
{{-- @include('adminlte::partials.footer.section_footer') --}}
