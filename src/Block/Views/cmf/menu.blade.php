<li class="block-item {{ isActiveRoute('backend.block.index') }}">
    <a href="{{ route('backend.block.index') }}">
        {{ trans('crud::crud.administration_type', ['type' => trans('block::block.blocks')]) }}
    </a>
</li>