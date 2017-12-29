<li class="block-item {{ isActiveRoute('backend.page.index') }}">
    <a href="{{ route('backend.page.index') }}">
        {{ trans('alpaca::alpaca.administration_type', ['type' => trans('alpaca::alpaca.pages')]) }}
    </a>
</li>
<li class="block-item {{ isActiveRoute('backend.topic.index') }}">
    <a href="{{ route('backend.topic.index') }}">
        {{ trans('alpaca::alpaca.administration_type', ['type' => trans('alpaca::topic.topics')]) }}
    </a>
</li>
<li class="block-item {{ isActiveRoute('backend.category.index') }}">
    <a href="{{ route('backend.category.index') }}">
        {{ trans('alpaca::alpaca.administration_type', ['type' => trans('alpaca::alpaca.categories')]) }}
    </a>
</li>