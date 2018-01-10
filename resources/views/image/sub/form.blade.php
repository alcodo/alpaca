{{ csrf_field() }}

@if($isCreate)

    <div class="form-group">
        <label for="file">{{ trans('alpaca::alpaca.file') }}<span class="text-danger">*</span></label>
        <input type="file" class="form-control-file" id="file" name="file" required>
    </div>

@else

    <div class="form-group">
        <label for="file">{{ trans('alpaca::alpaca.file') }}</label>
        <input type="file" class="form-control-file" id="file" name="file">
    </div>

@endif

<div class="form-group">
    <label for="title">{{ trans('alpaca::alpaca.title') }}</label>
    <input type="text" class="form-control" id="title" name="title"
           value="{{ old('title', isset($image) ? $image->title : '') }}">
</div>

<div class="form-group">
    <label for="alt">{{ trans('alpaca::alpaca.alt') }}</label>
    <input type="text" class="form-control" id="alt" name="alt"
           value="{{ old('alt', isset($image) ? $image->alt : '') }}">
</div>

<b-tabs>
    <b-tab title="Copyright Simple" active>

        <div class="form-group">
            <label for="copyright_simple">{{ trans('alpaca::image.copyright_simple') }}</label>
            <input type="text" class="form-control" id="copyright_simple" name="copyright_simple"
                   value="{{ old('copyright_simple', isset($image) ? $image->copyright_simple : '') }}">
        </div>

    </b-tab>
    <b-tab title="Copyright Creative Commons">

        <div class="form-group">
            <label for="copyright_author">{{ trans('alpaca::image.copyright_author') }}</label>
            <input type="text" class="form-control" id="copyright_author" name="copyright_author"
                   value="{{ old('copyright_author', isset($image) ? $image->copyright_author : '') }}">
        </div>
        <div class="form-group">
            <label for="copyright_title">{{ trans('alpaca::image.copyright_title') }}</label>
            <input type="text" class="form-control" id="copyright_title" name="copyright_title"
                   value="{{ old('copyright_title', isset($image) ? $image->copyright_title : '') }}">
        </div>
        <div class="form-group">
            <label for="copyright_source_url">{{ trans('alpaca::image.copyright_source_url') }}</label>
            <input type="text" class="form-control" id="copyright_source_url" name="copyright_source_url"
                   value="{{ old('copyright_source_url', isset($image) ? $image->copyright_source_url : '') }}">
        </div>
        <div class="form-group">
            <label for="copyright_license_url">{{ trans('alpaca::image.copyright_license_url') }}</label>
            <input type="text" class="form-control" id="copyright_license_url" name="copyright_license_url"
                   value="{{ old('copyright_license_url', isset($image) ? $image->copyright_license_url : '') }}">
        </div>
        <div class="form-group">
            <label for="copyright_license_tag">{{ trans('alpaca::image.copyright_license_tag') }}</label>
            <input type="text" class="form-control" id="copyright_license_tag" name="copyright_license_tag"
                   value="{{ old('copyright_license_tag', isset($image) ? $image->copyright_license_tag : '') }}">
        </div>
        <div class="form-group">
            <label for="copyright_modification">{{ trans('alpaca::image.copyright_modification') }}</label>
            <input type="text" class="form-control" id="copyright_modification" name="copyright_modification"
                   value="{{ old('copyright_modification', isset($image) ? $image->copyright_modification : '') }}">
        </div>

    </b-tab>
</b-tabs>

<button type="submit" class="btn btn-info btn-block" title="{{ trans('alpaca::alpaca.create') }}">
    {{ trans('alpaca::alpaca.save') }}
</button>