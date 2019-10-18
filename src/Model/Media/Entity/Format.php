<?php

namespace App\Model\Media\Entity;

use Doctrine\ORM\Mapping as ORM;
use Webmozart\Assert\Assert;

/**
 * @ORM\Embeddable()
 * Class Format
 * @package App\Model\Media\Entity
 */
class Format
{
	public const ONE = '1';
	public const HALF = '1/2';
	public const FOUR_TENTHS = '4/10';
	public const THREE_TENTHS = '3/10';
	public const ONE_FOURTH = '1/4';
	public const TWO_TENTHS = '2/10';
	public const THREE_TWENTIES = '3/20';
	public const ONE_EIGHTH = '1/8';
	public const ONE_TENTHS = '1/10';
	public const THREE_FORTIES = '3/40';
	public const ONE_TWENTIES = '1/20';
	public const ONE_FORTIES = '1/40';

	/**
	 * @ORM\Column(name="format", type="string", nullable=false)
	 * @var string
	 */
	private $value;

	public function __construct(string $value)
	{
		Assert::oneOf($value, [
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
		]);
		$this->value = $value;
	}

	/**
	 * @return string
	 */
	public function getValue(): string
	{
		return $this->value;
	}

	public function __toString(): string
	{
		return $this->value;
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
