@extends('app')

@section('scripts')
    <script defer src="https://google-code-prettify.googlecode.com/svn/loader/run_prettify.js"></script>
@endsection

@section('content')

    <div class="row">

        <div class="col-md-12">
            <h1>{{ trans('email::email.email-templates') }}</h1>

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