<?php

namespace classes;

class Config
{
	private static $loadedConfig = array();

	public static function get($item)
	{
		if (empty(self::$loadedConfig)) {
			self::loadConfig();
		}

		return self::$loadedConfig[$item];
	}

	private static function loadConfig()
	{
		self::$loadedConfig = parse_ini_file('config.ini', true);
	}
}