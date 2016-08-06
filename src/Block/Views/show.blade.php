@if($isMobile)
    <div class="block {{ $isMobileView ? 'visible-xs' : 'hidden-xs' }}">
        @include('block::block')
    </div>
@else
    <div class="block">
        @include('block::block')
    </div>
@endif