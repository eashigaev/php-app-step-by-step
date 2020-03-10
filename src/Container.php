<?php

class Container
{
    protected $bindings = [];

    public function __construct()
    {
        $this->bind(self::class, $this);
    }

    public function bind($contract, $resolver)
    {
        $this->bindings[$contract] = $resolver;
        return $this;
    }

    public function bindAll(array $bindings)
    {
        foreach ($bindings as $contract => $binding) {
            $this->bind($contract, $binding);
        }
        return $this;
    }

    public function make($contract)
    {
        if (array_key_exists($contract, $this->bindings)) {
            $contract = $this->bindings[$contract];
        }
        if (is_callable($contract)) {
            return $contract($this);
        }
        if (is_object($contract)) {
            return $contract;
        }
        return $this->makeClass($contract);
    }

    public function makeClass($class)
    {
        $constructor = (new \ReflectionClass($class))->getConstructor();

        if (!$constructor) return new $class;

        $args = array_map(
            function ($param) {
                return $this->make($param->getClass()->name);
            },
            $constructor->getParameters()
        );

        return new $class(...$args);
    }
}
