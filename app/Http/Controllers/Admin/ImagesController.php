<?php

namespace App\Http\Controllers\Admin;

use League\Glide\Server;

class ImagesController extends AdminController
{
    public function show(Server $glide)
    {
        return $glide->fromRequest()->response();
    }
}
