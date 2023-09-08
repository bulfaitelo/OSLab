<div>

    <div class="col-md-12">
        <h2>{{ $checklist->name }}</h2>
        <h4>{{ $checklist->descricao }}</h4>
        <form method="POST"  wire:submit.prevent="create">
            <div id="fb-render"></div>
            {{-- <input type="hidden"  id="checklist" wire:model="checklistForm"> --}}
            <input type="submit" value="salvar">
        </form>
    </div>


    <script>

        document.addEventListener('livewire:load', function () {
            var fbRender = document.getElementById('fb-render');
            var formData = '{!! $checklist->checklist !!}';
            var formRenderOpts = {
                formData,
                dataType: 'json',

            };

            var fData = $(fbRender).formRender(formRenderOpts);
            console.log(fData.userData); // retorna o formulário preenchido e formatado.

            $('#formChecklist').submit(function(event) {
                // $('#checklist').val(fData.userData);
                console.log('submit;');
                @this.set('checklistForm', 'fData.userData');
            });
        })




    </script>

</div>
