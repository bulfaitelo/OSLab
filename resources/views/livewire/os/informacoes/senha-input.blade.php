<div>
    <div class="input-group mb-3">
        @if ($checkPass === $senha_id)
            <input value="{{$senha}}" type="text" class="form-control" disabled placeholder="Senha">
        @else
            <input value="nao tem nada aui não" type="password" class="form-control" disabled placeholder="Senha">
        @endif
        <div class="input-group-append">
            <div class="input-group-text">
                <span wire:click="showPass({{$senha_id}})"
                    @class([
                        'fas fa-lock' => ($checkPass != $senha_id),
                        'fas fa-lock-open' => ($checkPass === $senha_id)
                        ])
                        >
                </span>
            </div>
        </div>
    </div>
</div>
