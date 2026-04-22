<table class="table table-sm table-hover text-nowrap">
    <thead>
      <tr>
        <th>Fabricante</th>
        <th>Nome</th>
        <th>Modelos</th>
        <th>Categoria</th>
        <th>Qtd. OS</th>
        <th>Criado pelo usuario</th>
        @if ((isset($edit) && $edit === true) || (isset($show) && $show === true) || (isset($destroy) && $destroy === true))
            <th style="width: 40px"></th>
        @endif
      </tr>
    </thead>
    <tbody>
      @forelse ($wikiTable as $item)
        <tr>
            <td>
                @if (isset($show) && $show === true)
                    @can('wiki_show')
                        <a href="{{ route('wiki.show', $item->id) }}">
                            <b>[{{ $item->fabricante->name }}]</b>
                        </a>
                    @else()
                        <b>[{{ $item->fabricante->name }}]</b>
                    @endcan
                @else
                    <b>[{{ $item->fabricante->name }}]</b>
                @endif
            </td>
            <td>
                @if (isset($show) && $show === true)
                    @can('wiki_show')
                        <a href="{{ route('wiki.show', $item->id) }}">
                            {{ $item->name}}
                        </a>
                    @else()
                        {{ $item->name}}
                    @endcan
                @else
                    {{ $item->name}}
                @endif
            </td>
            <td>
                @if (isset($show) && $show === true)
                    @can('wiki_show')
                        <a href="{{ route('wiki.show', $item->id) }}">
                            {{ $item->modelosTitle()}}
                        </a>
                    @else()
                        {{ $item->modelosTitle()}}
                    @endcan
                @else
                    {{ $item->modelosTitle()}}
                @endif
            </td>
            <td>{{ $item->categoria->name}}</td>
            <td>{{ $item->os->count() }}</td>
            <td>{{ $item->user->name}}</td>
            @if ((isset($edit) && $edit === true) || (isset($show) && $show === true) || (isset($destroy) && $destroy === true))
            <td>
                <div class="btn-group btn-group-sm">
                    @if (isset($edit) && $edit === true)
                        @can('wiki_edit')
                            <a href="{{ route('wiki.edit', $item->id) }}" title="Editar" class="btn btn-left btn-info"><i class="fas fa-edit"></i></a>
                        @endcan
                    @endif
                    @if (isset($show) && $show === true)
                        @can('wiki_show')
                            <a href="{{ route('wiki.show', $item->id) }}" title="Visualizar" class="btn btn-left btn-default"><i class="fas fa-eye"></i></a>
                        @endcan
                    @endif
                    @if (isset($destroy) && $destroy === true)
                        @can('wiki_destroy')
                            <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-name="{{$item->name}}" data-url="{{route('wiki.destroy', $item->id)}}" data-target="#modal-excluir"><i class="fas fa-trash"></i></button>
                        @endcan
                    @endif
                </div>
            </td>
            @endif
        </tr>
        @if ($item->snippet_texto)
        <tr>
            <td colspan="10" class="pl-1 border-top-0" style="max-width: 0;">
                <div class="mb-0 text-truncate" style="font-size: 13px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;width: 100%;">
                    <span class="text-dark" style="font-size: 13px"><b>Wiki</b></span>: {!! $item->snippet_texto !!}
                </div>
            </td>
        </tr>
        @endif
        @empty
        <tr>
            <th colspan="9">
                <h3>Não existem Wikis cadastradas</h3>
            </th>
        </tr>
        @endforelse
    </tbody>
  </table>
