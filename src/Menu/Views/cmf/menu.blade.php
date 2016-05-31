<li class="dropdown-header">{{ trans('menu::menu.menu') }}</li>
<li>
    <a class="{{ isActiveRoute('backend.menu.index') }}" href="{{ route('backend.menu.index') }}">
        {{ trans('crud::crud.administration_type', ['type' => 'Menus']) }}
    </a>
</li>