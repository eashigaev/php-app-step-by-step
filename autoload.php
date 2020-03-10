<?php

spl_autoload_register(function ($className) {
    $className = __DIR__ . '\\src\\' . $className;

    $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';

    require_once $fileName;
});
