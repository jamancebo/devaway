<?php

declare(strict_types=1);

namespace DevAway\Tests\Unit\KartCompetition\Competition\Domain\Service;

use DevAway\KartCompetition\Competition\Domain\Service\GetBestTimeRace;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Time;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\Entity\RaceMother;
use DevAway\Tests\Unit\KartCompetition\Competition\Infrastructure\PhpUnit\CompetitionModuleUnitCase;

class GetBestTimeRaceTest extends CompetitionModuleUnitCase
{
    public function testBestTimeRace()
    {
        $race = RaceMother::random();
        $getBestTimeRace = new GetBestTimeRace();
        $time = $getBestTimeRace->execute($race->laps());

        $this->assertInstanceOf(Time::class, $time);
        $this->assertEquals($race->bestTime(), $time);
    }
}
