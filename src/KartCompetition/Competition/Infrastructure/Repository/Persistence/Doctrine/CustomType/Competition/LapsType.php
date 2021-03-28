<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Infrastructure\Repository\Persistence\Doctrine\CustomType\Competition;

use DevAway\KartCompetition\Competition\Domain\ValueObject\Laps;
use DevAway\KartCompetition\Shared\Infrastructure\Repository\Doctrine\CustomType\ArrayCustomType;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class LapsType extends ArrayCustomType
{
    /**
     * @inheritDoc
     */
    protected function typeClassName(): string
    {
        return Laps::class;
    }

    /**
     * {@inheritdoc}
     */
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        $array = [];
        foreach ($value as $item) {
            $array[] = $item->value();
        }
        return json_encode($array);
    }
}
