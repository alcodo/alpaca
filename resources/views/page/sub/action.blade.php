<div class="btn-group">
    @if($isIndex)
        <a href="/backend/page" class="btn btn-default" title="{{ trans('alpaca::alpaca.index') }}">
            <i class="fa fa-list" aria-hidden="true"></i>
        </a>
    @endif
    @if($isShow)
        <a href="{{ $page->path }}" class="btn btn-default" title="{{ trans('alpaca::alpaca.show') }}">
            <i class="fa fa-external-link" aria-hidden="true"></i>
        </a>
    @endif
    <a href="/backend/page/{{ $page->id }}/edit" class="btn btn-info" title="{{ trans('alpaca::alpaca.edit') }}">
        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
    </a>

    <a href="#" class="btn btn-danger" title="{{ trans('alpaca::alpaca.delete') }}" v-b-modal.modalpage{{ $page->id }}>
        <i class="fa fa-trash" aria-hidden="true"></i>
    </a>
</div>

{{--Delete Component--}}
<b-modal id="modalpage{{ $page->id }}" title="{{ trans('alpaca::alpaca.sure_delete') }}" hide-footer>

    <form method="POST" action="/backend/page/{{ $page->id }}" accept-charset="UTF-8" aria-label="Action">
        <input name="_method" type="hidden" value="DELETE">
        {{ csrf_field() }}
        <button type="submit" class="btn btn-danger btn-block" title="{{ trans('alpaca::alpaca.delete') }}">
            <i class="fa fa-trash" aria-hidden="true"></i> {{ trans('alpaca::alpaca.delete') }}
        </button>
    </form>

</b-modal>