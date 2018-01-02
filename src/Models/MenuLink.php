<?php

namespace Alpaca\Models;

use Illuminate\Database\Eloquent\Model;

class MenuLink extends Model
{
    protected $table = 'al_menu_links';

    protected $fillable = [
        'text',
        'position',
        'title',
        'href',
        'rel',
        'target',
        // ref
        'menu_id',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

//    public function getLink()
//    {
//        $htmlLink = '<a';
//
//        if (! empty($this->title)) {
//            $htmlLink .= " title=$this->title";
//        }
//        if (! empty($this->href)) {
//            $htmlLink .= " href=$this->href";
//        }
//        if (! empty($this->rel)) {
//            $htmlLink .= " rel=$this->rel";
//        }
//        if (! empty($this->target)) {
//            $htmlLink .= " target=$this->target";
//        }
//        $htmlLink .= '>';
//        $htmlLink .= $this->text;
//        $htmlLink .= '</a>';
//
//        return $htmlLink;
//    }
}
