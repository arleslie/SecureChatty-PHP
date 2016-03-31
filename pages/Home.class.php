<?php

namespace pages;

class Home extends \classes\TplController
{
	public $filename = 'home.php';

	public function __construct()
	{
		parent::__construct();
		$messages = new \classes\Messages();

		$this->variables['alert'] = array(
			'success' => array(),
			'error' => array()
		);

		if (!empty($_POST['to']) && !empty($_POST['message'])) {
			if ($messages->send($_POST['to'], $_POST['subject'], $_POST['message'])) {
				$this->variables['alert']['success'][] = "Message sent successfully.";
			} else {
				$this->variables['alert']['error'][] = "Message was unable to be sent.";
			}
		}

		$this->variables['unreadMessages'] = $messages->getUnread();
	}
}