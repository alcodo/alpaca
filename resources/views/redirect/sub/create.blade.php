<b-modal v-cloak id="modalcreateredirect" title="{{ trans('alpaca::redirect.create_redirect') }}" hide-footer>

    <form method="POST" action="/backend/redirect" accept-charset="UTF-8" aria-label="Action">
        <input name="_method" type="hidden" value="POST">
        @include('alpaca::redirect.sub.form')
    </form>

</b-modal>