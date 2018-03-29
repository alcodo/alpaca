<?php

namespace Alpaca\Models;

use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    protected $fillable = [
        'from',
        'to',
        'code',
        'hits',
    ];
}
