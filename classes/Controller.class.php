<?php

namespace messenger;

class Controller
{
	public function getPage($page)
	{
		return file_get_contents("pages/{$page}.php");
	}
}
