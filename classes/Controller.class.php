<?php

namespace classes;

class Controller
{
	private $db;
	private $user;

	public function __construct()
	{
		$this->db = new DB();
		$this->user = new User(); // Grab the session information
	}

	public function getPage($page, $header = true)
	{
		if (!$this->user->isLoggedIn()) {
			$page = 'login';
		}

		switch ($page)
		{
			case 'logout':
				$_GET['logout'] = 1;
			case 'login':
				$page = new \pages\Login($this->db); // This file also opens the session to store login info.
				break;
			case 'compose':
				$page = new \pages\Compose();
				break;
			case 'home':
			default:
				$page = new \pages\Home();
				break;
		}

		$output = $page->getOutput();

		if ($header) {
			$template = new \pages\Template($this->user);
			$output = $template->getHeader() . $output . $template->getFooter();
		}

		return $output;
	}

	public function getAjax($requests)
	{
		$returns = array();
		foreach ($requests as $class => $request) {
			if (class_exists("\\classes\\ajax\\{$class}", true)) {
				$class2 = "\\classes\\ajax\\$class";
				$abcd = new $class2($request);
				$returns[$class] = $abcd->getReturn();
			}
		}

		return json_encode($returns);
	}
}
