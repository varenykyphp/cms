<?php

namespace Varenyky\Models\Menu;

use Varenyky\Models\Page\Page;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $table = 'menu_items';

    protected $fillable = [
        'menu_id',
        'type',
        'name',
        'link',
        'sort_order',
        'parent',
    ];

    public function children()
    {
        return MenuItem::where('parent', $this->id)->get();
    }

    public function getLink()
    {
        if ($this->type == 'link') {
            return $this->link;
        }

        $page = Page::where('id', $this->link)->first();
        if ($page !== null) {
            return '/'.$page->slug;
        }

        return '#';
    }
}