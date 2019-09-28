<?php

namespace App\Model\Media\UseCase\Create;

use App\Model\Media\Entity\Id;
use App\Model\Media\Entity\Media;
use App\Model\Media\Entity\MediaRepository;
use Doctrine\ORM\EntityManagerInterface;

class Handler
{

	/**
	 * @var EntityManagerInterface
	 */
	protected $em;
	/**
	 * @var MediaRepository
	 */
	protected $medias;

	public function __construct(EntityManagerInterface $em, MediaRepository $medias)
	{
		$this->em = $em;
		$this->medias = $medias;
	}

	public function handle(Command $command)
	{
		if ($command->budget < 0) {
			throw new \DomainException('Бюджет не может быть меньше 0.');
		}
		$this->medias->add(new Media(
			Id::next(),
			$command->mediaName,
			$command->companyName,
			\DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $command->publishingDate->format('Y-m-d H:i:s')),
			$command->budget
		));
		$this->em->flush();
	}
}
