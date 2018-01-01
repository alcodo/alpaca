<?php

namespace Alpaca\Models;

use Illuminate\Database\Eloquent\Model;

class Sitemap extends Model
{
    protected $fillable = [
        'title',
        'url',
    ];
}
