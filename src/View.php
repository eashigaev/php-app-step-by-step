<?php

class View
{
    protected $path;
    protected $extension;

    public function __construct($path, $extension = '.tpl.php')
    {
        $this->path = $path;
        $this->extension = $extension;
    }

    public function render($template, array $data = [])
    {
        extract($data);

        ob_start();

        require $this->path . $template . $this->extension;

        return ob_get_clean();
    }
}
