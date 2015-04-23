<?php

namespace classes;

class Config
{
	private static $loadedConfig = array();

	public function get($item)
	{
		if (empty($loadedConfig)) {
			self::loadConfig();
		}

		return $loadedConfig[$item];
	}

	private static function loadConfig()
	{
		self::$loadedConfig = parse_ini_file('../config.ini', true);
	}
}