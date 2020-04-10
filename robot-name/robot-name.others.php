<?php

// Simplest - change of collision - very small
class Robot
{
	private $name;

	public function __construct()
	{
		$this->reset();
	}

	public function getName()
	{
		return $this->name;
	}

	public function reset()
	{
		$this->name = chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999);
	}
}
