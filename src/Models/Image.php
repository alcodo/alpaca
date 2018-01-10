<?php

namespace Alpaca\Models;

use Response;
use Alpaca\User\Models\User;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'al_images';

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
}
