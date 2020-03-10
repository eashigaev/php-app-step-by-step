<?php

namespace App\Admin\Controllers;

class PageController
{
    public function index()
    {
        header('Location: /admin/posts');
        exit;
    }
}
