<?php

declare(strict_types=1);

namespace DevAway\Tests\Unit\KartCompetition\Competition\Infrastructure\PhpUnit;

use DevAway\KartCompetition\Competition\Domain\Entity\Pilot;
use DevAway\KartCompetition\Competition\Domain\Repository\PilotRepository;
use DevAway\KartCompetition\Competition\Domain\Repository\RaceRepository;
use DevAway\Tests\Unit\KartCompetition\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Mockery\MockInterface;

class CompetitionModuleUnitCase extends UnitTestCase
{
    private RaceRepository $raceRepository;
    private PilotRepository $pilotRepository;

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

    /**
     * @return PilotRepository|MockInterface
     */
    protected function pilotRepository(): MockInterface
    {
        if (empty($this->pilotRepository)) {
            $this->pilotRepository = $this->mock(PilotRepository::class);
        }
        return $this->pilotRepository;
    }

    /**
     * @return void
     */
    public function shouldNotFindPilot(): void
    {
        $this->pilotRepository()
            ->shouldReceive('findBy')
            ->once()
            ->andReturn([]);
    }

    /**
     * @param array $array
     * @return void
     */
    public function shouldFindPilot(array $array): void
    {
        $this->pilotRepository()
            ->shouldReceive('findBy')
            ->once()
            ->andReturn($array);
    }

    /**
     * @return void
     */
    public function shouldCreateRace(): void
    {
        $this->raceRepository()
            ->shouldReceive('create');
    }

    /**
     * @return void
     */
    public function shouldCreatePilot(): void
    {
        $this->pilotRepository()
            ->shouldReceive('create')
            ->once();
    }

    /**
     * @param array $races
     * @return void
     */
    public function shouldFindListRaces(array $races): void
    {
        $this->raceRepository()
            ->shouldReceive('findBy')
            ->andReturn($races);
    }

    /**
     * @return void
     */
    public function shouldNotFindByRaces(): void
    {
        $this->raceRepository()
            ->shouldReceive('findBy')
            ->once()
            ->andReturn([]);
    }

    /**
     * @return void
     */
    public function shouldUpdateRace(): void
    {
        $this->raceRepository()
            ->shouldReceive('update');
    }

    /**
     * @param Pilot $pilot
     * @return void
     */
    public function shouldFindOnePilot(Pilot $pilot): void
    {
        $this->pilotRepository()
            ->shouldReceive('find')
            ->once()
            ->andReturn($pilot);
    }

    /**
     * @return void
     */
    public function shouldNotFindOnePilot(): void
    {
        $this->pilotRepository()
            ->shouldReceive('find')
            ->once()
            ->andReturn(null);
    }
}
