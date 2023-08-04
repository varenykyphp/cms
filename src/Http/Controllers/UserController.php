<?php

namespace Varenyky\Http\Controllers;

use Varenyky\Repositories\UserRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;

class UserController extends BaseController
{
    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(): View
    {
        $users = $this->repository->getAllPaginated();

        return view('varenyky::users.index', compact('users'));
    }

    public function create(): View
    {
        return view('varenyky::users.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $create = $request->except(['_token']);

        $users = $this->repository->create($create);
  
        return redirect()->route('admin.users.index')->with('success', __('varenyky::labels.added'));
    }

    public function edit(User $user): View
    {
        return view('varenyky::users.edit', compact('user'));
    }

    public function update(Request $request, User $user): RedirectResponse
    {
        $update = array_filter($request->except(['_token', '_method']));
        $this->repository->update($user->id, $update);

        return redirect()->route('admin.users.edit', $user->id)->with('success', __('varenyky::labels.updated'));
    }

    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', __('varenyky::labels.deleted'));
    }
}
