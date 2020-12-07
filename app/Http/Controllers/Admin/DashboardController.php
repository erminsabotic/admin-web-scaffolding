<?php

namespace App\Http\Controllers\Admin;

use Inertia\Inertia;

class DashboardController extends AdminController
{
    public function index()
    {
        return Inertia::render($this->componentFullPath('Dashboard/Index'));
    }
}
