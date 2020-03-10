<?php

use App\Controllers\Admin\PageController;

session_start();

require_once '../../autoload.php';

$ctrl = new PageController();
echo $ctrl->index();
