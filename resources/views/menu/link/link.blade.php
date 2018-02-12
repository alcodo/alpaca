<a title="{{ $link->title }}" href="{{ $link->href }}"
   @if(!empty($link->rel))
   rel="{{ $link->rel }}"
   @endif
   @if(!empty($link->target))
   target="{{ $link->target }}"
   @endif
   class="@if($isBlockView) list-group-item list-group-item-action @endif {{ $class or '' }} {{ isActiveUrlExact($link->href) }}">
    {{ $link->text }}
</a>