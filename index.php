<?php

error_reporting(E_ALL);

require('config.inc.php');

$controller = new classes\Controller();

echo $controller->getPage('login');
