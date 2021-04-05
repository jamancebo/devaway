<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Infrastructure\Repository\Persistence\Doctrine\CustomType\Competition;

use DevAway\KartCompetition\Competition\Domain\ValueObject\Points;
use DevAway\KartCompetition\Shared\Infrastructure\Repository\Doctrine\CustomType\IntegerCustomType;

class PointsType extends IntegerCustomType
{
    /**
     * @inheritDoc
     */
    protected function typeClassName(): string
    {
        return Points::class;
    }
}