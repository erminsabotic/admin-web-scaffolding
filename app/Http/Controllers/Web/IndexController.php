<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use Inertia\Inertia;

class IndexController extends WebController
{
    public function index()
    {
        return Inertia::render($this->componentFullPath('Index'));
    }
}
