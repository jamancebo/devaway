<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Infrastructure\Repository\Persistence\Doctrine\CustomType\Competition;

use DevAway\KartCompetition\Competition\Domain\ValueObject\Laps;
use DevAway\KartCompetition\Shared\Infrastructure\Repository\Doctrine\CustomType\ArrayCustomType;

class LapsType extends ArrayCustomType
{
    /**
     * @inheritDoc
     */
    protected function typeClassName(): string
    {
        return Laps::class;
    }
}
