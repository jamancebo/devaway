<?php

declare(strict_types=1);

namespace DevAway\Tests\Unit\KartCompetition\Competition\Infrastructure\PhpUnit;

use DevAway\KartCompetition\Competition\Domain\Entity\Race;
use DevAway\KartCompetition\Competition\Domain\Repository\PilotRepository;
use DevAway\KartCompetition\Competition\Domain\Repository\RaceRepository;
use DevAway\KartCompetition\Shared\Domain\Criteria\Criteria;
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
    public function shouldNotFindRace(): void
    {
        $this->raceRepository()
            ->shouldReceive('findBy')
            ->once();
    }

    /**
     * @return void
     */
    public function shouldNotFindPilot(): void
    {
        $this->pilotRepository()
            ->shouldReceive('findBy')
            ->once();
    }

    /**
     * @param $criteria
     */
    public function shouldFindRace(Criteria $criteria): void
    {
        $this->raceRepository()
            ->shouldReceive('findBy')
            ->once()
            ->andReturn(['race' => 'found']);
    }

    /**
     * @param $criteria
     */
    public function shouldFindPilot(Criteria $criteria): void
    {
        $this->pilotRepository()
            ->shouldReceive('findBy')
            ->once()
            ->andReturn(['pilot' => 'found']);
    }

    /**
     * @return void
     */
    public function shouldCreateRace(): void
    {
        $this->raceRepository()
            ->shouldReceive('create')
            ->once();
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
            ->once()
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
}
