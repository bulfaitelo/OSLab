@inject('layoutHelper', 'JeroenNoten\LaravelAdminLte\Helpers\LayoutHelper')
@inject('preloaderHelper', 'JeroenNoten\LaravelAdminLte\Helpers\preloaderHelper')

@if($layoutHelper->isLayoutTopnavEnabled())
    @php( $def_container_class = 'container' )
@else
    @php( $def_container_class = 'container-fluid' )
@endif

{{-- Default Content Wrapper --}}
<div class="{{ $layoutHelper->makeContentWrapperClasses() }}">

    {{-- Preloader Animation (cwrapper mode) --}}
    @if($preloaderHelper->isPreloaderEnabled('cwrapper'))
        @include('adminlte::partials.common.preloader')
    @endif

    {{-- Content Header --}}
    @hasSection('content_header')
        <div class="content-header">
            <div class="{{ config('adminlte.classes_content_header') ?: $def_container_class }}">
                <div class="row">
                    <div class="col-sm-5">
                        @yield('content_header')
                        @hasSection ('content_header_help_content')
                        <span
                            class="help_popover h5 d-inline"
                            data-container="body"
                            data-toggle="popover"
                            data-placement="bottom"
                            @hasSection ('content_header_help_title')
                            data-title="@yield('content_header_help_title')"
                            @endif
                            data-content="@yield('content_header_help_content')"
                        >
                            <i class="fa-regular fa-circle-question"></i>
                        </span>

                        @endif
                    </div>
                    <div class="col-sm-7">
                        {{ Breadcrumbs::render() }}
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Main Content --}}
    <div class="content">
        <div class="{{ config('adminlte.classes_content') ?: $def_container_class }}">
            @stack('content')
            @yield('content')
        </div>
    </div>

</div>
