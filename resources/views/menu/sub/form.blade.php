{{ csrf_field() }}

<div class="form-group">
    <label for="title">{{ trans('alpaca::alpaca.title') }}<span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="title" name="title"
           value="{{ old('title', isset($menu) ? $menu->title : '') }}" required>
</div>

<div class="form-group">
    <label for="class">CSS Class</label>
    <input type="text" class="form-control" id="class" name="class"
           value="{{ old('title', isset($menu) ? $menu->class : '') }}">
</div>

<button type="submit" class="btn btn-info btn-block">{{ trans('alpaca::alpaca.save') }}</button>