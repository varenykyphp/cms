<?php

namespace Varenyky\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Varenyky\Repositories\PageRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Varenyky\Models\Page\Page;
use Varenyky\Models\Page\Block;
use Illuminate\Support\Str;

class PageController extends BaseController
{
    public function __construct(PageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(): View
    {
        $pages = Page::all();
        return view('varenyky::pages.index', compact('pages'));
    }

    public function create(): View
    {
        $pages = Page::all();
        $templates = Storage::allFiles('templates');
        return view('varenyky::pages.create', compact('pages', 'templates'));
    }

    public function store(Request $request)
    {
        $page = new Page;
        $page->template = $request->input('template');
        $page->name = $request->input('name');
        $page->slug = Str::slug($request->input('name'));
        $page->seo_key = $request->input('seo_key');
        $page->seo_snip = $request->input('seo_snip');
        $page->seo_title = $request->input('seo_title');
        $page->seo_desc = $request->input('seo_desc');
        $page->content = $request->input('content');
        $page->parent = $request->input('parent');
        $page->published = 0;
        $page->save();

        foreach ($request->input('tBlock') as $key => $value) {
            $block = Block::where('page_id', $page->id)->where('key', $key)->first();
            if ($block === null) {
                $block = new Block;
                $block->page_id = $page->id;
                $block->key = $key;
                $block->value = $value;
                $block->save();
            } else {
                $block->update([
                    'value' => $value,
                ]);
            }
        }

        foreach ($request->files as $key => $slug) {
            $filename = str_replace(['.' . $slug->getClientOriginalExtension()], '', $slug->getClientOriginalName());
            $filename = date('Y_m_d_His') . '_' . Str::slug($filename, '-');
            $savePath = 'images/' . $filename . '.' . $slug->getClientOriginalExtension();
            if (File::put(public_path($savePath), file_get_contents($slug->getRealPath()))) {
                $key = explode('_', $key);
                $block = Block::where('page_id', $page->id)->where('key', $key[1])->first();
                if ($block === null) {
                    $block = new Block();
                    $block->page_id = $page->id;
                    $block->key = $key[1];
                    $block->value = "/" . $savePath;
                    $block->save();
                } else {
                    $block->update([
                        'value' => "/" . $savePath,
                    ]);
                }
            }
        }

        return redirect()->route('admin.pages.index', $page->id)->with('success', __('varenyky::labels.added'));
    }

    public function edit(Page $page): View
    {
        $templates = Storage::allFiles('templates');
        $pages = Page::where('id', '<>', $page->id)->get();

        return view('varenyky::pages.edit', compact('page', 'pages', 'templates'));
    }
    public function update(Request $request, Page $page): RedirectResponse
    {

        $update = array_filter($request->only(['name', 'seo_title', 'seo_desc', 'template']));
        $this->repository->update($page->id, $update);

        foreach ($request->input('tBlock') as $key => $value) {
            $block = Block::where('page_id', $page->id)->where('key', $key)->first();
            if ($block === null) {
                $block = new Block;
                $block->page_id = $page->id;
                $block->key = $key;
                $block->value = $value;
                $block->save();
            } else {
                $block->update([
                    'value' => $value,
                ]);
            }
        }

        foreach ($request->files as $key => $slug) {
            $filename = str_replace(['.' . $slug->getClientOriginalExtension()], '', $slug->getClientOriginalName());
            $filename = date('Y_m_d_His') . '_' . Str::slug($filename, '-');
            $savePath = 'images/' . $filename . '.' . $slug->getClientOriginalExtension();
            if (File::put(public_path($savePath), file_get_contents($slug->getRealPath()))) {
                $key = explode('_', $key);
                $block = Block::where('page_id', $page->id)->where('key', $key[1])->first();
                if ($block === null) {
                    $block = new Block();
                    $block->page_id = $page->id;
                    $block->key = $key[1];
                    $block->value = "/" . $savePath;
                    $block->save();
                } else {
                    $block->update([
                        'value' => "/" . $savePath,
                    ]);
                }
            }
        }

        return redirect()->route('admin.pages.edit', $page->id)->with('success', __('varenyky::labels.updated'));
    }

    public function destroy(Page $page): RedirectResponse
    {
        $page->delete();

        return redirect()->route('admin.pages.index')->with('error', __('varenyky::labels.deleted'));
    }

    public function getBlocks(Request $request): JsonResponse
    {
        if ($request->isXmlHttpRequest()) {
            $blocks = [];
            $i = 0;

            foreach (include(storage_path('app/templates/' . $request->input('template') . '.php')) as $slug => $type) {
                $value = '';

                $blockValue = Block::where('page_id', $request->input('pageId'))->where('key', $slug)->first();
                if ($blockValue !== null) {
                    $value = $blockValue->value;
                }

                $blocks[$i] = [
                    'name' => ucwords(str_replace(['-'], [' '], $slug)),
                    'slug' => $slug,
                    'type' => $type,
                    'body' => $value,
                ];
                $i++;
            }

            return response()->json($blocks);
        }
    }
}
