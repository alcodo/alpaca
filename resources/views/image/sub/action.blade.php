<div class="btn-group float-right">
    <a href="#" class="btn btn-info btn-sm" title="{{ trans('alpaca::alpaca.edit') }}"
       v-b-modal.modalcode{{ $image->id }}>
        <i class="fas fa-code" aria-hidden="true"></i>
    </a>

    @can('image.edit')
        <a href="#" class="btn btn-info btn-sm" title="{{ trans('alpaca::alpaca.edit') }}"
           v-b-modal.modalimageedit{{ $image->id }}>
            <i class="fas fa-edit" aria-hidden="true"></i>
        </a>
    @endcan

    @can('image.delete')
        <a href="#" class="btn btn-danger btn-sm" title="{{ trans('alpaca::alpaca.delete') }}"
           v-b-modal.modalimagedelete{{ $image->id }}>
            <i class="fas fa-trash" aria-hidden="true"></i>
        </a>
    @endcan
</div>

{{--html code--}}
<b-modal v-cloak id="modalcode{{ $image->id }}" title="{{ trans('alpaca::image.html') }}" hide-footer>

    <pre class="prettyprint lang-html">
{{ \Alpaca\Support\Image\ImageAsHtmlCode::render($image) }}
    </pre>

</b-modal>

{{--Edit Component--}}
@can('image.edit')
    <b-modal v-cloak id="modalimageedit{{ $image->id }}" title="{{ trans('alpaca::alpaca.edit') }}" hide-footer>

        <form method="POST" action="/backend/image/{{ $image->id }}" accept-charset="UTF-8"
              enctype="multipart/form-data">
            <input name="_method" type="hidden" value="PUT">
            @include('alpaca::image.sub.form', ['isCreate' => false])
        </form>

    </b-modal>
@endcan

{{--Delete Component--}}
@can('image.delete')
    <b-modal v-cloak id="modalimagedelete{{ $image->id }}" title="{{ trans('alpaca::alpaca.sure_delete') }}" hide-footer>

        <form method="POST" action="/backend/image/{{ $image->id }}" accept-charset="UTF-8" aria-label="Action">
            <input name="_method" type="hidden" value="DELETE">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger btn-block" title="{{ trans('alpaca::alpaca.delete') }}">
                <i class="fas fa-trash" aria-hidden="true"></i> {{ trans('alpaca::alpaca.delete') }}
            </button>
        </form>

    </b-modal>
@endcan