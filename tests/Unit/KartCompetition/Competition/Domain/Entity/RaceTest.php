<?php

declare(strict_types=1);

namespace DevAway\Tests\Unit\KartCompetition\Competition\Domain\Entity;

use DevAway\KartCompetition\Competition\Domain\Entity\Race;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\IdMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\IdPilotMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\PointsMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\RaceNameMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\TimeMother;
use DevAway\Tests\Unit\KartCompetition\Competition\Infrastructure\PhpUnit\CompetitionModuleUnitCase;

class RaceTest extends CompetitionModuleUnitCase
{
    public function testIniciate()
    {
        $id = IdMother::random();
        $time = TimeMother::random();
        $points = PointsMother::random();
        $raceName = RaceNameMother::random();
        $idPilot = IdPilotMother::random();
        $bestTime = TimeMother::random();

        $race = Race::instantiate(
            $id,
            $time,
            $points,
            $raceName,
            $idPilot,
            $bestTime
        );

        $this->assertInstanceOf(Race::class, $race);
        $this->assertEquals($id, $race->id());
        $this->assertEquals($time, $race->time());
        $this->assertEquals($points, $race->points());
        $this->assertEquals($raceName, $race->name());
        $this->assertEquals($idPilot, $race->idPilot());
        $this->assertEquals($bestTime, $race->bestTime());
    }
}
