<?php

declare(strict_types=1);

namespace DevAway\Tests\Mother\KartCompetition\Competition\Application\Command;

use DevAway\KartCompetition\Competition\Application\Command\CreatePilot;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\AgeMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\IdMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\PhotoMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\PilotNameMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\TeamMother;

class CreatePilotMother
{
    /**
     * CreatePilot constructor.
     * @param string $id
     * @param string $photo
     * @param string $team
     * @param string $name
     * @param int $age
     * @return CreatePilot
     */
    public static function create(
        string $id,
        string $photo,
        string $team,
        string $name,
        int $age
    ) {
        return new CreatePilot(
            $id,
            $photo,
            $team,
            $name,
            $age
        );
    }

    /**
     * @return CreatePilot
     */
    public static function random()
    {
        return self::create(
            IdMother::random()->value(),
            PhotoMother::random()->value(),
            TeamMother::random()->value(),
            PilotNameMother::random()->value(),
            AgeMother::random()->value()
        );
    }
}
