<li class="block-desc">{{ trans('page::page.page') }}</li>
<li class="block-item {{ isActiveRoute('backend.page.index') }}">
    <a href="{{ route('backend.page.index') }}">
        {{ trans('crud::crud.administration_type', ['type' => 'Pages']) }}
    </a>
</li>
<li class="block-item {{ isActiveRoute('backend.topic.index') }}">
    <a href="{{ route('backend.topic.index') }}">
        {{ trans('crud::crud.administration_type', ['type' => 'Topics']) }}
    </a>
</li>
<li class="block-item {{ isActiveRoute('backend.category.index') }}">
    <a href="{{ route('backend.category.index') }}">
        {{ trans('crud::crud.administration_type', ['type' => 'Categories']) }}
    </a>
</li>