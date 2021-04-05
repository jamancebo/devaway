<?php

declare(strict_types=1);

namespace DevAway\Tests\Unit\KartCompetition\Competition\Domain\Entity;

use DevAway\KartCompetition\Competition\Domain\Entity\Clasification;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\IdPilotMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\PilotNameMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\PointsMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\RaceNameMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\TimeMother;
use DevAway\Tests\Unit\KartCompetition\Competition\Infrastructure\PhpUnit\CompetitionModuleUnitCase;

class ClasificationTest extends CompetitionModuleUnitCase
{
    public function testIniciate()
    {
        $raceName = RaceNameMother::random();
        $idPilot = IdPilotMother::random();
        $pilotName = PilotNameMother::random();
        $bestTime = TimeMother::random();
        $totalTime = TimeMother::random();
        $points = PointsMother::random();

        $clasification = Clasification::instantiate(
            $raceName,
            $idPilot,
            $pilotName,
            $bestTime,
            $totalTime,
            $points
        );

        $this->assertInstanceOf(Clasification::class, $clasification);
        $this->assertEquals($raceName, $clasification->raceName());
        $this->assertEquals($idPilot, $clasification->idPilot());
        $this->assertEquals($pilotName, $clasification->pilotName());
        $this->assertEquals($bestTime, $clasification->bestTime());
        $this->assertEquals($totalTime, $clasification->totalTime());
        $this->assertEquals($points, $clasification->points());
    }
}
