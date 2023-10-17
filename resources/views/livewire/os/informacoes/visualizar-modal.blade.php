<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            {{-- <h5 class="modal-title" id="anotacaoModalLabel">Vizualizar {{ $item->getTipo() }}</h5> --}}
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        @if ($item)
            @if ($item->tipo == 1)
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="anotacao">Anotação</label>
                        <textarea type="text" disabled id="anotacao" class="form-control" placeholder="Escreva aqui a anotação">{{$item->informacao}}</textarea>
                    </div>
                </div>
            @endif
            @if ($item->tipo == 2)
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="descricao_senha">Descricao</label>
                        <input type="text" value="{{$item->descricao}}" disabled id="descricao_senha" class="form-control" placeholder="Descrição ">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="tipo_senha">Tipo de senha</label>
                        {!! html()->select('', ['text'=> 'Texto', 'padrao'=> 'Padrão'], $item->tipo_informacao)->class('form-control')->disabled() !!}
                    </div>
                </div>
                <div class="col-md-12"  @if ($item->tipo_informacao == 'padrao') style="display: none" @endif >
                    <div class="form-group">
                        <label for="senha_texto">Senha</label>
                        @livewire('os.informacoes.senha-input', ['senha' => $item->informacao, 'senha_id' => $item->id], key($item->id))
                    </div>
                </div>
                <div class="col-md-12" @if ($item->tipo_informacao == 'texto') style="display: none" @endif >
                    <label for="">Padrão</label>
                    <svg class="patternlock" id="lock_view" viewBox="0 0 100 100" >
                        <g class="lock-actives"></g>
                        <g class="lock-lines"></g>
                        <g class="lock-dots">
                            <circle cx="20" cy="20" r="2"/>
                            <circle cx="50" cy="20" r="2"/>
                            <circle cx="80" cy="20" r="2"/>
                            <circle cx="20" cy="50" r="2"/>
                            <circle cx="50" cy="50" r="2"/>
                            <circle cx="80" cy="50" r="2"/>
                            <circle cx="20" cy="80" r="2"/>
                            <circle cx="50" cy="80" r="2"/>
                            <circle cx="80" cy="80" r="2"/>
                        </g>
                    </svg>
                </div>
            @endif
            @if ($item->tipo == 3)
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="descricao_senha">Descricao</label>
                        <input type="text" value="{{$item->descricao}}" disabled id="descricao_senha" class="form-control" placeholder="Descrição ">
                        @error('descricao_senha') <span class="error">{{ $message }}</span> @enderror
                    </div>
                </div>
                @if (in_array($item->tipo_informacao, ['jpg', 'bmp', 'png']))
                    <div class="col-md-12">
                        <img class="img-fluid" src="{{$item->url()}}" alt="{{$item->getDescricao()}}">
                    </div>
                @endif
                <div class="col-md-12 mt-3">
                    <div class="form-group">
                        <button type="button" class="btn btn-sm btn-primary" wire:click="getFile({{$item->id}})">
                            <i class="fa-solid fa-download"></i>
                            Download
                        </button>
                    </div>
                </div>
            @endif
        @endif
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
                <i class="fa-regular fa-rectangle-xmark"></i>
                Fechar
            </button>
        </div>
    </div>
    <script>
        // document.addEventListener('livewire:load', function () {
        //     window.livewire.on('senhaPadrao', () =>
        //         console.log('senhaPadrao');
        //     );
        // });
    </script>

    {{-- @if (($item) && ($item->tipo_informacao == 'padrao'))
        <script>

            document.addEventListener('livewire:load', function () {
                alert('teste');
                var e = document.getElementById('lock_view');
                var p =  new PatternLock(e, {
                });
                p.setPattern({{$item->senha}});
            });
        </script>
    @endif --}}
</div>

