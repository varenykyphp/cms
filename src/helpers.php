<?php

use Varenyky\Models\Page\Block;
use Varenyky\Models\Page\Page;

function get_block_value(Block $block)
{
    switch ($block->type) {
        case 'link':
            if($block->value == 1){
                return route('varenyky.home');
            }
            $page = Page::where('id', $block->value)->first();
            if ($page !== null) {
                if($page->parent == 0){
                    return route('varenyky.page', [$page->slug]);
                }else{
                    return route('varenyky.page', [$page->parentpage->slug, $page->slug]);
                }
            } else {
                return '#';
            }
            break;
        default:
            return $block->value;
            break;
    }
}
