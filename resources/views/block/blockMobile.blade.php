<div class="blockmobile">
    @if($block->title)
        <p class="blockmobile-title">{{ $block->title }}</p>
    @endif
    {!! $block->html !!}
</div>