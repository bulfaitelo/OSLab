<div>
    <div class="col-md-12">
        <h2>{{ $checklist->name }}</h2>
        <h4>{{ $checklist->descricao }}</h4>
        <form method="POST"  wire:submit="submit(new URLSearchParams(new FormData($event.target)).toString())">
            <div class="rendered-form">
                {!! $os->getHtmlChecklist() !!}
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i>
                Salvar
            </button>
        </form>
    </div>
</div>
