<?php

namespace pages;

class Home extends \classes\TplController
{
	public $filename = 'home.php';

	public function getOutput($variables = array())
	{
		$messages = new \classes\Messages();
		$variables['unreadMessages'] = $messages->getUnread();

		return parent::getOutput($variables);
	}
}