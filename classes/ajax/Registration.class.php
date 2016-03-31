<?php

namespace classes\ajax;

class Registration extends Ajax
{
	protected $return = array();

	private static $badCharacters = array(
		',',
		';',
		'@',
		'"',
		'\'',
		'%',
		'*',
		'&'
	);

	private static $badUsernames = array(
		'test', // Reserved for Unit Testing.
		'administrator',
		'root',
		'admin'
	);

	public function __construct($requests = array())
	{
		foreach ($requests as $func => $request) {
			$this->return[$func] = $this->$func($request);
		}
	}

	private function checkUsername($username)
	{
		foreach (self::$badCharacters as $character) {
			if (stripos($username, $character) !== false) {
				return 0;
			}
		}

		if (in_array($username, self::$badUsernames)) {
			return 0;
		}

		if (\classes\User::getUserByUsername($username) !== false) {
			return 0;
		}

		return 1;
	}
}