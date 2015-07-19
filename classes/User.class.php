<?php

namespace classes;

class User {
	private $id;
	private $username;
	private $loggedin;
	private $publickey;
	private $privatekey;
	private static $session;

	public function __construct($id = false)
	{
		if ($id === false) {
			session_start();
			$this->loggedin = !empty($_SESSION['id']);

			if ($this->loggedin) {
				$this->id = $id = $_SESSION['id'];
			}

			self::$session = $_SESSION;
			session_write_close();
		}

		$db = new DB();
		$user = $db->prepare(
			"SELECT id, username, publickey, privatekey
			 FROM users
			 WHERE id = :id"
		);

		$user->execute(array(':id' => $id));
		$user = $user->fetch(\PDO::FETCH_ASSOC);

		$this->id = $user['id'];
		$this->username = $user['username'];
		$this->publickey = $user['publickey'];
		$this->privatekey = $user['privatekey'];
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

	public function getPublickey()
	{
		return $this->publickey;
	}

	public function getPrivatekey()
	{
		return $this->privatekey;
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