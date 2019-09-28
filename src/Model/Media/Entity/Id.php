<?php

namespace App\Model\Media\Entity;

use Ramsey\Uuid\Uuid;

class Id
{

	private $value;

	public function __construct(string $value)
	{
		$this->value = $value;
	}

	public static function next()
	{
		return new self(Uuid::uuid4()->toString());
	}

	public function getValue()
	{
		return $this->value;
	}

	public function __toString()
	{
		return $this->value;
	}
}
