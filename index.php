<?php

error_reporting(E_ALL);

try {
	require('config.inc.php');
} catch (Exception $e) {
	die('Site is currently experecing problems.');
}

session_start();
include 'functions/autoloader.php';

$controller = new classes\Controller();
$SecureChatty = array(
	'user' => new classes\User()
);

if (!$SecureChatty['user']->isLoggedIn()) {
	echo $controller->getPage('login');
} else {
	echo $controller->getPage('home');
}