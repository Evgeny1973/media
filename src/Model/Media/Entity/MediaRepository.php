<?php

namespace App\Model\Media\Entity;

use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Knp\Component\Pager\PaginatorInterface;

class MediaRepository
{
	/**
	 * @var EntityManagerInterface
	 */
	protected $em;
	/**
	 * @var Connection
	 */
	protected $connection;
	/**
	 * @var PaginatorInterface
	 */
	protected $paginator;

	/**
	 * @var EntityRepository
	 */
	private $repository;

	public function __construct(EntityManagerInterface $em, Connection $connection, PaginatorInterface $paginator)
	{
		$this->repository = $em->getRepository(Media::class);
		$this->em = $em;
		$this->connection = $connection;
		$this->paginator = $paginator;
	}

	public function add(Media $media)
	{
		$this->em->persist($media);
	}

	public function findOneByMediaName(string $name)
	{
		return $this->repository->findOneBy(['mediaName' => $name]);
	}

	public function all(int $page, int $limit,string $sort, string $direction)
	{
		$qb = $this->connection->createQueryBuilder()
			->select('m.id', 'm.media_name AS mediaName',
				'm.company_name AS companyName','m.budget')
			->from('medias', 'm');
		$qb->orderBy($sort, $direction === 'asc' ? 'asc' : 'desc');
		return $this->paginator->paginate($qb, $page, $limit);
	}
}
