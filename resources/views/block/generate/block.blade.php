<div class="card mb-3 @if($block->menu) d-none d-sm-none d-md-block @endif"
     @if(isset($isWithBorder) && $isWithBorder) style="border: 1px solid silver" @endif>

    <div class="card-header">
        {{ $block->title }}
        @if(isset($isWithAction) && $isWithAction)
            @include('alpaca::block.sub.action')
        @endif
    </div>
    @if($block->menu)
        <div class="list-group list-group-flush">
            @foreach($block->menu->links as $link)

                @include('alpaca::menu.link.link', ['isBlockView' => true, 'link' => $link, 'class' => ''])

            @endforeach
        </div>
    @else
        <div class="card-body">
            {!! $block->html !!}
        </div>
    @endif
</div>