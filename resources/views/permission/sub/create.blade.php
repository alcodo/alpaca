<b-modal id="modalcreatepermission" title="{{ trans('alpaca::user.add_permission') }}" hide-footer>

    <form method="POST" action="/backend/permission" accept-charset="UTF-8" aria-label="Action">
        <input name="_method" type="hidden" value="POST">
        @include('alpaca::permission.sub.form')
    </form>

</b-modal>