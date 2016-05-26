<li class="dropdown-header">{{ trans('block::block.block') }}</li>
<li>
    <a class="{{ isActiveRoute('backend.block.index') }}" href="{{ route('backend.block.index') }}">
        {{ trans('crud::crud.administration_type', ['type' => 'Blocks']) }}
    </a>
</li>