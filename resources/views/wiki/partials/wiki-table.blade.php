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
      @foreach ($wikiTable as $item)
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

      @endforeach
    </tbody>
  </table>
