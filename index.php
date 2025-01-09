<?php
require_once './src/views/components/header.html.php';
require_once './src/views/components/nav.html.php';

require_once 'src/utils/Router.php';

$router = new Router();
$router->start();