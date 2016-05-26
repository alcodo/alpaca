<?php namespace Alcodo\Menu\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    protected $fillable = array(
        'title',
        'class',
        'html',
    );

    public function items()
    {
        return $this->hasMany('Alcodo\Menu\Models\Item', 'menu_id', 'id');
    }

}