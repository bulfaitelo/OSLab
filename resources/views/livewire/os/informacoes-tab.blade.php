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
            <button wire:click="$emit('postAdded')"> botão  </button>


        </div>

        <!-- /.card-header -->
        <div class="card-body table-responsive">
          <table class="table table-sm table-hover text-nowrap">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Tipo</th>
                <th>Observações</th>
                <th>Cadastro</th>
                <th style="width: 40px"></th>
              </tr>
            </thead>
            <tbody>

            </tbody>
          </table>
        </div>




<!-- Modal - ANOTACAO  -->
<div  class="modal fade" id="anotacaoModal" tabindex="-1" role="dialog" aria-labelledby="anotacaoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" wire:submit.prevent="anotacaoCreate">
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
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
        <div class="modal-header">
          <h5 class="modal-title" id="senhaModalLabel">Senha</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="text">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="salvechecklist" class="btn btn-sm btn-primary">
                <i class="fas fa-save"></i>
                Salvar
            </button>
        </div>
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
          <input type="text">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" id="salvechecklist" class="btn btn-sm btn-primary">
                <i class="fas fa-save"></i>
                Salvar
            </button>
        </div>
      </div>
    </div>
  </div>
<!-- FIM Modal - ANEXO  -->

<script>

        window.addEventListener('exibirMensagemFoi', event => {
            $('#anotacaoModal').modal('hide')
        })
</script>
</div>
