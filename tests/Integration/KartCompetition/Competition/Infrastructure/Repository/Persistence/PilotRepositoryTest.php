<?php

declare(strict_types=1);

namespace DevAway\Tests\Integration\KartCompetition\Competition\Infrastructure\Repository\Persistence;

use DevAway\KartCompetition\Competition\Domain\Entity\Pilot;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Age;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Id;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Photo;
use DevAway\KartCompetition\Competition\Domain\ValueObject\PilotName;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Points;
use DevAway\Tests\Integration\KartCompetition\Competition\Infrastructure\DataFixtures\PilotFixture;
use DevAway\Tests\Integration\KartCompetition\Competition\Infrastructure\PhpUnit\CompetitionModuleIntegrationTestCase;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\Criteria\CriteriaMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\Criteria\FilterMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\Criteria\FiltersMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\Entity\PilotMother;

class PilotRepositoryTest extends CompetitionModuleIntegrationTestCase
{
    public function testFindAndCreate()
    {
        $pilot = PilotMother::random();
        $this->pilotRepository()->create($pilot);

        $createdPilot = $this->pilotRepository()->find($pilot->id());

        $this->assertIsObject($createdPilot);
        $this->assertInstanceOf(Pilot::class, $createdPilot);

        $this->assertInstanceOf(Id::class, $createdPilot->id());
        $this->assertInstanceOf(Photo::class, $createdPilot->photo());
        $this->assertInstanceOf(Points::class, $createdPilot->points());
        $this->assertInstanceOf(PilotName::class, $createdPilot->name());
        $this->assertInstanceOf(Age::class, $createdPilot->age());

        $this->assertEquals($createdPilot->id(), $pilot->id());
        $this->assertEquals($createdPilot->photo(), $pilot->photo());
        $this->assertEquals($createdPilot->team(), $pilot->team());
        $this->assertEquals($createdPilot->name(), $pilot->name());
        $this->assertEquals($createdPilot->age(), $pilot->age());
        $this->assertEquals($createdPilot->points(), $pilot->points());
    }

    public function testFindBy()
    {
        $criteria = CriteriaMother::create(
            FiltersMother::create([
                FilterMother::create('id', PilotFixture::ID)
            ])
        );

        $pilots = $this->pilotRepository()->findBy($criteria);

        foreach ($pilots as $pilot) {
            $this->assertInstanceOf(Id::class, $pilot->id());
            $this->assertInstanceOf(Photo::class, $pilot->photo());
            $this->assertInstanceOf(Points::class, $pilot->points());
            $this->assertInstanceOf(PilotName::class, $pilot->name());
            $this->assertInstanceOf(Age::class, $pilot->age());
        }
    }
}
