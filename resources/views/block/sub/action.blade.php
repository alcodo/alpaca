<div class="btn-group float-right">
    <a href="/backend/block/{{ $block->id }}/edit" class="btn btn-info" title="{{ trans('alpaca::alpaca.edit') }}">
        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
    </a>

    <a href="#" class="btn btn-danger" title="{{ trans('alpaca::alpaca.delete') }}" v-b-modal.modalblock{{ $block->id }}>
        <i class="fa fa-trash" aria-hidden="true"></i>
    </a>
</div>

{{--Delete Component--}}
<b-modal id="modalblock{{ $block->id }}" title="{{ trans('alpaca::alpaca.sure_delete') }}" hide-footer>

    <form method="POST" action="/backend/block/{{ $block->id }}" accept-charset="UTF-8" aria-label="Action">
        <input name="_method" type="hidden" value="DELETE">
        {{ csrf_field() }}
        <button type="submit" class="btn btn-danger btn-block" title="{{ trans('alpaca::alpaca.delete') }}">
            <i class="fa fa-trash" aria-hidden="true"></i> {{ trans('alpaca::alpaca.delete') }}
        </button>
    </form>

</b-modal>