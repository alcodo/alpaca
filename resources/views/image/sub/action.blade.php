<div class="btn-group float-right">
    <a href="#" class="btn btn-info" title="{{ trans('alpaca::alpaca.edit') }}"
       v-b-modal.modalcode{{ $image->id }}>
        <i class="fa fa-code" aria-hidden="true"></i>
    </a>
    <a href="#" class="btn btn-info" title="{{ trans('alpaca::alpaca.edit') }}"
       v-b-modal.modalimageedit{{ $image->id }}>
        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
    </a>

    <a href="#" class="btn btn-danger" title="{{ trans('alpaca::alpaca.delete') }}"
       v-b-modal.modalimagedelete{{ $image->id }}>
        <i class="fa fa-trash" aria-hidden="true"></i>
    </a>
</div>

{{--html code--}}
<b-modal id="modalcode{{ $image->id }}" title="{{ trans('alpaca::image.html') }}" hide-footer>

    <pre class="prettyprint lang-html">
{{ \Alpaca\Support\Image\ImageAsHtmlCode::render($image) }}
    </pre>

</b-modal>

{{--Edit Component--}}
<b-modal id="modalimageedit{{ $image->id }}" title="{{ trans('alpaca::alpaca.sure_delete') }}" hide-footer>

    <form method="POST" action="/backend/image/{{ $image->id }}" accept-charset="UTF-8">
        <input name="_method" type="hidden" value="PUT">
        @include('alpaca::image.sub.form', ['isCreate' => false])
    </form>

</b-modal>

{{--Delete Component--}}
<b-modal id="modalimagedelete{{ $image->id }}" title="{{ trans('alpaca::alpaca.sure_delete') }}" hide-footer>

    <form method="POST" action="/backend/image/{{ $image->id }}" accept-charset="UTF-8" aria-label="Action">
        <input name="_method" type="hidden" value="DELETE">
        {{ csrf_field() }}
        <button type="submit" class="btn btn-danger btn-block" title="{{ trans('alpaca::alpaca.delete') }}">
            <i class="fa fa-trash" aria-hidden="true"></i> {{ trans('alpaca::alpaca.delete') }}
        </button>
    </form>

</b-modal>