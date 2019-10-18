<?php

namespace App\Model\Media\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="medias", indexes={
 * 		@ORM\Index(columns={"date"}),
 *      @ORM\Index(columns={"media_name"})
 *     })
 */
class Media
{
	/**
	 * @var Id
	 * @ORM\Column(type="media_id_type")
	 * @ORM\Id()
	 */
	private $id;

	/**
	 * @var string
	 * @ORM\Column(type="string", nullable=false)
	 */
	private $mediaName;

	/**
	 * @var string
	 * @ORM\Column(type="string", nullable=false)
	 */
	private $companyName;

	/**
	 * @var int | null
	 * @ORM\Column(type="integer", nullable=true)
	 */
	private $budget;

	/**
	 * @var \DateTimeImmutable
	 * @ORM\Column(type="datetime_immutable", nullable=true)
	 */
	private $publishingDate;

	/**
	 * @var \DateTimeImmutable
	 * @ORM\Column(type="datetime_immutable", nullable=true)
	 */
	private $date;

	/**
	 * @ORM\Embedded(class=Format::class, columnPrefix=false)
	 * @var Format
	 */
	private $format;

	/**
	 * @ORM\Embedded(class=Price::class, columnPrefix=false)
	 * @var Price
	 */
	private $price;

	public function __construct(
		Id $id,
		string $mediaName,
		string $companyName,
		\DateTimeImmutable $publishingDate,
		Format $format,
		Price $price
	) {
		$this->id = $id;
		$this->mediaName = $mediaName;
		$this->companyName = $companyName;
		$this->publishingDate = $publishingDate;
		$this->date = new \DateTimeImmutable('now', new \DateTimeZone('Europe/Moscow'));
		$this->format = $format;
		$this->price = $price;
	}

	/**
	 * @return Id
	 */
	public function getId(): Id
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getMediaName(): string
	{
		return $this->mediaName;
	}

	/**
	 * @return string
	 */
	public function getCompanyName(): string
	{
		return $this->companyName;
	}

	/**
	 * @return int|null
	 */
	public function getBudget(): ?int
	{
		return $this->budget;
	}

	/**
	 * @return \DateTimeImmutable
	 */
	public function getPublishingDate(): \DateTimeImmutable
	{
		return $this->publishingDate;
	}

	/**
	 * @return \DateTimeImmutable
	 */
	public function getDate(): \DateTimeImmutable
	{
		return $this->date;
	}

	/**
	 * @return Format
	 */
	public function getFormat(): Format
	{
		return $this->format;
	}

	/**
	 * @return Price
	 */
	public function getPrice(): Price
	{
		return $this->price;
	}

	public function edit(
		string $mediaName,
		string $companyName,
		\DateTimeImmutable $publishingDate,
		?int $budget = null
	) {
		$this->mediaName = $mediaName;
		$this->companyName = $companyName;
		$this->publishingDate = $publishingDate;
		$this->date = new \DateTimeImmutable('now', new \DateTimeZone('Europe/Moscow'));
		$this->budget = $budget;
	}
}
