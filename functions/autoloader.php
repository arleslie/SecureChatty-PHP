<?php

function autoloader($class)
{
	$file = str_replace('\\', '/', $class).'.class.php';
	if (file_exists($file)) {
		require $file;
	}
}

spl_autoload_register('autoloader');
