{{ csrf_field() }}

<div class="form-group">
    <label for="text">{{ trans('alpaca::menu.text') }}<span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="text" name="text"
           value="{{ old('title', isset($link) ? $link->text : '') }}" required>
</div>

<div class="form-group">
    <label for="href">{{ trans('alpaca::menu.href') }}<span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="href" name="href"
           value="{{ old('title', isset($link) ? $link->href : '') }}" required>
</div>

<div class="form-group">
    <label for="position">{{ trans('alpaca::menu.position') }}<span class="text-danger">*</span></label>
    <input type="number" class="form-control" id="position" name="position"
           value="{{ old('title', isset($link) ? $link->position : '') }}" required>
</div>

<div class="form-group">
    <label for="title">{{ trans('alpaca::alpaca.title') }}</label>
    <input type="text" class="form-control" id="title" name="title"
           value="{{ old('title', isset($link) ? $link->title : '') }}">
</div>

<div class="form-group">
    <label for="rel">{{ trans('alpaca::menu.rel') }}</label>
    <input type="text" class="form-control" id="rel" name="rel"
           value="{{ old('title', isset($link) ? $link->rel : '') }}">
</div>

<div class="form-group">
    <label for="target">{{ trans('alpaca::menu.target') }}</label>
    <input type="text" class="form-control" id="rel" name="target"
           value="{{ old('title', isset($link) ? $link->target : '') }}">
</div>

<button type="submit" class="btn btn-info btn-block">{{ trans('alpaca::alpaca.save') }}</button>