<div class="modal-dialog" role="document">
    <div class="modal-content">
        <div class="modal-header">
            {{-- <h5 class="modal-title" id="anotacaoModalLabel">Compartilhar {{ Str::limit($item->getDescricao(), '100') }}</h5> --}}
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        @if ($item)


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
                    <button type="button" wire:click="createShareUrl({{$item->id}})" class="btn btn-sm btn-oslab" >
                        <i class="fa-solid fa-share-nodes"></i>
                        Gerar URL
                    </button>
                    <br>
                    <i>Esse link terá validade por: {{getConfig('os_link_time_limit')}} minutos</i>
                @else
                    <button type="button" wire:click="createShareUrl({{$item->id}})" class="btn btn-sm btn-oslab" >
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
