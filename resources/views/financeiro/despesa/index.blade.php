@extends('adminlte::page')

@section('title', 'Lançamento')

@section('content_header')
    <h1>Lançamento</h1>
@stop

@section('content')
<div class="col-md-12">
    <div class="card ">
      <div class="card-header">
            <a href="{{ url()->previous() }}">
                <button type="button"  class="btn  btn-default">
                    <i class="fa-solid fa-chevron-left"></i>
                    Voltar
                </button>
            </a>
            @can('financeiro_lancamento_create')
                <button type="button"  class="btn  btn-danger" data-toggle="modal" data-target="#modal-despesa">
                    {{-- <i class="fa-solid fa-arrow-trend-down"></i> --}}
                    {{-- <i class="fa-solid fa-down-long"></i> --}}
                    <i class="fa-solid fa-plus"></i>
                    Adicionar Despesa
                </button>
                <div class="modal fade modal-primary" id="modal-despesa">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header despesa" >
                                <h4 class="modal-title">Adicionar Despesa</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="descricao">Descrição</label>
                                            {!! html()->text('descricao')->class('form-control')->placeholder('Nome da forma de pagamento')->required() !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="centro_custo_id">Centro de Custo</label>
                                            {!! html()->select('centro_custo_id', \App\Models\Configuracao\Financeiro\CentroCusto::orderBy('name')->where('despesa', '1')->pluck('name', 'id'))->class('form-control')->placeholder('Selecione')->required() !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="cliente_id">Cliente / Fonrcedor </label>
                                            {!! html()->select('cliente_id', \App\Models\Cliente\Cliente::orderBy('name')->pluck('name', 'id'))->class('form-control cliente')->placeholder('Selecione')->required() !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="observacoes"> Observações </label>
                                            {!! html()->textarea('observacoes')->class('form-control')->placeholder('Nome da forma de pagamento') !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="valor"> Valor </label>
                                            {!! html()->text('valor')->class('form-control decimal')->placeholder('Nome da forma de pagamento') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="vencimento"> Vencimento </label>
                                            {!! html()->date('vencimento')->class('form-control')->placeholder('Nome da forma de pagamento') !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="custom-control custom-switch custom-switch-on-danger">
                                                {!! html()->checkbox('despesa')->class('custom-control-input ') !!}
                                                <label class="custom-control-label" for="despesa">Despesa</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="forma_pagamento_id">Forma de pagamento</label>
                                        {!! html()->select('forma_pagamento_id', \App\Models\Configuracao\Financeiro\FormaPagamento::orderBy('name')->pluck('name', 'id'))->class('form-control')->placeholder('Selecione')->required() !!}
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">
                                    <i class="fas fa-times"></i>
                                    Fechar
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i>
                                    Salvar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endcan
            <hr>
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="cliente_id">Cliente / Fonrcedor </label>
                        <select class="form-control js-example-data-ajax" name="" id=""></select>
                        {{-- {!! html()->select('cliente_id', \App\Models\Cliente\Cliente::orderBy('name')->pluck('name', 'id'))->class('form-control cliente')->placeholder('Selecione')->required() !!} --}}
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="name">Forma de pagamento</label>
                {!! html()->text('name')->class('form-control')->placeholder('Nome da forma de pagamento')->required() !!}
            </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive">
        <table class="table table-sm table-hover text-nowrap">
          <thead>
            <tr>
              <th style="width: 10px">#</th>
              <th>Nome</th>
              <th>Descricao</th>
              <th style="width: 40px"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($contas as $item)
              <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $item->name}}</td>
                <td>{{ $item->descricao}}</td>
                <td>
                    <div class="btn-group btn-group-sm">
                        @can('financeiro_lancamento_edit')
                            <a href="{{ route('configuracao.financeiro.forma_pagamento.edit', $item->id) }}" title="Editar" class="btn btn-left btn-info"><i class="fas fa-edit"></i></a>
                        @endcan
                        @can('financeiro_lancamento_show')
                            <a href="{{ route('configuracao.financeiro.forma_pagamento.show', $item->id) }}" title="Editar" class="btn btn-left btn-default"><i class="fas fa-eye"></i></a>
                        @endcan
                        @can('financeiro_lancamento_destroy')
                            <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#modal-excluir_{{ $item->id }}"><i class="fas fa-trash"></i></button>
                        @endcan
                    </div>
                        @can('financeiro_lancamento_destroy')
                        <div class="modal fade" id="modal-excluir_{{ $item->id }}">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h4 class="modal-title">Realmente deseja Excluir?</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                <p><b>Nome:</b> {{ $item->name}}</p>
                                </div>
                                <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                    {!! html()->form('delete', route('configuracao.financeiro.forma_pagamento.destroy', $item->id))->open() !!}
                                        <input type="submit" class="btn btn-danger delete-permission" value="Excluir Lançamento">
                                    {!! html()->form()->close() !!}

                                </div>
                            </div>
                            <!-- /.modal-content -->
                            </div>
                            <!-- /.modal-dialog -->
                        </div>
                        @endcan
                    </div>
                  <!-- /.modal -->
                </td>
              </tr>

            @endforeach
          </tbody>
        </table>
      </div>

      <!-- /.card-body -->
      <div class="card-footer clearfix">
          {{-- {{$contas->appends(['busca' => $busca])->links() }} --}}
          {{ $contas->links() }}
      </div>
    </div>
</div>
@stop

@section('css')
<link href="{{ url('') }}/vendor/select2/dist/css/select2.min.css" rel="stylesheet" />
<link href="{{ url('') }}/vendor/select2/dist/css/select2-bootstrap4.min.css" rel="stylesheet" />
    <style>
        .receita {
            border-top: 3px solid #12cd37;
            /* background-color: #aaceb1; */
        }

        .despesa {
            border-top: 3px solid #cd121f;
        }

    </style>
@stop

@section('js')

<script src="{{ url('') }}/vendor/select2/dist/js/select2.full.min.js"></script>

<script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function() {
        $('.cliente').select2({
            theme: 'bootstrap4',
        });
    });

    // In your Javascript (external .js resource or <script> tag)

</script>
<script>


$(".js-example-data-ajax").select2({
  ajax: {
    url: "https://api.github.com/search/repositories",
    dataType: 'json',
    delay: 250,
    data: function (params) {
      return {
        q: params.term, // search term
        page: params.page
      };
    },
    processResults: function (data, params) {
      // parse the results into the format expected by Select2
      // since we are using custom formatting functions we do not need to
      // alter the remote JSON data, except to indicate that infinite
      // scrolling can be used
      params.page = params.page || 1;

      return {
        results: data.items,
        pagination: {
          more: (params.page * 30) < data.total_count
        }
      };
    },
    cache: true
  },
  placeholder: 'Search for a repository',
  minimumInputLength: 1,
  templateResult: formatRepo,
  templateSelection: formatRepoSelection
});

function formatRepo (repo) {
  if (repo.loading) {
    return repo.text;
  }

  var $container = $(
    "<div class='select2-result-repository clearfix'>" +
      "<div class='select2-result-repository__avatar'><img src='" + repo.owner.avatar_url + "' /></div>" +
      "<div class='select2-result-repository__meta'>" +
        "<div class='select2-result-repository__title'></div>" +
        "<div class='select2-result-repository__description'></div>" +
        "<div class='select2-result-repository__statistics'>" +
          "<div class='select2-result-repository__forks'><i class='fa fa-flash'></i> </div>" +
          "<div class='select2-result-repository__stargazers'><i class='fa fa-star'></i> </div>" +
          "<div class='select2-result-repository__watchers'><i class='fa fa-eye'></i> </div>" +
        "</div>" +
      "</div>" +
    "</div>"
  );

  $container.find(".select2-result-repository__title").text(repo.full_name);
  $container.find(".select2-result-repository__description").text(repo.description);
  $container.find(".select2-result-repository__forks").append(repo.forks_count + " Forks");
  $container.find(".select2-result-repository__stargazers").append(repo.stargazers_count + " Stars");
  $container.find(".select2-result-repository__watchers").append(repo.watchers_count + " Watchers");

  return $container;
}

function formatRepoSelection (repo) {
  return repo.full_name || repo.text;
}

</script>

<script>
    $('.decimal').mask('#.##0,00', { reverse: true });
</script>
@stop
