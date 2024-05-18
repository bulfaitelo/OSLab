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
        <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#arquivoModal">
            <i class="fa-solid fa-plus"></i>
            Arquivo
        </button>
    </div>
    <!-- /.card-header -->
    <div class="card-body table-responsive">
        <table class="table table-sm table-hover text-nowrap">
        <thead>
            <tr>
            <th>Tipo</th>
            <th>Descrição</th>
            <th>Cadastro</th>
            <th>Status</th>
            <th style="width: 40px"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($informacoes as $item)
                <tr wire:key="{{ $item->id }}">
                    <td>{{ $item->getTipo() }}</td>
                    <td>{{ Str::limit($item->getDescricao(), '100') }}</td>
                    <td>{{ $item->created_at->format('H:i - d/m/Y') }}</td>
                    <td>{{ $item->getStatus() }}</td>
                    <td>
                        <div class="btn-group btn-group-sm float-right">
                            @if ($item->tipo == 3)
                            <button type="button" class="btn btn-sm btn-primary" wire:click="getFile({{$item->id}})">
                                <i class="fa-solid fa-download"></i>
                            </button>
                            @endif
                            <button wire:click="$emitTo('os.informacoes.visualizar-modal', 'open', {{$item->id}} )"  class="btn btn-block btn-default"  title="Visualizar" >
                                <i class="fas fa-eye"></i>
                            </button>
                            @livewire('os.informacoes.delete-button', ['os_id' => $item->os_id, 'item_id' => $item->id], key($item->id))
                            <button type="button"
                                @if ($item->uuid)
                                    title="Compartilhado"  class="btn btn-block btn-success"
                                @else
                                    title="Compartilhar"  class="btn btn-block bg-lightblue"
                                @endif
                                wire:click="$emitTo('os.informacoes.compartilhar-modal', 'open', {{$item->id}}, {{$item->os_id}} )"  >
                                <i class="fa-solid fa-share-from-square"></i>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>

    <!-- Modal - ANOTACAO  -->
    <div wire:ignore.self class="modal fade" id="anotacaoModal" tabindex="-1" role="dialog" aria-labelledby="anotacaoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" wire:submit="anotacaoCreate()">
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
                                <textarea wire:model.live="anotacao" type="text" id="anotacao" class="form-control" placeholder="Escreva aqui a anotação"></textarea>
                                @error('anotacao') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
                            <i class="fa-regular fa-rectangle-xmark"></i>
                            Fechar
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
    <div wire:ignore.self class="modal fade" id="senhaModal" tabindex="-1" role="dialog" aria-labelledby="senhaModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" wire:submit="senhaCreate(senha_padrao)">
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
                                <input type="text" wire:model.live="descricao_senha" id="descricao_senha" class="form-control" placeholder="Descrição ">
                                @error('descricao_senha') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="tipo_senha">Tipo de senha</label>
                                <select wire:model.live="tipo_senha" id="tipo_senha" class="form-control">
                                    <option value="texto">Texto</option>
                                    <option value="padrao">Padrão</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12"  @if ($tipo_senha == 'padrao') style="display: none" @endif id="texto">
                            <div class="form-group">
                                <label for="senha_texto">Senha</label>
                                <div class="input-group mb-3">
                                    <input id="senha_texto" type="password" wire:model.live="senha_texto" class="form-control " placeholder="Senha">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <span id="senha_texto_icone" class="fas fa-lock"></span>
                                        </div>
                                    </div>
                                </div>
                                @error('senha_texto') <span class="error">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-12" @if ($tipo_senha == 'texto') style="display: none" @endif  id="padrao">
                            <label for="">Padrão</label>
                            <input type="hidden" id="senha_padrao" wire:model.live="senha_padrao">
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
                            @error('senha_padrao') <span class="error">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
                            <i class="fa-regular fa-rectangle-xmark"></i>
                            Fechar
                        </button>
                        <button type="submit" id="salvesenha" class="btn btn-sm btn-primary">
                            <i class="fas fa-save"></i>
                            Salvar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- FIM Modal - SENHA  -->

    <!-- Modal - ARQUIVO  -->
    <div wire:ignore.self class="modal fade" id="arquivoModal" tabindex="-1" role="dialog" aria-labelledby="arquivoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
                <form method="POST" wire:submit="arquivoCreate()">
                    <div class="modal-header">
                    <h5 class="modal-title" id="arquivoModalLabel">Anexo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="descricao_arquivo">Descricao</label>
                            <input type="text" wire:model.live="descricao_arquivo" id="descricao_arquivo" class="form-control" placeholder="Descrição ">
                            @error('descricao_arquivo') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="arquivo">Arquivo</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input wire:ignore.self  type="file" wire:model.live="arquivo" class="custom-file-input" id="arquivo" accept=".zip, .pdf, .jpg, .png, .bmp" >
                                    <label class="custom-file-label" for="arquivo"></label>
                                </div>
                            </div>

                            @error('arquivo') <span class="error">{{ $message }}</span> <br> @enderror

                            <i>Extenções permitidas: .zip, .pdf, .jpg, .png, .bmp, tamanho maximo 5mb</i>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
                            <i class="fa-regular fa-rectangle-xmark"></i>
                            Fechar
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
    <!-- FIM Modal - ARQUIVO  -->

    <!-- Modal - Vizualização  -->
    <div wire:ignore class="modal fade" id="modal-vizualizar" tabindex="-1" role="dialog" aria-hidden="true">
        @livewire('os.informacoes.visualizar-modal')
    </div>
    <!-- FIM Modal - Vizualização  -->

    <!-- Modal - Compartilhar  -->
    <div wire:ignore.self class="modal fade" id="modal-compartilhar" tabindex="-1" role="dialog" aria-hidden="true">
        @livewire('os.informacoes.compartilhar-modal')
    </div>
    <!-- FIM Modal - Compartilhar  -->
<script>
    document.addEventListener('livewire:init', function () {
        window.livewire.on('toggleVisualizarModal', () => $('#modal-vizualizar').modal('toggle'));
        window.livewire.on('toggleCompartilharModal', () => $('#modal-compartilhar').modal('toggle'));
        window.livewire.on('senhaPadrao', (senha) => {
            var e = document.getElementById('lock_view');
            var p =  new PatternLock(e, {
            });
            if (senha) {
                p.setPattern(senha);
                p.success();;
            }
        });
    });
</script>
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
        console.log(togglePassword);
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye / eye slash icon
        this.classList.toggle('fa-lock-open');
    });

    // function copiar(id) {
    //     let textoCopiado = document.getElementById("url_"+id);

    //     var tempTextArea = document.createElement("textarea").value = textoCopiado.href;
    //     // tempTextArea.value = urlElement.href;
    //     document.body.appendChild(tempTextArea);
    //     tempTextArea.select();
    //     tempTextArea.setSelectionRange(0, 99999)
    //     document.execCommand("copy");
    //     document.body.removeChild(tempTextArea);
    // }

</script>
<script>
    let senha_padrao ;
    document.addEventListener('livewire:init', function () {
        function sleep(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }
        var e = document.getElementById('lock');

        var p =  new PatternLock(e, {
            onPattern: async function(pattern) {
                senha = pattern.toString()
                if (senha.length > 3 ) {
                    this.success();
                    $('#salvesenha').removeAttr("disabled", "disabled");
                    senha_padrao = pattern;
                } else {
                    this.error();
                    $('#salvesenha').attr("disabled", "disabled");
                    senha_padrao = '';
                    await sleep(1000);
                    this.clear();
                }
            }
        });
    })
</script>
<script>
    // function setPadrao(id, tipo, senha) {
    //     if (tipo == 'padrao') {
    //         var e = document.getElementById('lock_view_'+id);
    //         var p =  new PatternLock(e, {
    //         });
    //         p.setPattern(senha);
    //     }
    // }
    // document.addEventListener('livewire:init', function () {
    //     prepareFormSenha()
    //     $('#tipo_senha').on("change", function () {
    //         prepareFormSenha()
    //     })

    //     function prepareFormSenha() {
    //         var tipo_senha = $('#tipo_senha').val();
    //         if (tipo_senha == 'texto') {
    //             $('#senha_texto').attr("required","required");
    //             $('#salvesenha').removeAttr("disabled", "disabled");
    //         } else {
    //             $('#senha_texto').removeAttr("required");
    //             $('#salvesenha').attr("disabled", "disabled");

    //         }
    //     }


    // });
</script>

@if(count($errors) > 0)
    @php
        flash()->addError('Por favor verifique o formulário', 'Ocorreu um erro!');
    @endphp
@endif
</div>
