<?php

namespace App\Controllers\Admin;

class AdminPageController
{
    public function index()
    {
        header('Location: /admin/posts');
        exit;
    }
}
