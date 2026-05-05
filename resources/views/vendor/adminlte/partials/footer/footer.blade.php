<footer class="main-footer text-sm">
    Copyright © 2023-{{ date('Y') }} <a target="_blank" href="https://github.com/bulfaitelo/oslab">OS<b>Lab</b></a>.
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        @yield('footer')
        @if(config('version.show'))
            <div class="text-muted text-sm">
                <a href="{{ config('version.url') }}" target="_blank" rel="noopener noreferrer"
                    class="text-decoration-none">
                    {{ config('version.number') }}
                </a>
            </div>
        @endif
    </div>
</footer>
