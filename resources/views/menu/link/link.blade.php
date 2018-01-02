<a title="{{ $link->title }}" href="{{ $link->href }}"
   @if(!empty($link->rel))
   rel="{{ $link->rel }}"
   @endif
   @if(!empty($link->target))
   rel="{{ $link->target }}"
   @endif
   class="list-group-item">
    {{ $link->text }}
</a>