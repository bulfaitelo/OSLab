<div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5>
                A OS: #{{ $item->id }}, não pode ser faturada por existir pendencias
            </h5>
        </div>
        <div class="modal-body">

        </div>
        <div class="modal-footer">
            <button id="fechar" type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
                <i class="fa-regular fa-rectangle-xmark"></i>
                Fechar
            </button>
        </div>

    </div>

    <script>
        document.addEventListener('livewire:init', function () {
            Livewire.on('toggleFaturarModal', () => $('#faturarModal').modal('toggle'));

            $("#fechar").click(function() {
                $('.nav-tabs a[href="#checklist"]').tab('show');
            });
        });
    </script>
</div>
