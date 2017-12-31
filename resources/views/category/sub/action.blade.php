<form method="POST" action="/backend/category/{{ $category->id }}" accept-charset="UTF-8"
      class="btn-group" aria-label="Action">
    @if($isIndex)
        <a href="/backend/category" class="btn btn-default" title="{{ trans('alpaca::alpaca.index') }}">
            <i class="fa fa-list" aria-hidden="true"></i>
        </a>
    @endif
    @if($isShow)
        <a href="{{ $category->path }}" class="btn btn-default" title="{{ trans('alpaca::alpaca.show') }}">
            <i class="fa fa-external-link" aria-hidden="true"></i>
        </a>
    @endif
    <a href="/backend/category/{{ $category->id }}/edit" class="btn btn-info"
       title="{{ trans('alpaca::alpaca.edit') }}">
        <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
    </a>
    <input name="_method" type="hidden" value="DELETE">
    {{ csrf_field() }}
    <button class="btn btn-danger" title="{{ trans('alpaca::alpaca.delete') }}"
            style="cursor: pointer;">
        <i class="fa fa-trash" aria-hidden="true"></i>
    </button>
</form>