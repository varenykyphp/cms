<?php

namespace Varenyky\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class AuthenticationController extends BaseController
{
    public function login(): View
    {
        return view('varenykyAdmin::login');
    }

    public function authenticate(Request $request): RedirectResponse
    {
        if (auth()->attempt($request->except(['_token']))) {
            return redirect()->intended(route('admin.dashboard'));
        }
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();
        return redirect()->route('admin.login');
    }
}
