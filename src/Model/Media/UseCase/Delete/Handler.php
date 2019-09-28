<?php

namespace App\Model\Media\UseCase\Delete;

use Doctrine\ORM\EntityManagerInterface;

class Handler
{

	/**
	 * @var EntityManagerInterface
	 */
	protected $em;

	public function __construct(EntityManagerInterface $em)
	{

		$this->em = $em;
	}

	public function handle(Command $command)
	{
		$this->em->remove($command->media);
		$this->em->flush();
	}
}
