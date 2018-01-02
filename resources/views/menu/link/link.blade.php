<a title="{{ $link->title }}" href="{{ $link->href }}"
   @if(!empty($link->rel))
   rel="{{ $link->rel }}"
   @endif
   @if(!empty($link->target))
   target="{{ $link->target }}"
   @endif
   class="{{ $class or '' }}">
    {{ $link->text }}
</a>