@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>
                Sitemap
            </h1>

            <table class="table">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{ trans('alpaca::alpaca.title') }}</th>
                </tr>
                </thead>
                @foreach ($sitemaps as $index => $sitemap)
                    <tr>
                        <td>{{ $index+1 }}</td>
                        <td><a href="{{ $sitemap->url }}">{{ $sitemap->title }}</a></td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection