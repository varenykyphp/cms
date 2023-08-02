<?php

namespace Varenyky\Http\Controllers;

use Varenyky\Repositories\MenuRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Varenyky\Models\Menu\Menu;
use Illuminate\Support\Str;
use Varenyky\Models\Menu\MenuItem;

class MenuController extends BaseController
{
    public function __construct(MenuRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(): View
    {
        $menus = $this->repository->getAllPaginated();

        return view('varenyky::menus.index', compact('menus'));
    }

    public function create(): View
    {
        return view('varenyky::menus.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $create = $request->except(['_token']);
        $create['slug'] = Str::slug($create['name']);

        $menus = $this->repository->create($create);

        return redirect()->route('admin.menus.index')->with('success', __('varenyky::labels.added'));
    }

    public function edit(Menu $menu): View
    {
        return view('varenyky::menus.edit', compact('menu'));
    }

    public function update(Request $request, Menu $menu): RedirectResponse
    {
        $update = array_filter($request->except(['_token', '_method']));
        $this->repository->update($menu->id, $update);

        return redirect()->route('admin.menus.edit', $menu->id)->with('success', __('varenyky::labels.updated'));
    }

    public function destroy(Menu $menu): RedirectResponse
    {
        $menuItem = MenuItem::where('menu_id',$menu->id)->get();
        foreach( $menuItem  as $item){
            $item->delete();
        }
        
        $menu->delete();

        return redirect()->route('admin.menus.index')->with('error', __('varenyky::labels.deleted'));
    }
}
