<?php

declare(strict_types=1);

namespace DevAway\Tests\Mother\KartCompetition\Competition\Domain\Entity;

use DevAway\KartCompetition\Competition\Domain\Entity\Pilot;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Age;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Id;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Photo;
use DevAway\KartCompetition\Competition\Domain\ValueObject\PilotName;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Team;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\AgeMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\IdMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\PhotoMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\PilotNameMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\TeamMother;

class PilotMother
{
    /**
     * @param Id|null $id
     * @param Photo $photo
     * @param Team $team
     * @param PilotName $name
     * @param Age $age
     * @return Pilot
     */
    public static function create(
        ?Id $id,
        Photo $photo,
        Team $team,
        PilotName $name,
        Age $age
    ): Pilot {
        return Pilot::instantiate($id, $photo, $team, $name, $age);
    }

    /**
     * @return Pilot
     */
    public static function random(): Pilot
    {
        return self::create(
            IdMother::random(),
            PhotoMother::random(),
            TeamMother::random(),
            PilotNameMother::random(),
            AgeMother::random()
        );
    }
}
