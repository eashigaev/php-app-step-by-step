<?php

namespace App\Controllers;

use Vendor\View;

class PageController
{
    protected View $view;

    public function __construct(View $view)
    {
        $this->view = $view;
    }

    public function index()
    {
        return $this->view->render('index', [
            'title' => 'Starter App'
        ]);
    }
}
