<?php


namespace App\Contracts;


interface InertiaSegmentController
{
    public function componentFullPath(string $component): string;
}
