<div>

    <div class="col-md-12">
        <h2>{{ $checklist->name }}</h2>
        <h4>{{ $checklist->descricao }}</h4>
        <form method="POST"  wire:submit.prevent="create">
            <div class="rendered-form">
                {!! $os->getHtmlChecklist() !!}
            </div>
        <input type="submit" value="salvar">
        </form>
    </div>

</div>
