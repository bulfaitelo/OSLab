<div>
    <div class="card custom-border">
        <div class="card-body p-3">
            {!! html()->select('name', $status, $status_selected)->class('form-control')->attribute('wire:model.live', 'status_id') !!}
            <span class="display-1 text-oslab" ><b>{{ $os_count }}</b></span>
        </div>
    </div>
</div>
