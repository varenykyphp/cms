<?php

namespace Varenyky\Http\Controllers;

use Varenyky\Repositories\PageRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Varenyky\Models\Page\Page;
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
        return view('varenyky::pages.index',compact('pages'));
    }

    public function create(): View
    {
        return view('varenyky::pages.create');
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

        // foreach ($request->input('tBlock') as $key => $value) {
        //     if (is_array($value)) {
        //         $value = implode(',', $value);
        //     }

        //     $block = new PageBlock();
        //     $block->page_id = $page->id;
        //     $block->template_block_id = $key;
        //     $block->value = $value;
        //     $block->save();
        // }

        // foreach ($request->files as $key => $upload) {
        //     $key = str_replace('tBlock_', '', $key);
        //     $filename = str_replace(['.'.$upload->getClientOriginalExtension()], '', $upload->getClientOriginalName());
        //     $filename = date('Y_m_d_His').'_'.Str::slug($filename, '-');
        //     $savePath = 'images/'.$filename.'.'.$upload->getClientOriginalExtension();
        //     if (File::put(public_path($savePath), file_get_contents($upload->getRealPath()))) {
        //         $block = new PageBlock;
        //         $block->page_id = $page->id;
        //         $block->template_block_id = $key;
        //         $block->value = "/".$savePath;
        //         $block->save();
        //     }
        // }

        return redirect()->route('admin.pages.index', $page->id)->with('success', __('varenyky::labels.added'));
        
    }

    public function edit(Page $page): View
    {
        // $templates = $this->templateRepository->getAll();
        $pages = Page::where('id', '<>', $page->id)->get();

        return view('varenyky::pages.edit', compact('page', 'pages'));
    }
    public function update(Request $request, Page $page): RedirectResponse
    {

        $update = array_filter($request->only(['name', 'seo_title', 'seo_desc','content']));
        $this->repository->update($page->id, $update);

        // foreach ($request->input('tBlock') as $key => $value) {
        //     $block = PageBlock::where('page_id', $page->id)->where('template_block_id', $key)->first();
        //     if ($block === null) {
        //         $block = new PageBlock;
        //         $block->page_id = $page->id;
        //         $block->template_block_id = $key;
        //         $block->value = $value;
        //         $block->save();
        //     } else {
        //         $block->update([
        //             'value' => $value,
        //         ]);
        //     }
        // }

        // foreach ($request->files as $key => $upload) {
        //     $key = str_replace('tBlock_', '', $key);
        //     $filename = str_replace(['.'.$upload->getClientOriginalExtension()], '', $upload->getClientOriginalName());
        //     $filename = date('Y_m_d_His').'_'.Str::slug($filename, '-');
        //     $savePath = 'images/'.$filename.'.'.$upload->getClientOriginalExtension();
        //     if (File::put(public_path($savePath), file_get_contents($upload->getRealPath()))) {
        //         $block = PageBlock::where('page_id', $page->id)->where('template_block_id', $key)->first();
        //         if ($block === null) {
        //             $block = new PageBlock;
        //             $block->page_id = $page->id;
        //             $block->template_block_id = $key;
        //             $block->value = "/".$savePath;
        //             $block->save();
        //         } else {
        //             $block->update([
        //                 'value' => "/".$savePath,
        //             ]);
        //         }
        //     }
        // }

        return redirect()->route('admin.pages.edit', $page->id)->with('success', __('varenyky::labels.updated'));
    }

    public function destroy(Page $page): RedirectResponse
    {
        $page->delete();

        return redirect()->route('admin.pages.index')->with('error', __('varenyky::labels.deleted'));
    }
}
