<?php
class Request
{
	public $class = null;
	public $method = null;
	public $arguments = array();

	public function canBeProcessed()
	{
		if($this->class == null || $this->method == null)
			return false;
		else
			return true;
	}
}
?>
