<?php

namespace pages;

class Home extends \classes\TplController
{
	public $filename = 'home.php';

	public function __construct()
	{
		$messages = new \classes\Messages();
		$variables['unreadMessages'] = $messages->getUnread();
	}
}