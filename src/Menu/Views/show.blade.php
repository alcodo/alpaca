@if($isMobile)
    <div class="block {{ $isMobileView ? 'visible-sm visible-xs' : 'hidden-sm hidden-xs' }}">
        @include('menu::menu')
    </div>
@else
    <div class="block">
        @include('menu::menu')
    </div>
@endif