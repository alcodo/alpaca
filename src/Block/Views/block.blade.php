@if($block->title)
    <p class="block-title">{{ $block->title }}</p>
@endif
{!! $block->html !!}