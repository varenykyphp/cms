<?php

namespace Varenyky\Support;

use Varenyky\Models\Page\Page;
use Varenyky\Models\Setting\Setting;

class SearchEngineFactory
{
    public $settings = [];
    public $title = '';
    public $description = '';
    public $snippet = '';
    public $language = '';
    public $image = '';

    public function __construct()
    {
        foreach (Setting::all() as $setting) {
            $this->settings[$setting->key] = $setting->value;
        }

        $this->title = $this->settings['default-seo-title'];
        $this->description = $this->settings['default-seo-description'];
    }

    public function page(Page $page)
    {
        if($page->seo_title != null){
            $this->title = $page->seo_title;
        }else{
            $this->title = $page->name . " | " . $this->settings['site-name'];
        }

        if($page->seo_desc != null){
            $this->description = $page->seo_desc;
        }

        if($page->seo_snip != null){
            $this->snippet = $page->seo_snip;
        }
    }
}
