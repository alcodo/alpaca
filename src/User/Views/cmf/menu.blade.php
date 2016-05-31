<li class="dropdown-header">{{ trans('user::user.user') }}</li>
<li>
    <a class="{{ isActiveRoute('backend.user.index') }}" href="{{ route('backend.user.index') }}">
        {{ trans('crud::crud.administration_type', ['type' => 'Users']) }}
    </a>
</li>
<li>
    <a class="{{ isActiveRoute('role.index') }}" href="{{ route('backend.role.index') }}">
        {{ trans('crud::crud.administration_type', ['type' => 'Roles']) }}
    </a>
</li>
<li>
    <a class="{{ isActiveRoute('backend.permission.index') }}" href="{{ route('backend.permission.index') }}">
        {{ trans('crud::crud.administration_type', ['type' => 'Permissions']) }}
    </a>
</li>