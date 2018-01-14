<b-modal id="modalcreateuser" title="{{ trans('alpaca::user.add_user') }}" hide-footer>

    <form method="POST" action="/backend/user" accept-charset="UTF-8" aria-label="Action">
        <input name="_method" type="hidden" value="POST">
        @include('alpaca::user.sub.form', ['isCreate' => true])
    </form>

</b-modal>