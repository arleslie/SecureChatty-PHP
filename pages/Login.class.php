<?php

namespace pages;

class Login extends \classes\TplController
{
	private $db;
	public $filename;

	public function __construct($db)
	{
		parent::__construct();

		$this->db = $db;
		$this->filename = 'loginForm.php';

		$registerTab = !empty($_GET['tab']) && $_GET['tab'] == 'register';
		if (empty($_SESSION['id']) && $registerTab && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['password2'])) {
			$this->register($_POST['username'], $_POST['password'], $_POST['password2']);
		}

		$signinTab = empty($_GET['tab']) || $_GET['tab'] == 'signin';
		if (empty($_SESSION['id']) && $signinTab && !empty($_POST['username']) && !empty($_POST['password'])) {
			$this->checkLogin($_POST['signinUsername'], $_POST['signinPassword']);
		}

		if (!empty($_GET['logout'])) {
			session_start();
			session_destroy();
			header('Location: index.php');
			die();
		}

		$this->variables['tab'] = 'login';
		if ($registerTab) {
			$this->variables['tab'] = 'register';
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

	private function register($username, $password, $password2)
	{
		$userCheck = new \classes\ajax\Registration(array('checkUsername' => $username));
		if ($userCheck->getReturn()['checkUsername'] !== 1) {
			$this->variables['errors']['registration'] = "Invalid Username.";
			return false;
		}

		if ($password !== $password2) {
			$this->variables['errors']['registration'] = "Passwords do not match.";
			return;
		}

		$register = $this->db->prepare(
			"INSERT INTO users (username, password)
			 VALUES (:username, :password)"
		);

		$register->execute(array(':username' => $username, ':password' => hash('sha256', $password. md5($username))));

		$this->checkLogin($username, $password);
	}

}
