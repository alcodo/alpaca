{{ csrf_field() }}

<div class="form-group">
    <label for="from">{{ trans('alpaca::redirect.from') }}<span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="from" name="from" placeholder="/old/path"
           value="{{ old('from', isset($redirect) ? $redirect->from : '') }}" required>
</div>


<div class="form-group">
    <label for="to">{{ trans('alpaca::redirect.to') }}<span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="to" name="to" placeholder="/new/path"
           value="{{ old('to', isset($redirect) ? $redirect->to : '') }}" required>
</div>

<div class="form-group">
    <label for="code">{{ trans('alpaca::redirect.code') }}<span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="code" name="code"
           value="{{ old('code', isset($redirect) ? $redirect->code : '301') }}" required>
    <small id="codeHelp" class="form-text text-muted">301, "Moved Permanently"—recommended for SEO<br>
        302, "Found" or "Moved Temporarily"
    </small>

</div>

<button type="submit" class="btn btn-info btn-block">{{ trans('alpaca::alpaca.save') }}</button>