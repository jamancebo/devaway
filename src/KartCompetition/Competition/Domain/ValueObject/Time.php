<?php

declare(strict_types=1);

namespace DevAway\KartCompetition\Competition\Domain\ValueObject;

use DevAway\KartCompetition\Shared\Domain\ValueObject\StringValueObject;

class Time extends StringValueObject
{
    public const INITIAL = "00:00:00.0000";
}
