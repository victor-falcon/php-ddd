<?php

declare(strict_types=1);

namespace Cal\Shared\Infrastructure\Persistence\Doctrine;

use Cal\Shared\Domain\Utils;
use Cal\Shared\Domain\ValueObject\Uuid;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

abstract class NullableStringType extends StringType implements DoctrineCustomType
{
    abstract protected function typeClassName(): string;

    public function getName(): string
    {
        return self::customTypeName();
    }

    public static function customTypeName(): string
    {
        $nameSpace = explode('\\', static::class);

        return Utils::toSnakeCase(str_replace('Type', '', end($nameSpace)));
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        $className = $this->typeClassName();

        return new $className($value);
    }

    /** @var Uuid */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value->value();
    }
}
