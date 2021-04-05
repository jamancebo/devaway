<?php

declare(strict_types=1);

namespace DevAway\Tests\Unit\KartCompetition\Competition\Application\Command\Handler;

use DevAway\KartCompetition\Competition\Application\Command\Handler\CreateRaceHandler;
use DevAway\KartCompetition\Competition\Domain\Exception\PilotNotFound;
use DevAway\Tests\Mother\KartCompetition\Competition\Application\Command\CreateRaceMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\Entity\RaceMother;
use DevAway\Tests\Unit\KartCompetition\Competition\Infrastructure\PhpUnit\CompetitionModuleUnitCase;

class CreateRaceTest extends CompetitionModuleUnitCase
{
    private CreateRaceHandler $handler;

    public function setUp(): void
    {
        parent::setUp();
        $this->handler = new CreateRaceHandler($this->raceRepository(), $this->pilotRepository());
    }

    public function testCreateRace()
    {
        $command = CreateRaceMother::random();

        $this->shouldCreateRace();
        $this->shouldFindListRaces(RaceMother::randomArray(2));
        $this->shouldUpdateRace();

        $createdRaces = $this->handler->handle($command);

        foreach ($createdRaces as $key => $createRace) {
            $this->assertEquals($command->idPilot(), $createRace->idPilot()->value());
            $this->assertEquals($command->races()[$key]["name"], $createRace->name()->value());
        }
    }
}
