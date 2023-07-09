{{-- @extends('adminlte::page', ['iFrameEnabled' => true]) --}}
@extends('adminlte::page')


@section('title', 'Home')

@section('content_header')
    <h1>[{{ $wiki->fabricante->name }}] -  {{ $wiki->name}} </h1>
    <h6>{{ $wiki->modelosTitle() }}</h6>
@stop

@section('content')
<div class="row">
    <div class="col-md-9">
        <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                    <h3 class="card-title">Online Store Visitors</h3>
                    <button type="button" class="btn btn-primary btn-sm">Editar</button>
                </div>
            </div>
            <div class="card-body">
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Explicabo temporibus, inventore est, architecto quisquam nam cum enim natus laborum voluptatem ipsam, minima quidem sapiente nulla at autem provident quibusdam odit?
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Quod iusto eum, obcaecati nemo ipsa non quidem. Consequatur, eius in! Earum eius at nam qui atque distinctio, sapiente adipisci eveniet nihil.
                Magnam fugiat sit doloribus, iure eos perspiciatis? Minus, mollitia non? Nihil consequatur nisi rerum porro asperiores. Optio dolore perferendis, corporis obcaecati ad quas harum cum facere incidunt deserunt architecto distinctio.
                Commodi pariatur tempora quae rerum magnam. Fugit modi iusto velit est saepe possimus voluptas tempore eius architecto quia earum temporibus quas, laboriosam distinctio. Quam at cumque alias illo nam eveniet.
                Blanditiis, unde asperiores eum ex recusandae odio quos placeat, veritatis qui officia, et illo odit? Nihil dolore optio, totam similique, et quisquam, minus libero maiores distinctio voluptatibus repudiandae sunt velit!
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

@stop
@section('js')

@stop
@section('footer')

@stop

{{-- @include('section_footer') --}}
{{-- @include('adminlte::partials.footer.section_footer') --}}
