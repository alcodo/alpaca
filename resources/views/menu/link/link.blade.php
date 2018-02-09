<a title="{{ $link->title }}" href="{{ $link->href }}"
   @if(!empty($link->rel))
   rel="{{ $link->rel }}"
   @endif
   @if(!empty($link->target))
   target="{{ $link->target }}"
   @endif
   class="list-group-item list-group-item-action {{ $class or '' }} {{ isActiveUrlExact($link->href) }}">
    {{ $link->text }}
</a>