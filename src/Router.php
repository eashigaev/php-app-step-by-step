<?php

class Router
{
    protected $handlers = [];

    public function register($url, $callback)
    {
        $this->handlers[$url] = $callback;
        return $this;
    }

    public function registerAll(array $routes)
    {
        foreach ($routes as $url => $callback) {
            $this->register($url, $callback);
        }
        return $this;
    }

    public function match()
    {
        $uri = $_SERVER['REQUEST_URI'] ?? '/';
        $path = parse_url($uri)['path'];

        foreach ($this->handlers as $url => $handler) {
            if ($url !== $path) continue;
            return $handler;
        }

        throw new Exception('404 Not Found');
    }
}
