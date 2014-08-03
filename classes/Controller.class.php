<?php

namespace classes;

class Controller
{
	public function getPage($page, $header = true)
	{
		switch ($page)
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
