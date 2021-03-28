<?php

declare(strict_types=1);

namespace DevAway\Tests\Unit\KartCompetition\Competition\Application\Command\Handler;

use DevAway\KartCompetition\Competition\Application\Command\Handler\CreateRaceHandler;
use DevAway\KartCompetition\Competition\Application\Exception\RaceExists;
use DevAway\KartCompetition\Shared\Domain\Criteria\Filters;
use DevAway\Tests\Mother\KartCompetition\Competition\Application\Command\CreateRaceMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\Criteria\CriteriaMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\Criteria\FiltersMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\Entity\RaceMother;
use DevAway\Tests\Unit\KartCompetition\Competition\Infrastructure\PhpUnit\CompetitionModuleUnitCase;

class CreateRaceTest extends CompetitionModuleUnitCase
{
    private CreateRaceHandler $handler;

    public function setUp(): void
    {
        parent::setUp();
        $this->handler = new CreateRaceHandler($this->raceRepository());
    }

    public function testCreateRace()
    {
        $command = CreateRaceMother::random();

        $this->shouldNotFindRace();
        $this->shouldCreateRace();

        $createdRace = $this->handler->handle($command);

        $this->assertEquals($command->name(), $createdRace->name()->value());
        $this->assertEquals($command->idPilot(), $createdRace->idPilot()->value());
        $this->assertEquals($command->laps(), $createdRace->laps()->values());
    }

    public function testCreateRaceExisting()
    {
        $command = CreateRaceMother::random();
        $criteria = CriteriaMother::create(FiltersMother::random());

        $this->expectException(RaceExists::class);
        $this->shouldFindRace($criteria);

        $this->handler->handle($command);
    }
}
