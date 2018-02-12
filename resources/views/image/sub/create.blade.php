<b-modal v-cloak id="modalcreateimage" title="{{ trans('alpaca::image.add_image') }}" hide-footer>

    <form method="POST" action="/backend/image" accept-charset="UTF-8" aria-label="Action" enctype="multipart/form-data">
        <input name="_method" type="hidden" value="POST">
        @include('alpaca::image.sub.form', ['isCreate' => true])
    </form>

</b-modal>