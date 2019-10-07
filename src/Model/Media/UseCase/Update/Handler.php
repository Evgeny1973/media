<?php

namespace App\Model\Media\UseCase\Update;

use App\Model\Flusher;

class Handler
{
	/**
	 * @var Flusher
	 */
	protected $flusher;

	public function __construct(Flusher $flusher)
	{
		$this->flusher = $flusher;
	}

	public function handle(Command $command)
	{
		$command->media->edit($command->mediaName, $command->companyName, \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $command->publishingDate->format('Y-m-d H:i:s')), $command->budget);
		$this->flusher->flush();
	}
}
