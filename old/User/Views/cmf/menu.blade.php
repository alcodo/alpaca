<li class="block-item {{ isActiveRoute('backend.user.index') }}">
    <a href="{{ route('backend.user.index') }}">
        {{ trans('crud::crud.administration_type', ['type' => trans('user::user.users')]) }}
    </a>
</li>
<li class="block-item {{ isActiveRoute('role.index') }}">
    <a href="{{ route('backend.role.index') }}">
        {{ trans('crud::crud.administration_type', ['type' => trans('user::role.roles')]) }}
    </a>
</li>
<li class="block-item {{ isActiveRoute('backend.permission.index') }}">
    <a href="{{ route('backend.permission.index') }}">
        {{ trans('crud::crud.administration_type', ['type' => trans('user::permission.permissions')]) }}
    </a>
</li>