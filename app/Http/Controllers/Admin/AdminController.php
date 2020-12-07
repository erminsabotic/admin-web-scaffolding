<?php


namespace App\Http\Controllers\Admin;


use App\Contracts\InertiaSegmentController;
use App\Http\Controllers\Controller;

class AdminController extends Controller implements InertiaSegmentController
{
    public function componentFullPath(string $component): string
    {
        return $this->generateComponentFullPath('Admin', $component);
    }
}
