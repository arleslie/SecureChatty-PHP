<?php

namespace classes;

class DB extends \PDO
{
	public function __construct()
	{
		$details = Config::get('Database');

		set_exception_handler(array(__CLASS__, 'error_handler'));
		parent::__construct("mysql:host={$details['host']};dbname={$details['name']}", $details['user'], $details['password']);
		restore_exception_handler();
	}

	public static function error_handler()
	{
		die("An error has occurred.");
	}
}