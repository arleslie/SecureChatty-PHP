<?php

namespace pages;

class Login extends \classes\TplController
{
	private $db;
	public $filename;

	public function __construct($db)
	{
		$this->db = $db;
		$this->filename = 'loginForm.php';

		if (empty($_SESSION['id']) && !empty($_POST['username']) && !empty($_POST['password'])) {
			$this->checkLogin($_POST['username'], $_POST['password']);
		}

		if (!empty($_GET['logout'])) {
			session_start();
			session_destroy();
			header('Location: index.php');
			die();
		}
	}

	private function checkLogin($username, $password)
	{
		$check = $this->db->prepare(
			"SELECT id, username
			 FROM users
			 WHERE username = :username AND password = :password"
		);

		$check->execute(array(
			':username' => $username,
			':password' => hash('sha256', $password . md5($username))
		));

		$results = $check->fetch(\PDO::FETCH_ASSOC);

		if (!empty($results['id'])) {
			session_start();
			$_SESSION['id'] = $results['id'];
			$_SESSION['key'] = hash('sha512', hash('sha256', $password . md5($username)));
			$_SESSION['username'] = $results['username'];
			header('Location: index.php');
			die();
		}
	}
}
