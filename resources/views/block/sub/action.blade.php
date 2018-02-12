<div class="btn-group float-right">

    @can('block.edit')
        <a href="/backend/block/{{ $block->id }}/edit" class="btn btn-info" title="{{ trans('alpaca::alpaca.edit') }}">
            <i class="fas fa-edit" aria-hidden="true"></i>
        </a>
    @endcan

    @can('block.delete')
        <a href="#" class="btn btn-danger" title="{{ trans('alpaca::alpaca.delete') }}"
           v-b-modal.modalblock{{ $block->id }}>
            <i class="fas fa-trash" aria-hidden="true"></i>
        </a>
    @endcan
</div>

{{--Delete Component--}}
@can('block.delete')
    <b-modal v-cloak id="modalblock{{ $block->id }}" title="{{ trans('alpaca::alpaca.sure_delete') }}" hide-footer>

        <form method="POST" action="/backend/block/{{ $block->id }}" accept-charset="UTF-8" aria-label="Action">
            <input name="_method" type="hidden" value="DELETE">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger btn-block" title="{{ trans('alpaca::alpaca.delete') }}">
                <i class="fas fa-trash" aria-hidden="true"></i> {{ trans('alpaca::alpaca.delete') }}
            </button>
        </form>

    </b-modal>
@endcan