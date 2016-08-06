@if($isMobile)
    <div class="block {{ $isMobileView ? 'visible-xs' : 'hidden-xs' }}">
        @include('menu::menu')
    </div>
@else
    <div class="block">
        @include('menu::menu')
    </div>
@endif