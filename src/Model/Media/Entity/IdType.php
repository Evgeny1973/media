<?php

namespace App\Model\Media\Entity;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class IdType extends GuidType
{
	public const NAME = 'media_id_type';

	public function getName()
	{
		return self::NAME;
	}

	public function requiresSQLCommentHint(AbstractPlatform $platform): bool
	{
		return true;
	}

	public function convertToPHPValue($value, AbstractPlatform $platform)
	{
		return !empty($value) ? new Id($value) : null;
	}

	public function convertToDatabaseValue($value, AbstractPlatform $platform)
	{
		return $value instanceof Id ? $value->getValue() : $value;
	}
}
