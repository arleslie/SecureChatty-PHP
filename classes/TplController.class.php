<?php

namespace classes;

class TplController
{
	public function getOutput()
	{
		ob_start();
		include("templates/{$this->filename}");
		return ob_get_clean();
	}
}