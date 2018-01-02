{{ csrf_field() }}

<input type="hidden" name="user_id" value="{{ optional(Auth::user())->id }}">

<div class="form-group">
    <label for="title">{{ trans('alpaca::alpaca.title') }}<span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="title" name="title"
           value="{{ old('title', isset($category) ? $category->title : '') }}" required>
</div>

<div class="form-group">
    <label for="path">{{ trans('alpaca::alpaca.path') }}</label>
    <input type="text" class="form-control" id="path" name="path"
           value="{{ old('path', isset($category) ? $category->path : '') }}">
    <small id="pathHelp" class="form-text text-muted">{{ trans('alpaca::alpaca.path_example') }}</small>
</div>

<div class="form-group">
    <label for="content">{{ trans('alpaca::alpaca.content') }}<span class="text-danger">*</span></label>
    <textarea class="form-control" id="content" rows="15" name="content" required>
                {{ old('content', isset($category) ? $category->content : '') }}
            </textarea>
</div>

<div class="form-check">
    <label class="form-check-label">
        <input type="hidden" name="active" value="0">
        <input type="checkbox" class="form-check-input" name="active" value="1"
               @if(old('active', isset($category) ? $category->active : true) == true) checked @endif>
        {{ trans('alpaca::alpaca.active') }}
    </label>
</div>

<button type="submit" class="btn btn-primary float-right">{{ trans('alpaca::alpaca.save') }}</button>
