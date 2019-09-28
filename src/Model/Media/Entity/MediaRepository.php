<?php

namespace App\Model\Media\Entity;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class MediaRepository
{
	/**
	 * @var EntityManagerInterface
	 */
	protected $em;

	/**
	 * @var EntityRepository
	 */
	private $repository;

	public function __construct(EntityManagerInterface $em)
	{
		$this->repository = $em->getRepository(Media::class);
		$this->em = $em;
	}

	public function add(Media $media)
	{
		$this->em->persist($media);
	}

	public function findOneByMediaName(string $name)
	{
		return $this->repository->findOneBy(['mediaName' => $name]);
	}
}
