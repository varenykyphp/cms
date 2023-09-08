<?php

namespace Varenyky\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Varenyky\Models\Page\Page;
use Varenyky\Models\Setting\Setting;
use Varenyky\Support\SearchEngineFactory;
use VarenykyECom\Support\EComSearchEngineFactory;

class FrontendController extends BaseController
{
    protected $seo;

    public function __construct()
    {
        if(class_exists('VarenykyECom\Support\EComSearchEngineFactory')){
            $this->seo = resolve(EComSearchEngineFactory::class);
        }else{
            $this->seo = resolve(SearchEngineFactory::class);
        }
    }

    public function index(): View
    {
        $homePageId = Setting::where('key', 'home')->first()->value;
        $page = Page::where('id', $homePageId)->first();
        $this->seo->page($page);
        return view($page->template, compact('page'));
    }

    public function show(string $slug): View
    {
        $page = Page::where('slug', $slug)->first();
        $this->seo->page($page);
        return view($page->template, compact('page'));
    }
}
