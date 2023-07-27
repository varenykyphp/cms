<?php

namespace Varenyky\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthenticationController extends BaseController
{
    public function login(): View
    {
        return view('varenykyAdmin::login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        if (auth('web')->attempt($request->except(['_token']))) {
            return redirect()->route('admin.dashboard');
        }
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();
        return redirect()->route('admin.login');
    }
}