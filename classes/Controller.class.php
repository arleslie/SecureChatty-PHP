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

	public function getPage($requested, $header = true)
	{
		if (!$this->user->isLoggedIn()) {
			$requested = 'login';
		}

		switch ($requested)
		{
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
