<li class="block-item {{ isActiveRoute('backend.gallery.index') }}">
    <a href="{{ route('backend.gallery.index') }}">
        {{ trans('crud::crud.administration_type', ['type' => trans('gallery::gallery.gallery')]) }}
    </a>
</li>