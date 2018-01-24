@if (isset($errors) && count($errors) > 0)
    <div class="alert alert-danger">
        <strong>
            {{ trans('alpaca::alpaca.error') }}
        </strong>
        <br>
        {{ trans('alpaca::alpaca.error_entering') }}
        <br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif