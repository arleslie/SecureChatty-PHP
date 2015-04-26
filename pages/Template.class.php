<?php

namespace pages;

class Template extends \classes\TplController
{
	public $filename;
	private $user;

	public function __construct($user)
	{
		parent::__construct();
		$this->user = $user;
	}


	public function getHeader()
	{
		$this->filename = 'header.php';

		$this->variables['loggedin'] = $this->user->isLoggedin();
		return $this->getOutput();
	}

	public function getFooter()
	{
		$this->filename = 'footer.php';
		return $this->getOutput();
	}
}
