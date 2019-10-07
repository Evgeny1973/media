<?php

namespace App\Model\Media\UseCase\Delete;

use App\Model\Flusher;
use App\Model\Media\Entity\MediaRepository;

class Handler
{
	/**
	 * @var Flusher
	 */
	protected $flusher;
	/**
	 * @var MediaRepository
	 */
	protected $medias;

	public function __construct(Flusher $flusher, MediaRepository $medias)
	{
		$this->flusher = $flusher;
		$this->medias = $medias;
	}

	public function handle(Command $command)
	{
		$this->medias->remove($command->media);
		$this->flusher->flush();
	}
}
