<?php

declare(strict_types=1);

namespace DevAway\Tests\Unit\KartCompetition\Competition\Domain\Service;

use DevAway\KartCompetition\Competition\Domain\Service\GetTotalTimeRace;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Time;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\Entity\RaceMother;
use DevAway\Tests\Unit\KartCompetition\Competition\Infrastructure\PhpUnit\CompetitionModuleUnitCase;

class GetTotalTimeRaceTest extends CompetitionModuleUnitCase
{
    public function testgetGetTotalTimeRace()
    {
        $race = RaceMother::random();
        $getTotalTimeRace = new GetTotalTimeRace();
        $time = $getTotalTimeRace->execute($race->laps());

        $this->assertInstanceOf(Time::class, $time);
    }
}
