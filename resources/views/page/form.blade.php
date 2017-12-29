{{ csrf_field() }}

{{--id for update?--}}

<div class="form-group">
    <label for="title">{{ trans('crud::crud.title') }}</label>
    <input type="text" class="form-control" id="title">
</div>

<div class="form-group">
    <label for="category">{{ trans('page::category.category') }}</label>
    <select id="category" class="form-control">
        @foreach($categories as $value => $text)
            <option value="{{ $value }}">{{ $text }}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <label for="path">{{ trans('crud::crud.path') }}</label>
    <input type="text" class="form-control" id="path">
    <small id="pathHelp" class="form-text text-muted">Example: /car/cabrio/bmw</small>
</div>

{{--tab for body and seo--}}
<b-tabs>
    <b-tab title="{{ trans('crud::crud.body') }}" active>

        <br>
        <div class="form-group">
            {{--<label for="content">{{ trans('crud::crud.body') }}</label>--}}
            <textarea class="form-control" id="content" rows="15"></textarea>
        </div>

    </b-tab>
    <b-tab title="SEO" >

        <div class="form-group">
            <label for="html_title">{{ trans('page::page.html_title') }}</label>
            <input type="text" class="form-control" id="html_title">
        </div>
        <div class="form-group">
            <label for="meta_description">{{ trans('page::page.meta_description') }}</label>
            <input type="text" class="form-control" id="meta_description">
        </div>
        <div class="form-group">
            <label for="meta_robots">{{ trans('page::page.meta_robots') }}</label>
            <input type="text" class="form-control" id="meta_robots">
        </div>

    </b-tab>
</b-tabs>

<div class="form-check">
    <label class="form-check-label">
        <input type="checkbox" class="form-check-input" checked>
        {{ trans('page::page.active') }}
    </label>
</div>

<button type="submit" class="btn btn-primary float-right">{{ trans('crud::crud.save') }}</button>
