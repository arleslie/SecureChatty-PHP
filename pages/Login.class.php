<?php

namespace pages;

class Login
{
	private $db;

	public function __construct()
	{
		global $db;
		$this->db = $db;
	}

	public function getOutput()
	{
		return file_get_contents('templates/loginForm.html');
	}
}
