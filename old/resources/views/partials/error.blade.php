@if (isset($errors) && count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Fehler</strong><br>
        Ein Fehler ist aufgetreten bei der Eingabe.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif