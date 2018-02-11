{{ csrf_field() }}

<div class="form-group">
    <label for="name">{{ trans('alpaca::user.name') }}<span class="text-danger">*</span></label>
    <input type="text" class="form-control" id="name" name="name"
           value="{{ old('name', isset($user) ? $user->name : '') }}" required>
</div>

<div class="form-group">
    <label for="email">{{ trans('alpaca::user.email') }}<span class="text-danger">*</span></label>
    <input type="email" class="form-control" id="email" name="email"
           value="{{ old('email', isset($user) ? $user->email : '') }}" required>
</div>

<div class="form-group">
    <label for="password">
        {{ trans('alpaca::user.password') }}@if($isCreate)<span class="text-danger">*</span>@endif
    </label>
    <input type="password" class="form-control" id="password" name="password"
           value="{{ old('password', '') }}" @if($isCreate) required @endif>
</div>

@if($isCreate)

    <div class="form-group">
        <label for="password">{{ trans('alpaca::user.password_confirm') }}<span class="text-danger">*</span></label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
               value="{{ old('password_confirmation', '') }}">
    </div>

@endif

<div class="form-group row">
    <div class="col-sm-2">{{ trans('alpaca::user.roles') }}</div>
    <div class="col-sm-10">
        @foreach($roles as $id => $roleName)
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="role{{ $id }}" name="roles[]" value="{{ $id }}"
                       @if(is_array(old('roles')))
                       @if(in_array($id, old('roles')))
                       checked
                       @endif
                       @elseif(isset($user) && $user->hasRole($roleName))
                       checked
                        @endif>
                <label class="form-check-label" for="role{{ $id }}">{{ $roleName }}</label>
            </div>
        @endforeach
    </div>
</div>

<button type="submit" class="btn btn-info btn-block">{{ trans('alpaca::alpaca.save') }}</button>