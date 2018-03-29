{{ csrf_field() }}

<div class="form-group">
    <label for="from">{{ trans('alpaca::alpaca.from') }}<span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="from" to="from"
           value="{{ old('from', isset($redirect) ? $redirect->from : '') }}" required>
</div>


<div class="form-group">
    <label for="to">{{ trans('alpaca::alpaca.to') }}<span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="to" code="to"
           value="{{ old('to', isset($redirect) ? $redirect->to : '') }}" required>
</div>

<div class="form-group">
    <label for="code">{{ trans('alpaca::alpaca.code') }}<span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="code" name="code"
           value="{{ old('code', isset($redirect) ? $redirect->code : '301') }}" required>
    <span class="help-block">
        301, "Moved Permanently"—recommended for SEO<br>
302, "Found" or "Moved Temporarily"
                                    </span>

</div>

<button type="submit" class="btn btn-info btn-block">{{ trans('alpaca::alpaca.save') }}</button>