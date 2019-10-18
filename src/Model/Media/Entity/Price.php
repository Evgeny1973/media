<?php

namespace App\Model\Media\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Embeddable()
 * Class Price
 * @package App\Model\Media\Entity
 */
class Price
{
	public const ONE = 381500;
	public const HALF = 192500;
	public const FOUR_TENTHS = 153100;
	public const THREE_TENTHS = 114100;
	public const ONE_FOURTH = 101500;
	public const TWO_TENTHS = 82500;
	public const THREE_TWENTIES = 62500;
	public const ONE_EIGHTH = 5500;
	public const ONE_TENTHS = 41600;
	public const THREE_FORTIES = 31100;
	public const ONE_TWENTIES = 21500;
	public const ONE_FORTIES = 13000;

	/**
	 * @ORM\Column(type="bigint", nullable=false)
	 * @var int
	 */
	protected $price;

	public function __construct(int $price)
	{
		$this->price = $price;
	}

	/**
	 * @return int
	 */
	public function getPrice(): int
	{
		return $this->price;
	}

	public static function toArray(): array
	{
		return [
			self::ONE,
			self::HALF,
			self::FOUR_TENTHS,
			self::THREE_TENTHS,
			self::ONE_FOURTH,
			self::TWO_TENTHS,
			self::THREE_TWENTIES,
			self::ONE_EIGHTH,
			self::ONE_TENTHS,
			self::THREE_FORTIES,
			self::ONE_TWENTIES,
			self::ONE_FORTIES,
		];
	}
}
