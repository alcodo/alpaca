<b-modal id="modalcreaterole" title="{{ trans('alpaca::user.add_role') }}" hide-footer>

    <form method="POST" action="/backend/role" accept-charset="UTF-8" aria-label="Action">
        <input name="_method" type="hidden" value="POST">
        @include('alpaca::role.sub.form')
    </form>

</b-modal>