<?php

declare(strict_types=1);

namespace DevAway\Tests\Unit\KartCompetition\Competition\Domain\Entity;

use DevAway\KartCompetition\Competition\Domain\Entity\Pilot;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\AgeMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\IdPilotMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\PhotoMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\PilotNameMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\ValueObject\TeamMother;
use DevAway\Tests\Unit\KartCompetition\Competition\Infrastructure\PhpUnit\CompetitionModuleUnitCase;

class PilotTest extends CompetitionModuleUnitCase
{
    public function testIniciate()
    {
        $id = IdPilotMother::random();
        $photo = PhotoMother::random();
        $team = TeamMother::random();
        $name = PilotNameMother::random();
        $age = AgeMother::random();

        $pilot = Pilot::instantiate(
            $id,
            $photo,
            $team,
            $name,
            $age
        );
        $this->assertInstanceOf(Pilot::class, $pilot);
        $this->assertEquals($id, $pilot->id());
        $this->assertEquals($photo, $pilot->photo());
        $this->assertEquals($team, $pilot->team());
        $this->assertEquals($name, $pilot->name());
        $this->assertEquals($age, $pilot->age());
    }
}
