<div class="btn-group float-right">
    @can('redirect.edit')
        <a href="#" class="btn btn-info" title="{{ trans('alpaca::alpaca.edit') }}"
           v-b-modal.edit{{ $redirect->id }}>
            <i class="fas fa-edit" aria-hidden="true"></i>
        </a>
    @endcan

    @can('redirect.delete')
        <a href="#" class="btn btn-danger" title="{{ trans('alpaca::alpaca.delete') }}"
           v-b-modal.delete{{ $redirect->id }}>
            <i class="fas fa-trash" aria-hidden="true"></i>
        </a>
    @endcan
</div>


{{--Edit Component--}}
@can('redirect.edit')
    <b-modal v-cloak id="edit{{ $redirect->id }}" title="{{ trans('alpaca::alpaca.edit') }}" hide-footer>

        <form method="POST" action="/backend/redirect/{{ $redirect->id }}" accept-charset="UTF-8">
            <input name="_method" type="hidden" value="PUT">
            @include('alpaca::redirect.sub.form')
        </form>

    </b-modal>
@endcan

{{--Delete Component--}}
@can('redirect.delete')
    <b-modal v-cloak id="delete{{ $redirect->id }}" title="{{ trans('alpaca::alpaca.sure_delete') }}" hide-footer>

        <form method="POST" action="/backend/redirect/{{ $redirect->id }}" accept-charset="UTF-8" aria-label="Action">
            <input name="_method" type="hidden" value="DELETE">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger btn-block" title="{{ trans('alpaca::alpaca.delete') }}">
                <i class="fas fa-trash" aria-hidden="true"></i> {{ trans('alpaca::alpaca.delete') }}
            </button>
        </form>

    </b-modal>
@endcan