<?php

namespace App\Controllers;

use App\Repositories\PostRepository;
use Vendor\View;

class PageController
{
    protected View $view;
    protected PostRepository $postRepository;

    public function __construct(View $view, PostRepository $postRepository)
    {
        $this->view = $view;
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        return $this->view->render('pages/index', [
            'post' => $this->postRepository->getAll()[0]
        ]);
    }

    public function about()
    {
        return $this->view->render('pages/about');
    }

    public function posts()
    {
        $id = $_GET['id'] ?? null;

        $post = $this->postRepository->getById($id);

        return $post
            ? $this->view->render('pages/posts-full', $post)
            : $this->view->render('pages/posts-all', [
                'posts' => $posts = $this->postRepository->getAll()
            ]);
    }
}
