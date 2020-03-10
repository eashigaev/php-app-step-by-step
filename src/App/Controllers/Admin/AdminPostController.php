<?php

namespace App\Controllers\Admin;

use App\Repositories\PostRepository;

class AdminPostController
{
    protected \View $view;
    protected PostRepository $postRepository;

    public function __construct(\View $view, PostRepository $postRepository)
    {
        $this->view = $view;
        $this->postRepository = $postRepository;

        $this->auth();
    }

    protected function auth()
    {
        $auth = $_SESSION['auth'] ?? false;

        if (!$auth) {
            header('Location: /admin/login');
            exit;
        }
    }

    public function index()
    {
        $posts = $this->postRepository->getAll();

        return $this->view->render('admin/posts', [
            'posts' => $posts
        ]);
    }

    public function create()
    {
        $this->postRepository->create([
            'id' => uniqid(),
            'title' => $_POST['title'] ?? '',
            'text' => $_POST['text'] ?? '',
        ]);

        header('Location: /admin/posts');
        exit;
    }

    public function delete()
    {
        $index = $_GET['index'] ?? null;

        $this->postRepository->delete($index);

        header('Location: /admin/posts');
        exit;
    }
}
