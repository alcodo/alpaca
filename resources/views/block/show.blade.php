<div class="card" @if(isset($isWithBorder) && $isWithBorder) style="border: 1px solid silver" @endif>

    <div class="card-header">
        {{ $block->title }}
        @if(isset($isWithAction) && $isWithAction)
            @include('alpaca::block.sub.action')
        @endif
    </div>
    @if($block->menu)
        <ul class="list-group list-group-flush">
            @foreach($block->menu->links as $link)

                <div class="list-group-item">
                    @include('alpaca::menu.link.link', ['link' => $link, 'class' => ''])
                </div>

            @endforeach
        </ul>
    @else
        <div class="card-body">
            {!! $block->html !!}
        </div>
    @endif
</div>