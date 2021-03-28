<?php

declare(strict_types=1);

namespace DevAway\Tests\Mother\KartCompetition\Competition\Application\Command;

use DevAway\KartCompetition\Competition\Application\Command\CreateRace;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\IdPilotMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\RaceNameMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\TimeMother;

class CreateRaceMother
{
    /**
     * @param string $idPilot
     * @param array $race
     * @return CreateRace
     */
    public static function create(
        string $idPilot,
        array $race
    ): CreateRace {
        return new CreateRace(
            $idPilot,
            $race
        );
    }

    public static function random()
    {
        return self::create(
            IdPilotMother::random()->value(),
            self::race()
        );
    }

    public static function race(): array
    {
        return [
            [
                'name' => RaceNameMother::random()->value(),
                'laps' => [
                    [
                        'time' => TimeMother::random()->value()
                    ],
                    [
                        'time' => TimeMother::random()->value()
                    ]
                ]
            ]
        ];
    }
}
