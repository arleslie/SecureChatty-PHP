<?php

namespace classes;

class User {
	private $db;
	private $id;
	private $username;
	private $loggedin;

	public function __construct($id = false)
	{	global $db;
		$this->db = $db;

		if ($id === false) {
			$this->loggedin = !empty($_SESSION['id']);

			if ($this->loggedin) {
				$this->id = $_SESSION['id'];
				$this->username = $_SESSION['username'];
			}
		}
	}

	public function isLoggedin()
	{
		return $this->loggedin;
	}
}