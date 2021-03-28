<?php

declare(strict_types=1);

namespace DevAway\Tests\Mother\KartCompetition\Competition\Domain\Entity;

use DevAway\KartCompetition\Competition\Domain\Entity\Race;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Id;
use DevAway\KartCompetition\Competition\Domain\ValueObject\IdPilot;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Laps;
use DevAway\KartCompetition\Competition\Domain\ValueObject\RaceName;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\IdMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\IdPilotMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\LapsMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\RaceNameMother;

class RaceMother
{
    /**
     * @param Id|null $id
     * @param RaceName $name
     * @param IdPilot $idPilot
     * @param Laps $laps
     * @return Race
     */
    public static function create(
        ?Id $id,
        RaceName $name,
        IdPilot $idPilot,
        Laps $laps
    ): Race {
        return Race::instantiate(
            $id,
            $name,
            $idPilot,
            $laps
        );
    }

    /**
     * @return Race
     */
    public static function random(): Race
    {
        return self::create(
            IdMother::random(),
            RaceNameMother::random(),
            IdPilotMother::random(),
            LapsMother::random()
        );
    }

    /**
     * @param int $race
     * @return Race[]
     */
    public static function randomArray(int $race = 1): array
    {
        return array_map(
            fn() => static::random(),
            array_fill(0, $race, null)
        );
    }
}
