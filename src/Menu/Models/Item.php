<?php

namespace Alcodo\Menu\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = [
        'text',
        'title',
        'href',
        'rel',
        'target',
        'menu_id',
    ];

    public function getLink()
    {
        $htmlLink = '<a';

        if (!empty($this->title)) {
            $htmlLink .= " title=$this->title";
        }
        if (!empty($this->href)) {
            $htmlLink .= " href=$this->href";
        }
        if (!empty($this->rel)) {
            $htmlLink .= " rel=$this->rel";
        }
        if (!empty($this->target)) {
            $htmlLink .= " target=$this->target";
        }
        $htmlLink .= '>';
        $htmlLink .= $this->text;
        $htmlLink .= '</a>';

        return $htmlLink;
    }

    public function menu()
    {
        return $this->belongsTo('Alcodo\Menu\Models\Menu');
    }
}
