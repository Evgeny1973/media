<?php

namespace App\Model\Media\UseCase\Update;

use App\Model\Media\Entity\Media;
use Symfony\Component\Validator\Constraints as Assert;

class Command
{
	/**
	 * @Assert\NotBlank()
	 */
	public $companyName;

	/**
	 * @Assert\NotBlank()
	 */
	public $mediaName;

	public $budget;

	/**
	 * @var \DateTime | null
	 */
	public $publishingDate;

	/**
	 * @var Media
	 */
	public $media;

	public function __construct(Media $media)
	{
		$this->mediaName = $media->getMediaName();
		$this->companyName = $media->getCompanyName();
		$this->budget = $media->getBudget();
		$this->publishingDate = $media->getPublishingDate();
		$this->media = $media;
	}
}
