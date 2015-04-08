<?php

namespace classes;

class TplController
{
	public function getOutput($variables = array())
	{
		if (!empty($variables)) {
			foreach ($variables as $k => $v) {
				$$k = $v;
			}
		}

		ob_start();
		include("templates/{$this->filename}");
		return ob_get_clean();
	}
}