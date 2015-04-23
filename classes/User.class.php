<?php

namespace classes;

class User {
	private $id;
	private $username;
	private $loggedin;

	public function __construct($id = false)
	{
		if ($id === false) {
			session_start();
			$this->loggedin = !empty($_SESSION['id']);

			if ($this->loggedin) {
				$this->id = $_SESSION['id'];
				$this->username = $_SESSION['username'];
			}
			session_write_close();
		}
	}

	public function getId()
	{
		return intval($this->id);
	}

	public function getUsername()
	{
		return $this->username;
	}

	public function isLoggedin()
	{
		return $this->loggedin;
	}
}