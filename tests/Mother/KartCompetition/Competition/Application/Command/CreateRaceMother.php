<?php

declare(strict_types=1);

namespace DevAway\Tests\Mother\KartCompetition\Competition\Application\Command;

use DevAway\KartCompetition\Competition\Application\Command\CreateRace;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\IdMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\IdPilotMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\PointsMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\RaceNameMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\TimeMother;

class CreateRaceMother
{
    /**
     * @param string $id
     * @param string $time
     * @param int $points
     * @param string $name
     * @param string $idPilot
     * @param string $bestTime
     * @return CreateRace
     */
    public static function create(
        string $id,
        string $time,
        int $points,
        string $name,
        string $idPilot,
        string $bestTime
    ): CreateRace {
        return new CreateRace(
            $id,
            $time,
            $points,
            $name,
            $idPilot,
            $bestTime
        );
    }

    public static function random()
    {
        return self::create(
            IdMother::random()->value(),
            TimeMother::random()->value(),
            PointsMother::random()->value(),
            RaceNameMother::random()->value(),
            IdPilotMother::random()->value(),
            TimeMother::random()->value()
        );
    }
}
