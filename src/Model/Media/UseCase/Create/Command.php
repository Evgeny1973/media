<?php

namespace App\Model\Media\UseCase\Create;


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
}
