<?php

namespace Varenyky\Models\Menu;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'name',
        'slug',
    ];

    public function items()
    {
        return $this->hasMany(MenuItem::class, 'menu_id', 'id')->where('parent', 0)->orderBy('sort_order');
    }
}