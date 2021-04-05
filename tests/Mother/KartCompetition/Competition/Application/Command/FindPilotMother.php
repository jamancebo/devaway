<?php

declare(strict_types=1);

namespace DevAway\Tests\Mother\KartCompetition\Competition\Application\Command;

use DevAway\KartCompetition\Competition\Application\Command\FindPilot;
use DevAway\KartCompetition\Competition\Domain\ValueObject\IdPilot;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\IdPilotMother;

class FindPilotMother
{
    /**
     * @param IdPilot $id
     * @return FindPilot
     */
    public static function create(IdPilot $id): FindPilot
    {
        return new FindPilot($id->value());
    }

    /**
     * @return FindPilot
     */
    public static function random(): FindPilot
    {
        return self::create(IdPilotMother::random());
    }
}
