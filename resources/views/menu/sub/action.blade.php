<div class="btn-group float-right">
    @can('menu.edit')
        <a href="#" class="btn btn-info" title="{{ trans('alpaca::alpaca.edit') }}"
           v-b-modal.modalmenuedit{{ $menu->id }}>
            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
        </a>
    @endcan

    @can('menu.delete')
        <a href="#" class="btn btn-danger" title="{{ trans('alpaca::alpaca.delete') }}"
           v-b-modal.modalmenudelete{{ $menu->id }}>
            <i class="fa fa-trash" aria-hidden="true"></i>
        </a>
    @endcan
</div>


{{--Edit Component--}}
@can('menu.edit')
    <b-modal id="modalmenuedit{{ $menu->id }}" title="{{ trans('alpaca::alpaca.edit') }}" hide-footer>

        <form method="POST" action="/backend/menu/{{ $menu->id }}" accept-charset="UTF-8">
            <input name="_method" type="hidden" value="PUT">
            @include('alpaca::menu.sub.form')
        </form>

    </b-modal>
@endcan

{{--Delete Component--}}
@can('menu.delete')
    <b-modal id="modalmenudelete{{ $menu->id }}" title="{{ trans('alpaca::alpaca.sure_delete') }}" hide-footer>

        <form method="POST" action="/backend/menu/{{ $menu->id }}" accept-charset="UTF-8" aria-label="Action">
            <input name="_method" type="hidden" value="DELETE">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger btn-block" title="{{ trans('alpaca::alpaca.delete') }}">
                <i class="fa fa-trash" aria-hidden="true"></i> {{ trans('alpaca::alpaca.delete') }}
            </button>
        </form>

    </b-modal>
@endcan