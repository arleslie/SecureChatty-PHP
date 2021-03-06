<?php

namespace classes;

class TplController
{
	private static $theme = 'default';
	protected $variables = array();

	// @todo: have the theme options automatically called without parent::__construct
	public function __construct()
	{
		if (!empty($_GET['theme'])) {
			switch ($_GET['theme']) {
				case 'non-js':
					User::setSession('theme', 'non-js');
					break;
				default:
					User::setSession('theme', 'default');
					break;
			}
		}

		if (!empty(User::getSession('theme'))) {
			self::$theme = User::getSession('theme');
		}
	}

	public function getOutput()
	{
		foreach ($this->variables as $k => $v) {
			$$k = $v;
		}

		$theme = self::$theme;

		ob_start();
		include("templates/{$theme}/{$this->filename}");
		return ob_get_clean();
	}
}