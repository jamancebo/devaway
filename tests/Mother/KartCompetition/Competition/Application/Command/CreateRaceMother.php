<?php

declare(strict_types=1);

namespace DevAway\Tests\Mother\KartCompetition\Competition\Application\Command;

use DevAway\KartCompetition\Competition\Application\Command\CreateRace;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\IdPilotMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\LapsMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\RaceNameMother;

class CreateRaceMother
{
    /**
     * @param string $name
     * @param string $idPilot
     * @param array $laps
     * @return CreateRace
     */
    public static function create(
        string $name,
        string $idPilot,
        array $laps
    ): CreateRace {
        return new CreateRace(
            $name,
            $idPilot,
            $laps
        );
    }

    public static function random()
    {
        return self::create(
            RaceNameMother::random()->value(),
            IdPilotMother::random()->value(),
            LapsMother::random()->values()
        );
    }
}
