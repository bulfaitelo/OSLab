<div>

    <div class="col-md-12">
        <h2>{{ $checklist->name }}</h2>
        <h4>{{ $checklist->descricao }}</h4>
        <form method="POST"  wire:submit.prevent="create">

            @forelse ($checklist->opcoes as $opcao)
                {{ $html->render($opcao->name) }} <br>
            @empty

            @endforelse
        </form>
    </div>

</div>
