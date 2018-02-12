<b-modal v-cloak id="modalcreatelink{{ $menu->id }}" title="{{ trans('alpaca::menu.create_link') }}" hide-footer>

    <form method="POST" action="/backend/menu/{{ $menu->id }}/link" accept-charset="UTF-8" aria-label="Action">
        <input name="_method" type="hidden" value="POST">
        @include('alpaca::menu.link.form', ['link' => null])
    </form>

</b-modal>