<div class="block {{ $isMobileView ? 'visible-xs' : 'hidden-xs' }}">
    @if($block->title)
        <p class="block-title">{{ $block->title }}</p>
    @endif
    {!! $block->html !!}
</div>