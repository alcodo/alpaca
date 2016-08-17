@extends('app')

@section('content')

    <h1>{{ ucfirst($pageCharacter) }}</h1>

    <ul>
        @foreach ($pages as $index => $page)
            @if($page->category)
                <li>
                    <a href="{{ route('page.show', [$page->slug]) }}">
                        {{$page->title}}
                    </a>
                </li>
            @endif
        @endforeach
    </ul>
@endsection