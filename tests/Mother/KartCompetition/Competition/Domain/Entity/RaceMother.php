<?php

declare(strict_types=1);

namespace DevAway\Tests\Mother\KartCompetition\Competition\Domain\Entity;

use DevAway\KartCompetition\Competition\Domain\Entity\Race;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Id;
use DevAway\KartCompetition\Competition\Domain\ValueObject\IdPilot;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Points;
use DevAway\KartCompetition\Competition\Domain\ValueObject\RaceName;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Time;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\IdMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\IdPilotMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\PointsMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\RaceNameMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\TimeMother;

class RaceMother
{
    /**
     * @param Id|null $id
     * @param Time $time
     * @param Points $points
     * @param RaceName $name
     * @param IdPilot $idPilot
     * @param Time $bestTime
     * @return Race
     */
    public static function create(
        ?Id $id,
        Time $time,
        Points $points,
        RaceName $name,
        IdPilot $idPilot,
        Time $bestTime
    ): Race {
        return Race::instantiate(
            $id,
            $time,
            $points,
            $name,
            $idPilot,
            $bestTime
        );
    }

    /**
     * @return Race
     */
    public static function random(): Race
    {
        return self::create(
            IdMother::random(),
            TimeMother::random(),
            PointsMother::random(),
            RaceNameMother::random(),
            IdPilotMother::random(),
            TimeMother::random()
        );
    }
}
