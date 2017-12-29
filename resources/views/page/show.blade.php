{{--@extends('app')--}}

@section('content')

    <div class="float-right">
        @include('page::page.action', ['isIndex' => true, 'isShow' => false])
    </div>

    <h1>{{$page->title}}</h1>
    {!!$page->content !!}



    @if(!is_null($page->category))
        <hr/>
        <p>
            <strong>
                Das könnte dich auch Interessieren:
            </strong>
        </p>
        <div class="list-group">
            @foreach($releated as $page)
                <a href="{{ $page->path }}" class="list-group-item">
                    <i class="fa fa-chevron-right" aria-hidden="true"></i> {{ $page->title }}
                </a>
            @endforeach
        </div>

        <p class="text-right">{{ trans('page::category.category') }}: <a href="{{ $page->category->path }}">
                {{$page->category->title}}
            </a>
        </p>
    @endif
@endsection