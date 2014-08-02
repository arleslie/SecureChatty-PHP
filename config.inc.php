<?php

try {
	$db = new PDO('mysql:host=localhost;dbname=messenger', 'messenger', 'CrH4KJPNY6WxWHNc');
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
	die('Site is currently experecing problems.');
}

session_start();
