<?php

declare(strict_types=1);

namespace DevAway\Tests\Unit\KartCompetition\Competition\Application\Command\Handler;

use DevAway\KartCompetition\Competition\Application\Command\Handler\FindPilotHandler;
use DevAway\KartCompetition\Competition\Domain\Entity\Pilot;
use DevAway\KartCompetition\Competition\Domain\Exception\PilotNotFound;
use DevAway\Tests\Mother\KartCompetition\Competition\Application\Command\FindPilotMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\Entity\PilotMother;
use DevAway\Tests\Unit\KartCompetition\Competition\Infrastructure\PhpUnit\CompetitionModuleUnitCase;

class FindPilotHandlerTest extends CompetitionModuleUnitCase
{
    private FindPilotHandler $handler;

    public function setUp(): void
    {
        parent::setUp();
        $this->handler = new FindPilotHandler($this->pilotRepository());
    }

    public function testFindPilot()
    {
        $command = FindPilotMother::random();
        $pilot = PilotMother::random();

        $this->shouldFindOnePilot($pilot);
        $foundPilot = $this->handler->handle($command);

        $this->assertInstanceOf(Pilot::class, $foundPilot);
        $this->assertEquals($foundPilot->id(), $pilot->id());
        $this->assertEquals($foundPilot->photo(), $pilot->photo());
        $this->assertEquals($foundPilot->team(), $pilot->team());
        $this->assertEquals($foundPilot->name(), $pilot->name());
        $this->assertEquals($foundPilot->age(), $pilot->age());
    }

    public function testNotFoundPilot()
    {
        $this->expectException(PilotNotFound::class);
        $this->expectExceptionCode(404);

        $this->shouldNotFindOnePilot();

        $pilot = $this->handler->handle(FindPilotMother::random());

        $this->expectException(PilotNotFound::class);
    }
}
