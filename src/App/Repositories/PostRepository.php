<?php

namespace App\Repositories;

class PostRepository
{
    protected $fileName = __DIR__ . '/../../../db/posts.json';

    public function getAll()
    {
        return json_decode(file_get_contents($this->fileName), true);
    }

    public function getById($id)
    {
        $posts = $this->getAll();
        foreach ($posts as $post) {
            if ($post['id'] == $id) return $post;
        }
        return null;
    }

    public function create(array $post)
    {
        $posts = $this->getAll();
        array_unshift($posts, $post);
        $this->saveAll($posts);
    }

    public function delete($index)
    {
        $posts = $this->getAll();
        array_splice($posts, $index, 1);
        $this->saveAll($posts);
    }

    public function saveAll(array $posts)
    {
        file_put_contents($this->fileName, json_encode($posts));
    }
}
