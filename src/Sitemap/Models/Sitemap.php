<?php

namespace Alpaca\Sitemap\Models;

use Illuminate\Database\Eloquent\Model;

class Sitemap extends Model
{

    protected $fillable = [
        'title',
        'url',
    ];

}