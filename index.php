<?php

error_reporting(E_ALL);

session_start();
include 'functions/autoloader.php';
$controller = new classes\Controller(); // The controller will handle the config info and manage DB access & Session Information.
session_write_close(); // This way the user can have multiple requests going on at the same time.

// The controller will override the page if the user isn't logged in.
echo $controller->getPage('home');