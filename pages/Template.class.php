<?php

namespace pages;

class Template extends \classes\TplController
{
	public $filename;

	public function getHeader()
	{
		$this->filename = 'header.php';
		return $this->getOutput();
	}

	public function getFooter()
	{
		$this->filename = 'footer.php';
		return $this->getOutput();
	}
}
