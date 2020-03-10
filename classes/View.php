<?php

class View
{
    protected $path;
    protected $extension;

    public function __construct($path = '/../templates/', $extension = '.php')
    {
        $this->path = $path;
        $this->extension = $extension;
    }

    public function render($template)
    {
        ob_start();

        require __DIR__ . '/' . $this->path . $template . $this->extension;

        return ob_get_clean();
    }
}
