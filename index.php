<?php

error_reporting(E_ALL);

require('config.inc.php');

$controller = new classes\Controller();
$SecureChatty = array(
	'user' => new classes\User()
);

if (!$SecureChatty['user']->isLoggedIn()) {
	echo $controller->getPage('login');
} else {
	echo $controller->getPage('home');
}