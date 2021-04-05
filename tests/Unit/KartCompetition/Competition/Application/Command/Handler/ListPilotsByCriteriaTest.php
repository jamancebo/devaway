<?php

declare(strict_types=1);

namespace DevAway\Tests\Unit\KartCompetition\Competition\Application\Command\Handler;

use DevAway\KartCompetition\Competition\Application\Command\Handler\ListPilotsByCriteriaHandler;
use DevAway\KartCompetition\Competition\Domain\Entity\Pilot;
use DevAway\KartCompetition\Competition\Domain\Exception\PilotNotFound;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Age;
use DevAway\KartCompetition\Competition\Domain\ValueObject\IdPilot;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Photo;
use DevAway\KartCompetition\Competition\Domain\ValueObject\PilotName;
use DevAway\KartCompetition\Competition\Domain\ValueObject\Team;
use DevAway\Tests\Mother\KartCompetition\Competition\Application\Command\ListPilotsMother;
use DevAway\Tests\Mother\KartCompetition\Competition\Domain\Entity\PilotMother;
use DevAway\Tests\Unit\KartCompetition\Competition\Infrastructure\PhpUnit\CompetitionModuleUnitCase;

class ListPilotsByCriteriaTest extends CompetitionModuleUnitCase
{
    private ListPilotsByCriteriaHandler $handler;

    public function setUp(): void
    {
        parent::setUp();
        $this->handler = new ListPilotsByCriteriaHandler($this->pilotRepository());
    }

    public function testListPilot()
    {
        $command = ListPilotsMother::withoutCriteria();

        $this->shouldFindPilot(PilotMother::randomArray(2));

        $list = $this->handler->handle($command);

        $this->assertIsArray($list);
        foreach ($list as $pilot) {
            $this->assertInstanceOf(Pilot::class, $pilot);
            $this->assertInstanceOf(IdPilot::class, $pilot->id());
            $this->assertInstanceOf(Photo::class, $pilot->photo());
            $this->assertInstanceOf(Team::class, $pilot->team());
            $this->assertInstanceOf(PilotName::class, $pilot->name());
            $this->assertInstanceOf(Age::class, $pilot->age());
        }
    }

    public function testNotFoundPilot()
    {
        $this->expectException(PilotNotFound::class);
        $this->expectExceptionCode(404);

        $this->shouldNotFindPilot();

        $list = $this->handler->handle(ListPilotsMother::random());

        $this->assertEquals([], $list);
    }
}
