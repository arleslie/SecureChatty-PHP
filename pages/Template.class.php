<?php

namespace pages;

class Template extends \classes\TplController
{
	public $filename;
	private $user;

	public function __construct($user)
	{
		$this->user = $user;
	}


	public function getHeader()
	{
		$this->filename = 'header.php';

		return $this->getOutput(array(
			'loggedin' => $this->user->isLoggedin()
		));
	}

	public function getFooter()
	{
		$this->filename = 'footer.php';
		return $this->getOutput();
	}
}
