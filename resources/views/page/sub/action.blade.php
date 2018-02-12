<div class="btn-group">
    @if($isIndex)
        @can('page.administer')
            <a href="/backend/page" class="btn btn-default" title="{{ trans('alpaca::alpaca.index') }}">
                <i class="fas fa-list" aria-hidden="true"></i>
            </a>
        @endcan
    @endif
    @if($isShow)
        <a href="{{ $page->path }}" class="btn btn-default" title="{{ trans('alpaca::alpaca.show') }}">
            <i class="fas fa-eye" aria-hidden="true"></i>
        </a>
    @endif
    @can('page.edit')
        <a href="/backend/page/{{ $page->id }}/edit" class="btn btn-info" title="{{ trans('alpaca::alpaca.edit') }}">
            <i class="fas fa-edit" aria-hidden="true"></i>
        </a>
    @endcan

    @can('page.delete')
        <a href="#" class="btn btn-danger" title="{{ trans('alpaca::alpaca.delete') }}"
           v-b-modal.modalpage{{ $page->id }}>
            <i class="fas fa-trash" aria-hidden="true"></i>
        </a>
    @endcan
</div>

{{--Delete Component--}}
@can('page.delete')
    <b-modal v-cloak id="modalpage{{ $page->id }}" title="{{ trans('alpaca::alpaca.sure_delete') }}" hide-footer>

        <form method="POST" action="/backend/page/{{ $page->id }}" accept-charset="UTF-8" aria-label="Action">
            <input name="_method" type="hidden" value="DELETE">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger btn-block" title="{{ trans('alpaca::alpaca.delete') }}">
                <i class="fas fa-trash" aria-hidden="true"></i> {{ trans('alpaca::alpaca.delete') }}
            </button>
        </form>

    </b-modal>
@endcan