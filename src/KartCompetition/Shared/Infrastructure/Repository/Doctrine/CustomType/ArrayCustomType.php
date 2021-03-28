<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Shared\Infrastructure\Repository\Doctrine\CustomType;

use DevAway\KartCompetition\Competition\Domain\ValueObject\Laps;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ArrayType;

abstract class ArrayCustomType extends ArrayType
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return self::customTypeName();
    }

    /**
     * @param array $value
     * @param AbstractPlatform $platform
     * @return Laps
     */
    public function convertToPHPValue($value, AbstractPlatform $platform): Laps
    {
        $array[] = $value;
        return $this->typeClassName()::fromValues($array);
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