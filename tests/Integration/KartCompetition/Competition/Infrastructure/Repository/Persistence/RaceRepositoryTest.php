<?php

declare(strict_types=1);

namespace DevAway\Tests\Integration\KartCompetition\Competition\Infrastructure\Repository\Persistence;

use DevAway\KartCompetition\Competition\Domain\Entity\Race;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Id;
use DevAway\KartCompetition\Competition\Domain\ValueObject\IdPilot;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Laps;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Points;
use DevAway\KartCompetition\Competition\Domain\ValueObject\RaceName;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Time;
use DevAway\Tests\Integration\KartCompetition\Competition\Infrastructure\DataFixtures\RaceFixture;
use DevAway\Tests\Integration\KartCompetition\Competition\Infrastructure\PhpUnit\CompetitionModuleIntegrationTestCase;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\Criteria\CriteriaMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\Criteria\FilterMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\Criteria\FiltersMother;
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
        $this->assertInstanceOf(RaceName::class, $createdRace->name());
        $this->assertInstanceOf(Laps::class, $createdRace->laps());

        $this->assertEquals($race->id()->value(), $createdRace->id()->value());
        $this->assertEquals($race->idPilot()->value(), $createdRace->idPilot()->value());
        $this->assertEquals($race->name()->value(), $createdRace->name()->value());
        $this->assertEquals($race->laps()->values(), $createdRace->laps()->values());
        $this->assertEquals($race->bestTime()->value(), $createdRace->bestTime()->value());
        $this->assertEquals($race->totalTime()->value(), $createdRace->totalTime()->value());
        $this->assertEquals($race->points()->value(), $createdRace->points()->value());
    }

    public function testFindByRaces()
    {
        $criteria = CriteriaMother::create(
            FiltersMother::create([
                FilterMother::create('id', RaceFixture::ID)
            ])
        );

        $races = $this->repository()->findBy($criteria);

        foreach ($races as $race) {
            $this->assertInstanceOf(Id::class, $race->id());
            $this->assertInstanceOf(IdPilot::class, $race->idPilot());
            $this->assertInstanceOf(RaceName::class, $race->name());
            $this->assertInstanceOf(Laps::class, $race->laps());
            $this->assertInstanceOf(Time::class, $race->bestTime());
            $this->assertInstanceOf(Time::class, $race->totalTime());
            $this->assertInstanceOf(Points::class, $race->points());
        }
    }

    public function testFindtRace()
    {
        $race = $this->repository()->find(Id::fromString(RaceFixture::ID));

        $this->assertInstanceOf(Id::class, $race->id());
        $this->assertInstanceOf(IdPilot::class, $race->idPilot());
        $this->assertInstanceOf(RaceName::class, $race->name());
        $this->assertInstanceOf(Laps::class, $race->laps());
        $this->assertInstanceOf(Time::class, $race->bestTime());
        $this->assertInstanceOf(Time::class, $race->totalTime());
        $this->assertInstanceOf(Points::class, $race->points());
    }

    public function testListRaces()
    {
        $races = $this->repository()->list();

        $this->assertIsArray($races);
        foreach ($races as $race) {
            $this->assertInstanceOf(Id::class, $race->id());
            $this->assertInstanceOf(IdPilot::class, $race->idPilot());
            $this->assertInstanceOf(RaceName::class, $race->name());
            $this->assertInstanceOf(Laps::class, $race->laps());
            $this->assertInstanceOf(Time::class, $race->bestTime());
            $this->assertInstanceOf(Time::class, $race->totalTime());
            $this->assertInstanceOf(Points::class, $race->points());
        }
    }

}
