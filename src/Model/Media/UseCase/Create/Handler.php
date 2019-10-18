<?php

namespace App\Model\Media\UseCase\Create;

use App\Model\Flusher;
use App\Model\Media\Entity\Format;
use App\Model\Media\Entity\Id;
use App\Model\Media\Entity\Media;
use App\Model\Media\Entity\MediaRepository;
use App\Model\Media\Entity\Price;

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
		if ($command->budget < 0) {
			throw new \DomainException('Бюджет не может быть меньше 0.');
		}
		$formats = Format::toArray();
		$prices = Price::toArray();

		$this->medias->add(new Media(
			Id::next(),
			$command->mediaName,
			$command->companyName,
			\DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $command->publishingDate->format('Y-m-d H:i:s')),
			new Format($formats[$command->format]),
			new Price($prices[$command->price])
		));
		$this->flusher->flush();
	}
}
