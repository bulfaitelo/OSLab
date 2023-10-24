<div class="modal fade"  id="modal-excluir" role="dialog"  aria-hidden="true">
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
            {!! html()->form('delete')->open() !!}
                <button type="submit" class="btn btn-danger delete-permission">
                    <i class="fa-solid fa-trash"></i>
                    Excluir
                </button>
            {!! html()->form()->close() !!}
            </div>
        </div>
    </div>
</div>
