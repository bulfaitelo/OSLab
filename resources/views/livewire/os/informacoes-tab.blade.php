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
            <th style="width: 40px"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($informacoes as $item)
                <tr>
                    <td>{{ $item->getTipo() }}</td>
                    <td>{{ Str::limit($item->getDescricao(), '100') }}</td>
                    <td>{{ $item->created_at->format('H:i - d/m/Y') }}</td>
                    <td>
                        <div class="btn-group btn-group-sm float-right">
                            @if ($item->tipo == 3)
                            <button type="button" class="btn btn-sm btn-primary" wire:click="getFile({{$item->id}})">
                                <i class="fa-solid fa-download"></i>
                            </button>

                            @endif
                            {{-- <a title="Visualizar" class="btn btn-left btn-default"><i class="fas fa-eye"></i></a> --}}
                            <button type="button"  title="Visualizar"  class="btn btn-block btn-default" data-toggle="modal" data-target="#modal-vizualizar_{{ $item->id }}" onclick="setPadrao('{{$item->id}}', '{{$item->tipo_informacao}}', '{{$item->informacao}}')" >
                                <i class="fas fa-eye"></i>
                            </button>
                            {{-- <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#modal-excluir_{{ $item->id }}"><i class="fas fa-trash"></i></button> --}}
                            @if($confirmacaoDelete===$item->id)
                                <button wire:click="delete({{ $item->id }})" title="Excluir"
                                    class="btn btn-left bg-olive " >
                                    <i class="fa-solid fa-check"></i>
                                </button>
                                <button wire:click="cancelDelete()" title="Cancelar"
                                    class="btn btn-left bg-maroon" >
                                    <i class="fa-solid fa-ban"></i>
                                </button>
                            @else
                                <button wire:click="confirmDelete({{ $item->id }})"
                                    class="btn btn-left  btn-danger" >
                                    <i class="fas fa-trash"></i>
                                </button>
                            @endif
                            @if ($item->uuid)
                                <button type="button"  title="Compartilhado"  class="btn btn-block btn-success" data-toggle="modal" data-target="#modal-compartilhar_{{ $item->id }}" >
                                    <i class="fa-solid fa-share-from-square"></i>
                                </button>
                            @else
                                <button type="button"  title="Compartilhar"  class="btn btn-block bg-lightblue" data-toggle="modal" data-target="#modal-compartilhar_{{ $item->id }}" >
                                    <i class="fa-solid fa-share-from-square"></i>
                                </button>
                            @endif
                        </div>
                    </td>
                    <!-- Modal - Vizlualização  -->
                    <div wire:ignore.self class="modal fade" id="modal-vizualizar_{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-vizualizar_{{ $item->id }}Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="anotacaoModalLabel">Vizualizar {{ $item->getTipo() }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
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
                                        <svg class="patternlock" id="lock_view_{{$item->id}}" viewBox="0 0 100 100" >
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
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
                                        <i class="fa-regular fa-rectangle-xmark"></i>
                                        Fechar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- FIM Modal - Vizlualização  -->
                    <!-- Modal - Compartilhar  -->
                    <div wire:ignore.self class="modal fade" id="modal-compartilhar_{{ $item->id }}" tabindex="-1" role="dialog" aria-labelledby="modal-compartilhar_{{ $item->id }}Label" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="anotacaoModalLabel">Compartilhar {{ Str::limit($item->getDescricao(), '100') }}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    @if ($item->uuid)
                                    <div class="col-md-12">
                                        {{-- <button type="button"  class="btn btn-sm btn-success" id="" onclick="copiar()" >
                                            <i class="fa-solid fa-paperclip"></i>
                                            Copiar
                                        </button> --}}
                                    </div>
                                    @endif
                                    <div class="col-md-12">
                                        <div class="row mb-1">
                                            @if ($item->uuid)
                                            <a href="{{$item->urlShare()}}" id="url_{{$item->id}}" class="ml-2" style="white-space: nowrap; overflow: hidden;" target="_blank" rel="noopener noreferrer">{{$item->urlShare()}}</a>
                                            {{-- <input type="text" id="url_{{$item->id}}"  value="{{$item->urlShare()}}"> --}}
                                            @endif
                                        </div>
                                        @if (!$item->uuid)
                                            <button type="button" wire:click="createShareUrl({{$item->id}})" class="btn btn-sm btn-primary" >
                                                <i class="fa-solid fa-share-nodes"></i>
                                                Gerar URL
                                            </button>
                                            <br>
                                            <i>Esse link terá validade por: {{getConfig('os_link_time_limit')}} minutos</i>
                                        @else
                                            <button type="button" wire:click="createShareUrl({{$item->id}})" class="btn btn-sm btn-primary" >
                                                <i class="fa-solid fa-retweet"></i>
                                                Atualizar URL
                                            </button>
                                        @endif
                                        @if ($item->uuid)
                                            <button type="button" wire:click="deleteShareUrl({{$item->id}})" class="btn btn-sm btn-danger" >
                                                <i class="fa-solid fa-share-nodes"></i>
                                                Apagar URL
                                            </button>
                                            <br>
                                            <i>Esse link será valido até: {{$item->validade_link?->format('H:i - d/m/Y')}}</i>
                                        @endif
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">
                                        <i class="fa-regular fa-rectangle-xmark"></i>
                                        Fechar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- FIM Modal - Compartilhar  -->
                </tr>
            @endforeach
        </tbody>
        </table>
    </div>




<!-- Modal - ANOTACAO  -->
<div wire:ignore.self class="modal fade" id="anotacaoModal" tabindex="-1" role="dialog" aria-labelledby="anotacaoModalLabel" aria-hidden="true">
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
                    <div class="col-md-12"  @if ($tipo_senha == 'padrao') style="display: none" @endif id="texto">
                        <div class="form-group">
                            <label for="senha_texto">Senha</label>
                            <div class="input-group mb-3">
                                <input id="senha_texto" type="password" wire:model.defer="senha_texto" class="form-control " placeholder="Senha">
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
            <form method="POST" wire:submit.prevent="arquivoCreate()">
                <div class="modal-header">
                <h5 class="modal-title" id="arquivoModalLabel">Anexo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="descricao_arquivo">Descricao</label>
                        <input type="text" wire:model.defer="descricao_arquivo" id="descricao_arquivo" class="form-control" placeholder="Descrição ">
                        @error('descricao_arquivo') <span class="error">{{ $message }}</span> @enderror
                    </div>
                    <div class="form-group">
                        <label for="arquivo">Arquivo</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input wire:ignore.self  type="file" wire:model="arquivo" class="custom-file-input" id="arquivo" accept=".zip, .pdf, .jpg, .png, .bmp" >
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
    function setPadrao(id, tipo, senha) {
        if (tipo == 'padrao') {
            var e = document.getElementById('lock_view_'+id);
            var p =  new PatternLock(e, {
            });
            p.setPattern(senha);
        }
    }
    document.addEventListener('livewire:load', function () {
        prepareFormSenha()
        $('#tipo_senha').on("change", function () {
            prepareFormSenha()
        })

        function prepareFormSenha() {
            var tipo_senha = $('#tipo_senha').val();
            if (tipo_senha == 'texto') {
                $('#senha_texto').attr("required","required");
                $('#salvesenha').removeAttr("disabled", "disabled");
            } else {
                $('#senha_texto').removeAttr("required");
                $('#salvesenha').attr("disabled", "disabled");

            }
        }


    });
</script>

@if(count($errors) > 0)
@php
    flash()->addError('Por favor verifique o formulário', 'Ocorreu um erro!');
@endphp
@endif
</div>
