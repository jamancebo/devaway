<?php

declare(strict_types=1);

namespace DevAway\Tests\Unit\KartCompetition\Competition\Application\Command\Handler;

use DevAway\KartCompetition\Competition\Application\Command\Handler\FindAllRaceHandler;
use DevAway\KartCompetition\Competition\Domain\Entity\Race;
use DevAway\KartCompetition\Competition\Domain\Exception\RaceNotFound;
use DevAway\Tests\Mother\KartCompetition\Competition\Application\Command\ListRaceMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\Entity\RaceMother;
use DevAway\Tests\Unit\KartCompetition\Competition\Infrastructure\PhpUnit\CompetitionModuleUnitCase;

class ListRaceByCriteriaTest extends CompetitionModuleUnitCase
{
    private FindAllRaceHandler $handler;
    public const ID = '203513b1-0836-360f-a4af-c25b6cf31111' ;

    public function setUp(): void
    {
        parent::setUp();
        $this->handler = new FindAllRaceHandler($this->raceRepository());
    }

    public function testFindRaces()
    {
        $command = ListRaceMother::withoutCriteria();

        $this->shouldFindListRaces(RaceMother::randomArray(2));

        $list = $this->handler->handler($command);

        $this->assertIsArray($list);
        foreach ($list as $race) {
            $this->assertInstanceOf(Race::class, $race);
        }
    }

    public function testNotFoundRaces()
    {
        $this->expectException(RaceNotFound::class);
        $this->expectExceptionCode(404);

        $this->shouldNotFindByRaces();

        $list = $this->handler->handler(ListRaceMother::random());
    }
}
