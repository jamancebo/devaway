<?php

declare(strict_types=1);

namespace DevAway\Tests\Unit\KartCompetition\Competition\Application\Command\Handler;

use DevAway\KartCompetition\Competition\Application\Command\Handler\CreatePilotHandler;
use DevAway\KartCompetition\Competition\Application\Exception\PilotExists;
use DevAway\KartCompetition\Competition\Domain\Entity\Pilot;
use DevAway\Tests\Mother\KartCompetition\Competition\Application\Command\CreatePilotMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\Criteria\CriteriaMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\Criteria\FiltersMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\Entity\PilotMother;
use DevAway\Tests\Unit\KartCompetition\Competition\Infrastructure\PhpUnit\CompetitionModuleUnitCase;

class CreatePilotTest extends CompetitionModuleUnitCase
{
    private CreatePilotHandler $handler;

    public function setUp(): void
    {
        parent::setUp();
        $this->handler = new CreatePilotHandler($this->pilotRepository());
    }

    public function testCreatePilot()
    {
        $command = CreatePilotMother::random();

        $this->shouldNotFindPilot();
        $this->shouldCreatePilot();

        $pilot = $this->handler->handle($command);

        $this->assertEquals($command->id(), $pilot->id()->value());
        $this->assertEquals($command->photo(), $pilot->photo()->value());
        $this->assertEquals($command->team(), $pilot->team()->value());
        $this->assertEquals($command->name(), $pilot->name()->value());
        $this->assertEquals($command->age(), $pilot->age()->value());
    }

    public function testCreatePilotExisting()
    {
        $command = CreatePilotMother::random();

        $this->expectException(PilotExists::class);
        $this->shouldFindPilot(PilotMother::randomArray());

        $this->handler->handle($command);
    }
}
