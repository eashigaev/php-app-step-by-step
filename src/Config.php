<?php

class Config
{
    protected $items = [];

    public function set($name, $value)
    {
        $this->items[$name] = $value;
        return $this;
    }

    public function setAll(array $items)
    {
        foreach ($items as $name => $value) {
            $this->set($name, $value);
        }
        return $this;
    }

    public function get($name, $default = null)
    {
        return $this->items[$name] ?? $default;
    }
}
