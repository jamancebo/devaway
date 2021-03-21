<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Shared\Infrastructure\Repository\Doctrine\CustomType;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\IntegerType;

abstract class IntegerCustomType extends IntegerType
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return self::customTypeName();
    }

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return integer;
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return is_integer($value) ? $value : $value->value();
    }

    /**
     * @param mixed $value
     * @param AbstractPlatform $platform
     * @return mixed
     */
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (is_integer($value)) {
            return $this->typeClassName()::fromInt($value);
        }
        return $this->typeClassName()::fromString($value);
    }

    /**
     * @return string
     */
    public static function customTypeName(): string
    {
        return (new \ReflectionClass(static::class))->getShortName();
    }

    /**
     * @return string
     */
    abstract protected function typeClassName(): string;
}
