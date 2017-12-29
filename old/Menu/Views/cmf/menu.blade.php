<li class="block-item {{ isActiveRoute('backend.menu.index') }}">
    <a href="{{ route('backend.menu.index') }}">
        {{ trans('crud::crud.administration_type', ['type' => trans('menu::menu.menus')]) }}
    </a>
</li>