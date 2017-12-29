{{ csrf_field() }}

<input type="hidden" name="user_id" value="{{ optional(Auth::user())->id }}">
{{--id for update?--}}

<div class="form-group">
    <label for="title">{{ trans('alpaca::alpaca.title') }}</label>
    <input type="text" class="form-control" id="title" name="title">
</div>

<div class="form-group">
    <label for="category">{{ trans('alpaca::category.category') }}</label>
    <select id="category" class="form-control" name="category_id">
        @foreach($categories as $value => $text)
            <option value="{{ $value }}">{{ $text }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="path">{{ trans('alpaca::alpaca.path') }}</label>
    <input type="text" class="form-control" id="path" name="path">
    <small id="pathHelp" class="form-text text-muted">Example: /car/cabrio/bmw</small>
</div>

{{--tab for body and seo--}}
<b-tabs>
    <b-tab title="{{ trans('alpaca::alpaca.body') }}" active>

        <br>
        <div class="form-group">
            {{--<label for="content">{{ trans('alpaca::alpaca.body') }}</label>--}}
            <textarea class="form-control" id="content" rows="15" name="content"></textarea>
        </div>

    </b-tab>
    <b-tab title="SEO">

        <div class="form-group">
            <label for="html_title">{{ trans('alpaca::alpaca.html_title') }}</label>
            <input type="text" class="form-control" id="html_title" name="html_title">
        </div>
        <div class="form-group">
            <label for="meta_description">{{ trans('alpaca::alpaca.meta_description') }}</label>
            <input type="text" class="form-control" id="meta_description" name="meta_description">
        </div>
        <div class="form-group">
            <label for="meta_robots">{{ trans('alpaca::alpaca.meta_robots') }}</label>
            <input type="text" class="form-control" id="meta_robots" name="meta_robots">
        </div>

    </b-tab>
</b-tabs>

<div class="form-check">
    <label class="form-check-label">
        <input type="checkbox" class="form-check-input" name="active" value="1" checked>
        {{ trans('alpaca::alpaca.active') }}
    </label>
</div>

<button type="submit" class="btn btn-primary float-right">{{ trans('alpaca::alpaca.save') }}</button>
