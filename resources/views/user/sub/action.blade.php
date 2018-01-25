<div class="btn-group float-right">
    <a href="#" class="btn btn-info" title="{{ trans('alpaca::alpaca.edit') }}"
       v-b-modal.modaluseredit{{ $user->id }}>
        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
    </a>

    <a href="#" class="btn btn-danger" title="{{ trans('alpaca::alpaca.delete') }}"
       v-b-modal.modaluserdelete{{ $user->id }}>
        <i class="fa fa-trash" aria-hidden="true"></i>
    </a>
</div>


{{--Edit Component--}}
<b-modal id="modaluseredit{{ $user->id }}" title="{{ trans('alpaca::alpaca.edit') }}" hide-footer>

    <form method="POST" action="/backend/user/{{ $user->id }}" accept-charset="UTF-8">
        <input name="_method" type="hidden" value="PUT">
        @include('alpaca::user.sub.form', ['isCreate' => false])
    </form>

</b-modal>

{{--Delete Component--}}
<b-modal id="modaluserdelete{{ $user->id }}" title="{{ trans('alpaca::alpaca.sure_delete') }}" hide-footer>

    <form method="POST" action="/backend/user/{{ $user->id }}" accept-charset="UTF-8" aria-label="Action">
        <input name="_method" type="hidden" value="DELETE">
        {{ csrf_field() }}
        <button type="submit" class="btn btn-danger btn-block" title="{{ trans('alpaca::alpaca.delete') }}">
            <i class="fa fa-trash" aria-hidden="true"></i> {{ trans('alpaca::alpaca.delete') }}
        </button>
    </form>

</b-modal>