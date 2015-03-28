<?php

namespace pages;

class Login
{
	private $db;

	public function __construct()
	{
		global $db;
		$this->db = $db;

		if (empty($_SESSION['id']) && !empty($_POST['username']) && !empty($_POST['password'])) {
			$this->checkLogin($_POST['username'], $_POST['password']);
		}
	}

	public function getOutput()
	{
		return include('templates/loginForm.php');
	}

	private function checkLogin($username, $password)
	{
		$check = $this->db->prepare(
			"SELECT id
			 FROM users
			 WHERE username = :username AND password = :password"
		);

		$check->execute(array(
			':username' => $username,
			':password' => hash('sha256', $password . md5($username))
		));

		$results = $check->fetch(\PDO::FETCH_ASSOC);

		if (!empty($results['id'])) {
			$_SESSION['id'] = $results['id'];
			$_SESSION['key'] = hash('sha512', hash('sha256', $password . md5($username)));
		}
	}
}
