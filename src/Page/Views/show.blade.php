@extends('app')

@section('content')
    <h1>{{$page->title}}</h1>
    {!!$page->body !!}

    @if(!is_null($page->category))
        <hr/>
        <p>
            <strong>
                Das könnte dich auch Interessieren:
            </strong>
        </p>
        <div class="list-group">
            @foreach($releated as $page)
                <a href="{{ $page->getPageLink() }}" class="list-group-item">
                    <i class="fa fa-chevron-right" aria-hidden="true"></i> {{ $page->title }}
                </a>
            @endforeach
        </div>

        <p class="text-right">{{ trans('page::category.category') }}: <a href="{{ $page->getCategoryLink() }}">
                {{$page->category->title}}
            </a>
        </p>
    @endif
@endsection