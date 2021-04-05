<?php

declare(strict_types=1);

namespace DevAway\Tests\Unit\KartCompetition\Competition\Application\Command\Handler;

use DevAway\KartCompetition\Competition\Application\Command\Handler\FindAllRaceHandler;
use DevAway\KartCompetition\Competition\Domain\Entity\Race;
use DevAway\KartCompetition\Competition\Domain\Exception\RaceNotFound;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Id;
use DevAway\KartCompetition\Competition\Domain\ValueObject\IdPilot;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Laps;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Points;
use DevAway\KartCompetition\Competition\Domain\ValueObject\RaceName;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Time;
use DevAway\Tests\Mother\KartCompetition\Competition\Application\Command\ListRaceMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\Entity\RaceMother;
use DevAway\Tests\Unit\KartCompetition\Competition\Infrastructure\PhpUnit\CompetitionModuleUnitCase;

class ListRaceByCriteriaTest extends CompetitionModuleUnitCase
{
    private FindAllRaceHandler $handler;

    public function setUp(): void
    {
        parent::setUp();
        $this->handler = new FindAllRaceHandler($this->raceRepository());
    }

    public function testFindRaces()
    {
        $command = ListRaceMother::withoutCriteria();

        $this->shouldFindListRaces(RaceMother::randomArray(2));

        $list = $this->handler->handle($command);

        $this->assertIsArray($list);
        foreach ($list as $race) {
            $this->assertInstanceOf(Race::class, $race);
            $this->assertInstanceOf(Id::class, $race->id());
            $this->assertInstanceOf(IdPilot::class, $race->idPilot());
            $this->assertInstanceOf(RaceName::class, $race->name());
            $this->assertInstanceOf(Laps::class, $race->laps());
            $this->assertInstanceOf(Time::class, $race->bestTime());
            $this->assertInstanceOf(Time::class, $race->totalTime());
            $this->assertInstanceOf(Points::class, $race->points());
        }
    }

    public function testNotFoundRaces()
    {
        $this->expectException(RaceNotFound::class);
        $this->expectExceptionCode(404);

        $this->shouldNotFindByRaces();

        $list = $this->handler->handle(ListRaceMother::random());

        $this->assertEquals([], $list);
    }
}
