<li class="block-desc">{{ trans('menu::menu.menu') }}</li>
<li class="block-item {{ isActiveRoute('backend.menu.index') }}">
    <a href="{{ route('backend.menu.index') }}">
        {{ trans('crud::crud.administration_type', ['type' => 'Menus']) }}
    </a>
</li>