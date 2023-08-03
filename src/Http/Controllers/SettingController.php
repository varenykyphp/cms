<?php

namespace Varenyky\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Varenyky\Models\Setting\Setting;
use Illuminate\Support\Str;
use Varenyky\Repositories\SettingRepository;

class SettingController extends BaseController
{
    public function __construct(SettingRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(): View
    {
        $settings = $this->repository->getAllPaginated();
        return view('varenyky::settings.index', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        foreach ($request->except(['_token']) as $key => $value) {
            Setting::where('key', $key)->update(['value' => $value]);
        }

        return redirect()->route('admin.settings.index')->with('success', __('varenyky::labels.updated'));
    }

}
