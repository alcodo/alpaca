@extends('app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>
                {{ trans('sitemap::sitemap.sitemap') }}
            </h1>

            <table class="table table-striped">
                <thead>
                <tr>
                    <th class="col-md-1">#</th>
                    <th class="col-md-5">{{ trans('crud::crud.title') }}</th>
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