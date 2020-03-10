<?php

namespace App\Controllers\Admin;

class PageController
{
    public function index()
    {
        header('Location: /admin/posts');
        exit;
    }
}
