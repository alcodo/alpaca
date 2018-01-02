{{ csrf_field() }}

<input type="hidden" name="user_id" value="{{ optional(Auth::user())->id }}">

<div class="form-group">
    <label for="title">{{ trans('alpaca::alpaca.title') }}<span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="title" name="title"
           value="{{ old('title', isset($page) ? $page->title : '') }}" required>
</div>

<div class="form-group">
    <label for="category">{{ trans('alpaca::category.category') }}</label>
    <select id="category" class="form-control" name="category_id">
        @foreach($categories as $key => $value)
            <option value="{{ $key }}"
                    @if ($key == old('category_id', isset($page) ? $page->category_id : ''))
                    selected="selected"
                    @endif
            >{{ $value }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="path">{{ trans('alpaca::alpaca.path') }}</label>
    <input type="text" class="form-control" id="path" name="path"
           value="{{ old('path', isset($page) ? $page->path : '') }}">
    <small id="pathHelp" class="form-text text-muted">{{ trans('alpaca::alpaca.path_example') }}</small>
</div>

{{--tab for body and seo--}}
<b-tabs>
    <b-tab title="{{ trans('alpaca::alpaca.content') }}" active>

        <div class="form-group">
            <span class="text-danger">*</span><textarea class="form-control" id="content" rows="15" name="content" required>
                {{ old('content', isset($page) ? $page->content : '') }}
            </textarea>
        </div>

    </b-tab>
    <b-tab title="SEO">

        <br>
        <div class="form-group">
            <label for="html_title">{{ trans('alpaca::page.html_title') }}</label>
            <input type="text" class="form-control" id="html_title" name="html_title"
                   value="{{ old('html_title', isset($page) ? $page->html_title : '') }}">
        </div>
        <div class="form-group">
            <label for="meta_description">{{ trans('alpaca::page.meta_description') }}</label>
            <input type="text" class="form-control" id="meta_description" name="meta_description"
                   value="{{ old('meta_description', isset($page) ? $page->meta_description : '') }}">
        </div>
        <div class="form-group">
            <label for="meta_robots">{{ trans('alpaca::page.meta_robots') }}</label>
            <input type="text" class="form-control" id="meta_robots" name="meta_robots"
                   value="{{ old('meta_robots', isset($page) ? $page->meta_robots : '') }}">
        </div>

    </b-tab>
</b-tabs>

<div class="form-check">
    <label class="form-check-label">
        <input type="hidden" name="active" value="0">
        <input type="checkbox" class="form-check-input" name="active" value="1" placeholder="Example: noindex, nofollow"
               @if(old('active', isset($page) ? $page->active : true) == true) checked @endif>
        {{ trans('alpaca::alpaca.active') }}
    </label>
</div>

<button type="submit" class="btn btn-primary float-right">{{ trans('alpaca::alpaca.save') }}</button>
