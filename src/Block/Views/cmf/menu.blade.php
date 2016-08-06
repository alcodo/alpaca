<li class="block-desc">{{ trans('block::block.block') }}</li>
<li class="block-item {{ isActiveRoute('backend.block.index') }}">
    <a href="{{ route('backend.block.index') }}">
        {{ trans('crud::crud.administration_type', ['type' => 'Blocks']) }}
    </a>
</li>