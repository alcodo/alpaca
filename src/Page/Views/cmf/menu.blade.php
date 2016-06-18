<li class="dropdown-header">{{ trans('page::page.page') }}</li>
<li>
    <a class="{{ isActiveRoute('backend.page.index') }}" href="{{ route('backend.page.index') }}">
        {{ trans('crud::crud.administration_type', ['type' => 'Pages']) }}
    </a>
</li>
<li>
    <a class="{{ isActiveRoute('backend.topic.index') }}" href="{{ route('backend.topic.index') }}">
        {{ trans('crud::crud.administration_type', ['type' => 'Topics']) }}
    </a>
</li>
<li>
    <a class="{{ isActiveRoute('backend.category.index') }}" href="{{ route('backend.category.index') }}">
        {{ trans('crud::crud.administration_type', ['type' => 'Categories']) }}
    </a>
</li>