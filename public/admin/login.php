<?php

use App\Controllers\AuthController;

session_start();

require_once '../../autoload.php';

$ctrl = new AuthController(new View());
echo $ctrl->login();
