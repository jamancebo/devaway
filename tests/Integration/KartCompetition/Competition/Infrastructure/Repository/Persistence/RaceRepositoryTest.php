<?php

declare(strict_types=1);

namespace DevAway\Tests\Integration\KartCompetition\Competition\Infrastructure\Repository\Persistence;

use DevAway\KartCompetition\Competition\Domain\Entity\Race;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Id;
use DevAway\KartCompetition\Competition\Domain\ValueObject\IdPilot;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Points;
use DevAway\KartCompetition\Competition\Domain\ValueObject\RaceName;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Time;
use DevAway\Tests\Integration\KartCompetition\Competition\Infrastructure\PhpUnit\CompetitionModuleIntegrationTestCase;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\Entity\RaceMother;

class RaceRepositoryTest extends CompetitionModuleIntegrationTestCase
{
    public function testFindAndCreate()
    {
        $race = RaceMother::random();
        $this->repository()->create($race);

        $createdRace = $this->repository()->find($race->id());

        $this->assertIsObject($createdRace);
        $this->assertInstanceOf(Race::class, $createdRace);

        $this->assertInstanceOf(Id::class, $createdRace->id());
        $this->assertInstanceOf(IdPilot::class, $createdRace->idPilot());
        $this->assertInstanceOf(Points::class, $createdRace->points());
        $this->assertInstanceOf(RaceName::class, $createdRace->name());
        $this->assertInstanceOf(Time::class, $createdRace->time());

        $this->assertEquals($race->id()->value(), $createdRace->id()->value());
        $this->assertEquals($race->idPilot()->value(), $createdRace->idPilot()->value());
        $this->assertEquals($race->points()->value(), $createdRace->points()->value());
        $this->assertEquals($race->name()->value(), $createdRace->name()->value());
        $this->assertEquals($race->time()->value(), $createdRace->time()->value());
        $this->assertEquals($race->bestTime()->value(), $createdRace->bestTime()->value());
    }
}
