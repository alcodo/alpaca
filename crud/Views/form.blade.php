@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>{{ $title }}</h1>

            {!! $formStart !!}

            @foreach ($formFields as $field)
                {!! $field !!}
            @endforeach

            {!! $formClose !!}
        </div>
    </div>
@endsection