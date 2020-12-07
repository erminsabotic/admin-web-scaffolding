<?php


namespace App\Http\Controllers\Web;


use App\Contracts\InertiaSegmentController;
use App\Http\Controllers\Controller;

class WebController extends Controller implements InertiaSegmentController
{
    public function componentFullPath(string $component): string
    {
        return $this->generateComponentFullPath('Web', $component);
    }
}
