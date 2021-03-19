<?php

declare(strict_types=1);

namespace DevAway\Tests\Unit\KartCompetition\Competition\Infrastructure\PhpUnit;

use DevAway\KartCompetition\Competition\Domain\Repository\RaceRepository;
use DevAway\Tests\Unit\KartCompetition\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Mockery\MockInterface;

class CompetitionModuleUnitCase extends UnitTestCase
{
    private RaceRepository $raceRepository;

    /**
     * @return RaceRepository|MockInterface
     */
    protected function raceRepository(): MockInterface
    {
        if (empty($this->raceRepository)) {
            $this->raceRepository = $this->mock(RaceRepository::class);
        }
        return $this->raceRepository;
    }
}
