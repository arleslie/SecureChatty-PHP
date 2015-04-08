<?php

namespace classes;

class DB extends \PDO
{
	private $dbHost;
	private $dbName;
	private $dbUser;
	private $dbPass;
	protected $connection = null;

	public function __construct()
	{
		include('config.inc.php');

		$this->dbHost = $dbHost;
		$this->dbName = $dbName;
		$this->dbUser = $dbUser;
		$this->dbPass = $dbPass;

		set_exception_handler(array(__CLASS__, 'error_handler'));
		parent::__construct("mysql:host={$this->dbHost};dbname={$this->dbName}", $this->dbUser, $this->dbPass);
		restore_exception_handler();
	}

	public static function error_handler()
	{
		die("An error has occurred.");
	}
}