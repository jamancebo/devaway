<?php

declare(strict_types=1);

namespace DevAway\Tests\Mother\KartCompetition\Competition\Domain\Entity;

use DevAway\KartCompetition\Competition\Domain\Entity\Clasification;
use DevAway\KartCompetition\Competition\Domain\ValueObject\IdPilot;
use DevAway\KartCompetition\Competition\Domain\ValueObject\PilotName;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Points;
use DevAway\KartCompetition\Competition\Domain\ValueObject\RaceName;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Time;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\IdPilotMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\PilotNameMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\PointsMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\RaceNameMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\TimeMother;

class ClasificationMother
{
    /**
     * @param RaceName|null $raceName
     * @param IdPilot $idPilot
     * @param PilotName $pilotName
     * @param Time|null $bestTime
     * @param Time $totalTime
     * @param Points $points
     * @return Clasification
     */
    public static function create(
        ?RaceName $raceName,
        IdPilot $idPilot,
        PilotName $pilotName,
        ?Time $bestTime,
        Time $totalTime,
        Points $points
    ): Clasification {
        return Clasification::instantiate(
            $raceName,
            $idPilot,
            $pilotName,
            $bestTime,
            $totalTime,
            $points
        );
    }

    /**
     * @return Clasification
     */
    public static function random(): Clasification
    {
        return self::create(
            RaceNameMother::random(),
            IdPilotMother::random(),
            PilotNameMother::random(),
            TimeMother::bestTimeRandom(),
            TimeMother::create(TimeMother::BESTTIME),
            PointsMother::random()
        );
    }
}
