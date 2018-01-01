@extends('alpaca::layout')

@section('content')

    <div class="row">

        <div class="col-md-12">
            <h1>{{ trans('alpaca::emailtemplate.email-templates') }}</h1>

            <div class="row">
                <div class="col-md-12">
                    <ul>
                        @foreach ($emailTemplates as $entry)
                            <li>
                                <a href="{{ $entry['link'] }}">
                                    {{ $entry['text'] }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

        </div>

    </div>
@endsection