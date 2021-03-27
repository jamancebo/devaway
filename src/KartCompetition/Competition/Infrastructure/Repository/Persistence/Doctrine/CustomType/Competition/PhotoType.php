<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Infrastructure\Repository\Persistence\Doctrine\CustomType\Competition;

use DevAway\KartCompetition\Competition\Domain\ValueObject\Photo;
use DevAway\KartCompetition\Shared\Infrastructure\Repository\Doctrine\CustomType\StringCustomType;

class PhotoType extends StringCustomType
{
    /**
     * @inheritDoc
     */
    protected function typeClassName(): string
    {
        return Photo::class;
    }
}
