<?php

namespace classes;

class User {
	private $id;
	private $username;
	private $loggedin;
	private static $session;

	public function __construct($id = false)
	{
		if ($id === false) {
			session_start();
			$this->loggedin = !empty($_SESSION['id']);

			if ($this->loggedin) {
				$this->id = $_SESSION['id'];
				$this->username = $_SESSION['username'];
			}

			self::$session = $_SESSION;
			session_write_close();
		}
	}

	public static function getUserByUsername($username)
	{
		$db = new DB();
		$user = $db->prepare(
			"SELECT id
			 FROM users
			 WHERE username = :username"
		);

		$user->execute(array(':username' => $username));

		if ($user->rowCount() !== 0) {
			$results = $user->fetch(\PDO::FETCH_ASSOC);
			return new User($results['id']);
		} else {
			return false;
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

	public static function getSession($variable)
	{
		if (empty(self::$session[$variable])) {
			return false;
		}

		return self::$session[$variable];
	}

	public static function setSession($variable, $value)
	{
		session_start();
		$_SESSION[$variable] = $value;
		session_write_close();

		self::$session[$variable] = $value;
	}
}