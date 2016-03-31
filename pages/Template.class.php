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
		$this->variables['active'] = array(
			'messages' => empty($_GET['page']) || $_GET['page'] == 'messages' ? 'active' : '',
			'compose' => !empty($_GET['page']) && $_GET['page'] == 'compose' ? 'active' : '',
			'settings' => !empty($_GET['page']) && $_GET['page'] == 'settings' ? 'active' : ''
		);

		return $this->getOutput();
	}

	public function getFooter()
	{
		$this->filename = 'footer.php';
		return $this->getOutput();
	}
}
