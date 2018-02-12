<div class="btn-group float-right">
    @can('menu.edit_link')
        <a href="#" class="btn btn-info btn-sm" title="{{ trans('alpaca::alpaca.edit') }}"
           v-b-modal.modalmenulinkedit{{ $menu->id }}{{ $link->id }}>
            <i class="fas fa-edit" aria-hidden="true"></i>
        </a>
    @endcan

    @can('menu.delete_link')
        <a href="#" class="btn btn-danger btn-sm" title="{{ trans('alpaca::alpaca.delete') }}"
           v-b-modal.modalmenulinkdelete{{ $menu->id }}{{ $link->id }}>
            <i class="fas fa-trash" aria-hidden="true"></i>
        </a>
    @endcan
</div>


{{--Edit Component--}}
@can('menu.edit_link')
    <b-modal v-cloak id="modalmenulinkedit{{ $menu->id }}{{ $link->id }}" title="{{ trans('alpaca::alpaca.edit') }}"
             hide-footer>

        <form method="POST" action="/backend/menu/{{ $menu->id }}/link/{{ $link->id }}" accept-charset="UTF-8">
            <input name="_method" type="hidden" value="PUT">
            @include('alpaca::menu.link.form')
        </form>

    </b-modal>
@endcan


{{--Delete Component--}}
@can('menu.delete_link')
    <b-modal v-cloak id="modalmenulinkdelete{{ $menu->id }}{{ $link->id }}" title="{{ trans('alpaca::alpaca.sure_delete') }}"
             hide-footer>

        <form method="POST" action="/backend/menu/{{ $menu->id }}/link/{{ $link->id }}" accept-charset="UTF-8"
              aria-label="Action">
            <input name="_method" type="hidden" value="DELETE">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger btn-block" title="{{ trans('alpaca::alpaca.delete') }}">
                <i class="fas fa-trash" aria-hidden="true"></i> {{ trans('alpaca::alpaca.delete') }}
            </button>
        </form>

    </b-modal>
@endcan