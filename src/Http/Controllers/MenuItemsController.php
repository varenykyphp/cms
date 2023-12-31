<?php

namespace Varenyky\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Varenyky\Models\Menu\Menu;
use Varenyky\Models\Menu\MenuItem;
use Varenyky\Models\Page\Page;
use Varenyky\Repositories\MenuItemRepository;
use VarenykyECom\Models\Category;

class MenuItemsController extends BaseController
{
    public function __construct(MenuItemRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(int $id): View
    {
        $menuItems = MenuItem::where('menu_id',$id)->get();
        $menu_id = $id;
        return view('varenyky::menus.items.index', compact('menuItems','menu_id'));
    }

    public function create(int $id): View
    {
        $menuItems = MenuItem::where('menu_id',$id)->get();
        $pages = Page::all();
        $menu_id = $id;
        $categories = [];

        if (class_exists(Category::class)) {
            $categories = Category::all();
        }

        return view('varenyky::menus.items.create',compact('menu_id','pages','menuItems', 'categories'));

    }

    public function store(Request $request,int $id): RedirectResponse
    {
        $create = $request->except(['_token']);
        $create['menu_id'] = $id;
        $menuItems = $this->repository->create($create);

        return redirect()->route('admin.menuItems.items.index',$id)->with('success', __('varenyky::labels.added'));
    }

    public function edit(int $id, MenuItem $item): View
    {

        $menuItems = MenuItem::where('menu_id',$id)->get();
        $pages = Page::all();
        $categories = [];

        if (class_exists(Category::class)) {
            $categories = Category::all();
        }
        return view('varenyky::menus.items.edit', compact('item','id','pages','menuItems', 'categories'));

    }

    public function update(Request $request,int $id, MenuItem $item): RedirectResponse
    {
        $update = array_filter($request->except(['_token', '_method']));
        $this->repository->update($item->id, $update);

        return redirect()->route('admin.menuItems.items.edit',[$id,$item])->with('success', __('varenyky::labels.updated'));
    }

    public function destroy(int $id,MenuItem $item): RedirectResponse
    {
        $item->delete();

        return redirect()->route('admin.menuItems.items.index',$id)->with('error', __('varenyky::labels.deleted'));
    }
}
