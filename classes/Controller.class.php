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
			default:
			case 'login':
				$page = new \pages\Login();
				break;
		}

		$output = $page->getOutput();

		if ($header) {
			$template = new \pages\Template();
			$output = $template->getHeader() . $output . $template->getFooter();
		}

		return $output;
	}
}
