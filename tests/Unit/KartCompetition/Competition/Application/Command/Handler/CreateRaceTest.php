<?php

declare(strict_types=1);

namespace DevAway\Tests\Unit\KartCompetition\Competition\Application\Command\Handler;

use DevAway\KartCompetition\Competition\Application\Command\Handler\CreateRaceHandler;
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

    }
}
