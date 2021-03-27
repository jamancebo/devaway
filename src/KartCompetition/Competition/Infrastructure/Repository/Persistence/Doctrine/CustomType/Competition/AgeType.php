<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Infrastructure\Repository\Persistence\Doctrine\CustomType\Competition;

use DevAway\KartCompetition\Competition\Domain\ValueObject\Age;
use DevAway\KartCompetition\Shared\Infrastructure\Repository\Doctrine\CustomType\IntegerCustomType;

class AgeType extends IntegerCustomType
{
    /**
     * @inheritDoc
     */
    protected function typeClassName(): string
    {
        return Age::class;
    }
}
