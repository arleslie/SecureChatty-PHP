<?php

namespace classes\ajax;

class Registration extends Ajax
{
	protected $return = array();

	public function __construct($requests = array())
	{
		foreach ($requests as $func => $request) {
			$this->return[$func] = $this->$func($request);
		}
	}

	private function checkUsername($username)
	{
		if (\classes\User::getUserByUsername($username) !== false) {
			return 0;
		}

		$badCharacters = array(
			',',
			';',
			'@',
			'"',
			'\'',
			'%',
			'*',
			'&'
		);

		foreach ($badCharacters as $character) {
			if (stripos($username, $character) !== false) {
				return 0;
			}
		}

		return 1;
	}
}