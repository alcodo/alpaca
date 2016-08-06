<ul class="block">
    @if(view()->exists('page::cmf.menu'))
        @include('page::cmf.menu')
    @endif
    @if(view()->exists('gallery::cmf.menu'))
        <li role="separator" class="divider"></li>
        @include('gallery::cmf.menu')
    @endif
    @if(view()->exists('user::cmf.menu'))
        <li role="separator" class="divider"></li>
        @include('user::cmf.menu')
    @endif
    @if(view()->exists('video::cmf.menu'))
        <li role="separator" class="divider"></li>
        @include('video::cmf.menu')
    @endif
    @if(view()->exists('block::cmf.menu'))
        <li role="separator" class="divider"></li>
        @include('block::cmf.menu')
    @endif
    @if(view()->exists('menu::cmf.menu'))
        <li role="separator" class="divider"></li>
        @include('menu::cmf.menu')
    @endif
    @if(view()->exists('forum::cmf.menu'))
        <li role="separator" class="divider"></li>
        @include('forum::cmf.menu')
    @endif
</ul>