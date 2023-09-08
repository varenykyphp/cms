<?php

namespace Varenyky\Models\Menu;

use Varenyky\Models\Page\Page;
use Illuminate\Database\Eloquent\Model;
use VarenykyECom\Models\Category;
use Illuminate\Support\Str;

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

        if ($this->type == 'category') {
            $category = Category::where('id', $this->link)->first();
            if ($category !== null) {
                return "/category/".$category->id."/".Str::slug($category->name);
            }
        }

        $page = Page::where('id', $this->link)->first();
        if ($page !== null) {
            return '/'.$page->slug;
        }

        return '#';
    }
}
