<?php

use App\Controllers\AuthController;

require_once '../../autoload.php';

$ctrl = new AuthController(new View());
echo $ctrl->login();
