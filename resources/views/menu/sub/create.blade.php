<b-modal id="modalcreatemenu" title="{{ trans('alpaca::menu.create_menu') }}" hide-footer>

    <form method="POST" action="/backend/menu" accept-charset="UTF-8" aria-label="Action">
        <input name="_method" type="hidden" value="POST">
        @include('alpaca::menu.sub.form')
    </form>

</b-modal>