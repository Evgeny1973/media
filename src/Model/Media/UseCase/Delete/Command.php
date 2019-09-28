<?php

namespace App\Model\Media\UseCase\Delete;

use App\Model\Media\Entity\Media;

class Command
{

	public $media;

	public function __construct(Media $media)
	{
		$this->media = $media;
	}
}
