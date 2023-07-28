<?php

namespace Varenyky\Http\Controllers;

use Illuminate\View\View;

class DashboardController extends BaseController
{
    public function __construct()
    {
        // $this->middleware(['role:admin|editor']);
    }

    public function index(): View
    {
        return view('varenyky::dashboard.index');
    }
}
