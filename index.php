<?php

require('config.inc.php');
require('classes/Controller.class.php');
require('classes/Encryption.class.php');

$controller = new messenger\Controller();

echo $controller->getPage('loginForm');
