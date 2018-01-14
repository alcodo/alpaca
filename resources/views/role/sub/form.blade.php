{{ csrf_field() }}

<div class="form-group">
    <label for="name">{{ trans('alpaca::alpaca.name') }}<span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="name" name="name"
           value="{{ old('name', isset($role) ? $role->name : '') }}" required>
</div>

<button type="submit" class="btn btn-info btn-block">{{ trans('alpaca::alpaca.save') }}</button>