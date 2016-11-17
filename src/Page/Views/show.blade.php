@extends('app')

@section('content')
    <h1>{{$page->title}}</h1>
    {!!$page->body !!}

    @if(!is_null($page->category))
        <hr/>
        <p class="text-right">{{ trans('page::category.category') }}: <a href="{{ $page->getCategoryLink() }}">
                {{$page->category->title}}
            </a>
        </p>
    @endif
@endsection