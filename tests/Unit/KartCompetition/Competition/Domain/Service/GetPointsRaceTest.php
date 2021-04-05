<?php

declare(strict_types=1);

namespace DevAway\Tests\Unit\KartCompetition\Competition\Domain\Service;

use DevAway\KartCompetition\Competition\Domain\Service\GetPointsRace;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Points;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\Entity\RaceMother;
use DevAway\Tests\Unit\KartCompetition\Competition\Infrastructure\PhpUnit\CompetitionModuleUnitCase;

class GetPointsRaceTest extends CompetitionModuleUnitCase
{
    private GetPointsRace $service;

    public function setUp(): void
    {
        parent::setUp();
        $this->service = new GetPointsRace($this->raceRepository());
    }
    public function testGetTotalTimeRace()
    {
        $race = RaceMother::random();
        $this->shouldNotFindByRaces();
        $points = $this->service->execute($race->name(), $race->bestTime());

        $this->assertInstanceOf(Points::class, $points);
        $this->assertEquals(25, $points->value());
    }
}
