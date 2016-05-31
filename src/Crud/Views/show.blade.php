@extends('app')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h1>{{ $title }}</h1>
            <p>
                {{ dump($entry) }}
            </p>
        </div>
    </div>
@endsection