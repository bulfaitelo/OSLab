<div>
    <div class="card-header pl-0">
        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#anotacaoModal">
            <i class="fa-solid fa-plus"></i>
            Anotação
        </button>
        <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#senhaModal">
            <i class="fa-solid fa-plus"></i>
            Senha
        </button>
        <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#anexoModal">
            <i class="fa-solid fa-plus"></i>
            Anexo
        </button>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive">
        <table class="table table-sm table-hover text-nowrap">
        <thead>
            <tr>
            <th>Tipo</th>
            <th>Observações</th>
            <th>Cadastro</th>
            <th style="width: 40px"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($informacoes as $item)
                <tr>
                    <td>{{ $item->tipo }}</td>
                    <td>{{ Str::limit($item->informacao, '100') }}</td>
                    <td>{{ $item->created_at->format('H:i - d/m/Y') }}</td>
                </tr>

            @endforeach

        </tbody>
        </table>
    </div>




<!-- Modal - ANOTACAO  -->
<div  class="modal fade" id="anotacaoModal" tabindex="-1" role="dialog" aria-labelledby="anotacaoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" wire:submit.prevent="anotacaoCreate()">
                <div class="modal-header">
                    <h5 class="modal-title" id="anotacaoModalLabel">Adicionar Anotação</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="anotacao">Anotação</label>
                            <textarea wire:model.defer="anotacao" type="text" id="anotacao" class="form-control" placeholder="Escreva aqui a anotação"></textarea>
                            @error('anotacao') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
                        <i class="fa-regular fa-rectangle-xmark"></i>
                        Close
                    </button>
                    <button type="submit" id="salvechecklist" class="btn btn-sm btn-primary">
                        <i class="fas fa-save"></i>
                        Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- FIM Modal - ANOTACAO  -->

<!-- Modal - SENHA  -->
<div class="modal fade" id="senhaModal" tabindex="-1" role="dialog" aria-labelledby="senhaModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" wire:submit.prevent="senhaCreate(senha_padrao)">
                <div class="modal-header">
                    <h5 class="modal-title" id="senhaModalLabel">Senha</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="descricao_senha">Descricao</label>
                            <input type="text" wire:model.defer="descricao_senha" id="descricao_senha" class="form-control" placeholder="Descrição ">
                            @error('descricao_senha') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="tipo_senha">Tipo de senha</label>
                            <select wire:model.defer="tipo_senha" id="tipo_senha" class="form-control">
                                <option value="texto">Texto</option>
                                <option value="padrao">Padrão</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12" id="texto">
                        <div class="form-group">
                            <label for="senha_texto">Senha</label>
                            <div class="input-group mb-3">
                                <input id="senha_texto" type="password" wire:label.defer="senha_texto" class="form-control " placeholder="Senha">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span id="senha_texto_icone" class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="display: none" id="padrao">
                        <label for="">Padrão</label>
                        <input type="hidden" id="senha_padrao" wire:model.defer="senha_padrao">
                        <svg class="patternlock" id="lock" viewBox="0 0 100 100" >
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
                        <i class="fa-regular fa-rectangle-xmark"></i>
                        Close
                    </button>
                    <button type="submit" id="salvechecklist" class="btn btn-sm btn-primary">
                        <i class="fas fa-save"></i>
                        Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>
  </div>
<!-- FIM Modal - SENHA  -->

<!-- Modal - ANEXO  -->
<div class="modal fade" id="anexoModal" tabindex="-1" role="dialog" aria-labelledby="anexoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="anexoModalLabel">Anexo</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            @include('adminlte::partials.form-alert')

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
                <i class="fa-regular fa-rectangle-xmark"></i>
                Close
            </button>
            <button type="submit" id="salvechecklist" class="btn btn-sm btn-primary">
                <i class="fas fa-save"></i>
                Salvar
            </button>
        </div>
      </div>
    </div>
  </div>
<!-- FIM Modal - ANEXO  -->

@if(count($errors) > 0)
<script>
    $('.modal').modal('hide');
</script>
@endif
<script>
    window.addEventListener('closeModal', event => {
        $('.modal').modal('hide');
    })
</script>
<script>
    // Obtém uma referência para o elemento select e a div
    const selectElement = document.getElementById('tipo_senha');
    const divTexto = document.getElementById('texto');
    const divPadrao = document.getElementById('padrao');

    // Adiciona um ouvinte de evento para detectar mudanças no select
    selectElement.addEventListener('change', function () {
        // Obtém o valor da opção selecionada
        const selectedOption = selectElement.value;

        // Verifica o valor da opção e aplica as propriedades desejadas à div
        if (selectedOption === 'texto') {
            divTexto.style.display= "";
            divPadrao.style.display= "none";
        } else if (selectedOption === 'padrao') {
            divTexto.style.display= "none";
            divPadrao.style.display= "";
      }
    });
    const togglePassword = document.querySelector('#senha_texto_icone');
    const password = document.querySelector('#senha_texto');
    const icone = document.querySelector('#senha_texto_icone');

    togglePassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye / eye slash icon
        this.classList.toggle('fa-lock-open');
    });
</script>
<script>
    let senha_padrao ;
    document.addEventListener('livewire:load', function () {
        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }
        var e = document.getElementById('lock');

        var p =  new PatternLock(e, {
            onPattern: async function(pattern) {
                senha = pattern.toString()


                if (senha.length > 3 ) {
                    this.success();
                    senha_padrao = pattern;
                } else {
                    this.error();
                    await sleep(1000);
                    this.clear();
                }

            }
        });
    })
</script>

@if(count($errors) > 0)
@php
    flash()->addError('Por favor verifique o formulário', 'Ocorreu um erro!');
@endphp
@endif
</div>
