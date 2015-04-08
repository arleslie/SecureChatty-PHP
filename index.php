<?php

error_reporting(E_ALL);

include 'functions/autoloader.php';
$controller = new classes\Controller(); // The controller will handle the config info and manage DB access & Session Information.

// I hate notices so handle undefined variable.
if (empty($_GET['page'])) {
	$_GET['page'] = 'home';
}

// The controller will override the page if the user isn't logged in.
echo $controller->getPage($_GET['page']);