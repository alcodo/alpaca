<?php

namespace Alpaca\Gallery\Models;

use Alpaca\User\Models\User;
use Illuminate\Database\Eloquent\Model;
use Response;

class Image extends Model
{
    protected $fillable = [
        'title',
        'filepath',
        'alt',

        'copyright_simple',

        'copyright_author',
        'copyright_title',
        'copyright_source_url',
        'copyright_license_url',
        'copyright_license_tag',
        'copyright_modification',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getHtmlOutput()
    {
        // blade render
        $html = Response::view('gallery::wrapperBind', ['image' => $this])->getContent();
        $html = trim($html);

        // html prettify
        return $this->getPrettyHtml($html);
    }

    /**
     * Return pretty html.
     *
     * @param $html
     * @return mixed
     */
    public function getPrettyHtml($html)
    {
        $params = [
            'show-body-only' => true,
            'indent' => true,
            'output-html' => true,
            'wrap' => 200, ];
        $tidy = tidy_parse_string($html, $params, 'UTF8');
        $tidy->cleanRepair();

        $this->htmlOutput = $tidy;

        return $tidy;
    }
}
