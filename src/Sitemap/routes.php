<?php

Route::get(strtolower(trans('sitemap::sitemap.sitemap')), 'SitemapFront@html');
Route::get('/sitemap.xml', 'SitemapFront@xml');
