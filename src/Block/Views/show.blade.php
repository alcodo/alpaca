@if($isMobile)
    <div class="block {{ $isMobileMenu ? 'visible-sm visible-xs' : 'hidden-sm hidden-xs' }}">
        @include('block::block')
    </div>
@else
    <div class="block">
        @include('block::block')
    </div>
@endif