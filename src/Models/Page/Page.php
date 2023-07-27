<?php

namespace Varenyky\Models\Page;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'template',
        'content',
        'seo_title',
        'seo_desc',
        'seo_snip',
        'seo_key',
        'parent',
        'published',
    ];

    public function blocks()
    {
        $blocks = [];
        foreach (Block::where('page_id', $this->id)->get() as $block) {
            if ($block->templateblock !== null) {
                $blocks[$block->templateblock->slug] = get_block_value($block);
            }
        }

        return $blocks;
    }
}