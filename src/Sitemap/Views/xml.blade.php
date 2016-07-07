{!! '<'.'?'.'xml version="1.0" encoding="UTF-8"?>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        @foreach ($sitemaps as $index => $sitemap)
            <loc>{{ $sitemap->url }}</loc>
        @endforeach
    </url>
</urlset>