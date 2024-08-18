<div>
    @if ($menu->count())
    <div class="col">
        <div class="row">
        @foreach ($menu as $item)
            {{-- @dump($item) --}}
            <div class="col">
                <a href="{{ route($item->route) }}">
                    <button type="button" class="btn btn-primary">
                        <i class="{{ $item->icon }}"></i>
                        <span class="d-none d-sm-inline">{{ $item->text }}</span>
                    </button>
                </a>
            </div>
        @endforeach
        </div>
    </div>

    @endif
</div>
