<?php

declare(strict_types=1);

namespace DevAway\Tests\Unit\KartCompetition\Competition\Domain\Entity;

use DevAway\KartCompetition\Competition\Domain\Entity\Race;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\IdMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\IdPilotMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\LapsMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\PointsMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\RaceNameMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\TimeMother;
use DevAway\Tests\Unit\KartCompetition\Competition\Infrastructure\PhpUnit\CompetitionModuleUnitCase;

class RaceTest extends CompetitionModuleUnitCase
{
    public function testIniciate()
    {
        $id = IdMother::random();
        $raceName = RaceNameMother::random();
        $idPilot = IdPilotMother::random();
        $laps = LapsMother::random();
        $bestTime = TimeMother::random();
        $totalTime = TimeMother::random();
        $points = PointsMother::random();

        $race = Race::instantiate(
            $id,
            $raceName,
            $idPilot,
            $laps,
            $bestTime,
            $totalTime,
            $points
        );

        $this->assertInstanceOf(Race::class, $race);
        $this->assertEquals($id, $race->id());
        $this->assertEquals($raceName, $race->name());
        $this->assertEquals($idPilot, $race->idPilot());
        $this->assertEquals($laps, $race->laps());
        $this->assertEquals($bestTime, $race->bestTime());
        $this->assertEquals($totalTime, $race->totalTime());
        $this->assertEquals($points, $race->points());
    }
}
