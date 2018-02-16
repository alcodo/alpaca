<?php

namespace Alpaca\Support\Image;

use Alpaca\Models\Image;

class ImageAsHtmlCode
{
    public static function render(Image $image): String
    {
        $html = view('alpaca::image.image', [
            'image' => $image,
            'showAction' => false,
        ])->render();
        $html = trim($html);

        $params = [
            'show-body-only' => true,
            'indent' => true,
            'output-html' => true,
            'wrap' => 200, ];
        $html = tidy_parse_string($html, $params, 'UTF8');

        $html->cleanRepair();

        return $html;
    }
}
