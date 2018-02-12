<div class="btn-group float-right">
    @can('role.edit')
        <a href="#" class="btn btn-info" title="{{ trans('alpaca::alpaca.edit') }}"
           v-b-modal.modalroleedit{{ $role->id }}>
            <i class="fas fa-edit" aria-hidden="true"></i>
        </a>
    @endcan

    @can('role.delete')
        <a href="#" class="btn btn-danger" title="{{ trans('alpaca::alpaca.delete') }}"
           v-b-modal.modalroledelete{{ $role->id }}>
            <i class="fas fa-trash" aria-hidden="true"></i>
        </a>
    @endcan
</div>


{{--Edit Component--}}
@can('role.edit')
    <b-modal v-cloak id="modalroleedit{{ $role->id }}" title="{{ trans('alpaca::alpaca.edit') }}" hide-footer>

        <form method="POST" action="/backend/role/{{ $role->id }}" accept-charset="UTF-8">
            <input name="_method" type="hidden" value="PUT">
            @include('alpaca::role.sub.form')
        </form>

    </b-modal>
@endcan

{{--Delete Component--}}
@can('role.delete')
    <b-modal v-cloak id="modalroledelete{{ $role->id }}" title="{{ trans('alpaca::alpaca.sure_delete') }}" hide-footer>

        <form method="POST" action="/backend/role/{{ $role->id }}" accept-charset="UTF-8" aria-label="Action">
            <input name="_method" type="hidden" value="DELETE">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger btn-block" title="{{ trans('alpaca::alpaca.delete') }}">
                <i class="fas fa-trash" aria-hidden="true"></i> {{ trans('alpaca::alpaca.delete') }}
            </button>
        </form>

    </b-modal>
@endcan