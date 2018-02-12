<div class="btn-group">
    @if($isIndex)
        @can('category.administer')
            <a href="/backend/category" class="btn btn-default" title="{{ trans('alpaca::alpaca.index') }}">
                <i class="fas fa-list" aria-hidden="true"></i>
            </a>
        @endcan
    @endif
    @if($isShow)
        <a href="{{ $category->path }}" class="btn btn-default" title="{{ trans('alpaca::alpaca.show') }}">
            <i class="fas fa-eye" aria-hidden="true"></i>
        </a>
    @endif
    @can('category.edit')
        <a href="/backend/category/{{ $category->id }}/edit" class="btn btn-info"
           title="{{ trans('alpaca::alpaca.edit') }}">
            <i class="fas fa-edit" aria-hidden="true"></i>
        </a>
    @endcan


    @can('category.delete')
        <a href="#" class="btn btn-danger" title="{{ trans('alpaca::alpaca.delete') }}"
           v-b-modal.modalcategory{{ $category->id }}>
            <i class="fas fa-trash" aria-hidden="true"></i>
        </a>
    @endcan
</div>

{{--Delete Component--}}
@can('category.delete')
    <b-modal id="modalcategory{{ $category->id }}" title="{{ trans('alpaca::alpaca.sure_delete') }}" hide-footer>

        <form method="POST" action="/backend/category/{{ $category->id }}" accept-charset="UTF-8" aria-label="Action">
            <input name="_method" type="hidden" value="DELETE">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger btn-block" title="{{ trans('alpaca::alpaca.delete') }}">
                <i class="fas fa-trash" aria-hidden="true"></i> {{ trans('alpaca::alpaca.delete') }}
            </button>
        </form>

    </b-modal>
@endcan