<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Infrastructure\Repository\Persistence\Doctrine\CustomType\Competition;

use DevAway\KartCompetition\Competition\Domain\ValueObject\Team;
use DevAway\KartCompetition\Shared\Infrastructure\Repository\Doctrine\CustomType\StringCustomType;

class TeamType extends StringCustomType
{
    /**
     * @inheritDoc
     */
    protected function typeClassName(): string
    {
        return Team::class;
    }
}

