<?php

require '../classes/PostRepository.php';
require_once '../classes/View.php';

$view = new View();
echo $view->render('pages/about');
